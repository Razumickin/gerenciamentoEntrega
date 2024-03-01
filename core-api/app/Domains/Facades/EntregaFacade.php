<?php

namespace App\Domains\Facades;

use App\Services\EntregaService;
use Illuminate\Support\Facades\Facade;

class EntregaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EntregaService::class;
    }
}
