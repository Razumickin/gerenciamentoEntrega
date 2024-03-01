<?php

namespace App\Domains\Facades;

use App\Services\DestinarioService;
use Illuminate\Support\Facades\Facade;

class DestinatarioFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DestinarioService::class;
    }
}
