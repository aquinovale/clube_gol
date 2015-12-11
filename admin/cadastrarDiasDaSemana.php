
<?php 
	$atual = basename(__FILE__);  
    include('topo.php'); 
	require '../include/banco.php';
?>

<script type="text/javascript">
	
	
	function alterarDiaDaSemana(id){
		$.ajax({
				url : 'functions/alterarDiaDaSemana.php', /* URL que será chamada */ 
				type : 'POST', /* Tipo da requisição */ 
				data: 'id=' + id,
				dataType: 'json', /* Tipo de transmissão */
				success: function(data){
					$('#form').fadeIn();
					$('#id').val(data.id);
					$('#descricao').val(data.descricao);
					$('#hora_inicio_hora').val(data.hora_inicio.substr(0,2));
					$('#hora_inicio_minuto').val(data.hora_inicio.substr(3,2));
					$('#hora_final_hora').val(data.hora_final.substr(0,2));
					$('#hora_final_minuto').val(data.hora_final.substr(3,2));
					if(data.funciona){
						$('#funciona').attr("checked",true);
					}else{
						$('#funciona').attr("checked",false);
					}
					
									
				}
		   });   
	}
	
</script>


<div class="row">
    <div class="span12">
        <form class="form-horizontal " action="" method="POST" style="display: none;" id="form"> 
            <fieldset>
                <div id="legend">
                    <legend class=""><h1>Dias de Funcionamento</h1></legend>
                </div>
			<?php
				$class='';
				header('Content-type: text/html; charset=UTF-8');
				if($_SERVER['REQUEST_METHOD'] == "POST") {
					$erro = false;
					$msg_erro = '';
		
					if(empty($_SESSION['usuario_logado']['id'])){
						$msg_erro = $msg_erro . "Problemas ao identificar Empresa! <br \>";
						$erro = true;	
					}
										
					if(empty($_POST['hora_inicio_hora']) or empty($_POST['hora_inicio_minuto'])){
						$msg_erro = $msg_erro . "A hora de início precisa ser preenchido! <br \>";
						$erro = true;
					}else{
						if($_POST['hora_inicio_hora'] >= 24 or $_POST['hora_inicio_minuto'] >= 60){
							$msg_erro = $msg_erro . "O horário está incorreto! <br \>";
							$erro = true;
						}else{
							$_POST['hora_inicio'] = $_POST['hora_inicio_hora']. ":" .  $_POST['hora_inicio_minuto'];
							
						}							
					}
					
					if(empty($_POST['hora_final_hora']) or empty($_POST['hora_final_minuto'])){
						$msg_erro = $msg_erro . "A hora de final precisa ser preenchido! <br \>";
						$erro = true;
					}else{
						if($_POST['hora_final_hora'] >= 24 or $_POST['hora_final_minuto'] >= 60){
							$msg_erro = $msg_erro . "O horário está incorreto! <br \>";
							$erro = true;
						}else{
							$_POST['hora_final'] = $_POST['hora_final_hora']. ":" .  $_POST['hora_final_minuto'];
							
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
					$where = array('id' => $_POST['id'], 'id_empresa' => $_SESSION['usuario_logado']['id']);
					unset($_POST['id']);
					unset($_POST['hora_inicio_hora']);
					unset($_POST['hora_inicio_minuto']);	
					unset($_POST['hora_final_hora']);
					unset($_POST['hora_final_minuto']);	
					if(!isset($_POST['funciona'])){						
						$_POST['funciona'] = 'false';
					}
				
					if(editar('clientes', '00198500', 'clientes.dia_semana', $where, $_POST)){
						unset($_POST);
						echo 'Alteração feita com sucesso.';
					}else{
						unset($_POST);
						echo 'Problemas ao editar quadra.';
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
                        <input type="text" id="descricao" name="descricao" maxlength=20 placeholder="" class="input-xlarge tamanho" readonly>

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="hora_inicio">Hora de Início</label>
                    <div class="controls">
                        <input type="text" id="hora_inicio_hora" name="hora_inicio_hora" value="08" maxlength=20 placeholder="" class="input-xlarge tamanho"> :
                        <input type="text" id="hora_inicio_minuto" name="hora_inicio_minuto" value="00" maxlength=20 placeholder="" class="input-xlarge tamanho">

                    </div>
                </div>
                

                <div class="control-group">
                    <label class="control-label" for="hora_final">Hora de Final</label>
                    <div class="controls">
                        <input type="text" id="hora_final_hora" name="hora_final_hora" value="18" maxlength=20 placeholder="" class="input-xlarge tamanho"> :
                        <input type="text" id="hora_final_minuto" name="hora_final_minuto" value="00" maxlength=20 placeholder="" class="input-xlarge tamanho">

                    </div>
                </div>                
                
                <div class="control-group">
                    <label class="control-label" for="funciona">Funciona neste dia?</label>
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
						<th>Hora Início</th>					
						<th>Hora Final</th>
						<th>Funcionando?</th>
						<th>Alterar</th>
					</tr>
				</thead>
				<tbody>
					<?php
						
						$campos = array("id_empresa" => $_SESSION['usuario_logado']['id']);
						$camposEspeciais = array("feriado" => " IS NULL ");
						$ordem = array('id');
						$dias = listar('clientes', '00198500', 'clientes.dia_semana', $campos, $ordem, null, null, $camposEspeciais);
						foreach($dias as $dia){
						
							echo "<tr id='dia{$dia['id']}' ><td>{$dia['descricao']}</td>";
							echo "<td>{$dia['hora_inicio']}</td>";
							echo "<td>{$dia['hora_final']}</td>";						
							echo "<td>". ($dia['funciona'] ? "Funcionando" : "Desativada") ."</td>";							
							echo "<td class='last'> <input type='button' onclick='alterarDiaDaSemana({$dia['id']})' value='Alterar' id='excluir'></td></tr>";
							
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












