<?php
	require_once('../core/index.php');
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
						<legend id="legend_dados_pessoais">Cadastro de CEP</legend>     		
			          	
		                <div class="row">   
		              
		                	<div class="col-lg-2 form-group">
		                		<label for="cep">CEP:</label>
		                		<input id="cep" name="cep" type="text" placeholder="Somente números" class="form-control" maxlength="10"/>
		                	</div>

		                	<div class="col-lg-10 form-group">
		                		<label for="logradouro">Logradouro:</label>
		                		<input id="logradouro" name="logradouro" type="text" readonly="readonly" class="form-control" maxlength="100" />
		                	</div>

		                </div>

		                <div class="row">
		                	<div class="col-lg-5 form-group">
		                		<label for="bairro">Bairro:</label>
		                		<input id="bairro" name="bairro" type="text" readonly="readonly" class="form-control" maxlength="100" />
		                	</div>

		                	<div class="col-lg-5 form-group">
		                		<label for="cidade">Cidade:</label>
		                		<input id="cidade" name="cidade" type="text" readonly="readonly" class="form-control" maxlength="100" />
		                	</div>		

		                	<div class="col-lg-2 form-group">
		                		<label for="uf">UF:</label>
		                		<input id="uf" name="uf" type="text" readonly="readonly" class="form-control" maxlength="2" />
		                	</div>	
		            	</div>

		            	<br/>
		                
		                <div class="row">
		                	<div class="col-lg-12 form-group" style="margin-top:29px">
		                    	<button id="btn_salvar" name="btn_salvar" type="button" class="btn btn-primary"> Salvar e Finalizar <i class="glyphicon glyphicon-floppy-saved"></i></button>
		                  
		                    	<button id="btn_cancelar" name="btn_cancelar" type="button" class="btn btn-danger"> Cancelar <i class="glyphicon glyphicon-floppy-remove"></i></button>
		                    </div>
		                </div>

					</fieldset>
				</form>
			</div>
			<?php require_once("../modal/index.php") ?>
        </div>
		<script type="text/javascript" src="js/cadastrar.js" ></script>
    </body>	
</html>