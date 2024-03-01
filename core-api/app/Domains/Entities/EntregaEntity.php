<?php

namespace App\Domains\Entities;

use stdClass;

class EntregaEntity
{
    public string $entrega_id;
    public TransportadoraEntity $transportadora;
    public int $volumes;
    public $remetente;
    public DestinatarioEntity $destinatario;
    public array $rastreamentos;

    public static function ConvertStdClassToEntity(stdClass $entrega):EntregaEntity
    {
        $entregaEntity = new EntregaEntity();

        $entregaEntity->entrega_id = $entrega->_id;
        $entregaEntity->volumes = $entrega->_volumes;
        $entregaEntity->remetente = $entrega->_remetente->_nome;
        $entregaEntity->transportadora = $entrega->_transportadora;
        $entregaEntity->destinatario = DestinatarioEntity::ConvertStdClassToEntity($entrega->_destinatario);
        $entregaEntity->rastreamentos = array();

        for($index = 0; $index < count($entrega->_rastreamento); $index++)
        {
            $entregaEntity->rastreamentos[$index] = RastreamentoEntity::ConvertToEntity($entrega->_rastreamento[$index]);
        }

        return $entregaEntity;
    }
}
