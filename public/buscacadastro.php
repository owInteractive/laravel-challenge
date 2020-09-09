<?php
if(isset($_POST['email']) && isset($_POST['senha'])){
	
include("conectarpdo.php");
include("usuario_pdo.php");

$u = new Usuario();

$email = addslashes(trim($_POST['email']));
$senha = addslashes(sha1($_POST['senha']));

if($_POST['salvifica'] == "salvar"){
setcookie('valsalmail', $email, time() + (3600*24*365*2));
setcookie('valsalpass', $_POST['senha'], time() + (3600*24*365*2));
}

$ir = (@$_POST['pagina']);

if($u->login($email, $senha) == true){
	if(isset($_SESSION["emaillog"]) || isset($_SESSION["senha"]) || isset($_SESSION["empr"])){
		if(!empty($ir)){
			header("Location: $ir");
		}else{header("Location: index.php");}
	}else{header("Location: teste_login.php");}
}else{
	header("Location: teste_login.php");
	}

$pdo = null;
	}else{header("Location: teste_login.php");}
?>