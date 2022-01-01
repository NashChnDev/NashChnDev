<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
       // $this->registerPolicies();
        
        $this->registerPolicies($gate);

       $user = \Auth::user();

        
        Gate::define('super_admin', function ($user) {
            return in_array($user->role_id, [0]);
        });
        
        // Auth gates for: User management
        Gate::define('admin', function ($user) {
            return in_array($user->role_id, [1]);
        });
        
        Gate::define('super_admin_admin', function ($user) {
            return in_array($user->role_id, [0,1]);
        });
        
         Gate::define('Request_EntryOnly', function ($user) {
            return in_array($user->role_id, [2]);
        });
        
        Gate::define('Approver', function ($user) {
            return in_array($user->role_id, [3]);
        });
        
         Gate::define('Issue_EntryOnly', function ($user) {
            return in_array($user->role_id, [4]);
        });
        
         Gate::define('Return_EntryOnly', function ($user) {
            return in_array($user->role_id, [5]);
        });
        
         Gate::define('Scrap_EntryOnly', function ($user) {
            return in_array($user->role_id, [6]);
        });
        
        Gate::define('Report_Viewer', function ($user) {
            return in_array($user->role_id, [7]);
        });
        
        Gate::define('Transaction_Rights', function ($user) {
            return in_array($user->role_id, [8]);
        });
        
        

        //
    }
}
