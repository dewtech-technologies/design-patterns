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

    /**
     * @OA\Post(
     *     path="/v1/dewtech/pagar",
     *     tags={"Strategy"},
     *     summary="Executa um pagamento",
     *     description="Executa um pagamento com o método especificado",
     *     operationId="pagar",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Informações do método de pagamento",
     *         @OA\JsonContent(
     *             required={"metodo_pagamento"},
     *             @OA\Property(property="metodo_pagamento", type="string", example="cartao")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resultado do pagamento",
     *         @OA\JsonContent(
     *             @OA\Property(property="resultado", type="string", example="sucesso")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Dados inválidos"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * )
     */
    public function pagar(Request $request)
    {
        $metodoPagamento = $request->input('metodo_pagamento');
        $resultado = $this->pagamentoService->executarPagamento($metodoPagamento);

        return response()->json(['resultado' => $resultado]);
    }
}
