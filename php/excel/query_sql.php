<?php

// ahpaceg
$query_1 = 
"SELECT 
codigo as 'REGISTRO', 
DATE_FORMAT(fr.reg_data_hora, '%d/%m/%Y   %H:%i:%s') as 'INSERIDO',
usu.usu_nome as 'USUÁRIO', 
usu.usu_login as 'LOGIN', 
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
FROM 
ahpaceg 
JOIN fm_registros fr ON ahpaceg.codigo = fr.reg_codigo 
JOIN fm_usuarios usu ON usu_codigo = fr.reg_codigo_usuario 
ORDER BY 
fr.reg_data_hora";


// taxa_de_reconvocação - TAXA DE RECONVOCAÇÃO DE EXAMES
$query_22 = 
"SELECT 
codigo as 'REGISTRO', 
DATE_FORMAT(fr.reg_data_hora, '%d/%m/%Y   %H:%i:%s') as 'INSERIDO', 
usu.usu_nome as 'USUÁRIO', 
usu.usu_login as 'LOGIN', 
taxa_de_reconvocação_2 as 'Data da Repetição', 
taxa_de_reconvocação_3 as 'Nº do Atendimento', 
taxa_de_reconvocação_4 as 'Nome do Paciente', 
taxa_de_reconvocação_5 as 'Exame', 
taxa_de_reconvocação_8 as 'Motivo', 
taxa_de_reconvocação_9 as 'Descrição do Motivo' 
FROM taxa_de_reconvocação tr 
JOIN fm_registros fr ON fr.reg_codigo_registro = tr.codigo 
JOIN fm_usuarios usu ON usu_codigo = fr.reg_codigo_usuario 
WHERE fr.reg_codigo_formulario = '22' AND fr.reg_ativo = 'SIM' 
ORDER BY fr.reg_data_hora";


// análise_técnica_pres - ANÁLISE TÉCNICA DE PRESCRIÇÃO
$query_28 = 
"SELECT 
codigo as 'REGISTRO',
DATE_FORMAT(fr.reg_data_hora, '%d/%m/%Y   %H:%i:%s') as 'DATA E HORA',
usu.usu_nome as 'USUÁRIO',
usu.usu_login as 'LOGIN',
análise_técnica_pres_2 AS 'Número do Atendimento:',
análise_técnica_pres_3 as 'CRM - MÉDICO:',
análise_técnica_pres_4 as 'Unidade de Internção',
análise_técnica_pres_5 as 'Horário de Entrega da Prescrição:',
análise_técnica_pres_6 as 'Primeiro horário aprazado na prescrição',
análise_técnica_pres_7 as 'Quantidade de itens prescritos:',
análise_técnica_pres_8 as 'Medicamentos com duplicidade terapêutica:',
análise_técnica_pres_10 as 'Frequência errada ou sem frequência:',
análise_técnica_pres_11 as 'Alergia relatada a medicamento prescrito:',
análise_técnica_pres_12 as 'Medicamento sem via de administração ou via inadequada:',
análise_técnica_pres_13 as 'Medicamento sem dose ou erro de dose:',
análise_técnica_pres_14 as 'Falha de aprazamento (sem aprazamento ou aprazamento inadequado):',
análise_técnica_pres_15 as 'Sem diluição ou diluição errada:',
análise_técnica_pres_16 as 'Medicamento prescrito sem  tempo/velocidade de infusão ou velocidade errada:',
análise_técnica_pres_17 as 'Medicamento fora da validade da prescrição:',
análise_técnica_pres_18 as 'Observação errada para enfermagem:',
análise_técnica_pres_19 as 'Medicamento não padronizado prescrito sem informação se está com paciente:',
análise_técnica_pres_20 as 'Incompatibilidade em Y:',
análise_técnica_pres_21 as 'Interações medicamentosas relevantes:',
análise_técnica_pres_22 as 'Ausência de terapia específica:',
análise_técnica_pres_23 as 'Medicamento desnecessário:',
análise_técnica_pres_24 as 'Medicamento inapropriado (medicamento apresenta risco para o paciente):',
análise_técnica_pres_25 as 'Erro na antibioticoterapia (dose, via, ausência de ficha de controle):',
análise_técnica_pres_26 as 'Outro:'
FROM análise_técnica_pres at
JOIN fm_registros fr ON fr.reg_codigo_registro = at.codigo
JOIN fm_usuarios usu ON usu_codigo = fr.reg_codigo_usuario
WHERE reg_codigo_formulario = '28'
ORDER BY fr.reg_data_hora";



