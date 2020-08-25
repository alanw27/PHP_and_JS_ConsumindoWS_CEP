<?php
	require_once('../core/index.php');

	$token = sanitize("id");
	$sql = "SELECT * FROM tb_logradouro WHERE token = '$token'";
	$result = retorna_consulta($sql);
?>
<!DOCTYPE html>
<html>
<?php require_once('../htmls/header.php'); ?>

    <body class="bootstrap-admin-with-small-navbar">	
		
		<?php require_once('../htmls/menu-superior-menor.php'); ?>
		<?php require_once('../htmls/menu-superior-maior.php'); ?>
		
        <div class="container">
            <div class="row"> 
	            <form id="form_cep_cadastrar" name="form_cep_cadastrar">
					<fieldset>
						<legend id="legend_dados_pessoais">Visualizar CEP</legend>     		
			          	
		                <div class="row">   
		              
		                	<div class="col-lg-2 form-group">
		                		<label for="cep">CEP:</label>
		                		<input id="cep" name="cep" type="text" value="<?php echo $result[0]['cep'] ?>" readonly="readonly" placeholder="Somente números" class="form-control" maxlength="10"/>
		                	</div>

		                	<div class="col-lg-10 form-group">
		                		<label for="logradouro">Logradouro:</label>
		                		<input id="logradouro" name="logradouro" type="text" value="<?php echo $result[0]['logradouro'] ?>" readonly="readonly" class="form-control" maxlength="100" />
		                	</div>

		                </div>

		                <div class="row">
		                	<div class="col-lg-5 form-group">
		                		<label for="bairro">Bairro:</label>
		                		<input id="bairro" name="bairro" type="text" value="<?php echo $result[0]['bairro'] ?>" readonly="readonly" class="form-control" maxlength="100" />
		                	</div>

		                	<div class="col-lg-5 form-group">
		                		<label for="cidade">Cidade:</label>
		                		<input id="cidade" name="cidade" type="text" value="<?php echo $result[0]['cidade'] ?>" readonly="readonly" class="form-control" maxlength="100" />
		                	</div>		

		                	<div class="col-lg-2 form-group">
		                		<label for="uf">UF:</label>
		                		<input id="uf" name="uf" type="text" value="<?php echo $result[0]['uf'] ?>" readonly="readonly" class="form-control" maxlength="2" />
		                	</div>	
		            	</div>

		            	<br/>
		                
		                <div class="row">
		                	<div class="col-lg-12 form-group">
		                    	<a href="/TesteCD2/index.php">
		                    		<button id="btn_voltar" name="btn_cancelar" type="button" class="btn btn-primary"> <i class="glyphicon glyphicon-circle-arrow-left"> <b>VOLTAR</b> </i></button>
		                    	</a>
		                    </div>
		                </div>

					</fieldset>
				</form>
			</div>
			<?php require_once("../modal/index.php") ?>
        </div>
    </body>	
</html>