<?php

namespace App\Providers;

use App\Services\DestinarioService;
use App\Services\EntregaService;
use App\Services\RastreamentoService;
use App\Services\RemetenteService;
use App\Services\TransportadoraService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
