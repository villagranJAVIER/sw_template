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
        return Inertia::render("Welcome", [
            'title'   => 'Bienvenido',
            'routeName' => $this->routeName,
        ]);
    }
}
