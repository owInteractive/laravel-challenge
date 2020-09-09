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

	$verreq2 = $pdo->prepare("SELECT * FROM eventos WHERE id = :evento ORDER BY id DESC LIMIT 1");
	$verreq2->bindValue("evento", $evento);

	$verreq2->execute();

	if($verreq2->rowCount() > 0){while($row3 = $verreq2->fetch(PDO::FETCH_OBJ)){
		$titulo = $row3->titulo;
		$descricao = $row3->descr;
		
	$verreq3 = $pdo->prepare("SELECT * FROM eventos WHERE id = :evento AND usu = :usuario");
	$verreq3->bindValue("evento", $evento);
	$verreq3->bindValue("usuario", $usuario);

	$verreq3->execute();

	if($verreq3->rowCount() > 0){
	$verreq5 = $pdo->prepare("SELECT * FROM participar WHERE evento = :evento");
	$verreq5->bindValue("evento", $evento);

	$verreq5->execute();

	$partot = $verreq5->rowCount();
	
	$eventocod =  base64_encode($evento);
	$eventocod2 = base64_encode(666);
		
	$botoes = "Total Participantes: <b style='color:red'>$partot</b><br>
	<div id='editarev'>
	<center>Editar</center>
	</div>
	<script>
$('#editarev').click(function(){
	window.location='editar.php?dub=$eventocod&pub=$eventocod2';
});
</script>
	";}else{
		
	$verreq4 = $pdo->prepare("SELECT * FROM participar WHERE evento = :evento AND usu = :usuario");
	$verreq4->bindValue("evento", $evento);
	$verreq4->bindValue("usuario", $usuario);

	$verreq4->execute();

	if($verreq4->rowCount() > 0){
	$botoes = "<div id='voltadela'>
	<div id='resultback'>
	<center><b style='color:green;'>Participando do evento</b></center><div id='sairev'>
	<center>Sair</center>
	</div>
	</div>
	</div>
		<script>
$('#resultback').click(function(){
	var ideven = $evento;
	var idusu = $usuario;
	var numi = $numi;
	
	document.getElementById('ajudater' + numi).innerHTML = '';
		
		var dadospremio = {
			palavra1 : ideven + ';' + idusu + ';' + numi 
		}
		
		$.post('saireven.php', dadospremio, function(retorna){
			//Mostra dentro da ul os resultado obtidos 
			$('#voltadela').html(retorna);
		});
});
</script>
	";}else{$botoes = "
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
			palavra1 : ideven + ';' + idusu + ';' + numi 
		}
		
		$.post('parteven.php', dadospremio, function(retorna){
			//Mostra dentro da ul os resultado obtidos 
			$('#voltadela').html(retorna);
		});
});
</script>
	";}
	}
	
	
	
		echo "

<div class='capa'>

<div class='dadosven'>
<center>
<div class='fechar'>
<font style='font-size:21px;'><b>X</b></font>
</div>
<center><h3><b>$titulo</b></h3></center>
<p style='text-align:justify;margin:6px 6px 6px 6px;'>$descricao</p><br>
$botoes
<br>

</center>
</div>
</div>
<script>
$(document).ready(function(){
		var ident = 0;
		ident ++;
		if (ident == 1){
		$('.dadosven').css({visibility:'visible', display: 'block', marginTop:'100px'});
		$('.capa').css({visibility:'visible', display:'block'});
		}
		if (ident > 1){
		$('.dadosven').css({visibility:'hidden', display:'none'});
		$('.capa').css({visibility:'hidden', display:'none'});
		ident = 0;
		}

	$('.fechar').click(function(){
		$('.dadosven').css({visibility:'hidden', display:'none'});
		$('.capa').css({visibility:'hidden', display:'none'});
		ident = 0;
	});
});
</script>
";
	}}

?>