<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\TemplateMethod\CsvProcessor;
use App\TemplateMethod\XmlProcessor;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/dewtech/process-file",
     *     summary="Processa um arquivo CSV ou XML",
     *     description="Upload e processamento de um arquivo CSV ou XML.",
     *     operationId="processFile",
     *     tags={"Template Method"},
     *     @OA\RequestBody(
     *         description="Arquivo para ser processado",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="file",
     *                     description="Arquivo para upload",
     *                     type="string",
     *                     format="binary"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro Interno",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public function processFile(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['success' => false, 'message' => 'Nenhum arquivo enviado.'], 400);
        }

        $file = $request->file('file');
        $processor = $this->getProcessor($file->getClientOriginalExtension());
        if (!$processor) {
            return response()->json(['success' => false, 'message' => 'Tipo de arquivo não suportado.'], 400);
        }

        $result = $processor->process($file->getPathName());

        return response()->json($result);
    }

    private function getProcessor($extension)
    {
        return match($extension) {
            'csv' => new CsvProcessor(),
            'xml' => new XmlProcessor(),
            default => null,
        };

    }

}
