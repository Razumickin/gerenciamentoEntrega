<?php

namespace App\Domains\Entities;

use stdClass;

class DestinatarioEntity
{
    public string $nome;
    public string $cpf;
    public string $endereco;
    public string $estado;
    public string $cep;
    public string $pais;
    public string $latitude;
    public string $longitude;

    public static function ConvertStdClassToEntity(stdClass $destinatario):DestinatarioEntity
    {
        $destinatarioEntity = new DestinatarioEntity();

        $destinatarioEntity->nome = $destinatario->_nome;
        $destinatarioEntity->cpf = $destinatario->_cpf;
        $destinatarioEntity->endereco = $destinatario->_endereco;
        $destinatarioEntity->estado = $destinatario->_estado;
        $destinatarioEntity->cep = str_replace('-','', $destinatario->_cep);
        $destinatarioEntity->pais = $destinatario->_pais;
        $destinatarioEntity->latitude = $destinatario->_geolocalizao->_lat;
        $destinatarioEntity->longitude = $destinatario->_geolocalizao->_lng;

        return $destinatarioEntity;
    }
}
