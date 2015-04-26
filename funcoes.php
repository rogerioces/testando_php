<?php

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
?>