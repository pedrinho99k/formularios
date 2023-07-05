var url = '/Formularios/';
$(document).ready(function () {
    MontarFormulario();
});

function MontarFormulario() {
    var cod_formulario = $("#cod_form").val();
    $("#form-principal").html(``);
    $("#fim").html(``);
    $("#form-principal").addClass("mb-2 mt-1");
    $("#inicio").addClass("d-none");
    $.ajax({
        url: url + "php/Funcoes/buscar-formulario-codigo-json.php",
        data: {
            cod_formulario: cod_formulario
        },
        method: "POST",
        dataType: "JSON",
        success: function (result) {
            result.forEach(function (elemento) {
                switch (elemento['form_ativo']) {
                    case "SIM":
                        $("#form-principal").append(`
                        <a class="btn mt-1" href="`+ url + `"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                        <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                      </svg> Menu Principal</a>
                        <h4 class="text-center " id="cod_form" >` + elemento['form_codigo'] + `</h4>
                        <h4 class="text-center " id="sigla_form">` + elemento['form_sigla'] + `</h4>
                        <h4 class="text-center mt-1 my-2 pt-4 pb-4" id="title-form">` + elemento['form_nome'] + `</h4>
                        `);
                        break;
                }
            });
            return true;
        }
        , error: function () {
            console.log("Erro ao montar Título formulario pelo Ajax!");
        }
    });
    setTimeout(function () {
        $.ajax({
            url: url + "php/Funcoes/montar-formulario.php",
            data: {
                cod_formulario: cod_formulario
            },
            method: "POST",
            dataType: "JSON",
            success: function (result) {
                result.forEach(function (elemento) {
                    $("#form-principal").append(`<h6 class="mb-4" id="ques">` + elemento['ques_html'] + `</h6><hr>`);
                });
            }
            , error: function () {
                console.log("Erro ao montar formulario pelo Ajax!");
            }
        });
    }, 20);
    setTimeout(function () {
        $("#form-principal").append(`<div class="col-md-12 text-center my-3 mt-3"><button type="button" class="btn btn-primary button-salvar" style="width:100%;" onclick="SalvarDadosFormulario()">Salvar</button></div>`)
    }, 300);
}

function SalvarDadosFormulario() {

    var cod_form = $("#cod_form").text();
    var sigla_form = $("#sigla_form").text();
    var cod_usuario = $("#cod_usuario_login").text();
    var codigo = $("#codigo").val();
    var cod_registro = $("#cod_registro").val();
    var dados = $("form").serializeArray();

    $.ajax({
        method: "POST",
        url: url + "php/Funcoes/salvar-dados-formularios.php",
        data: {
            cod_usuario: cod_usuario,
            cod_form: cod_form,
            sigla_form: sigla_form,
            dados: dados,
            codigo: codigo,
            cod_registro: cod_registro
        },
        success: function (result) {
            console.log(result);
            if (result == 'Salvo com sucesso!') {
                /*$("#form").addClass("placeholder-glow");
                $(".form-label, .form-select, .form-control").addClass("placeholder");
                $(".form-label, .form-select, .form-control, hr, .button-salvar").fadeOut("slow");*/
                $("#form-principal").html("");
                $("#fim").addClass("text-center");
                $("#fim").append(`
                <div class="col-md-12 mt-3 mb-4">
                <div class="card" style="width: 30%; margin-left:35%; margin-right:35%;">
                <div class="card-body text-center card- ini" style="background-color: #d1e7dd;">
                    <div class="alert alert-success text-center" role="alert" style="border:none">
                        <h5 id="icone">✅</h5>
                        <h5>Seu registro foi salvo com sucesso!</h5>
                    </div>
                </div>
                <div class="card-body text-center card-fim">
                    <h5 class="card-title">Deseja:</h5>
                    <a href="`+ url + `" class="btn btn-primary mb-2" style="width: 100%;">Voltar ao Menu Principal</a>
                    <button type="button" class="btn btn-primary button-prin mb-2" style="width:100%;" onclick="MontarFormulario(`+ cod_form + `)">Novo Registro</button>
                    <a href="logout.php" class="btn btn-primary mb-2" style="width: 100%;">Sair do Sistema</a>
                </div>
            </div>
            </div>
            `);
                $(".card-fim").hide().delay('1000').toggle("slow");
                $(".card").hide().delay('500').fadeIn("slow");
                /*setTimeout(function () {
                    $(".alert").addClass("d-none");
                    window.location.href = url;
                }, 5000);*/
            } else {
                $("#form-principal").html("");
                $("#fim").addClass("text-center");
                $("#fim").append(`
                <div class="col-md-12 mt-3 mb-4">
                <div class="card" style="width: 30%; margin-left:35%; margin-right:35%;">
                <div class="card-body text-center card- ini" style="background-color: #f8d7da;">
                    <div class="alert alert-danger text-center" role="alert" style="border:none">
                        <h5 id="icone">❌</h5>
                        <h5>Erro ao salvar!</h5>
                    </div>
                </div>
                <div class="card-body text-center card-fim">
                    <h5 class="card-title">Entre em contato com setor de Tecnologia da Informação!</h5>
                    <a href="`+ url + `" class="btn btn-primary mb-2" style="width: 100%;">Voltar ao Menu Principal</a>
                    <a href="logout.php" class="btn btn-primary mb-2" style="width: 100%;">Sair do Sistema</a>
                </div>
            </div>
            </div>
            `);
                $(".card-fim").hide().delay('1000').toggle("slow");
                $(".card").hide().delay('500').fadeIn("slow");
            }
        }, error: function () {
            console.log("Erro ao salvar dados pelo Ajax!");
        }
    });
}