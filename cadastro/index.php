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
                <center><h1>Consulta Cadastrados</h1></center>
            </div>
            <div class="row" style="float: right">
                <div class="col-lg-12 form-group"> 
                    <a href="cadastrar.php"> 
                        <button id="btn_cadastrar" name="btn_cadastrar" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Cadastrar CEP</button>
                    </a>
                </div>
            </div>
   		    <div class="row">
                <div id="tabela" class="col-lg-12">
                        <table class="table table-striped table-bordered dataTable" id="example" aria-describedby="example_info">
                            <thead>                         
                                <tr role ="row">
                                    <th>CEP</th>
                                    <th>Logradouro</th>
                                    <th>Bairro</th>
                                    <th>Cidade</th>
                                    <th>UF</th>
                                    <th style="width: 200px;">Opções</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                    $sql = "SELECT * FROM tb_logradouro";
                                    $result = retorna_consulta($sql);

                                    foreach ($result as $key) 
                                    {
                                ?>
                                    <tr>
                                        <td><?php echo $key["cep"]; ?></td>
                                        <td><?php echo $key["logradouro"]; ?></td>
                                        <td><?php echo $key["bairro"]; ?></td>
                                        <td><?php echo $key["cidade"]; ?></td>
                                        <td><?php echo $key["uf"]; ?></td>
                                        <td>
                                            <a href="editar.php?id=<?php echo $key["token"]; ?>"  ><button id="btn_atualizar" name="btn_atualizar" type="button" class="btn btn-success" >Atualizar <i class="glyphicon glyphicon-refresh" ></i></button></a>
                                            <button id="btn_excluir" name="btn_excluir" type="button" class="btn btn-danger" onclick="excluir('<?php echo $key["token"]; ?>');"> Excluir  <i class="glyphicon glyphicon-floppy-remove" ></i></button>
                                        </td>
                                    </tr>
                                <?php    
                                    }
                               ?>
                            </tbody>
                        </table>
            	</div>
            </div>		
				
		</div>
        <script type="text/javascript" src="js/index.js" ></script>			 
    </body>	
</html>