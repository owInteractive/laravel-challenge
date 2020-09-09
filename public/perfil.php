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
?>
<html lang="pt-br">
<link rel="icon" href="mariano_ipiranga.jpg">

  <head>
  
    <meta charset="utf8">
	<link rel="icon" href="myrano_icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=480">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
	<script type="text/javascript" src="js/jquery_min.js"></script>

    <title>Perfil Usuário</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="css/toolkit.css" rel="stylesheet">

    <style>
      body {
        width: 1px;
        min-width: 100%;
        *width: 100%;

      }

    </style>

	
  </head>
<body>
<div id="conteudo">

<style>
.menu{width:100%;height:50px;position:fixed;top:0;z-index:999;font-size:20px;left:0px;}

ul{position:fixed;width:100%;list-style:none;margin-top:0px;background:black;}
li{float:left;text-decoration:none;list-style:none;text-align:center;
border-right: 2px solid #eeeeee;}

a,h2{padding-top:5px;margin-top:0px;resize:true;font-size:22px;text-decoration:none;display:block;width:130px;height:50px;color:white;}
.clic, a:hover{color:white;background:grey;text-decoration:none;}

#dadosmoi{margin:0 auto;width:460px;font-size:17px;}
#alterando{background:#1E90FF;color:white;width:160px;height:35px;font-size:18px;font-weight:bold;border-radius:12px;}
#listagem{background:black;color:white;width:160px;height:35px;font-size:18px;font-weight:bold;border-radius:12px;}
</style>

<div class="menu">
<div id="nav">
<ul>
<li style="margin-left:-40px;"><a style="float:left;width:130px;text-align:center;" 
href="index.php"><h2 style="text-align:left;margin-left:20px;">Eventos</h2></a>
</li>

<li><a class="clic" style="float:left;width:100px;text-align:center;" href="perfil.php"><h2 style="text-align:left;margin-left:20px;">Perfil</h2></a>
</li>

<li style="float:right;border-right:none;"><a style="float:left;width:60px;text-align:center;" href="logout.php" ><h2 style="text-align:left;margin-left:10px;">Sair</h2></a>
</li>
</ul>
</div>

</div>
<br><br>

<?php
include("conectarpdo.php");

$f = 0;

$login = $_SESSION["emaillog"];
$senha = $_SESSION["senha"];

		$sql = $pdo->prepare("SELECT * FROM users WHERE email = :login AND senha = :senha ORDER BY id DESC LIMIT 1");
		$sql->bindValue("login", $login);
		$sql->bindValue("senha", $senha);

		$sql->execute();

		if($sql->rowCount() > 0){
		
		while($row = $sql->fetch(PDO::FETCH_OBJ)){
			
			$id_usu = $row->id;
			$email = $row->email;
			$nome = $row->nome;
			
		}
		}
?>
<br>
<div id="dadosmoi">
<center><h3><b>Meus dados</b></h3>
<b>E-mail: </b><?php echo $email; ?><br>
<b>Nome: </b><?php echo $nome; ?><br><br>

<a href="mudacad.php" id="alterando">Alterar Dados</a><br>
<a href="listacont.php" id="listagem">Lista Contatos</a>
</center>
<br><br>
</div>

<div id="temeve">

<div id="participando">
<center><h3 style="color:black;"><b>Estou Participando</b></h3>
<?php
		$f1 = 0;
		
		date_default_timezone_set ("America/Sao_Paulo");
		
			$dataref = strtotime(date("Y-m-d H:i"));

			$limitemin = $dataref;

		
		$busca = $pdo->prepare("SELECT evento FROM participar WHERE usu = :idusu ORDER BY id ASC");
		
		$busca->bindValue("idusu", $id_usu);
		
		$busca->execute();
		
		if($busca->rowCount() > 0){while($row2 = $busca->fetch(PDO::FETCH_OBJ)){
			$evento = $row2->evento;

			
		$busca2 = $pdo->prepare("SELECT * FROM eventos WHERE id = :evento AND comeco > :min");
		
		$busca2->bindValue("evento", $evento);
		$busca2->bindValue("min", $limitemin);

		$busca2->execute();
		
		if($busca2->rowCount() > 0){while($rowb = $busca2->fetch(PDO::FETCH_OBJ)){
			$ideven = $rowb->id;
			$titulo = $rowb->titulo;
			$descricao = $rowb->descr;
			$comeco = $rowb->comeco;
			$final = $rowb->fim;
			$usu_cad = $rowb->usu;
			
			$f1++;
		
		echo "<p id='ajudater".$f1."'><b>".$titulo."</b> <br> <b>Início:</b> ".date("d-m-Y H:i", $comeco)." <b>Fim:</b> ".date("d-m-Y H:i", $final)."</p><hr>";
?>
<!--Abrir caixa entrar ou sair do evento!-->
<script>
$('#ajudater<?php echo $f1; ?>').click(function(){
	var numi = <?php echo $f1; ?>;
	var idev = <?php echo $ideven; ?>;
	var soueu = <?php echo $id_usu; ?>;
	
	console.log("cliquei abrir" + numi);
		
		var dadospremio = {
			palavra1 : idev + ";" + soueu + ";" + numi 
			}
		
		console.log(idev + " - " + soueu);
		
		$.post('buscaeven.php', dadospremio, function(retorna){
			//Mostra dentro da ul os resultado obtidos 
			$('.resultado').html(retorna);
		});
});
</script>

<style>
#ajudater<?php echo $f1; ?>:hover{cursor:pointer;}
</style>

<!--Fim Abrir caixa entrar ou sair do evento!-->
<?php
		}}
		}echo "<a style='color:green;width:200px;font-size:16px;background:transparent;' target='_blank' id='csvpart' href='csvparticipo.php'>
		Exportar lista eventos csv</a>";}else{echo "<center>Nenhum evento...</center>";}

?>
</center>
<br><br>
</div>

<div id="fazendo">
<center><h3><b style="color:black;">Meus Eventos</b></h3>
<?php
		$f2 = 0;
		
		$busca3 = $pdo->prepare("SELECT * FROM eventos WHERE comeco > :min AND usu = :idusu ORDER BY comeco ASC");
		
		$busca3->bindValue("idusu", $id_usu);
		$busca3->bindValue("min", $limitemin);
		$busca3->execute();
		
		if($busca3->rowCount() > 0){while($row3 = $busca3->fetch(PDO::FETCH_OBJ)){
			$ideven = $row3->id;
			$titulo = $row3->titulo;
			$descricao = $row3->descr;
			$comeco = $row3->comeco;
			$final = $row3->fim;
			$usu_cad = $row3->usu;
			
			$f2++;
			
			echo "<p id='ajudaseg".$f2."'><b>".$titulo."</b> <br> <b>Início:</b> ".date("d-m-Y H:i", $comeco)." <b>Fim:</b> ".date("d-m-Y H:i", $final)."</p><hr>";
			
?>
<!--Abrir caixa entrar ou sair do evento!-->
<script>
$('#ajudaseg<?php echo $f2; ?>').click(function(){
	var numi = <?php echo $f2; ?>;
	var idev = <?php echo $ideven; ?>;
	var soueu = <?php echo $id_usu; ?>;
	
	console.log("cliquei abrir" + numi);
		
		var dadospremio = {
			palavra1 : idev + ";" + soueu + ";" + numi 
			}
		
		console.log(idev + " - " + soueu);
		
		$.post('buscaeven.php', dadospremio, function(retorna){
			//Mostra dentro da ul os resultado obtidos 
			$('.resultado').html(retorna);
		});
});
</script>

<style>
#ajudaseg<?php echo $f2; ?>:hover{cursor:pointer;}
</style>

<!--Fim Abrir caixa entrar ou sair do evento!-->

<?php
		}echo "<a style='color:green;width:200px;font-size:16px;background:transparent;' target='_blank' id='csvpart' href='csvfaco.php'>
		Exportar meus eventos csv</a>";}else{echo "<center>Nenhum evento criado...</center>";}

		$pdo = null;
?>
</center>

</div>
<br><br>
</div>

<style>
#temeve{width:1000px;display:block;margin:0 auto;position:relative;}
#participando{float:left;width:460px;font-size:16px;color:blue;overflow-y:scroll;height:200px;margin-bottom:20px;margin-left:11px;margin-right:11px;}
#fazendo{float:left;width:460px;font-size:16px;color:blue;overflow-y:scroll;height:200px;margin-bottom:20px;margin-left:11px;margin-right:11px;}

@media screen and (min-width:0px) and (max-width:800px){
#temeve{width:100%;display:block;margin:0 auto;position:relative;}
}

#editarev{width:120px;height:30px;border-radius:12px;background:#1E90FF;color:white;cursor:pointer;}
#partev{width:120px;height:30px;border-radius:12px;background:#1E90FF;color:white;cursor:pointer;}
#sairev{width:120px;height:30px;border-radius:12px;background:red;color:white;cursor:pointer;}
	
.dadosven{color:grey;font-size:18px;margin:0 auto;visibility:hidden;display:none;background:#eeeeee;width:390px;border-radius:6px;}
.fechar{float:right;border-radius:23px;opacity:.6;background-color:black;color:white;height:29px;width:29px;cursor:pointer;}

.capa{background: rgba(0, 0, 0, 0.8);width: 100%;height: 100%;position: fixed;top: 0;z-index:8999;display:none;visibility:hidden;scroll:none;}
</style>

<div class="resultado">
</div>
</div>

</body>
</html>