<link rel='stylesheet' type='text/css' href='include/css_clube/clube-do-gol.css' />

<script type='text/javascript' src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
<script type="text/javascript">
	$(document).ready( function() {
	   /* Executa a requisição quando o campo CEP perder o foco */
	   $('#cep').live('blur', function(){
			   /* Configura a requisição AJAX */
			   $('#salvar').attr('disabled','disabled');
			   $.ajax({
					url : 'include/consultar_cep.php', /* URL que será chamada */ 
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


<?php
	$atual = basename(__FILE__);	
	include 'topo.php';
	require 'include/banco.php';
?>

<div class="row">
    <div class="span12">
        <form class="form-horizontal" action="" method="POST">
            <fieldset>
                <div id="legend">
                    <legend class=""><h1>Cadastre-se</h1></legend>
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
					if(inserir('clientes', '00198500', 'clientes.empresa', $_POST)){
						echo 'Formulário enviado com sucesso.';
						unset($_POST);
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
                        <input type="text" id="razao_social" name="razao_social" placeholder="" value="<?php echo isset($_POST['razao_social']) ? $_POST['razao_social'] : null; ?>" class="input-xlarge tamanho" />
                    </div>
                </div>



                <div class="control-group">
                    <label class="control-label" for="nome_fantasia">Nome Fantasia</label>
                    <div class="controls">
                        <input type="text" id="nome_fantasia" name="nome_fantasia" placeholder="" value="<?php echo isset($_POST['nome_fantasia']) ? $_POST['nome_fantasia'] : null; ?>" class="input-xlarge tamanho" />
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="responsavel">Responsável</label>
                    <div class="controls">
                        <input type="text" id="responsavel" name="responsavel" placeholder="" value="<?php echo isset($_POST['responsavel']) ? $_POST['responsavel'] : null; ?>" class="input-xlarge tamanho" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="cnpj">CNPJ</label>
                    <div class="controls">
                        <input type="text" id="cnpj" name="cnpj" maxlength=14 placeholder="" value="<?php echo isset($_POST['cnpj']) ? $_POST['cnpj'] : null; ?>" class="input-xlarge tamanho">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="email">E-mail</label>
                    <div class="controls">
                        <input type="text" id="email" name="email" placeholder="" value="<?php echo isset($_POST['email']) ? $_POST['email'] : null; ?>" class="input-xlarge tamanho">

                    </div>
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
                    <label class="control-label" for="cep">CEP</label>
                    <div class="controls">
                        <input type="text" id="cep" name="cep" placeholder="" maxlength=8 value="<?php echo isset($_POST['cep']) ? $_POST['cep'] : null; ?>" class="input-xlarge tamanho">

                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="logradouro">Endereço</label>
                    <div class="controls">
                        <input type="text" id="logradouro" name="logradouro" readonly placeholder="" value="<?php echo isset($_POST['logradouro']) ? $_POST['logradouro'] : null; ?>" class="input-xlarge tamanho">

                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="numero">Número</label>
                    <div class="controls">
                        <input type="text" id="numero" name="numero" placeholder="" maxlength=10 value="<?php echo isset($_POST['numero']) ? $_POST['numero'] : null; ?>" class="input-xlarge tamanho" />
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="compl">Complemento</label>
                    <div class="controls">
                        <input type="text" id="compl" name="compl" placeholder="" maxlength=20 value="<?php echo isset($_POST['compl']) ? $_POST['compl'] : null; ?>" class="input-xlarge tamanho" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="bairro">Bairro</label>
                    <div class="controls">
                        <input type="text" id="bairro" name="bairro" readonly placeholder="" value="<?php echo isset($_POST['bairro']) ? $_POST['bairro'] : null; ?>" class="input-xlarge tamanho">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="cidade">Cidade</label>
                    <div class="controls">
                        <input type="text" id="cidade" name="cidade" readonly placeholder="" value="<?php echo isset($_POST['cidade']) ? $_POST['cidade'] : null; ?>" class="input-xlarge tamanho">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="uf">Estado</label>
                    <div class="controls">
                        <input type="text" id="uf" name="uf" readonly placeholder="" value="<?php echo isset($_POST['uf']) ? $_POST['uf'] : null; ?>" class="input-xlarge tamanho">
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="telefone">Telefone</label>
                    <div class="controls">
                        <input type="text" id="telefone" name="telefone" placeholder="" value="<?php echo isset($_POST['telefone']) ? $_POST['telefone'] : null; ?>" class="input-xlarge tamanho">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="celular">Celular</label>
                    <div class="controls">
                        <input type="text" id="celular" name="celular" placeholder="" value="<?php echo isset($_POST['celular']) ? $_POST['celular'] : null;  ?>" class="input-xlarge tamanho" >

                    </div>
                </div>
                


                <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                        <input type="submit" value="Cadastrar" id="salvar">
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