// indicador_de__acompa - INDICADOR DE ACOMPANHAMENTO FARMACOTERAPÊUTICO
$query_29 =  
"SELECT 
codigo as 'REGISTRO', 
DATE_FORMAT(fr.reg_data_hora, '%d/%m/%Y   %H:%i:%s') as 'INSERIDO', 
usu.usu_nome as 'USUÁRIO', 
usu.usu_login as 'LOGIN', 
indicador_de__acompa_2 as 'MÊS COMPETÊNCIA', 
indicador_de__acompa_3 as 'UNIDADE DE INTERNAÇÃO', 
indicador_de__acompa_4 as 'DATA', 
indicador_de__acompa_5 as 'OCUPAÇÃO DE LEITOS', 
indicador_de__acompa_6 as 'ADMISSÃO', 
indicador_de__acompa_7 as 'NÚMERO DE EVOLUÇÕES', 
indicador_de__acompa_8 as 'NUMERO TOTAL DE INTERVENÇÕES', 
indicador_de__acompa_9 as 'INTERVENÇÕES ACEITAS', 
indicador_de__acompa_10 as 'INTERVENÇÕES NÃO ACEITAS', 
indicador_de__acompa_11 as 'CONCILIAÇÕES MEDICAMENTOSAS', 
indicador_de__acompa_14 as 'REALIZAÇÃO DE PROFILAXIA TEV', 
indicador_de__acompa_15 as 'OCORRÊNCIA DE REAÇÃO ADVERSA A MEDICAMENTOS', 
indicador_de__acompa_16 as 'PARTICIPAÇÃO EM VISITA MULTIDISCIPLINAR', 
indicador_de__acompa_17 as 'REALIZADA VISITA - PACIENTE SEGURO', 
indicador_de__acompa_18 as 'REALIZADA TRANSIÇÃO DO CUIDADO', 
indicador_de__acompa_19 as 'ORIENTAÇÃO DE ALTA PARA DOMICILIO' 
FROM 
indicador_de__acompa ia 
JOIN fm_registros fr ON fr.reg_codigo_registro = ia.codigo 
JOIN fm_usuarios usu ON usu_codigo = fr.reg_codigo_usuario 
WHERE 
fr.reg_codigo_formulario = '29' 
AND fr.reg_ativo <> 'EXCLUIDO'
ORDER BY fr.reg_data_hora";



// ronda_farmaceutica
$query_34 = 
"SELECT 
codigo as 'REGISTRO',
DATE_FORMAT(fr.reg_data_hora, '%d/%m/%Y   %H:%i:%s') as 'INSERIDO',
usu.usu_nome as 'USUÁRIO',
usu.usu_login as 'LOGIN',
ronda_farmaceutica_2 as 'UNIDADE HOSPITALAR',
ronda_farmaceutica_3 as 'GELADEIRA - Existe termômetro disponível na geladeira de armazenamento de medicamentos?',
ronda_farmaceutica_4 as 'GELADEIRA - Existe planilha de controle de temperatura?',
ronda_farmaceutica_5 as 'GELADEIRA - Estão verificando a temperatura e preenchendo a planilha corretamente nos turnos padronizados?',
ronda_farmaceutica_6 as 'GELADEIRA- Se não estiverem registrando, qual turno é?',
ronda_farmaceutica_8 as 'GELADEIRA -  Todas as medicações estão devidamente   etiquetadas após a abertura?',
ronda_farmaceutica_9 as 'GELADEIRA - Existe medicamento vencido?',
ronda_farmaceutica_10 as 'GELADEIRA -  Está sendo utilizado exclusivamente para o armazenamento de medicamentos?',
ronda_farmaceutica_11 as 'GELADEIRA -  A limpeza da geladeira está sendo feita?',
ronda_farmaceutica_12 as 'POSTO DE ENFERMAGEM -  Os medicamentos de uso coletivo encontram-se devidamente etiquetados  após  a abertura?',
ronda_farmaceutica_13 as 'POSTO DE ENFERMAGEM -  As etiquetas anexadas aos medicamentos de uso coletivo estão preenchidas corretamente (data de validade?)',
ronda_farmaceutica_14 as 'POSTO DE ENFERMAGEM - Existe medicamento vencido?',
ronda_farmaceutica_15 as 'POSTO DE ENFERMAGEM -  Existe excesso de medicamentos (do mesmo) abertos?',
ronda_farmaceutica_16 as 'POSTO DE ENFERMAGEM -  Se existem excesso, quais e quantos são?',
ronda_farmaceutica_17 as 'CARRINHOS DE EMERGÊNCIA - Está sendo realizada a conferência do carrinho de emergência?',
ronda_farmaceutica_18 as 'CARRINHOS DE EMERGÊNCIA - data da última conferência?',
ronda_farmaceutica_19 as 'ARMAZENAMENTO DE MEDICAMENTOS DE ALTA VIGILÂNCIA (MAV) - Os MAVs estão sendo armazenados em condições seguras, separados dos demais medicamentos?',
ronda_farmaceutica_20 as 'GUARDA SEGURA  DOS MEDICAMENTOS  DE USO PROPRIO DO PACIENTE - Os medicamentos do paciente estão armazenados em local específico, com a chave em posse da equipe de enfermagem?',
ronda_farmaceutica_21 as 'OBSERVAÇÕES RELEVANTES:',
ronda_farmaceutica_22 as 'AÇÕES - o enfermeiro do plantão foi informado das inconformidades  caso tenha havido?',
ronda_farmaceutica_23 as 'ENFERMEIRO(A) RESPONSÁVEL PELO PLANTÃO:',
ronda_farmaceutica_24 as 'DATA DA INSPEÇÃO:'
FROM
ronda_farmaceutica rf
JOIN fm_registros fr ON fr.reg_codigo_registro = rf.codigo
JOIN fm_usuarios usu ON usu_codigo = fr.reg_codigo_usuario
WHERE fr.reg_codigo_formulario = '34'
ORDER BY fr.reg_data_hora";


