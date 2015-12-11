<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Clube do Gol™</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="../include/css/bootstrap.css" rel="stylesheet">
        <link href="../include/css/bootstrap-responsive.css" rel="stylesheet">
        <script src="../include/js/jquery.js"></script>
        <script src="../include/js/bootstrap.js"></script>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <!-- Barra menus -->
            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand" href="index.php">
                        Clube do Gol™ Admin
                    </a>
                    <ul class="nav">
					<?php
						                      
                        require '../include/utils.php';
                        
						session_start();
						if(empty($_SESSION['id']) or isset($_SESSION['id'])){
							if($_SESSION['id'] != md5($_SESSION['usuario_logado']['id'])){
								header("location: ../index.php");						
							}
						}
                        $paginas[] = array('url' => 'index.php', 'label' => 'Início');
                        $paginas[] = array('url' => 'cadastrarQuadras.php', 'label' => 'Quadras');
                        $paginas[] = array('url' => 'cadastrarDiasDaSemana.php', 'label' => 'Dias da semana');
                        $paginas[] = array('url' => 'cadastrarFeriado.php', 'label' => 'Feriados');
                        $paginas[] = array('url' => 'mensagens.php', 'label' => 'Mensagens');
                     
                        
                        foreach($paginas as $pagina){
							$marcador = paginaAtual($atual, $pagina['url']);
							echo "<li class='$marcador'><a href='{$pagina['url']}'>{$pagina['label']}</a></li>";
						}                        
                        
                        ?>
                        
                    </ul>
                    <div class="btn-group pull-right">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user"></i> <?php echo $_SESSION["usuario_logado"]["nome_fantasia"]; ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="alterarCliente.php"><i class="icon-wrench"></i> Opções</a></li>
                            <li><a href="alterarSenha.php"><i class="icon-user"></i> Password</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-share"></i> Logout</a></li>
                        </ul>
                    </div>
                    
                </div>
            </div><!-- navbar -->
