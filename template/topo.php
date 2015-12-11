<!DOCTYPE html>
<html lang="br">
    <head>
        <meta charset="utf-8">
        <title>Clube do Gol - Quadras™</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="include/css/bootstrap.css" rel="stylesheet">
        <link href="include/css/bootstrap-responsive.css" rel="stylesheet">
        <script src="include/js/jquery.js"></script>
        <script src="include/js/bootstrap.js"></script>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand" href="index.php">Clube do Gol - Quadras</a>
                    <ul class="nav">
                        <?php 
							require 'include/utils.php';

							$paginas[] = array('url' => 'index.php', 'label' => 'Início');
							$paginas[] = array('url' => 'cadastro.php', 'label' => 'Cadastre-se');
							$paginas[] = array('url' => 'faleconosco.php', 'label' => 'Fale Conosco');
							$paginas[] = array('url' => 'sobre.php', 'label' => 'Sobre');
							foreach($paginas as $pagina){
								$marcador = paginaAtual($atual, $pagina['url']);
								echo "<li class='$marcador'><a href='{$pagina['url']}'>{$pagina['label']}</a></li>";
							}

                        ?>
                         

                    </ul>
                </div>
            </div>
