<?php

namespace App\Http\Controllers\Api;

use App\Domains\Facades\EntregaFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function index(): Response
    {
        $data = EntregaFacade::GetAllEntregas();
        return response(compact('data'));
    }

    public function getEntrega(Request $request)
    {
        $data = EntregaFacade::GetEntregaByEntregaId($request->route('entrega_id'));
        return response(compact('data'));
    }

    public function filterEntregaByDestinarioCpf(Request $request)
    {
        $data = EntregaFacade::GetEntregaByDestinarioCpf($request->post('destinario_cpf'));
        return response(compact('data'));
    }
}