// intervencao_farmaceutica
$query_37 = 
"SELECT 
codigo as 'REGISTRO',
DATE_FORMAT(fr.reg_data_hora, '%d/%m/%Y   %H:%i:%s') as 'INSERIDO',
usu.usu_nome as 'USUÁRIO',
usu.usu_login as 'LOGIN',
intervencao_farmaceutica_2 as 'DATA:',
intervencao_farmaceutica_3 as 'UNIDADE DE INTERNAÇÃO',
intervencao_farmaceutica_4 as 'ATIVIDADE CLINICA',
intervencao_farmaceutica_5 as 'PROFISSIONAL',
intervencao_farmaceutica_8 as 'INTERVENÇÃO',
intervencao_farmaceutica_9 as 'ACEITA',
intervencao_farmaceutica_10 as 'OBSERVAÇÕES'
FROM 
intervencao_farmaceutica intfarm
JOIN fm_registros fr ON fr.reg_codigo_registro = intfarm.codigo
JOIN fm_usuarios usu ON usu_codigo = fr.reg_codigo_usuario
WHERE fr.reg_codigo_formulario = 37
AND fr.reg_ativo <> 'EXCLUIDO'
ORDER BY fr.reg_data_hora";


// adesao_a_visita__pac - ADESAO A VISITA PACIENTE/SEGURO
$query_44 =
"SELECT
codigo as 'REGISTRO',
DATE_FORMAT(fr.reg_data_hora, '%d/%m/%Y   %H:%i:%s') as 'INSERIDO',
usu.usu_nome as 'USUÁRIO',
usu.usu_login as 'LOGIN',
adesao_a_visita__pac_3 as 'Categoria Profissional',
adesao_a_visita__pac_4 as 'Mês de Referencia',
adesao_a_visita__pac_5 as 'Quantidade'
FROM
adesao_a_visita__pac ade
JOIN fm_registros fr ON fr.reg_codigo_registro = ade.codigo
JOIN fm_usuarios usu ON usu_codigo = fr.reg_codigo_usuario
WHERE fr.reg_codigo_formulario = 44
AND fr.reg_ativo <> 'EXCLUIDO'
ORDER BY fr.reg_data_hora";

$query_57 =
"SELECT
codigo as 'RESGISTRO',
DATE_FORMAT(fr.reg_data_hora, '%d/%m/%Y   %H:%i:%s') as 'INSERIDO',
usu.usu_nome as 'USUÁRIO',
usu.usu_login as 'LOGIN',
cdp.*
FROM
controle_de_patrimôn cdp
JOIN fm_registros fr ON fr.reg_codigo_registro = cdp.codigo
JOIN fm_usuarios usu ON usu_codigo = fr.reg_codigo_usuario
WHERE fr.reg_codigo_formulario = 57
AND fr.reg_ativo <> 'EXCLUIDO'
ORDER BY fr.reg_data_hora
";
?>