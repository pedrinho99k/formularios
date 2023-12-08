<?php

// Autoload do Composer
require __DIR__ . '/../../vendor/autoload.php';

// Arquivo de Conexão
require __DIR__ . '/../conexao/conexao.php';


// Conectar ao banco de dados
$conexao = Conectar();

// Consultas SQL

// INDICADOR DE ACOMPANHAMENTO FARMACOTERAPÊUTICO
$query_29 = "SELECT codigo as 'REGISTRO', fr.reg_data_hora as 'INSERIDO', indicador_de__acompa_2 as 'Mês competência',
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


// AHPACEG
$query_1 = "SELECT codigo as 'Código',
fm_registros.reg_data_hora as 'Data e Hora',
ahpaceg_2 as 'Mês competência',
ahpaceg_3 as 'Número de casos de extravasamento de contrastes',
ahpaceg_4 as 'Número de casos de flebite em pacientes que foram submetidos a punção venosa para infusão de contraste para realização de exame de imagem:',
ahpaceg_5 as 'Número de exames de imagem repetidos na instituição de saúde:',
ahpaceg_6 as 'Total de clientes que receberam contraste por meio do acesso endovenoso para realizar exame de imagem:',
ahpaceg_7 as 'Total de exames de imagem realizados:',
ahpaceg_8 as 'Reinternações em 30 dias:',
ahpaceg_9 as 'Total de pacientes classificados(BRADEN) com risco de LPP:',
ahpaceg_10 as 'Total de pacientes internados classificados com risco de quedas:',
ahpaceg_11 as 'Total de pacientes internados com pulseira padronizada (ou outro dispositivo de identificação):',
ahpaceg_12 as 'Total de paradas cardiorrespiratórias (PCR) em pacientes internados na Unidade de Internação durante o mês:',
ahpaceg_13 as 'Número de óbitos de pacientes cirúrgicos intra-hospitalares que ocorreram até 7 dias após a cirurgia:',
ahpaceg_14 as 'Número de pacientes submetidos a cirurgia com verificação de checklist:',
ahpaceg_15 as 'Número de pacientes submetidos a cirurgias com internação, exceto parto normal e cesária:',
ahpaceg_16 as 'Número de pacientes submetidos a cirurgias com internação:',
ahpaceg_17 as 'Número óbitos cirúrgicos durante o mês:',
ahpaceg_18 as 'Número de cateter central-dia no período em UTI Adulto:',
ahpaceg_19 as 'Número de cateter vesical de demora-dia no mês em UTI Adulto:',
ahpaceg_20 as 'Número de infecções em sítio cirúrgico em apendicectomia realizada por laparoscopia durante o mês:',
ahpaceg_21 as 'Número de infecções em sítio cirúrgico em colecistectomia realizada por laparoscopia durante o mês:',
ahpaceg_22 as 'Número de infecções em sítio cirúrgico em herniorrafia/hernioplastia realizada por laparoscopia durante o mês. Deve ser considerada a reparação de hérnia inguinal, diafragmática, femoral, umbilical ou hérnia da parece abdominal anterior:',
ahpaceg_23 as 'Número total de ITU em pacientes na UTI Adulto com CVD:',
ahpaceg_24 as 'Total de casos novos de IPCSL associada ao CVC, em UTI Adulto:',
ahpaceg_25 as 'Total de cirurgias limpas:',
ahpaceg_26 as 'Total de infecções de sítio cirúrgico em cirurgias limpas:',
ahpaceg_27 as 'Total de infecções hospitalares:',
ahpaceg_28 as 'Total de novos casos de PAV na UTI Adulto:',
ahpaceg_29 as 'Total de pacientes com ventilações mecânicas-dia na UTI Adulto:',
ahpaceg_30 as 'Total de pacientes-dia internados em UTI adulto com cateter venoso central-dia, há pelo menos 2 dias:',
ahpaceg_31 as 'Número de internações em Unidade de Internação (ENF/Apto) oriundas da Unidade de Urgência/ Emergência durante o mês:',
ahpaceg_32 as 'Número de internações em Unidade de Terapia Intensiva (UTI) oriundas da Unidade de Urgência/ Emergência durante o mês:',
ahpaceg_33 as 'Número total de atendimentos na Urgência/ Emergência durante o mês:',
ahpaceg_34 as 'Total de leitos operacionais:',
ahpaceg_35 as 'Total de óbitos:',
ahpaceg_36 as 'Total de óbitos em UTI ADULTO:',
ahpaceg_37 as 'Total de pacientes internados:',
ahpaceg_38 as 'Total de pacientes internados, exceto pacientes com câncer e obstétricos:',
ahpaceg_39 as 'Total de pacientes-dia:',
ahpaceg_40 as 'Total de pacientes-dia das Unidades de Internação (enf / apto):',
ahpaceg_41 as 'Total de pacientes-dia no período em UTI Adulto:',
ahpaceg_42 as 'Total de saídas:',
ahpaceg_43 as 'Total de saídas UTI ADULTO:',
ahpaceg_44 as 'Número de reações transfusionais (grau I, II, III e IV):',
ahpaceg_45 as 'Total de unidades de sangue transfundidas:',
ahpaceg_46 as 'Número de apendicectomias realizadas durante o mês:',
ahpaceg_47 as 'Número de colecistectomias realizadas durante o mês:',
ahpaceg_48 as 'Número de herniorrafias/hernioplastias realizadas durante o mês:',
ahpaceg_49 as 'Número de casos de reações alérgicas após infusão de contraste para realizar exame:',
ahpaceg_50 as 'Número total de erros de medicação em pacientes internados com dano (leve, moderado ou grave) ao paciente:',
ahpaceg_51 as 'Total de casos novos de lesão por pressão:',
ahpaceg_52 as 'Total de pacientes que sofreram dano em decorrência de queda na instituição de saúde:',
ahpaceg_53 as 'Total de quedas registradas:',
ahpaceg_54 as 'Total de quedas registradas em pacientes internos e externos:',
ahpaceg_55 as 'Número de saídas hospitalares de pacientes submetidos a procedimentos cirúrgicos. Saídas hospitalares são as altas mais óbitos mais transferências externas durante o mês:'
FROM ahpaceg
JOIN fm_registros ON ahpaceg.codigo = fm_registros.reg_codigo";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo_form'])) {
    $codigo_form = $_POST['codigo_form'];

    switch ($codigo_form) {
        case 1:
            $query = $query_1;
            break;
        case 29:
            $query = $query_29;
            break;
        default:
            $query = "SELECT * FROM ahpaceg";
    }

    try {
        if (!empty($query)) {
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
        
            // Nome do arquivo que fica salvo no sistema
            $nomeArquivo = "exportacao_" . $data . ".xlsx";
        
            // Salvar o arquivo Excel
            $writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            $writer->save("planilhas/" . $nomeArquivo);
            
        } 
    } catch (PDOException $e) {
        echo "<h3>Erro ao gerar planilha</h3>" . $e->getMessage();
    }

}

// Pasta que fica as exportações
$directory = __DIR__ . "/planilhas";

// Verificar se existe o diretorio
if (!file_exists($directory)) {
    // Criar o diretorio se ele não existir
    if (!mkdir($directory, 0777, true)) {
        die('Erro ao criar a pasta de exportação!');
    }
}

?>