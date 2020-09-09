<?php

$arquivoread = fopen ('listas/teste_email.csv', 'r');
	
while(!feof($arquivoread)){
// Pega os dados da linha
$linha = fgets($arquivoread, 1024);

// Divide as Informações das celular para poder salvar
$dados = explode(';', $linha);

// Verifica se o Dados Não é o cabeçalho ou não esta em branco
if($dados[0] != 'Nome' && !empty($linha))
{
	$emailenv = $dados[0];
	$nomeenv = $dados[1];
	
	echo $emailenv;
	}
}


?>