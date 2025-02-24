<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Author;
use App\Models\PaymentVoucher;
use App\Policies\ArticlePolicy;
use App\Policies\AuthorPolicy;
use App\Policies\PaymentVoucherPolicy;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /* Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        }); */
        // Gate::before(function ($user, $ability) {
        //     return $user->hasRole('Admin') ? true : null;
        // });
    }
}
