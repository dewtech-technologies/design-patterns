<?php

namespace App\Observers;

use App\Events\PedidoConcluidoEvent;
use App\Models\EventLog;

class RegistrarTransacaoObserver
{
    public function handle(PedidoConcluidoEvent $event)
    {
        $log = new EventLog([
            'tipo_evento' => 'Pedido Concluído',
            'pedido_id' =>$event->pedido->id,
            'descricao' => "Transação financeira registrada com sucesso : Pedido " . $event->pedido->id
        ]);

        $log->save();

        \Log::info($log->descricao);
    }
}
