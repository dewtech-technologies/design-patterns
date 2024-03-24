<?php

namespace App\Http\Controllers\Pedido;

use App\Http\Controllers\Controller;
use App\Models\Pedido;

class PedidoController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/dewtech/pedido/concluir/{pedidoId}",
     *     operationId="concluirPedido",
     *     tags={"Observer"},
     *     summary="Concluir um pedido",
     *     description="Conclui um pedido e notifica os observadores.",
     *     @OA\Parameter(
     *         name="pedidoId",
     *         in="path",
     *         required=true,
     *         description="ID do Pedido",
     *         @OA\Schema(
     *             type="string",
     *             format="uuid"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pedido concluído com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Pedido concluído e observadores notificados")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pedido não encontrado"
     *     )
     * )
     */
    public function concluir($pedidoId)
    {
        $pedido = Pedido::find($pedidoId);

        if(!$pedido) {
            return response()->json(['message'=> 'Pedido não encontrado'],404);
        }

        $pedido->concluirPedido();

        return response()->json(['message'=>
            'Pedido concluído e observadores notificados'
        ]);
    }

}
