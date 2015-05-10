<?php require_once ('funcoes.php'); ?>
<?php require_once ('conexao.php'); 
conexao();
if (isset($_POST['atualizar'])){ //Se os dados do formularios por post forem de nome atualizar
	$sql_atualizabd = "UPDATE CLIENTES SET nome ='" . $_POST['nome']."', sobrenome='".$_POST['sobrenome']."' WHERE id=" . $_POST['id']; // Vai atualizar o registro com o novo nome, e sobrenome informados
	atualizar($sql_atualizabd); //Chama a funcao atualizar, passando o SQL de update
	$guardaLog = $_POST['nome']. "|" . $_POST['sobrenome'] . "|" . $_POST['id']; //Vai guardar as variaveis selecionadas num array para serem utilizadas no log
	atualizaLog($guardaLog); //Chama a função atualizaLog, do arquivo funcoes, que vai gravar os dados informados no array $guardaLog
	unset($_POST['atualizar']); // Apos ter feito o update, o unset vai limpar as variavies usadas nas codições. Com isso nao vai ter dados no formulario e ele nao ira aparecer mais apos ter feito o update 
	unset($_GET['acao']);       
	unset($_GET['id']);
	echo "<br /> <b>Registro atualizado com sucesso!</b><br />";
}
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<title></title>
</head>
<body>
<?php 
//Para atualizar o registro selecionado
if ((isset ($_GET['acao'])) && ($_GET['acao'] == 'alterar') && (isset($_GET['id']))){ //Se os dados do link alterar foi clicado, passa-o por get
	$sql_update = "SELECT * FROM CLIENTES WHERE id=" . $_GET['id'] ." LIMIT 1"; //Seleciona todos os dados da tabela CLIENTES do registro tal
	$rs_atualiza = seleciona($sql_update);	
    while ($resupdate = mysql_fetch_assoc($rs_atualiza)) {
    ?>
    <form method="POST" enctype="multipart/form-data" action=""> <!-- o action do formulario esta vazio, para exibir o resultado na mesma pagina. Se quise exibir o resultado em outra pagina, deve-se informar a pagina desejada dentro do action -->
		Nome:      <input type="text" name="nome" value="<?php echo ($resupdate['nome']) ?>" /> <br /> <!-- vai exibir o valor de nome buscado no banco no campo nome do formulario -->
		Sobrenome: <input type="text" name="sobrenome" value="<?php echo ($resupdate['sobrenome']) ?>" /> <br /><!-- vai exibir o valor de sobrenome buscado no banco no campo nome do formulario -->
			       <input type="hidden" name="id" value="<?php echo ($resupdate['id']) ?>" />
		<input type="submit" name="atualizar" value="Atualizar" /> <br /> <!-- Formulario de nome atualizar com valuor Atualizar -->
	</form>
    <?php    
    }	
}

//Para excluir o registro selecionado
if ((isset ($_GET['acao'])) && ($_GET['acao'] == 'excluir') && (isset($_GET['id']))){ //Se os dados do link excluir foi clicado, passa-o por get
	$sql_deletar = "DELETE FROM CLIENTES WHERE id = " . $_GET['id']; //Monta o SQL para deletar o registro selecionado
	deletar($sql_deletar); // Chama a funcao deletar do arquivo funcoes passando comando sql com registro desejado para excluir
	echo "<br />Registro ID " . $_GET['id'] . " excluido com sucesso!";
	/* Vai ser utitlizado somente se o outro link excluir passando id e nome for habilitado
	 * $nome = $_GET['nome'];
	 * echo "Nome excluido: " . $nome;	
	 * 
	 */
	$guardaLog = $_GET['id']; //Vai guardar as variaveis selecionadas num array para serem utilizadas no log
	atualizaLog($guardaLog); //Chama a função atualizaLog, do arquivo funcoes, que vai gravar os dados informados no array $guardaLog
	unset($_POST['excluir']); // Apos ter feito o update, o unset vai limpar as variavies usadas nas codições. Com isso nao vai ter dados no formulario e ele nao ira aparecer mais apos ter feito o update
	unset($_GET['acao']);
	unset($_GET['id']);	
}
?>
<?php 
$sql_seleciona = "SELECT * FROM CLIENTES"; //pesquisa por todos os registros da tabela CLIENTES e armazena na variavel $sql_seleciona
$rs_clientes = seleciona($sql_seleciona);  //chama a funcao seleciona do arquivo de funcoes.php e passa o sql para ela. O resultado armazena na variavel $rs_clientes
echo "<br /> O total de registros na tabela CLIENTES é: " . mysql_num_rows($rs_clientes) . "<br />"; //Imprime o total de registros cadastrados
while ($res = mysql_fetch_assoc($rs_clientes)) { // mysql_fetch_assoc: Retorna uma matriz associativa de strings que corresponde a linha obtida, ou FALSE se não
	/*echo ($res['nome']) . " ";                   // houverem mais linhas. Armazena o resultado na variavel $res, onde o o while irá percorre-la e exibir o valor de nome 
	echo ($res['sobrenome']);                    // e sobrenome para o primeiro registro, para o segundo registro etc.
	echo ($res['id']);	
    */
	?> <!--  tem que finalizar o php (mas sem sair do while para entao exibir os resultados e tambem o link de alterar para cada registro-->
	<?php echo ($res['nome']) . " "; ?><?php echo ($res['sobrenome']) ?> |   <!--  exibe nome e sobrenome -->
	<a href="seleciona.php?acao=alterar&id=<?php echo ($res['id']) ?>">Alterar</a> <!--  exibe link alterar pegando o id do registro -->
	<a href="seleciona.php?acao=excluir&id=<?php echo ($res['id']) ?>">Excluir</a> <!--  exibe link excluir pegando o id do registro -->
	<!--  <a href="seleciona.php?acao=excluir&id=<?php echo ($res['id']) ?>&nome=<?php echo ($res['nome']) ?>">Excluir</a> --> <!--  Outro tipo de esclusão, passando ID e nome-->
	<?php
	echo "<br />"; 	 
}
?>
<br />
<a href="index.php">Voltar para o index</a>
</body>
</html>