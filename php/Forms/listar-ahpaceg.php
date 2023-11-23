<?php session_start(); ?>
<div class="p-4" id="form-body" style="background-color: white;">
    <h4>Relatório AHPACEG</h4>
    <form class="row g-3">
        <div class="col-md-4">
            <label for="mes-inicial" class="form-label">Mês competência Inicial</label>
            <input type="month" class="form-control" id="mes-inicial">
        </div>
        <div class="col-md-4">
            <label for="mes-final" class="form-label">Mês competência Final</label>
            <input type="month" class="form-control" id="mes-final">
        </div>
        <div class="col-md-4">
            <label for="mes-final" class="form-label"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg></label>
            <button type="button" class="btn btn-success w-100 mt-1" onclick="PesquisarMesCompetencia()">Pesquisar</button>
        </div>
    </form>
    <div id="tabela-vizualizar-registros">

    </div>
</div>
<script>
    var url = '/Formularios/';

    function PesquisarMesCompetencia() {
        var mes_inicial = $("#mes-inicial").val();
        var mes_final = $("#mes-final").val();
        if (mes_inicial === "" && mes_final === "") {
            $("#form-body").append("Busca todos");
        } else {
            //$("#form-body").append(mes_inicial + " até " + mes_final);
            VizualizarRegistro(1);
        }
    }

    function VizualizarRegistro(cod_form) {
        var mes_inicial = $("#mes-inicial").val();
        var mes_final = $("#mes-final").val();

        var mesesPercorridos = percorrerMeses(mes_inicial, mes_final);


        var siglaArray = [];
        var html_tabela = `<table class="table">
    <thead>
      <tr>
        <th scope="col" style="width:50%">Questão</th>
        <th scope="col">Valor</th>
      </tr>
    </thead>
    <tbody id='corpo-tabel-vizualizacao'>
    </tbody>
  </table>
    `;
        $("#tabela-vizualizar-registros").html(html_tabela);
        var html_tbody;
        $.ajax({
            url: url + "php/Funcoes/montar-formulario.php",
            data: {
                cod_formulario: cod_form
            },
            method: "POST",
            dataType: "JSON",
            success: function(result) {
                result.forEach(function(elemento) {

                    siglaArray.push(elemento['ques_sigla']);

                });
                //Busca a descrição das perguntas e inserem na tabela
                $.ajax({
                    method: "POST",
                    url: url + "php/Funcoes/montar-formulario.php",
                    data: {
                        cod_formulario: cod_form
                    },
                    dataType: "JSON",
                    success: function(result) {
                        for (var i = 0; i < siglaArray.length; i++) {
                            if (siglaArray[i] === 'codigo') {

                            } else {
                                html_tbody += '<tr><th id="' + siglaArray[i] + '"></th>';

                                mesesPercorridos.forEach(function(mes) {
                                    html_tbody += '<td id="' + mes.getFullYear() + '_' + Mes(mes.getMonth()) + '_' + siglaArray[i] + '">' + mes.getFullYear() + '_' + Mes(mes.getMonth()) + '_' + siglaArray[i] + '</td>';

                                });
                                html_tbody += '</tr>';
                            }
                        }
                        $('#corpo-tabel-vizualizacao').append(html_tbody);

                        result.forEach(function(elemento) {
                            switch (elemento['ques_sigla']) {
                                case 'codigo':
                                    break;
                                default:
                                    $("#" + elemento['ques_sigla']).text(elemento['ques_descricao']);
                                    break;
                            }
                        });
                    },
                    error: function() {
                        console.log("Erro ao inputar dados do formulario pelo Ajax!");
                        foi = false;
                    }
                });
                //Busca os valores e insere na tabela
                mesesPercorridos.forEach(function(mes) {
                    $.ajax({
                        method: "POST",
                        url: url + "php/Funcoes/buscar-dados-ahpaceg-mes.php",
                        data: {
                            mes_competencia: Mes(mes.getMonth()) + '/' + mes.getFullYear()
                        },
                        dataType: "JSON",
                        success: function(result) {
                            for (let index = 0; index < siglaArray.length; index++) {
                                $("#"+ mes.getFullYear() + '_' + Mes(mes.getMonth()) + '_' + siglaArray[index]).text(result[siglaArray[index]]);
                            }
                        },
                        error: function() {
                            console.log("Erro ao inputar dados do formulario pelo Ajax!");
                            foi = false;
                        }
                    });
                });
            },
            error: function() {
                console.log("Erro ao montar formulario pelo Ajax!");
            }
        });

        var html_tbody;
    }

    function percorrerMeses(dataInicial, dataFinal) {
        var meses = [];

        var [anoInicial, mesInicial] = dataInicial.split("-");
        var [anoFinal, mesFinal] = dataFinal.split("-");

        var atual = new Date(anoInicial, mesInicial - 1);
        var final = new Date(anoFinal, mesFinal - 1);

        while (atual <= final) {
            meses.push(new Date(atual));
            atual.setMonth(atual.getMonth() + 1);
        }

        return meses;
    }

    function Mes(mes) {
        mesArray = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
        return mesArray[mes];
    }
</script>