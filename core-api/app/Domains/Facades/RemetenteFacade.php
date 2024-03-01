<?php

namespace App\Domains\Facades;

use App\Services\RemetenteService;
use Illuminate\Support\Facades\Facade;

class RemetenteFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RemetenteService::class;
    }
}
