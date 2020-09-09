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

$valemail = $_POST["email"];
$valnome = $_POST["nome"];

$login = $_SESSION["emaillog"];
$senha = $_SESSION["senha"];

include("conectarpdo.php");

$puxinpre = $pdo->prepare("SELECT * FROM lista WHERE emailusu = :emailusu AND senhausu = :senhausu AND email = :testemail");
$puxinpre->bindValue(":emailusu", $login);
$puxinpre->bindValue(":senhausu", $senha);
$puxinpre->bindValue(":testemail", $valemail);

$puxinpre->execute();

if($puxinpre->rowCount() > 0){
	
}else{

echo "<center><h3><b>Lista de Contatos</b></h3></center>";

$sqlin = $pdo->prepare("INSERT INTO lista (email, nome, emailusu, senhausu) VALUES (:emaillis, :nomelis, :emailusu, :senhausu)");
$sqlin->bindValue(":emaillis", $valemail);
$sqlin->bindValue(":nomelis", $valnome);
$sqlin->bindValue(":emailusu", $login);
$sqlin->bindValue(":senhausu", $senha);

$sqlin->execute();

sleep(1);

$f = 0;

$puxin = $pdo->prepare("SELECT * FROM lista WHERE emailusu = :emailusu AND senhausu = :senhausu ORDER BY id DESC");
$puxin->bindValue(":emailusu", $login);
$puxin->bindValue(":senhausu", $senha);

$puxin->execute();

while($row = $puxin->fetch(PDO::FETCH_OBJ)){
	$id_ref = $row->id;
	$emailden = $row->email;
	$nomeden = $row->nome;
	$f++;
	
	$codman = base64_encode($id_ref);
	
	echo "<a href='deletarpag.php?ped=&carro=$codman&boi=&pasto=' class='vermelhin'><b>X</b></a><b>".$f."</b> - ".$emailden." - ".$nomeden."<br>";
}
}

$pdo = null;

?>