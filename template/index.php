<link rel='stylesheet' type='text/css' href='include/css_clube/clube-do-gol.css' />
<script type="text/javascript">
    $(function() {
        $('.carousel').carousel({
            interval: 5000
        });
    });
</script>


<?php 
   $atual = basename(__FILE__);
   include 'topo.php';
   require 'include/banco.php';
?>

<div class="carousel slide" id="myCarousel">
    <div class="carousel-inner">
	<?php
           $class = ' active';
           for ($i = 1 ; $i <= 4; $i++){
                if($i > 1){
                  $class = '';
                }
    	   	echo "<div class='item $class'><center><img alt='' src='include/banner/$i.jpg' ></center></div>";
	   }
        ?>
    </div>
    <a data-slide="prev" href="#myCarousel" class="left carousel-control"></a>
    <a data-slide="next" href="#myCarousel" class="right carousel-control"></a>
</div>

<div class="row">
    <div class="span12">
      <form class="form-horizontal" action='' method="POST">
          <div id="legend">
              <legend class=""><h1>Login</h1></legend>
          </div>

			<?php
				if($_SERVER['REQUEST_METHOD'] == "POST") {
					$erro = false;
					$msg_erro = '';
					if(empty($_POST['email'])){
						$msg_erro = "O email precisa ser preenchido! <br \>";
						$erro = true;
					}

					if(empty($_POST['senha'])){
						$msg_erro = $msg_erro . "A senha precisa ser preenchida! <br \>";
						$erro = true;
					}

					if($erro == false){
						$usuario_logado = validarUsuario('clientes', '00198500', 'clientes.empresa', $_POST['email'], $_POST['senha']);
						if(empty($usuario_logado)){
							$msg_erro = "Usuário ou senha incorretos.";
							$class = 'alert alert-error';
						}else{
							$class = 'alert alert-success';
							session_start();
							$_SESSION['id'] = md5($usuario_logado['id']);
							$_SESSION['usuario_logado'] = $usuario_logado;
							header("location: admin/index.php");							
						}						
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
					echo $msg_erro;
		        }	
		    }
	  ?>
          </div>
          <div class="control-group">
              <label class="control-label" for="email">E-mail:</label>
              <div class="controls">
                  <input type="text" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : null; ?>" class="input-xlarge tamanho">
              </div>
          </div>
          <div class="control-group">
              <label class="control-label" for="senha">Password:</label>
              <div class="controls">
                  <input type="password" id="senha" name="senha" class="input-xlarge tamanho">
              </div>
          </div>
          <div class="control-group">
              <label class="control-label"></label>
              <div class="controls">
                  <button class="btn btn-success">Login</button>
              </div>
          </div>
      </form>
  </div>
</div>

<hr />

<?php
	include 'rodape.php';
?>
