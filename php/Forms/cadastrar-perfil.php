<?php session_start(); ?>
<form>
    <div class="col-md-12 py-4" id="form-body" style="background-color: white;">
        <div class="container-fluid">
            <h4>Cadastros de Perfil</h4>
            <form class="row g-3">
                <div class="col-md-12">
                    <label for="cod_perfil" class="form-label">Cód. do Perfil</label>
                    <input type="text" class="form-control" id="cod_perfil" name="cod_perfil" disabled>
                </div>
                <div class="col-md-12">
                    <label for="desc_perfil" class="form-label">Descrição do Perfil</label>
                    <input type="text" class="form-control" id="desc_perfil" name="desc_perfil">
                </div>
                <div class="col-md-12 my-2">
                    <button type="button" class="btn btn-primary" onclick="SalvarPerfil()">Salvar</button>
                </div>
            </form>
            <div id="tabela">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Cód.</th>
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