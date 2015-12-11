
<?php 
	$atual = basename(__FILE__);  
    include('topo.php'); 
	require '../include/banco.php';
?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

<script type="text/javascript">
	$(function() {
		
		$( "#calendario" ).datepicker({
			buttonImageOnly: true,
			showOtherMonths: true,
			selectOtherMonths: true,
			dateFormat: 'yy-mm-dd',
			dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    
		});
	});
	
	
	function excluirFeriado(id){
		$.ajax({
				url : 'functions/deletaFeriado.php', /* URL que será chamada */ 
				type : 'POST', /* Tipo da requisição */ 
				data: 'id=' + id,
				dataType: 'json', /* Tipo de transmissão */
				success: function(data){
						$('#dia'+id).remove();
						
					
									
				}
		   });   
	}
	
</script>


<div class="row">
    <div class="span12">
        <form class="form-horizontal invisivel" action="" method="POST"  id="form">
            <fieldset>
                <div id="legend">
                    <legend class=""><h1>Feriados</h1></legend>
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
					
					if(empty($_POST['descricao'])){
						$msg_erro = $msg_erro . "A descrição precisa ser preenchida! <br \>";
						$erro = true;
					}

					if(empty($_POST['feriado'])){
						$msg_erro = $msg_erro . "A data precisa ser preenchida! <br \>";
						$erro = true;
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
					$_POST['id_empresa'] = $_SESSION['usuario_logado']['id'];					
					
					$_POST['funciona'] = 'true';
					if(inserir('clientes', '00198500', 'clientes.dia_semana', $_POST, array('id' => "(SELECT nextval('seq_dia_da_semana'))"))){
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
                        <input type="text" id="descricao" name="descricao" maxlength=20 placeholder="" class="input-xlarge tamanho" >

                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="feriado">Dia do Feriado</label>
                    <div class="controls">
                        
						<input type="text" name='feriado' id="calendario" placeholder="" class="input-xlarge tamanho"/>
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
					
						<th>Feriado</th>
						<th>Data</th>					
						<th>Excluir?</th>
					</tr>
				</thead>
				<tbody>
					<?php
						
						$campos = array("id_empresa" => $_SESSION['usuario_logado']['id']);
						$camposEspeciais = array('feriado' => ' IS NOT NULL');
						$ordem = array('feriado', 'descricao');
						$dias = listar('clientes', '00198500', 'clientes.dia_semana', $campos, $ordem, null, null, $camposEspeciais);
						
						foreach($dias as $dia){
						
							echo "<tr id='dia{$dia['id']}' ><td>{$dia['descricao']}</td>";
							echo "<td>{$dia['feriado']}</td>";
					
							echo "<td class='last'> <input type='button' onclick='excluirFeriado({$dia['id']})' value='x' id='excluir'></td></tr>";
							
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












