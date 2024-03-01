<?php

namespace App\Http\Controllers\Api;

use App\Domains\Facades\EntregaFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class EntregaController extends Controller
{
    public function index(): Response
    {

        $data = EntregaFacade::GetAllEntregas();
        return response(compact('data'));
    }
}
