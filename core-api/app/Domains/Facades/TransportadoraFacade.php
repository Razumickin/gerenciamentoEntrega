<?php

namespace App\Domains\Facades;

use App\Services\TransportadoraService;
use Illuminate\Support\Facades\Facade;

class TransportadoraFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TransportadoraService::class;
    }
}
