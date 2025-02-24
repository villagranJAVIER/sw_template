<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Module;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Cache;
class RoleController extends Controller
{
    protected string $routeName;
    protected string $source;
    protected string $module = 'role';
    protected Role $model;

    public function __construct()
    {
        $this->routeName = "role.";
        $this->source    = "Security/Role/";
        $this->model     = new Role();
        $this->middleware("permission:{$this->module}.index")->only(['index', 'show']);
        $this->middleware("permission:{$this->module}.store")->only(['store', 'create']);
        $this->middleware("permission:{$this->module}.update")->only(['update', 'edit']);
        $this->middleware("permission:{$this->module}.delete")->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $direction = $request->direction ?? 'desc';
        $order = $request->order ?? 'created_at';

        $records = $this->model->query()->when($request->search, function ($query, $search) {
            if ($search != '') {

                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            }
        });

        $records = $records->orderBy($order, $direction)->paginate(8)->withQueryString()->through(
            fn ($zone) => [
                'id' => $zone->id,
                'name' => $zone->name,
                'description' => $zone->description
            ]
        );

        return Inertia::render("{$this->source}Index", [
            'title'          => 'Gestión de Roles',
            'records'        => $records,
            'routeName'      => $this->routeName,
            'search'         => $request->search ?? '',
            'direction'     => $direction
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render("{$this->source}Create", [
            'title'         => 'Agregar Roles',
            'routeName'     => $this->routeName,
            'modules'       => Module::orderBy('key')->get(['id', 'name', 'description', 'key']),
            'permissions'   => Permission::get(['id', 'name', 'description', 'module_key'])->groupBy('module_key')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());
        $role->syncPermissions($request->permissions);
        return redirect()->route("{$this->routeName}index")->with('success', 'Rol creado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return Inertia::render("{$this->source}Edit", [
            'title'         => 'Editar Roles',
            'role'          => $role->load('permissions:id,name,description,module_key'),
            'modules'       => Module::orderBy('key')->get(['id', 'name', 'description', 'key']),
            'permissions'   => Permission::get(['id', 'name', 'description', 'module_key'])->groupBy('module_key')->toArray(),
            'routeName'     => $this->routeName,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        $role->syncPermissions($request->permissions);

        Cache::forget("role.{$role->id}");
        return redirect()->route("{$this->routeName}index")->with('success', 'Rol modificado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(role $role)
    {
        Cache::forget("role.{$role->id}");
        $role->delete();
        return redirect()->route("{$this->routeName}index")->with('success', 'Rol eliminado con éxito!');
    }
}
