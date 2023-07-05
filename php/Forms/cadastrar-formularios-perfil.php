<?php session_start(); ?>
<form>
    <div class="col-md-12 py-4" id="form-body" style="background-color: white;">
        <div class="container-fluid">
            <h4>Vincular Perfis com Formulários</h4>
            <form class="row g-3">
                <div class="col-md-12">
                    <label for="cod_formulario" class="form-label">Cód. Formulário</label>
                    <select class="form-select" id="cod_formulario" name="cod_formulario">

                    </select>
                </div>
                <div class="col-md-12">
                    <label for="cod_perfil" class="form-label">Cód. Perfil</label>
                    <select class="form-select" id="cod_perfil" name="cod_perfil">

                    </select>
                </div>
                <div class="col-md-12 my-2">
                    <button type="button" class="btn btn-primary" onclick="SalvarVinculoFormularioPerfil()">Salvar</button>
                </div>
                <div class="col-md-12" id="retorno" >
                </div>
            </form>
            <div id="tabela">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Cód.</th>
                            <th scope="col">Formulário</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Ativo</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody id="corpo-tabela">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>