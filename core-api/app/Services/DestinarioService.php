<?php

namespace App\Services;

use App\Domains\Entities\Destinatario;

class DestinarioService
{
    private Destinatario $destinatario;

    public function SetDestinario(Destinatario $destinatario):void
    {
        $this->destinatario = $destinatario;
    }

    public function GetDestinarioById($id):Destinatario
    {
        return $this->destinatario;
    }
}
