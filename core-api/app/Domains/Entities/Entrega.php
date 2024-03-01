<?php

namespace App\Domains\Entities;

class Entrega
{
    public string $id;
    public Transportadora $transportadora;
    public int $volume;
    public Remetente $remetente;
    public Destinatario $destinatario;
}
