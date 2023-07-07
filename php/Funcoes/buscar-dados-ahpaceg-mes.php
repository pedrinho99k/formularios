<?php


$filtro = 'ahpaceg_2';
$valor_filtro = $_POST['mes_competencia'];
//$valor_filtro = '05/2023';
$cod_formulario = 1;
$formulario = 'ahpaceg';

include_once '../conexao/conexao.php';
$conn = Conectar();

// VARIÁVEIS QUE UTILIZAREMOS
$linha = '';
$dados = [];
$i = 0;

// QUERY PARA BUSCAR DESCRIÇÕES DAS QUESTÕES E SIGLAS DAS QUESTÕES ATIVAS NO FORMULÁRIOS
$query_usuarios = "SELECT ques_descricao as Questões, ques_sigla AS Sigla 
FROM fm_questoes AS ques
JOIN fm_formularios_questoes AS fq ON ques.ques_codigo = fq_ques_codigo
WHERE fq.fq_form_codigo = $cod_formulario
AND fq.fq_vinculo_ativo = 'SIM'
AND ques_descricao != 'codigo'
ORDER BY ques_posicao ASC";
$result_usuarios = $conn->prepare($query_usuarios);
$result_usuarios->execute(); // Executar a QUERY
while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
    $questao = $row_usuario['Questões']; // SALVA 
    $sigla = $row_usuario['Sigla'];
    switch ($sigla) {
        case 'codigo':
            break;
        case $filtro:
            $dados[$sigla] = $valor_filtro;
            break;
        default:
            $SQL = "SELECT SUM(" . $sigla . ") AS " . $sigla . " FROM " . $formulario . "
    JOIN fm_registros ON reg_codigo_registro = codigo
    JOIN fm_formularios ON reg_codigo_formulario = form_codigo
    JOIN fm_usuarios ON reg_codigo_usuario = usu_codigo
    WHERE " . $filtro . " = '" . $valor_filtro . "'
    AND reg_ativo = 'SIM'";
            $result = $conn->prepare($SQL);
            $result->execute();
            while ($linha_result = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados[$sigla] = $linha_result[$sigla];
                $i++;
            }
            break;
    }
}
echo json_encode($dados);

