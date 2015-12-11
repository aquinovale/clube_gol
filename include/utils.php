<?php
	function paginaAtual($atual, $pagina){
		if ($atual == $pagina){
			return 'active';
		}else{
			return "$atual";
		}
	}
?>
