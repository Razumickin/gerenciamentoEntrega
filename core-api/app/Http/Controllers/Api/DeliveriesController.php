<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveriesRequest;
use Illuminate\Http\Request;

class DeliveriesController extends Controller
{
    public function getDeliveries(DeliveriesRequest $request)
    {
        $data = $request->validated();

        return response(compact('data'));
    }
}
