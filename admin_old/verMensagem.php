<?php include('topo.php'); ?>
<div class="row">
    <div class="span12">
        <form class="form-horizontal" action='excluirMensagem.php' method="GET">
            <fieldset>
                <div id="legend">
                    <legend class=""><h1>Ver Mensagem</h1></legend>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="nome">Nome</label>
                    <div class="controls">
                        <input type="text" id="nome_razao" value="" class="input-xlarge">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="email">E-mail</label>
                    <div class="controls">
                        <input type="text" id="cpf_cnpj" value="" class="input-xlarge">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="assunto">Assunto</label>
                    <div class="controls">
                        <input type="text" id="email" value="" class="input-xlarge">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="mensagem">Mensagem</label>
                    <div class="controls">
                        <textarea id="mensagem" rows="5"></textarea>
                    </div>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <input type="submit" value="Clique para excluir" >
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
<?php include("rodape.php"); ?>
