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
	$usuario = $campos[1];
	$numi = $campos[2];
	
	$email = $_SESSION["emaillog"];
	$senha = $_SESSION["senha"];
	
	$verreqpre = $pdo->prepare("SELECT nome FROM users WHERE email = :email AND senha = :senha ORDER BY id DESC LIMIT 1");
	$verreqpre->bindValue("email", $email);
	$verreqpre->bindValue("senha", $senha);

	$verreqpre->execute();
	
	while($rowpre = $verreqpre->fetch(PDO::FETCH_OBJ)){
		$nome = $rowpre->nome;
	}

	$verreq2 = $pdo->prepare("SELECT * FROM participar WHERE evento = :evento AND usu = :usuario ORDER BY id DESC LIMIT 1");
	$verreq2->bindValue("evento", $evento);
	$verreq2->bindValue("usuario", $usuario);

	$verreq2->execute();

	if($verreq2->rowCount() > 0){
		$verreq21 = $pdo->prepare("DELETE FROM participar WHERE evento = :evento AND usu = :usuario");
		$verreq21->bindValue("evento", $evento);
		$verreq21->bindValue("usuario", $usuario);

		$verreq21->execute();
		
		echo "
		<div id='voltadela'>
		<div id='partev'>
		<center>Participar</center>
		</div>
		</div>
	
		<script>
$('#partev').click(function(){
	var ideven = $evento;
	var idusu = $usuario;
	var numi = $numi;
	
	document.getElementById('ajudater' + numi).innerHTML = '<b style=color:blue;font-size:10px;>Participando</b>';
			
		var dadospremio = {
			palavra1 : ideven + ';' + idusun + ';' + numi 
		}
		
		$.post('parteven.php', dadospremio, function(retorna){
			//Mostra dentro da ul os resultado obtidos 
			$('#voltadela').html(retorna);
		});
});
</script>
";
		
	}


?>