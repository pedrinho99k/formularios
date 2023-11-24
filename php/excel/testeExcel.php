<?php

// Autoload do Composer
require __DIR__ . '/../../vendor/autoload.php';

// Arquivo de Conexão
require __DIR__ . '/../conexao/conexao.php';


// Conectar ao banco de dados
$conexao = Conectar();

// Consulta SQL
$query = "SELECT codigo as 'REGISTRO', fr.reg_data_hora as 'INSERIDO', indicador_de__acompa_2 as 'Mês competência',
indicador_de__acompa_3 as 'UNIDADE DE INTERNAÇÃO', indicador_de__acompa_4 as 'DATA',
indicador_de__acompa_5 as 'OCUPAÇÃO DE LEITOS', indicador_de__acompa_6 as 'ADMISSÃO',
indicador_de__acompa_7 as 'NÚMERO DE EVOLUÇÕES', indicador_de__acompa_8 as 'NUMERO TOTAL DE INTERVENÇÕES',
indicador_de__acompa_9 as 'INTERVENÇÕES ACEITAS', indicador_de__acompa_10 as 'INTERVENÇÕES NÃO ACEITAS',
indicador_de__acompa_11 as 'CONCILIAÇÕES MEDICAMENTOSAS', indicador_de__acompa_14 as 'REALIZAÇÃO DE PROFILAXIA TEV',
indicador_de__acompa_15 as 'OCORRÊNCIA DE REAÇÃO ADVERSA A MEDICAMENTOS', indicador_de__acompa_16 as 'PARTICIPAÇÃO EM VISITA MULTIDISCIPLINAR',
indicador_de__acompa_17 as 'REALIZADA VISITA - PACIENTE SEGURO', indicador_de__acompa_18 as 'REALIZADA TRANSIÇÃO DO CUIDADO',
indicador_de__acompa_19 as 'ORIENTAÇÃO DE ALTA PARA DOMICILIO' 
FROM indicador_de__acompa ia
JOIN fm_registros fr ON fr.reg_codigo_registro  = ia.codigo 
WHERE fr.reg_codigo_formulario='29' AND fr.reg_ativo <> 'EXCLUIDO'";

try {
    $resultado = $conexao->prepare($query);
    $resultado->execute();

    // Criar uma instância do PhpSpreadsheet
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Adicionar cabeçalhos
    $coluna = 'A';
    foreach ($resultado->fetch(PDO::FETCH_ASSOC) as $campo => $valor) {
        $sheet->setCellValue($coluna . '1', $campo);
        $coluna++;
    }

    // Adicionar dados
    $linha = 2;
    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $coluna = 'A';
        foreach ($row as $valor) {
            $sheet->setCellValue($coluna . $linha, $valor);
            $coluna++;
        }
        $linha++;
    }

    // Data atual quando o arquivo foi gerado
    $data = date('d-m-Y');

    // Nome que vai ficar salvo no arquivo
    $nomeDownload = "exportacao_dia:" . $data . ".xlsx";

    // Definir cabeçalhos HTTP para download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=$nomeDownload");
    header('Cache-Control: max-age=0');

    // Pasta que fica as exportações
    $directory = __DIR__ . "/planilhas";

    // Verificar se existe o diretorio
    if (!file_exists($directory)) {
        // Criar o diretorio se ele não existir
        if (!mkdir($directory, 0777, true)) {
            die('Erro ao criar a pasta de exportação!');
        }
    }

    // Nome do arquivo que fica salvo no sistema
    $nomeArquivo = "exportacao_" . $data . ".xlsx";

    // Salvar o arquivo Excel
    $writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    $writer->save("planilhas/" . $nomeArquivo);
    
} catch (PDOException $e) {
    echo "<h3>Erro ao gerar planilha</h3>" . $e->getMessage();
}

?>