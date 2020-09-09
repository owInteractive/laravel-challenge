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
	
	$classe = (@$_POST['palavra1']);
	
	$campos = explode(";", $classe);
	$evento = $campos[0];
	
	$email = $_SESSION["emaillog"];
	$senha = $_SESSION["senha"];
	
	$verreqpre = $pdo->prepare("SELECT id FROM users WHERE email = :email AND senha = :senha");
	$verreqpre->bindValue("email", $email);
	$verreqpre->bindValue("senha", $senha);

	$verreqpre->execute();
	
	if($verreqpre->rowCount() > 0){while($rowpre = $verreqpre->fetch(PDO::FETCH_OBJ)){
		$id_usu = $rowpre->id;
	}

	
		$verreq21 = $pdo->prepare("DELETE FROM eventos WHERE id = :evento AND usu = :usuario");
		$verreq21->bindValue("evento", $evento);
		$verreq21->bindValue("usuario", $id_usu);

		$verreq21->execute();
		
		echo "
<script>
	window.location='perfil.php';
</script>
";
		
	}


?>