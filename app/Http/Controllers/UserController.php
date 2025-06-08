<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\StoreUser;
use App\Models\ApiUser;
use Illuminate\Http\Request;
use App\Models\Module;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Traits\Filterable;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\select;

class UserController extends Controller
{
    use Filterable;
    protected string $routeName;
    protected string $source;
    protected string $module = 'user';
    protected User $model;
    private string $storage_path = 'public/photos/';

    public function __construct()
    {
        $this->routeName = "user.";
        $this->source    = "Security/User/";
        $this->model     = new User();
        $this->middleware("permission:{$this->module}.index")->only(['index', 'show']);
        $this->middleware("permission:{$this->module}.store")->only(['store', 'create']);
        $this->middleware("permission:{$this->module}.update")->only(['edit', 'update']);
        $this->middleware("permission:{$this->module}.delete")->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $filters = $this->getFiltersBase($request->query());
        $records = $this->model->with('roles')->orderBy($filters->order, $filters->direction);

        $records = $records->when($request->search, function ($query, $search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhereHas('roles', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
        });

        $records = $records->paginate(8)->withQueryString()->through(
            fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles ? $user->roles->pluck('name') : null,
            ]
        );

        return Inertia::render("{$this->source}Index", [
            'title'     => 'Gestión de Usuarios',
            'users'     => $records,
            'profiles'  => Role::get(['id', 'name']),
            'routeName' => $this->routeName,
            'filters'   => $filters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("{$this->source}Create", [
            'title'         => 'Agregar Usuarios',
            'routeName'     => $this->routeName,
            'roles'         => Role::orderBy('name')->select('id', 'name', 'description')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = $this->model::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => $request->password,
            ]);
            $user->syncRoles($request->roles);
        });
        return redirect()->route('user.index')->with('success', 'Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render("{$this->source}Edit", [
            'title'         => 'Editar Usuarios.',
            'routeName'     => $this->routeName,
            'user'          => $user->load('roles:id,name'),
            'roles'         => Role::orderBy('name')->select('id', 'name', 'description')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        DB::transaction(function () use ($request, $user) {
            $fields = $request->validated();
            if ($fields['password'] === null) {
                $user->update([
                    'name' => $fields['name'],
                    'email' => $fields['email'],
                ]);
            } else {
                $user->update([
                    'name' => $fields['name'],
                    'email' => $fields['email'],
                    'password' => $fields['password'],
                ]);
            }
            $user->syncRoles($fields['roles']);
        });

        return redirect()->route('user.index')->with('success', 'Usuario modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Usuario eliminado con éxito');
    }
}
