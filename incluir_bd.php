<?php require_once ('conexao.php'); ?>
<?php require_once ('funcoes.php'); ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<title></title>
</head>
<body>
<?php 
   	if(isset ($_POST['enviar'])){ //Verifica se o comando enviar foi acionado no formulario da pagina incluir.php e contem conteudo
		$nome = $_POST["nome"];   // recebe o valor informado no campo nome
		$sobrenome = $_POST["sobrenome"]; // recebe o valor informado no campo sobrenome
		echo $nome . "<br />";
		echo $sobrenome . "<br />";
		
		conexao(); //aciona conexao com o banco de dados, aquivo conexao.php
		
		$sql_inserir = "INSERT INTO CLIENTES (nome, sobrenome) VALUES ('$nome', '$sobrenome')"; //insere na tabela clientes os valores informados no formulario para nome ex sobrenome 
		
		if (inserir($sql_inserir)){ //chama a funcao inserir, arquivo funcoes.php
			echo ("Registro inserido com sucesso! ID do registro: " .mysql_insert_id() ."<br />"); // Inclui o registro e exibe o ID do registro 
			$guardaLog = $nome. "|" . $sobrenome; //Vai guardar as variaveis selecionadas num array para serem utilizadas no log
			atualizaLog($guardaLog); //Chama a função atualizaLog, do arquivo funcoes, que vai gravar os dados informados no array $guardaLog
			unset($_POST['enviar']); //limpa os dados enviados pelo formulario
			}else {
				echo ("Erro na rotina de inserção!!! " .mysql_error()) ."<br />"; // Exibe que nao foi inserido o registro e informa qual o erro
			}
		
	}
?>
<a href="incluir.php">Voltar para incluir</a>
</body>
</html>