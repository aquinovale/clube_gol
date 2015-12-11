
<?php 
	$atual = basename(__FILE__);  
    include('topo.php'); 
	require '../include/banco.php';
?>

<script type="text/javascript">
	
	function alterarQuadra(id){
		$.ajax({
				url : 'functions/alterarQuadra.php', /* URL que será chamada */ 
				type : 'POST', /* Tipo da requisição */ 
				data: 'id=' + id,
				dataType: 'json', /* Tipo de transmissão */
				success: function(data){
					$('#id').val(data.id);
					$('#descricao').val(data.descricao);
					$('#duracao_hora').val(data.duracao.substr(0,2));
					$('#duracao_minuto').val(data.duracao.substr(3,2));
					$('#qtde_limite').val(data.qtde_limite);
					if(data.funciona){
						$('#funciona').attr("checked",true);
					}else{
						$('#funciona').attr("checked",false);
					}
					
									
				}
		   });   
	}
	
	function deletaQuadra(id){
		   $('#quadra'+id).children('.last').html("<div id='loading'> Loading...</div>"); 
		   $('#loading').show();
		   
		   $.ajax({
				url : 'functions/deletaQuadra.php', /* URL que será chamada */ 
				type : 'POST', /* Tipo da requisição */ 
				data: 'id=' + id,
				dataType: 'json', /* Tipo de transmissão */
				success: function(data){
					
					$('#quadra'+id).remove();
					$('#loading').hide();
									
				}
		   });   
	}
</script>


<div class="row">
    <div class="span12">
        <form class="form-horizontal" action="" method="POST">
            <fieldset>
                <div id="legend">
                    <legend class=""><h1>Quadras</h1></legend>
                </div>
			<?php
				$class='';
				header('Content-type: text/html; charset=UTF-8');
				if($_SERVER['REQUEST_METHOD'] == "POST") {
					$erro = false;
					$msg_erro = '';
					$nova_quadra = empty($_POST['id']) ? true : false;
					if($nova_quadra == false){
						if(empty($_SESSION['usuario_logado']['id'])){
							$msg_erro = $msg_erro . "Problemas ao identificar Empresa! <br \>";
							$erro = true;	
						}
					}
										
					if(empty($_POST['descricao'])){
						$msg_erro = $msg_erro . "A descrição precisa ser preenchida! <br \>";
						$erro = true;
					}
				
					if(empty($_POST['duracao_hora']) or empty($_POST['duracao_minuto'])){
						$msg_erro = $msg_erro . "O tempo de duração precisa ser preenchido! <br \>";
						$erro = true;
					}else{
						if($_POST['duracao_hora'] >= 24 or $_POST['duracao_minuto'] >= 60){
							$msg_erro = $msg_erro . "O tempo de duração está incorreto! <br \>";
							$erro = true;
						}else{
							$_POST['duracao'] = $_POST['duracao_hora']. ":" .  $_POST['duracao_minuto'];
							unset($_POST['duracao_hora']);
							unset($_POST['duracao_minuto']);	
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
					
					if($nova_quadra){
						unset($_POST['id']);
						if(empty($_POST['funciona'])){
							$_POST['funciona'] = 'false';
						}
						$_POST['id_empresa'] = $_SESSION['usuario_logado']['id'];	
						if(inserir('clientes', '00198500', 'clientes.quadra', $_POST)){
							echo 'Quadra salva com sucesso.';
							unset($_POST);
						}else{
							echo 'Problemas ao salvar quadra.';
						}
					}else{
						$idQuadra = array('id' => $_POST['id']);
						unset($_POST['id']);
						unset($_POST['id_empresa']);
						if(editar('clientes', '00198500', 'clientes.quadra', $idQuadra, $_POST)){
							unset($_POST);
							echo 'Alteração feita com sucesso.';
						}else{
							unset($_POST);
							echo 'Problemas ao editar quadra.';
						}
					}					
		        }else{
					echo $msg_erro;
		        }	
		    }
		?>
                </div>
				<input type="hidden" id="id" name="id"  placeholder="" class="input-xlarge tamanho">
				
                <div class="control-group">
                    <label class="control-label" for="descricao">Descrição</label>
                    <div class="controls">
                        <input type="text" id="descricao" name="descricao" maxlength=20 placeholder="" class="input-xlarge tamanho">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="duracao">Tempo de Duração (Minutos)</label>
                    <div class="controls">
                        <input type="text" id="duracao_hora" name="duracao_hora" value="01" maxlength=20 placeholder="" class="input-xlarge tamanho"> :
                        <input type="text" id="duracao_minuto" name="duracao_minuto" value="00" maxlength=20 placeholder="" class="input-xlarge tamanho">

                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="qtde_limite">Máximo de Jogadores (Em branco = Ilimitado)</label>
                    <div class="controls">
                        <input type="text" id="qtde_limite" name="qtde_limite" maxlength=20 placeholder="" class="input-xlarge tamanho">

                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="funciona">Quadra está funcionando?</label>
                    <div class="controls">
                        <input type="checkbox" name="funciona" id="funciona" value="true" checked>

                    </div>
                </div>
                <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                        <input type="submit" value="Salvar" id="salvar">
                    </div>
                </div>

            </fieldset>
        </form>
        <div class="span12">
			<table >
				<thead>
					<tr>
					
						<th>Descrição</th>
						<th>Duração</th>					
						<th>Limite Jogadores</th>
						<th>Funcionando?</th>
						<th>Excluir</th>
					</tr>
				</thead>
				<tbody>
					<?php
						
						$campos = array("id_empresa" => $_SESSION['usuario_logado']['id']);
						$ordem = array('descricao');
						$quadras = listar('clientes', '00198500', 'clientes.quadra', $campos, $ordem);
						foreach($quadras as $quadra){
						
							echo "<tr id='quadra{$quadra['id']}' onclick='alterarQuadra({$quadra['id']})'><td><a href='#quadra{$quadra['id']}'>{$quadra['descricao']}</a></td>";
							echo "<td>{$quadra['duracao']}</td>";
							echo "<td>". (empty($quadra['qtde_limite']) ? "Ilimitado" : $quadra['qtde_limite']) ."</td>";
							echo "<td>". ($quadra['funciona'] ? "Funcionando" : "Desativada") ."</td>";
							echo "<td class='last'> <input type='button' onclick='deletaQuadra({$quadra['id']})' value='x' id='excluir'></td></tr>";
						}
						
						
						
					?>				
						
					</tr>
				</tbody>
			</table>	
        </div>
    </div>
</div>

<hr />

<?php 
	include 'rodape.php';
?>












