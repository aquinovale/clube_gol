<?php
	require("../../include/banco.php");
	$id = $_POST['id'];
	excluir('clientes', '00198500', 'clientes.quadra', array('id' => $id));
	$dados['status'] = 'sucesso';
	echo json_encode($dados);
 
?>
