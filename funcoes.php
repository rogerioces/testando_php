<?php
//Define a hora como sendo do Brasil
date_default_timezone_set("Brazil/East");

//setlocale — Define informações locais
setlocale(LC_TIME, "pt_BR");

/** strftime — Formata uma hora/data de acordo com as configurações locais 
 * Parametros para strftime usados: acesse http://php.net/manual/pt_BR/function.strftime.php
 * %A - nome da semana completo de acordo com a localidade 
 * %d - dia do mês como um número decimal (de 01 até 31) 
 * %B - nome do mês completo de acordo com a localidade 
 * %Y - ano como número decimal incluindo o século 
 * %T - hora corrente, igual a %H:%M:%S 
 */
echo strftime("Em Portugues: %A %d %B %Y %T" . "<br />");

/**
 * @param unknown $guardaLog
 * Função que vai receber variaveis informadas e vai gravar a ação feita no arquivo log.log (registrar historico de uso do sistema)
 */
function atualizaLog($guardaLog){
	
	echo "Guarda Log: " . $guardaLog . "<br />"; //Exibe o conteudo do array informado
	
	$dados = explode("|",$guardaLog); /* utiliza a funcao explode, que vai quebrar o conteudo de $guardaLog que esta antes e depois de !, colocando seu valor em cada
										 casa do array $dados 
									  */ 	
	$nome = $dados[0];               // recebe o valor de nome informado no array $guardaLog e atribui a varivel $nome
	$sobrenome = $dados[1];          // recebe o valor de sobrenome informado no array $guardaLog e atribui a varivel $sobrenome
	echo "nome: " . $nome; 
	echo "<br /> Sobrenome: " . $sobrenome;
	
	//Vai guardar a data do sistema no momento quando escrever no arquivo log.log
	$today = strftime("%A %d %B %Y %T"); //Usa a funcao strftime para pegar a hora local e exibir no formato: Dia da semana,(por extenso) dia(numero), mes, ano e hora
	//$today = date("j M Y D G:i:s T");
	echo "<br /> Hora do registro: " . $today;
	
	//funcao count conta o tamanho do array e armazena em $contagemArray
	$contagemArray = count($dados);
	echo "<br />Tamanho do array dados: " . $contagemArray . "<br />";
	
	// Abre ou cria o arquivo log.log
	// "a" representa que o arquivo é aberto para ser escrito
	$fp = fopen("../testando/log/log.log", "a");  //abre o conteudo de log.log dentro da pasta log de testando
  	
	//Se valor de $ contagemArray for menor ou igual a 2, veio da tela de inclusão; senao, veio da tela de alteração
	if ($contagemArray  <= 2){
		// Escreve o conteudo das variaveis no arquivo log.log. No final quebra uma linha
		$escreve = fwrite($fp, "Inclusão - " . "Nome: " . $dados[0] . " Sobrenome: " . $dados[1] .  " " . $today . "\n");
	}else {
		// Escreve o conteudo das variaveis no arquivo log.log, inclusive com o ID do registro. No final quebra uma linha
		$escreve = fwrite($fp, "Atualização - " . "Nome: " . $dados[0] . " Sobrenome: " . $dados[1] .  " ID: " . $dados[2] .  " " . $today . "\n");
	}	

	// Fecha o arquivo
	fclose($fp);
	echo "<br /> log criado com sucesso <br />"; //exibe na tela que o log foi gravado com sucesso

}

function inserir($sql) { //verifica se o comando de inserir sql foi informado
	if (mysql_query($sql)){
		return TRUE;
	}else {
		return FALSE;
	}
	
}

function seleciona($sql){
	return mysql_query($sql);
}

function atualizar($sql) { //verifica se o comando de inserir sql foi informado
	if (mysql_query($sql)){
		return TRUE;
	}else {
		return FALSE;
	}



	
	
	
}
?>