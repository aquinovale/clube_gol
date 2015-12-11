<?php 
	$atual = null;
    include('topo.php'); 
	require '../include/banco.php';
?>

<div class="row">
    <div class="span12">
        <form class="form-horizontal" action="" method="POST">
            <fieldset>
                <div id="legend">
                    <legend class=""><h1>Alterar Cadastro</h1></legend>
                </div>
			<?php
				header('Content-type: text/html; charset=UTF-8');
				if($_SERVER['REQUEST_METHOD'] == "POST") {
					$erro = false;
					$msg_erro = '';
					
					if(empty($_POST['password'])){
						$msg_erro = $msg_erro . "Senha precisa ser preenchido! <br \>";
						$erro = true;
					}

					if($erro == false){
						if($_POST['password'] != $_POST['conf_senha']){
							$msg_erro = $msg_erro . "Senha e confirmação de senha precisam ser iguais! <br \>";
							$erro = true;
						}
					}
					if($erro == false){
						$class = 'alert alert-success';
					}else{
						$class = 'alert alert-error';
					}
				}
		?>	
		<div class="<?php print $class; ?>">
                    <button type="button" class="close" data-dismiss="alert">×</button>
		<?php

		    if($_SERVER['REQUEST_METHOD'] == "POST") {
		    	if($erro == false){		
					unset($_POST['conf_senha']);					
					if(editar('clientes', '00198500', 'clientes.empresa', array('id' => $_SESSION['usuario_logado']['id']), $_POST)){
						unset($_POST);
						echo 'Alteração feita com sucesso.';
					}else{
						echo 'Problemas ao enviar formulário.';
					}					
		        }else{
					echo $msg_erro;
		        }	
		    }
		?>
                </div>

                <div class="control-group">
                    <label class="control-label" for="senha">Senha</label>
                    <div class="controls">
                        <input type="password" id="senha" name="password" maxlength=20 placeholder="" class="input-xlarge tamanho">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="conf_senha">Confirme a senha</label>
                    <div class="controls">
                        <input type="password" id="conf_senha" name="conf_senha" placeholder="" class="input-xlarge tamanho">

                    </div>
                </div>                


                <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                        <input type="submit" value="Salvar" id="salvar">
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>

<hr />

<?php 
	include 'rodape.php';
?>












