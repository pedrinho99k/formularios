<?php session_start(); ?>
<div class="col-md-12  py-4" id="form-body" style="background-color: white;">
    <div class="container-fluid row g-3">
        <h4 class="text-center">Cadastros de Avaliação</h4>
        <!--Formulário de cadastro-->
        <div class="col-md-6" style="max-height:610px; overflow-x: auto;">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="nav_avaliacao" aria-current="page" href="#">Avaliação</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav_questao" href="#">Questão</a>
                </li>
            </ul>
            <!--Formulário da Avaliação-->
            <form class="col-md-12" id="form_avaliacao">
                <div class="col-md-12">
                    <div class="alert alert-warning mt-2" id="msg_dados-avaliacao" role="alert">
                        Insira os dados da Avaliação, após a inserção clique no botão "AVANÇAR" para cadastrar as quesões da respectiva avaliação.
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="cod_avaliacao" class="form-label">Cód. da Avaliação</label>
                    <input type="text" class="form-control" id="cod_avaliacao" name="cod_avaliacao" disabled>
                </div>
                <div class="col-md-12">
                    <label for="nome_avaliacao" class="form-label">Nome da Avaliação</label>
                    <input type="text" class="form-control text-uppercase" id="nome_avaliacao" name="nome_avaliacao">
                </div>
                <div class="col-md-12">
                    <label for="desc_avaliacao" class="form-label">Descrição da Avaliação</label>
                    <textarea type="text" class="form-control" id="desc_avaliacao" name="desc_avaliacao" rows="6"></textarea>
                </div>
                <div class="col-md-12">
                    <label for="ava_login" class="form-label">Avaliação exige login?</label><BR>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="ava_login" id="SIM" value="SIM" autocomplete="off">
                        <label class="btn btn-outline-primary" for="SIM">SIM</label>

                        <input type="radio" class="btn-check" name="ava_login" id="NÃO" value="NÃO" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="NÃO">NÃO</label>
                    </div>
                </div>
                <div class="col-md-4 d-grid gap-2 mx-auto">
                    <button type="button" class="btn btn-primary" onclick="SalvarAvaliacao()">AVANÇAR</button>
                </div>
            </form>
            <!--Formulário da Questão-->
            <form class="d-none" id="form_questao_avaliacao">
                <div class="col-md-12">
                    <label for="cod_questao_avaliacao" class="form-label">Cód. da Questão</label>
                    <input type="text" class="form-control" id="cod_questao_avaliacao" name="cod_questao_avaliacao" disabled>
                </div>
                <div class="col-md-12">
                    <label for="sigla_questao_avaliacao" class="form-label">Sigla da Questão</label>
                    <input type="text" class="form-control" id="sigla_questao_avaliacao" name="sigla_questao_avaliacao">
                </div>
                <div class="col-md-12">
                    <label for="desc_questao_avaliacao" class="form-label">Descrição da Questão</label>
                    <input type="text" class="form-control" id="desc_questao_avaliacao" name="desc_questao_avaliacao">
                </div>
                <div class="col-md-12">
                    <label for="html_questao_avaliacao" class="form-label">HTML Questão</label>
                    <textarea type="text" class="form-control" name="html_questao_avaliacao" id="html_questao_avaliacao" rows="7"></textarea>
                </div>
                <div class="col-md-6 d-grid gap-2 mt-2 mx-auto">
                    <button type="button" class="btn btn-lg btn-primary" onclick="SalvarQuestao()">Salvar Questão</button>
                </div>
            </form>
        </div>
        <!--Pré Vizualização do Formulário pronto-->
        <form class="col-md-6" id="form-avaliacao" style="max-height: 650px; overflow-x: auto;">
            <h4 class="text-center">Pré-Vizualização da Avaliação</h4>
            <div class="text-center mt-1 my-2 pt-4 pb-4" id="title-form">
                <h2 class="text-center text-uppercase" id="nome_avaliacao_visu" name="nome_avaliacao_visu">Nome da Avaliação</h2>
                <p class="text-center" id="desc_avaliacao_visu" name="desc_avaliacao_visu">Descrição da avaliação</p>
            </div>


        </form>

        <div class="col-md-6 d-grid gap-2 mx-auto">
            <button type="button" class="btn btn-lg btn-primary" onclick="">Finalizar Avaliação</button>
        </div>
    </div>
