<?php

namespace App\Services;

use App\Domains\Entities\DestinatarioEntity;
use App\Models\Destinatario;

class DestinarioService
{
    public function CreateDestinario(DestinatarioEntity $destinarioEntity):void
    {
        $destinatario = new Destinatario();

        $destinatario->nome = $destinarioEntity->nome;
        $destinatario->cpf = $destinarioEntity->cpf;
        $destinatario->endereco = $destinarioEntity->endereco;
        $destinatario->estado = $destinarioEntity->estado;
        $destinatario->cep = $destinarioEntity->cep;
        $destinatario->pais = $destinarioEntity->pais;
        $destinatario->latitude = $destinarioEntity->latitude;
        $destinatario->longitude = $destinarioEntity->longitude;

        $destinatario->save();
    }

    public function GetDestinarioByCpf(string $cpf):DestinatarioEntity
    {
        $destinatario = Destinatario::where('cpf', '=', $cpf)->first();
        return DestinatarioEntity::ConvertModelToEntity($destinatario);
    }

    public function CheckDestinatarioByCpf(string $cpf):bool
    {
        $destinario = Destinatario::where('cpf', '=', $cpf)->first();

        if($destinario === null)
        {
            return false;
        }

        return true;
    }
}
