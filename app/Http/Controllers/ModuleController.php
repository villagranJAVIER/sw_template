<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;

use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;

class ModuleController extends Controller
{
    private Module $model;
    private string $source;
    private string $routeName;
    private string $module = 'module';

    public function __construct()
    {
        $this->middleware('auth');
        $this->source = 'Security/Module/';
        $this->model = new Module();
        $this->routeName = 'module.';

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
            fn ($module) => [
                'id' => $module->id,
                'name' => $module->name,
                'description' => $module->description,
                'key' => $module->key
            ]
        );

        return Inertia::render("{$this->source}Index", [
            'modules'   =>  $records,
            'title'     => 'Gestión de Módulos',
            'routeName' => $this->routeName,
            'search'    => $request->search ?? '',
            'direction' => $direction
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("{$this->source}Create", [
            'title'          => 'Agregar Módulos',
            'routeName'      => $this->routeName
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuleRequest $request)
    {
        Module::create($request->validated());
        return redirect()->route('module.index')->with('success', 'Módulo creado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        return Inertia::render("{$this->source}Edit", [
            'title'          => 'Editar Módulos',
            'routeName'      => $this->routeName,
            'module' => $module
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModuleRequest $request, Module $module)
    {
        $module->update($request->validated());
        return redirect()->route('module.index')->with('success', 'Módulo modificado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('module.index')->with('success', 'Módulo eliminado con éxito');
    }
}
