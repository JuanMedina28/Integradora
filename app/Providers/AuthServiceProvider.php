<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('mostrarAdminUser', function(User $user){
            if($user->tipo_us==1 && $user->id==1){
                return true;
            }else{
                return false;
            }
        });

        GATE::define('mostrarAdmin', function(User $user){
            if($user->tipo_us==1){
                return true;
            }else{
                return false;
            }
        });
        GATE::define('mostarAdmin&Negocio', function(User $user){
            if($user->tipo_us==1 || $user->tipo_us==2){
                return true;
            }else{
                return false;
            }
        });
        GATE::define('mostarNegocio', function(User $user){
            if($user->tipo_us==2){
                return true;
            }else{
                return false;
            }
        });
        GATE::define('mostarCliente', function(User $user){
            if($user->tipo_us==3){
                return true;
            }else{
                return false;
            }
        });
        GATE::define('mostarNegocio', function(User $user){
            if($user->tipo_us==2){
                return true;
            }else{
                return false;
            }
        });
        GATE::define('mostrarNegocio&Cliente', function(User $user){
            if($user->tipo_us==2 || $user->tipo_us==3){
                return true;
            }else{
                return false;
            }
        });

        //
    }
}
