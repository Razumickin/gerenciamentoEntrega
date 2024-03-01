<?php

namespace App\Services;

use App\Domains\Entities\DestinatarioEntity;
use App\Models\Destinatario;
use Illuminate\Database\Eloquent\Collection;

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
        $destinatario = Destinatario::whereCpf($cpf)->first();
        return $this->ConvertFromCollectionToDestinatarioEntity($destinatario);
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

    private function ConvertFromCollectionToDestinatarioEntity(Collection $destinatario):DestinatarioEntity
    {
        $destinarioEntity = new DestinatarioEntity();

        $destinarioEntity->nome = $destinatario->nome;
        $destinarioEntity->cpf = $destinatario->cpf;
        $destinarioEntity->endereco = $destinatario->endereco;
        $destinarioEntity->estado = $destinatario->estado;
        $destinarioEntity->cep = $destinatario->cep;
        $destinarioEntity->pais = $destinatario->pais;
        $destinarioEntity->latitude = $destinatario->latitude;
        $destinarioEntity->longitude = $destinatario->longitude;

        return $destinarioEntity;
    }
}
