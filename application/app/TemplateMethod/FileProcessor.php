<?php

namespace App\TemplateMethod;

abstract class FileProcessor
{
    public function process($filepath)
    {
        if (!$this->validate($filepath)) {
            return ['success' => false, 'message' => 'Falha na validação do arquivo.'];
        }
        $data = $this->parse($filepath);
        if (!$data) {
            return ['success' => false, 'message' => 'Erro ao processar o arquivo.'];
        }
        if (!$this->save($data)) {
            return ['success' => false, 'message' => 'Erro ao salvar os dados.'];
        }

        return ['success' => true, 'message' => 'Arquivo processado com sucesso.'];
    }

    abstract protected function validate($filePath);
    abstract protected function parse($filePath);
    abstract protected function save($data);
}
