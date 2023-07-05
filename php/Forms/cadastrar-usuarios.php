<?php session_start(); ?>
<form>
    <div class="col-md-12 py-4" id="form-body" style="background-color: white;">
        <div class="container-fluid">
            <h4>Cadastros de Usuários</h4>
            <form class="row g-3">
                <div class="col-md-12">
                    <label for="cod_usuario" class="form-label">Cód. do Usuário</label>
                    <input type="text" class="form-control" id="cod_usuario" name="cod_usuario" disabled>
                </div>
                <div class="col-md-12">
                    <label for="login_usuario" class="form-label">Login do Usuário</label>
                    <input type="text" class="form-control" id="login_usuario" name="login_usuario" disabled>
                </div>
                <div class="col-md-12">
                    <label for="nome_usuario" class="form-label">Nome do Usuário</label>
                    <input type="text" class="form-control" id="nome_usuario" name="nome_usuario">
                </div>
                <div class="col-md-12">
                    <label for="email_usuario" class="form-label">Email do Usuário</label>
                    <input type="email" class="form-control" id="email_usuario" name="email_usuario">
                </div>
                <div class="col-md-12">
                    <label for="cod_perfil_usuario" class="form-label">Perfil</label>
                    <select class="form-select" id="cod_perfil_usuario" name="cod_perfil_usuario">
                        
                    </select>
                </div>
                <div class="col-md-12 my-2">
                    <button type="button" class="btn btn-primary" onclick="SalvarUsuario()">Salvar</button>
                    <button type="button" class="btn btn-secondary" onclick="LimparCamposCadastroUsuario()">Limpar Campos</button>
                </div>
            </form>
            <div id="tabela">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Cód.</th>
                        <th scope="col">Login</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
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