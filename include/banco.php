<?php

function conectar($user, $password) 
{
	$conn = new PDO('pgsql:dbname=cronos;host=localhost;', $user, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	return $conn;
}

function inserir($user, $password, $tabela, $dados, $campos=null) 
{
	foreach($dados as $chave => $value){		
		if(!empty($value)){
			$cols[] = $chave;		
			$vals[] = $chave == 'password' ? "'" . md5( $value ) . "'" : "'" . $value . "'";		
		}
	}
	$insert = "INSERT INTO " . $tabela . "(";
	if(!empty($campos)){
		foreach($campos as $chave => $value){		
			$cols2[] = $chave;		
			$vals2[] = $value;		
		}
		
		$total = count($cols2);
		for($i = 0; $i < $total; $i++){
			$cols[] = $cols2[$i];
			$vals[] = $vals2[$i];
		}
	}
	
	
	$insert .= implode(",", $cols) .") VALUES (". implode(",", $vals) .");";
	
	$conn = conectar($user, $password);
	$conn = $conn -> prepare($insert);
	return $conn -> execute();	
}

function editar($user, $password, $tabela, $onde, $dados) 
{
	/*
	foreach($dados as $chave => $value){		
		if(!empty($value)){
			$cols[] = $chave;		
			$vals[] = $chave == 'password' ? "'" . md5( $value ) . "'" : "'" . $value . "'";		
		}
	}
	$campos = "";
	$total = count($cols);
	for($i = 0; $i < $total; $i++){
		$campos .= $cols[$i] . " = " . $vals[$i];
		if(($total-1) != $i){
			$campos .= ","; 
		}	
	}
	*/
	
	
	$update = "UPDATE " . $tabela . montaCampos($dados, ",", "SET");
//	$update .= " WHERE id = " . $onde;
	$update .= montaCampos($onde);
	
	$conn = conectar($user, $password);
	$conn = $conn -> prepare($update);
	return $conn -> execute();	
}


function listar($userDB, $passwordDB, $tabela, $dados, $ordem, $limite=null, $fetch=null, $campos=null) 
{
/*	foreach($dados as $chave => $value){		
		if(!empty($value)){
			$cols[] = $chave;		
			$vals[] = $chave == 'password' ? "'" . md5( $value ) . "'" : "'" . $value . "'";		
		}
	}
	$campos = "";
	$total = count($cols);
	for($i = 0; $i < $total; $i++){
		$campos .= $cols[$i] . " = " . $vals[$i];
		if(($total-1) != $i){
			$campos .= " AND "; 
		}	
	}
	*/
	$consulta = "SELECT * FROM " . $tabela . montaCampos($dados, null, null) . montaCamposEspeciais($campos, " AND ") . " ORDER BY " . implode(",", $ordem) . " " . $limite;

	$conn = conectar($userDB, $passwordDB);
	$query = $conn->query($consulta);
	
	if(isset($fetch)){
		return $query->fetch();
	}	
	return $query->fetchAll();
}

function validarUsuario($userDB, $passwordDB, $tabela, $usuario, $password){
	$consulta = "SELECT * FROM ". $tabela . " WHERE email = ". "'" . $usuario . "'" . " AND password = ". "'" . md5( $password ). "'" . " LIMIT 1";
	$conn = conectar($userDB, $passwordDB);
	$query = $conn->query($consulta);
	return $query->fetch();
}

function montaCamposEspeciais($dados, $operador)
{
	if(!empty($dados)){
		foreach($dados as $chave => $value){		
			if(!empty($value)){
				$cols[] = $chave;		
				$vals[] = $value;
			}
		}
		
		
		$campos = "";
		$total = count($cols);
		for($i = 0; $i < $total; $i++){
			$campos .= $cols[$i] . $vals[$i];
			if(($total-1) != $i){
				$campos .= $operador; 
			}	
		}
		
		return " AND " . $campos;
	}
	return "";
	
}

function montaCampos($dados, $operador=null, $string=null)
{
	if(empty($operador)){
		$operador = " AND "; 
	}
	if(empty($string)){
		$string = " WHERE "; 
	}

	foreach($dados as $chave => $value){		
		if(!empty($value)){
			$cols[] = $chave;		
			$vals[] = $chave == 'password' ? "'" . md5( $value ) . "'" : "'" . $value . "'";		
			
			/*
			if($chave == 'password'){
				$vals[] = "'" . md5( $value ) . "'";
			}else{
				if(empty($operador2)){
					$vals[] = "'" . $value . "'";
				}else{
					$vals[] = $value;		
				}				
			}
			*/
			

		}
	}
	$campos = "";
	$total = count($cols);
	for($i = 0; $i < $total; $i++){
		$campos .= $cols[$i] . " = " . $vals[$i];
		if(($total-1) != $i){
			$campos .= $operador; 
		}	
	}
	return " " . $string ." " . $campos;
}

function excluir($userDB, $passwordDB, $tabela, $dados) 
{	
	$delete = " DELETE FROM " . $tabela . montaCampos($dados);
	$conn = conectar($userDB, $passwordDB);
	$conn = $conn -> prepare($delete);
	return $conn -> execute();
}


function ver($tabela, $campos, $onde) 
{
}


?>
