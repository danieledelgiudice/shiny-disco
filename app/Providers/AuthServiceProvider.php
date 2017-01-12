<?php

namespace App\Providers;

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
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->before(function ($user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });
        
        $gate->define('visualizzare-pratica', function ($user, $pratica) {
            return $user->filiale->id === $pratica->cliente->filiale->id;
        });
        
        $gate->define('creare-pratica', function ($user, $cliente) {
            return $user->filiale->id === $cliente->filiale->id;
        });

        $gate->define('modificare-pratica', function ($user, $pratica) {
            return $user->filiale->id === $pratica->cliente->filiale->id;
        });
        
        $gate->define('eliminare-pratica', function ($user, $pratica) {
            return $user->filiale->id === $pratica->cliente->filiale->id;
        });
        
        
        
        
        
        $gate->define('visualizzare-cliente', function ($user, $cliente) {
            return $user->filiale->id === $cliente->filiale->id;
        });
        
        $gate->define('modificare-cliente', function ($user, $cliente) {
            return $user->filiale->id === $cliente->filiale->id;
        });

        $gate->define('eliminare-cliente', function ($user, $cliente) {
            return $user->filiale->id === $cliente->filiale->id;
        });
    }
}
