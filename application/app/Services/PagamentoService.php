<?php

namespace App\Services;

use App\Strategies\PagamentoCartaoCreditoStrategy;
use App\Strategies\PagamentoPaypalStrategy;
use App\Strategies\PagamentoPixStrategy;
use App\Strategies\PagamentoStrategy;
use http\Exception\InvalidArgumentException;

class PagamentoService
{
    private $strategies;
    public function __construct()
    {
        $this->strategies = [
            'cartao' => new PagamentoCartaoCreditoStrategy(),
            'pix' => new PagamentoPixStrategy(),
            'paypal' => new PagamentoPayPalStrategy()
        ];
    }

    public function executarPagamento($metodoPagamento)
    {
        if (!array_key_exists($metodoPagamento, $this->strategies)) {
            return "Método de pagamento inválido: $metodoPagamento";
        }

        $strategy = $this->strategies[$metodoPagamento];
        return $strategy->executar();
    }
}

