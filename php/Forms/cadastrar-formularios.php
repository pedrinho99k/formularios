<?php session_start(); ?>
<form>
    <div class="col-md-12 py-4" id="form-body" style="background-color: white;">
        <div class="container-fluid">
            <h4>Cadastro Formulário</h4>
            <form class="row g-3">
                <div class="col-md-12">
                    <label for="cod_formulario" class="form-label">Cód. do Formulário</label>
                    <input type="text" class="form-control" id="cod_formulario" name="cod_formulario" disabled>
                </div>
                <div class="col-md-12">
                    <label for="nome_formulario" class="form-label">Nome do Formulário</label>
                    <input type="text" class="form-control" id="nome_formulario" name="nome_formulario">
                </div>
                <div class="col-md-12">
                    <label for="sigla_formulario" class="form-label">Sigla do Formulário</label>
                    <input type="text" class="form-control" id="sigla_formulario" name="sigla_formulario">
                </div>
                <div class="col-md-12 my-2">
                    <button type="button" class="btn btn-primary" onclick="SalvarFormulario()">Salvar</button>
                    <button type="button" class="btn btn-secondary" onclick="LimparCamposCadastroFormulario()">Limpar Campos</button>
                </div>
            </form>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <p>Está ação vai apagar o formulario!</p>
                    <button id="modal-btn-prosseguir" class="modal-btn">Prosseguir</button>
                    <button id="modal-btn-cancelar" class="modal-btn cancel" onclick="fecharModal()">Cancelar</button>
                </div>
            </div>
            <div id="tabela">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Cód.</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Sigla</th>
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
<script>
    
</script>