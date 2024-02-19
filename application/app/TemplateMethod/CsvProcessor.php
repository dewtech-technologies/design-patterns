<?php

namespace App\TemplateMethod;

class CsvProcessor extends FileProcessor
{
    protected function validate($filePath)
    {
        // Verificar se o arquivo existe e pode ser lido
        if (!file_exists($filePath) || !is_readable($filePath)) {
            return false;
        }
        // Verificar a extensão do arquivo
        if (pathinfo($filePath, PATHINFO_EXTENSION) !== 'csv') {
            return false;
        }

        // Verificar algumas linhas para confirmar o formato CSV
        if (($handle = fopen($filePath, 'r')) !== false) {
            $line = fgets($handle);
            fclose($handle);

            // Verificar se há pelo menos uma vírgula, característico de CSV
            if (strpos($line, ',') === false) {
                return false;
            }
        } else {
            return false;
        }

        return true;
    }

    protected function parse($filePath)
    {
        // Abrir o arquivo CSV e ler linha por linha
        $data = [];
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $data[] = $row;
            }
            fclose($handle);
            return $data;
        }

        return false;
    }

    protected function save($data)
    {
        // Implementar a lógica para salvar os dados
        // Isso pode envolver salvar em um banco de dados, enviar para outro serviço, etc.
        try {
            foreach ($data as $row) {
                // Aqui você salvaria cada linha do CSV
                // Por exemplo, inserir no banco de dados
            }
            return true;
        } catch (\Exception $e) {
            // Tratar qualquer exceção que possa ocorrer durante o salvamento
            return false;
        }
    }
}
