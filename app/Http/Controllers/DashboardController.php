<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return Inertia::render("Dashboard", [
            'data' => null,
        ]);
    }
}
