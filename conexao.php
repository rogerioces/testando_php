<?php
/* Arquivo de conexão com o banco de dados Mysql
 * 
 */
   function conexao () {
	$banco 	   = "testando";  //informar o banco a se conectar
	$usuario   = "root";  //informar o usuario do banco
	$senha 	   = "";      //informar a senha do banco
	$host      = "localhost"; //informar se site local (localhost) ou site externo
	$conn 	   = mysql_connect($host, $usuario, $senha) or die ("Erro na rotina de conexao: " .mysql_error());
            
	mysql_select_db($banco) or die ("Erro ao selecionar o banco de dados: "  .mysql_error());
	
   }


?>
