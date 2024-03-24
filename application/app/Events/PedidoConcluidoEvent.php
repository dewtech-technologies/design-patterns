<?php

namespace App\Events;

use App\Models\Pedido;
use Illuminate\Queue\SerializesModels;

class PedidoConcluidoEvent
{
    use SerializesModels;

    public $pedido;

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }
}