</div>
<script>


    var url = '/Formularios/';
    $(document).ready(function() {
        $("#msg_dados-avaliacao").hide();
    });

    $("#nome_avaliacao").keyup(function(e) {
        $("#nome_avaliacao_visu").text($("#nome_avaliacao").val());
        if ($("#nome_avaliacao").val() === '') {
            $("#nome_avaliacao_visu").text('Nome da Avaliação');
        }
    });
    $("#desc_avaliacao").keyup(function(e) {
        $("#desc_avaliacao_visu").text($("#desc_avaliacao").val());
        if ($("#desc_avaliacao").val() === '') {
            $("#desc_avaliacao_visu").text('Descrição da avaliação');
        }
    });
    $("#nav_questao").click(function(e) {
        e.preventDefault();
        let cod_avaliacao = $("#cod_avaliacao").val();
        if (cod_avaliacao === '') {
            $("#msg_dados-avaliacao").slideDown();
            setInterval(() => {
                $("#msg_dados-avaliacao").slideUp();
            }, 10000);
        } else {
            $("#nav_questao").addClass("active");
            $("#form_questao_avaliacao").removeClass("d-none");
            $("#nav_avaliacao").removeClass("active");
            $("#form_avaliacao").addClass("d-none");
        }

    });
    $("#nav_avaliacao").click(function(e) {
        e.preventDefault();
        $("#nav_avaliacao").addClass("active");
        $("#nav_questao").removeClass("active");
        $("#form_avaliacao").removeClass("d-none");
        $("#form_questao_avaliacao").addClass("d-none");
    });


    function SalvarAvaliacao() {
        let cod_avaliacao = $("#cod_avaliacao").val();
        let nome_avaliacao = $("#nome_avaliacao").val();
        let desc_avaliacao = $("#desc_avaliacao").val();
        let ava_login = $('input[name="ava_login"]:checked').val();
        $.ajax({
            method: "POST",
            url: url + "php/Funcoes/salvar-avaliacao.php",
            data: {
                cod_avaliacao,
                nome_avaliacao,
                desc_avaliacao,
                ava_login
            },
            success: function(result) {
                $("#cod_avaliacao").val(result);
                $("#nav_questao").addClass("active");
                $("#form_questao_avaliacao").removeClass("d-none");
                $("#nav_avaliacao").removeClass("active");
                $("#form_avaliacao").addClass("d-none");
                $("#desc_questao_avaliacao").focus();
            },
            error: function() {
                console.log("Erro ao Salvar avaliação");
            }
        });
    }

    let posicao = 1;

    function HtmlQuestao() {
        let desc_avaliacao = $("#desc_avaliacao").val();
        let desc_questao = $("#desc_questao_avaliacao").val();
        let cod_avaliacao = $("#cod_avaliacao").val();
        $("#sigla_questao_avaliacao").val('ava_' + cod_avaliacao + '_ques_' + posicao);
        let sigla_questao = $("#sigla_questao_avaliacao").val();
        var html_questao = `
            <div id="ques_` + posicao + `">
                <div class="col-md-12 d-grid" >
                    <label class="form-label">` + desc_questao + `</label>
                    <div class="col-md-4 mx-auto btn-group" role="group" aria-label="` + desc_avaliacao + `">
                        <input type="radio" class="btn-check" name="ava_` + cod_avaliacao + `" id="1_` + sigla_questao + `" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="1_` + sigla_questao + `">1</label>
                    
                        <input type="radio" class="btn-check" name="ava_` + cod_avaliacao + `" id="2_` + sigla_questao + `" autocomplete="off">
                        <label class="btn btn-outline-primary" for="2_` + sigla_questao + `">2</label>
                    
                        <input type="radio" class="btn-check" name="ava_` + cod_avaliacao + `" id="3_` + sigla_questao + `" autocomplete="off">
                        <label class="btn btn-outline-primary" for="3_` + sigla_questao + `">3</label>
                    
                        <input type="radio" class="btn-check" name="ava_` + cod_avaliacao + `" id="4_` + sigla_questao + `" autocomplete="off">
                        <label class="btn btn-outline-primary" for="4_` + sigla_questao + `">4</label>
                    
                        <input type="radio" class="btn-check" name="ava_` + cod_avaliacao + `" id="5_` + sigla_questao + `" autocomplete="off">
                        <label class="btn btn-outline-primary" for="5_` + sigla_questao + `">5</label>
                    </div>
                </div>
            </div>`;
        var html_questao_substitui = `
            <div class="col-md-12 d-grid" >
                <label class="form-label">` + desc_questao + `</label>
                <div class="col-md-4 mx-auto btn-group" role="group" aria-label="` + desc_avaliacao + `">
                    <input type="radio" class="btn-check" name="ava_` + cod_avaliacao + `" id="1_` + sigla_questao + `" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="1_` + sigla_questao + `">1</label>
                    
                    <input type="radio" class="btn-check" name="ava_` + cod_avaliacao + `" id="2_` + sigla_questao + `" autocomplete="off">
                    <label class="btn btn-outline-primary" for="2_` + sigla_questao + `">2</label>
                    
                    <input type="radio" class="btn-check" name="ava_` + cod_avaliacao + `" id="3_` + sigla_questao + `" autocomplete="off">
                    <label class="btn btn-outline-primary" for="3_` + sigla_questao + `">3</label>
                    
                    <input type="radio" class="btn-check" name="ava_` + cod_avaliacao + `" id="4_` + sigla_questao + `" autocomplete="off">
                    <label class="btn btn-outline-primary" for="4_` + sigla_questao + `">4</label>
                    
                    <input type="radio" class="btn-check" name="ava_` + cod_avaliacao + `" id="5_` + sigla_questao + `" autocomplete="off">
                    <label class="btn btn-outline-primary" for="5_` + sigla_questao + `">5</label>
                </div>
            </div>`;

        if ($("#ques_" + posicao).length) {
            $("#ques_" + posicao).html(html_questao_substitui);
            $("#html_questao_avaliacao").val($("#ques_" + posicao).html());
        } else {
            $("#form-avaliacao").append(html_questao);
            $("#html_questao_avaliacao").val($("#ques_" + posicao).html());
        }
    }

    $("#desc_questao_avaliacao").keyup(function(e) {
        HtmlQuestao();
    });

    function SalvarQuestao() {
        let cod_questao_avaliacao = $("#cod_questao_avaliacao").val();
        let desc_questao = $("#desc_questao_avaliacao").val();
        let cod_avaliacao = $("#cod_avaliacao").val();
        let sigla_questao = $("#sigla_questao_avaliacao").val();
        let html_questao = $("#html_questao_avaliacao").val();
        $.ajax({
            method: "POST",
            url: url + "php/Funcoes/salvar-questoes-avaliacao.php",
            data: {
                cod_questao_avaliacao,
                desc_questao,
                cod_avaliacao,
                sigla_questao,
                html_questao,
                posicao
            },
            success: function (result) {
                console.log(result);
                posicao++;
                
            },error: function(){
                console.log("Erro ao salvar questão!");
            }
        });
    }
</script>