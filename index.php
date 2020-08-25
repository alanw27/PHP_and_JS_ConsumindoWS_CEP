<?php
	require_once('core/index.php');
?>
<!DOCTYPE html>
<html>
	<?php require_once('htmls/header.php'); ?>

    <body class="bootstrap-admin-with-small-navbar">
		
		<?php require_once('htmls/menu-superior-menor.php'); ?>
		<?php require_once('htmls/menu-superior-maior.php'); ?>
		
       
        <div class="container">
            <div class="row">

                <center><h1>Consulta CEP's Cadastrados</h1></center>

            </div>
   		    <div class="row">
                <div id="tabela" class="col-lg-12">
                        <table class="table table-striped table-bordered dataTable" id="example" aria-describedby="example_info">
                            <thead>                         
                                <tr role ="row">
                                    <th>CEP</th>
                                    <th>Logradouro</th>
                                    <th style="width: 200px;">Opções</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                    $sql = "SELECT cep, logradouro, token FROM tb_logradouro";
                                    $result = retorna_consulta($sql);

                                    foreach ($result as $key) 
                                    {
                                ?>
                                    <tr>
                                        <td><?php echo $key["cep"]; ?></td>
                                        <td><?php echo $key["logradouro"]; ?></td>
                                        <td>
                                            <a href="/TesteCD2/cadastro/visualizar.php?id=<?php echo $key["token"]; ?>"  ><button id="btn_visualizar" name="btn_visualizar" type="button" class="btn btn-success" >Visualizar <i class="glyphicon glyphicon-search" ></i></button></a>
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