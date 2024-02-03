<?php

namespace App\Strategies;

class PagamentoCartaoCreditoStrategy implements PagamentoStrategy
{
    public function executar()
    {
        return "Pagamento com cartão de crédito realizado.";
    }
}
