<?php

namespace App\Domains\Facades;

use App\Services\RastreamentoService;
use Illuminate\Support\Facades\Facade;

class RastreamentoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RastreamentoService::class;
    }
}
