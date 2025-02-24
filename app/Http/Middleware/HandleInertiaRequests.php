<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user'  => $request->user()  ? $request->user()->load('file') : null,
                'root'  => $request->user()  ? $request->user()->isSuperAdmin()  : null,
                'roles' => $request->user()  ? $request->user()->getRolesArray() : [],
                'can'   => $request->user()  ? $request->user()->getPermissionArray() : [],
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'success' => $request->session()->get('success'),
                'danger' => $request->session()->get('danger'),
                'error'   => $request->session()->get('error'),
                'isBanned' => $request->session()->get('isBanned'),
            ],
        ];
    }
}
