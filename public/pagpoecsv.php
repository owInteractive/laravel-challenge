<?php
//Inicio criação sessão com Cookies
if(isset($_COOKIE['adenX9Tro']) && isset($_COOKIE['sinH3Nta']) && isset($_COOKIE['emP3rsta']) 
	&& isset($_COOKIE['aleatOLogin']) && isset($_COOKIE['tementrapag'])){
	session_start();
	$_SESSION['emaillog'] = $_COOKIE['adenX9Tro'];
	$_SESSION['senha'] = $_COOKIE['sinH3Nta'];
	$_SESSION['empr'] = $_COOKIE['emP3rsta'];
}else{session_start();}
//Fim criando sessão com Cookies

if(!isset($_SESSION["emaillog"]) || !isset($_SESSION["senha"]) || !isset($_SESSION["empr"])) {
	header("Location: teste_login.php?pag=index.php");
	exit;
}

if((($_SESSION["empr"]) <> 'MaR14n0') || (($_SESSION["emaillog"]) == "")){
	header("Location: teste_login.php");
	exit;
}
date_default_timezone_set ("America/Sao_Paulo");

include("conectarpdo.php");


$arqlista = $_FILES['arqcsv'];

	if(!empty($_FILES['arqcsv']['name'])){
		$extensao2 = $_FILES['arqcsv']['name'];
		$diretorio2 = "listas/";
	
		move_uploaded_file($_FILES['arqcsv']['tmp_name'], $diretorio2.$extensao2);
	}
	
	sleep(3);
	
	$login = $_SESSION["emaillog"];
	$senha = $_SESSION["senha"];
	
	$linkarq = "listas/".$extensao2;
	
	$arquivoread = fopen ($linkarq, 'r');
	
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
	
$sqlin = $pdo->prepare("INSERT INTO lista (email, nome, emailusu, senhausu) VALUES (:emaillis, :nomelis, :emailusu, :senhausu)");
$sqlin->bindValue(":emaillis", $emailenv);
$sqlin->bindValue(":nomelis", $nomeenv);
$sqlin->bindValue(":emailusu", $login);
$sqlin->bindValue(":senhausu", $senha);

$sqlin->execute();
}
}
	
	
	$pdo = null;
	
echo "<script>
window.location='listacont.php';
</script>";
?>