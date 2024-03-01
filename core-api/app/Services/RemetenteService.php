<?php

namespace App\Services;

use App\Domains\Entities\Remetente;

class RemetenteService
{
    private Remetente $remetente;

    public function SetRemetente(Remetente $remetente):void
    {
        $this->remetente = $remetente;
    }

    public function GetRemetenteByEntregaId($id):Remetente
    {
        return $this->remetente;
    }
}
