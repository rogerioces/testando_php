<?php require_once ('conexao.php'); ?>
<?php require_once ('funcoes.php'); ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<title></title>
</head>
<body>
<?php 
conexao();
$sql_seleciona = "SELECT * FROM CLIENTES"; //pesquisa por todos os registros da tabela CLIENTES e armazena na variavel $sql_seleciona
$rs_clientes = seleciona($sql_seleciona);  //chama a funcao seleciona do arquivo de funcoes.php e passa o sql para ela. O resultado armazena na variavel $rs_clientes
echo "O total de registros na tabela CLIENTES é: " . mysql_num_rows($rs_clientes) . "<br />"; //Imprime o total de registros cadastrados
while ($res = mysql_fetch_assoc($rs_clientes)) { // mysql_fetch_assoc: Retorna uma matriz associativa de strings que corresponde a linha obtida, ou FALSE se não
	echo ($res['nome']) . " ";                   // houverem mais linhas. Armazena o resultado na variavel $res, onde o o while irá percorre-la e exibir o valor de nome 
	echo ($res['sobrenome']) . "<br /> " ;       // e sobrenome para o primeiro registro, para o segundo registro etc. 
}
?>
<a href="index.php">Voltar para o index</a>
</body>
</html>