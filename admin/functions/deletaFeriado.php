<?php
	require("../../include/banco.php");
	session_start();
	$id = $_POST['id'];
	excluir('clientes', '00198500', 'clientes.dia_semana', array('id' => $id, 'id_empresa' => $_SESSION['usuario_logado']['id']));
	$dados['status'] = 'sucesso';
	echo json_encode($dados);
 
?>
