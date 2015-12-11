<?php 
	$atual = null;
    include('topo.php'); 
	require '../include/banco.php';
?>

<script type="text/javascript">
	$(document).ready( function() {
	   /* Executa a requisição quando o campo CEP perder o foco */
	   $('#cep').live('blur', function(){
			   /* Configura a requisição AJAX */
			   $('#salvar').attr('disabled','disabled');
			   $.ajax({
					url : '../include/consultar_cep.php', /* URL que será chamada */ 
					type : 'POST', /* Tipo da requisição */ 
					data: 'cep=' + $('#cep').val(), /* dado que será enviado via POST */
					dataType: 'json', /* Tipo de transmissão */
					success: function(data){
						if(data.sucesso == 1){
							$('#logradouro').val(data.endereco);
							$('#bairro').val(data.bairro);
							$('#cidade').val(data.cidade);
							$('#uf').val(data.estado);
							$('#salvar').removeAttr('disabled');
	 						$('#numero').focus();
						}
					}
			   });   
	   return false;    
	   });
	});
</script>

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
					if(empty($_POST['razao_social'])){
						$msg_erro = "Razão Social precisa ser preenchido! <br \>";
						$erro = true;
					}
					
					if(empty($_POST['nome_fantasia'])){
						$msg_erro = $msg_erro . "Nome Fantasia precisa ser preenchido! <br \>";
						$erro = true;
					}

					if(empty($_POST['responsavel'])){
						$msg_erro = $msg_erro . "Responsável precisa ser preenchido! <br \>";
						$erro = true;
					}


					if(empty($_POST['cnpj'])){
						$msg_erro = $msg_erro . "Cnpj precisa ser preenchido! <br \>";
						$erro = true;
					}

					if(empty($_POST['email'])){
						$msg_erro = $msg_erro . "Email precisa ser preenchido! <br \>";
						$erro = true;
					}
		
					if(empty($_POST['numero'])){
						$msg_erro = $msg_erro . "Número precisa ser preenchido! <br \>";
						$erro = true;
					}
					
					if(empty($_POST['cep'])){
						$msg_erro = $msg_erro . "Cep precisa ser preenchido! <br \>";
						$erro = true;
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
					if(editar('clientes', '00198500', 'clientes.empresa', array('id' =>$_SESSION['usuario_logado']['id']), $_POST)){
						foreach($_POST as $campos => $valores){
							$_SESSION['usuario_logado'][$campos] = $valores;
						}
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
                    <label class="control-label" for="razao_social">Razão Social</label>
                    <div class="controls">
                        <input type="text" id="razao_social" name="razao_social" placeholder="" value="<?php echo $_SESSION['usuario_logado']['razao_social']; ?>" class="input-xlarge tamanho" />
                    </div>
                </div>



                <div class="control-group">
                    <label class="control-label" for="nome_fantasia">Nome Fantasia</label>
                    <div class="controls">
                        <input type="text" id="nome_fantasia" name="nome_fantasia" placeholder="" value="<?php echo $_SESSION['usuario_logado']['nome_fantasia']; ?>" class="input-xlarge tamanho" />
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="responsavel">Responsável</label>
                    <div class="controls">
                        <input type="text" id="responsavel" name="responsavel" placeholder="" value="<?php echo $_SESSION['usuario_logado']['responsavel']; ?>" class="input-xlarge tamanho" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="cnpj">CNPJ</label>
                    <div class="controls">
                        <input type="text" id="cnpj" name="cnpj" maxlength=14 placeholder="" value="<?php echo $_SESSION['usuario_logado']['cnpj']; ?>" class="input-xlarge tamanho">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="email">E-mail</label>
                    <div class="controls">
                        <input type="text" id="email" name="email" placeholder="" value="<?php echo $_SESSION['usuario_logado']['email']; ?>" class="input-xlarge tamanho">

                    </div>
                </div>
            
                <div class="control-group">
                    <label class="control-label" for="cep">CEP</label>
                    <div class="controls">
                        <input type="text" id="cep" name="cep" placeholder="" maxlength=8 value="<?php echo $_SESSION['usuario_logado']['cep']; ?>" class="input-xlarge tamanho">

                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="logradouro">Endereço</label>
                    <div class="controls">
                        <input type="text" id="logradouro" name="logradouro" readonly placeholder="" value="<?php echo $_SESSION['usuario_logado']['logradouro']; ?>" class="input-xlarge tamanho">

                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="numero">Número</label>
                    <div class="controls">
                        <input type="text" id="numero" name="numero" placeholder="" maxlength=10 value="<?php echo $_SESSION['usuario_logado']['numero']; ?>" class="input-xlarge tamanho" />
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="compl">Complemento</label>
                    <div class="controls">
                        <input type="text" id="compl" name="compl" placeholder="" maxlength=20 value="<?php echo $_SESSION['usuario_logado']['compl']; ?>" class="input-xlarge tamanho" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="bairro">Bairro</label>
                    <div class="controls">
                        <input type="text" id="bairro" name="bairro" readonly placeholder="" value="<?php echo $_SESSION['usuario_logado']['bairro']; ?>" class="input-xlarge tamanho">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="cidade">Cidade</label>
                    <div class="controls">
                        <input type="text" id="cidade" name="cidade" readonly placeholder="" value="<?php echo $_SESSION['usuario_logado']['cidade']; ?>" class="input-xlarge tamanho">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="uf">Estado</label>
                    <div class="controls">
                        <input type="text" id="uf" name="uf" readonly placeholder="" value="<?php echo $_SESSION['usuario_logado']['uf']; ?>" class="input-xlarge tamanho">
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="telefone">Telefone</label>
                    <div class="controls">
                        <input type="text" id="telefone" name="telefone" placeholder="" value="<?php echo $_SESSION['usuario_logado']['telefone']; ?>" class="input-xlarge tamanho">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="celular">Celular</label>
                    <div class="controls">
                        <input type="text" id="celular" name="celular" placeholder="" value="<?php echo $_SESSION['usuario_logado']['celular'];  ?>" class="input-xlarge tamanho" >

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
