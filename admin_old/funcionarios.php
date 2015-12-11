<?php include("topo.php"); ?>
<div class="row">
    <div class="span12">
        <legend class="">
            <h1>Lista de Funcionários</h1>
        </legend>
        <div class="btn-toolbar">
            <a href="incluirFuncionario.php"><button class="btn btn-primary">Novo Funcionário</button></a>
        </div>
        <div class="well">
            <table width="100%" class="table">
                <col style="width:10%">
                <thead>
                    <tr class="bold">
                        <td>#</td>
                        <td>Nome</td>
                        <td>E-mail</td>
                        <td>Perfil</td>
                        <td style="width: 36px;">Ações</td>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("rodape.php"); ?>