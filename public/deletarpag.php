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

include("conectarpdo.php");

$codref = base64_decode($_GET["carro"]);
$login = $_SESSION["emaillog"];
$senha = $_SESSION["senha"];

		$verreq21 = $pdo->prepare("DELETE FROM lista WHERE emailusu = :emailusu AND senhausu = :senhausu AND id = :codid");
		$verreq21->bindValue("emailusu", $login);
		$verreq21->bindValue("senhausu", $senha);
		$verreq21->bindValue("codid", $codref);

		$verreq21->execute();
		
		echo "
<script>
	window.location='listacont.php';
</script>
";

$pdo = null;
?>