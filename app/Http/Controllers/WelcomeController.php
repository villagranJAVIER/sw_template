<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class WelcomeController extends Controller
{
    protected string $routeName;
    protected string $source;

    public function __construct()
    {
        $this->routeName = "welcome.";
        $this->source    = "Welcome/";
    }

    public function welcome(Request $request): Response
    {
        return Inertia::render("{$this->source}Home/Index", [
            'title'   => 'Bienvenido',
            'routeName' => $this->routeName,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function committee()
    {
        return Inertia::render("{$this->source}Committee/Index", [
            'title'   => 'Comité',
            'routeName' => $this->routeName,
        ]);
    }

    public function place()
    {
        return Inertia::render("{$this->source}Place/Index", [
            'title'   => 'Lugar',
            'routeName' => $this->routeName,
        ]);
    }

    public function program()
    {
        return Inertia::render("{$this->source}Program/Index", [
            'title'   => 'Programa',
            'routeName' => $this->routeName,
        ]);
    }
}
