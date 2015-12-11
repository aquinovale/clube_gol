<?php 
	$atual = basename(__FILE__);
	include  'topo.php';
?>

<div class="row">
  <div class="span12">
      <form class="form-horizontal" action='' method="POST">
          <div id="legend">
              <legend class=""><h1>Fale Conosco</h1></legend>
          </div>

			<?php
				if($_SERVER['REQUEST_METHOD'] == "POST") {
					$erro = false;
					$msg_erro = '';
					if(empty($_POST['nome'])){
						$msg_erro = "Nome precisa ser preenchido! <br \>";
						$erro = true;
					}

					if(empty($_POST['email'])){
						$msg_erro = $msg_erro . "Email precisa ser preenchido! <br \>";
						$erro = true;
					}

					if(empty($_POST['assunto'])){
						$msg_erro = $msg_erro . "Assunto precisa ser preenchido! <br \>";
						$erro = true;
					}
	
					if(empty($_POST['mensagem'])){
						$msg_erro = $msg_erro . "Mensagem precisa ser preenchido! <br \>";
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
					
					$to = 'aquino.vale@gmail.com';
					$subject = $_POST['assunto'];
					$message = $_POST['mensagem'];
					$headers = 'From: ' . $_POST['email'] . "\r\n" .
					'Reply-To: ' . $_POST['email'] . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

					if(mail($to, $subject, $message, $headers)){
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
              <label class="control-label" for="nome">Nome:</label>
              <div class="controls">
                  <input type="text" id="nome" name="nome" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : null; ?>" class="input-xlarge">
              </div>
          </div>
          <div class="control-group">
              <label class="control-label" for="email">E-mail:</label>
              <div class="controls">
                  <input type="text" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : null; ?>" class="input-xlarge">
              </div>
          </div>
          <div class="control-group">
              <label class="control-label" for="assunto">Assunto:</label>
              <div class="controls">
                  <input type="text" id="assunto" name="assunto" value="<?php echo isset($_POST['assunto']) ? $_POST['assunto'] : null; ?>" class="input-xlarge">
              </div>
          </div>
          <div class="control-group">
              <label class="control-label" for="mensagem">Mensagem:</label>
              <div class="controls">
                  <textarea rows="10" style="width: 600px; height: 200px;" name="mensagem"></textarea>
              </div>
          </div>
          <div class="control-group">
              <label class="control-label"></label>
              <div class="controls">
                  <button>Enviar Mensagem</button>
              </div>
          </div>
      </form>
  </div>
</div>

<hr />

<?php
	include 'rodape.php';
?>
