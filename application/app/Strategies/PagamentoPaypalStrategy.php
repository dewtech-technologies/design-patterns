<?php

namespace App\Strategies;

class PagamentoPaypalStrategy implements PagamentoStrategy
{

    public function executar()
    {
        return "Pagemento realizado com PayPal";
    }
}
