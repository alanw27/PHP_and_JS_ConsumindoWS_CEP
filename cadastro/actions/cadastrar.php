<?php
	require_once('../../core/index.php');

	$acao = sanitize('acao');

	if(isset($acao))
	{
		switch (strtoupper($acao)) 
		{
			case strtoupper('salvar_e_concluir'):
			
				cadastra_CEP();

			break;
			case strtoupper('buscaCEPNaBase'):
			
				verificaCEPCadastrado();

			break;
			default:
				
				break;
		}
	}

	function cadastra_CEP()
	{
		$logradouro = sanitize("logradouro");
		$bairro = sanitize("bairro");
		$cidade = sanitize("cidade");
		$uf = sanitize("uf");
		$cep = sanitize("cep");
		$token = generateRandomString(256);

		$sql = "INSERT INTO 
			  `tb_logradouro`
			(
				logradouro,
				bairro,
				cidade,
				uf,
				cep,
				token
			) 
			VALUES 
			(
			  '$logradouro',
			  '$bairro',
			  '$cidade',
			  '$uf',
			  '$cep',
			  '$token'
			);";
		//echo $sql;die;
		$cod_cep = salvarSpecial($sql);
		if($cod_cep)
		{
			echo "CEP cadastrado com sucesso!";
			die();
		}	
		else
		{
			echo "Ocorreu um erro ao tentar cadastrar o CEP, se o erro persistir, favor contatar o administrador do sistema.";
			die();
		}
	}
	function verificaCEPCadastrado()
	{
		$cep = sanitize("cep");
		if(!empty($cep))
		{
			$sql = "select * from tb_logradouro where cep = '$cep'";
			//echo $sql;die;
			$tb_logradouro = retorna_consulta($sql);
			$cepCadastrado = count($tb_logradouro) > 0;

			if($cepCadastrado)
			{
				echo json_encode($tb_logradouro);
				die;
			}
			else
			{
				echo json_encode(array());
				die();
			}
		}	
	}