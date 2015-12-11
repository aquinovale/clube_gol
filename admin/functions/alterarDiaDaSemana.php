<?php
	require("../../include/banco.php");
	session_start();
	
	$id = $_POST['id'];
	$lista = listar('clientes', '00198500', 'clientes.dia_semana', array('id' => $id, 'id_empresa' => $_SESSION['usuario_logado']['id']), array('id'), null, 'true');
	foreach($lista as $chave => $valor){
		$dados[$chave] = $valor;
	}
	echo json_encode($dados);
?>
