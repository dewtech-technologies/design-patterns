<?php

namespace App\Http\Controllers\Pagamento;

use App\Http\Controllers\Controller;
use App\Services\PagamentoService;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    private $pagamentoService;

    public function __construct()
    {
        $this->pagamentoService = new PagamentoService();
    }
    public function pagar(Request $request)
    {
        $metodoPagamento = $request->input('metodo_pagamento');
        $resultado = $this->pagamentoService->executarPagamento($metodoPagamento);

        return response()->json(['resultado' => $resultado]);
    }
}
