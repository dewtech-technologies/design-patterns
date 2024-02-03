<?php

namespace App\Strategies;

class PagamentoPixStrategy implements PagamentoStrategy
{

    public function executar()
    {
        return "Pagamento realizado com Pix!";
    }
}
