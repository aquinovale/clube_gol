<?php include("topo.php"); ?>
<div class="row">
    <div class="span12">
        <legend class="">
            <h1>Lista de Clientes</h1>
        </legend>
        <div class="btn-toolbar">
            <a href="incluirCliente.php">
                <button class="btn btn-primary">Novo Cliente</button>
            </a>
        </div>
        <div class="well">
            <table width="100%" class="table">
                <col style="width:10%">
                <thead>
                    <tr class="bold">
                        <td>#</td>
                        <td>Nome/Razão</td>
                        <td>Cpf/CNPJ</td>
                        <td>Email</td>
                        <td>Telefone</td>
                        <td>Celular</td>
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