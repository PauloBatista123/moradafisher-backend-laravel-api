<?php

namespace App\Providers;

use App\Models\Permissao;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
   /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'app\Model' => 'app\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach ($this->getPermissoes() as $permissao) {
               Gate::define($permissao->nome,
                    function($user) use ($permissao){
                        return $user->existePapel($permissao->papeis) || $user->existeAdmin();
                    }
                );
           }
    }

    public function getPermissoes()
    {
        return Permissao::with('papeis')->get();
    }
}
