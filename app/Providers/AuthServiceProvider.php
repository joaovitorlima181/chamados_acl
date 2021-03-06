<?php

namespace App\Providers;

use App\Models\Chamado;
use App\Models\Permissao;
use App\Policies\ChamadoPolicy;
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

        foreach ($this->listaPermissoes() as $permissao) {
            Gate::define($permissao->nome, function($user) use ($permissao){
                return $user->temUmPapelDestes($permissao->papeis) || $user->isSuperAdmin();
            });
        }
    }

    public function listaPermissoes()
    {
        return Permissao::with('papeis')->get();
    }
}
