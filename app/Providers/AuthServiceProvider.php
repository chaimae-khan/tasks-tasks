<?php

namespace App\Providers;
use App\Policies\TaskPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Task::class => TaskPolicy::class,];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('task.create', [TaskPolicy::class, 'create']);
        Gate::define('task.delete',[TaskPolicy::class, 'delete']);
        Gate::define('task.history',[TaskPolicy::class,'history']);
        Gate::define('task.getemployee',[TaskPolicy::class,'getemployee']);
    }
}
