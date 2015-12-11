<?php include('topo.php'); ?>
<div class="row">
    <div class="span12">
        <form class="form-horizontal" action='' method="POST">
            <fieldset>
                <div id="legend">
                    <legend class=""><h1>Alterar Funcionário</h1></legend>
                </div>
                <div class="control-group">
                    <label class="control-label" for="nome">Nome</label>
                    <div class="controls">
                        <input type="text" id="nome" name="nome" value="" class="input-xlarge">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="email">E-mail</label>
                    <div class="controls">
                        <input type="text" id="email" name="email" value="" class="input-xlarge">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="senha">Senha</label>
                    <div class="controls">
                        <input type="text" id="senha" name="senha" value="" class="input-xlarge">                           
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="prf_id">Perfil</label>
                    <div class="controls">
                        <select name="prf_id">
                            <option>TO DO</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                        <input type="submit" value="Alterar" >
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
<?php include("rodape.php"); ?>
