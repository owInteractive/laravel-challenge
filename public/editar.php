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
?>
<html lang="pt-br">
<link rel="icon" href="mariano_ipiranga.jpg">

  <head>
  
    <meta charset="utf8">
	<link rel="icon" href="myrano_icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=420">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
	<script type="text/javascript" src="js/jquery_min.js"></script>

    <title>Editar Evento</title>

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

#dadosmoi{margin:0 auto;width:380px;font-size:17px;}
#listapart{margin:0 auto;width:380px;font-size:17px;}

#maiszao{margin:0 auto;height:40px;width:40px;font-size:25px;background:green;border-radius:25px;color:white;font-weight:bold;cursor:pointer;}

.cg{text-decoration: none;padding:5px;font-weight:400;font-size:18px;color:white;background-color:black;
border-radius: 6px;}
.cg:hover{background-color:#454040;color:white;}
#msg{margin:0 auto;color:red;font-size:17px;font-weight:bold;height:25px;}

#contatospa{visibility:hidden;display:none;}
.mailenv{display:none;visibility:hidden;}
</style>

<div class="menu">
<div id="nav">
<ul>
<li style="margin-left:-40px;"><a style="float:left;width:130px;text-align:center;" 
href="index.php"><h2 style="text-align:left;margin-left:20px;">Eventos</h2></a>
</li>

<li><a style="float:left;width:100px;text-align:center;" href="perfil.php"><h2 style="text-align:left;margin-left:20px;">Perfil</h2></a>
</li>

<li style="float:right;border-right:none;"><a style="float:left;width:60px;text-align:center;" href="logout.php" ><h2 style="text-align:left;margin-left:10px;">Sair</h2></a>
</li>
</ul>
</div>

</div>
<br><br>

<div class="mailenv">

</div>

<?php
include("conectarpdo.php");

$f = 0;

$numeven = base64_decode($_GET["dub"]);
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
		
		$sql2 = $pdo->prepare("SELECT * FROM eventos WHERE id = :neven AND usu = :idodu ORDER BY id DESC LIMIT 1");
		$sql2->bindValue("neven", $numeven);
		$sql2->bindValue("idodu", $id_usu);

		$sql2->execute();

		if($sql2->rowCount() > 0){
		
		while($row2 = $sql2->fetch(PDO::FETCH_OBJ)){
			
			$id_noeven = $row2->id;
			$titulo = $row2->titulo;
			$descricao = $row2->descr;
			$inicio = $row2->comeco;
			$fim = $row2->fim;
			
		}
		}else{echo 'Nenhum resultado encontrado...<br>
		<script>
			window.location="perfil.php";
		</script>';}

if(isset($_POST['mandando'])){

$notitulo = (@$_POST['ntitulo']);
$nodescr = (@$_POST['ndescricao']);

$noinicio = strtotime(date($_POST['ninicio']));
$nofim = strtotime(date($_POST['nfinal']));

$querin = $pdo->prepare("UPDATE eventos SET titulo = :notitulo, descr = :nodescr, comeco = :noinicio, fim = :nofim WHERE id = :idnoeven AND usu = :idusu");
$querin->bindValue("notitulo", $notitulo);
$querin->bindValue("nodescr", $nodescr);
$querin->bindValue("noinicio", $noinicio);
$querin->bindValue("nofim", $nofim);
$querin->bindValue("idnoeven", $id_noeven);
$querin->bindValue("idusu", $id_usu);

$querin->execute();

echo '<script>
	alert("Dados do evento alterados! Você será redirecionado para a página de perfil.");
</script>';

echo '<script>
	window.location="perfil.php";
</script>';
}
$pdo = null;

$iniciomos = date("d-m-Y H:i", $inicio);
$finalmos = date("d-m-Y H:i", $fim);
?>

<div id="dadosmoi">
<center><h3><b>Alterar Dados Evento</b></h3></center>

<form name="contato" name="enviaformo" target method="post">
<b>Título: </b><br>
<input type="text" name="ntitulo" value="<?php echo $titulo; ?>" class="form-control" placeholder="Título..." required><br>

<b>Descrição: </b><br>
<textarea name="ndescricao" rows="6" style="width:380px;" id="descr" class="form-control" placeholder="Descrição..." required><?php echo $descricao; ?></textarea><br>

<b>Começo: </b><br>
<input type="text" name="ninicio" value="<?php echo $iniciomos; ?>" class="form-control" placeholder="Início..." required><br>

<b>Fim: </b><br>
<input type="text" name="nfinal" value="<?php echo $finalmos; ?>" class="form-control" placeholder="Final..." required><br>


<center>
<button style="margin-bottom:8px;" class="cg" id="enviacadas" name="mandando" type="submit">Alterar</button>
<button style="margin-left:10px;margin-bottom:8px;" class="cg" type="reset">Reset</button>
</center>
</form>

<style>
#deletaqui{background:red;color:white;width:110px;height:33px;font-size:18px;font-weight:bold;border-radius:12px;margin:0 auto;cursor:pointer;}
#deletaqui2{background:red;color:white;width:110px;height:33px;font-size:18px;font-weight:bold;border-radius:12px;margin:0 auto;cursor:pointer;}

.dadosvenx{color:grey;font-size:18px;margin:0 auto;visibility:hidden;display:none;background:#eeeeee;width:390px;border-radius:6px;}
.fecharx{float:right;border-radius:23px;opacity:.6;background-color:black;color:white;height:29px;width:29px;cursor:pointer;}

.capax{background: rgba(0, 0, 0, 0.8);width: 100%;height: 100%;position: fixed;top: 0;z-index:8999;display:none;visibility:hidden;scroll:none;}
#convidando{background:#1E90FF;color:white;width:235px;height:30px;font-size:17px;font-weight:bold;border-radius:12px;margin:0 auto;cursor:pointer;}
</style>

<div id="deletaqui">
<center>Deletar</center>
</div>

<hr>
</div>
<div id="listapart">
<div id="convidando">
<center>Convidar Lista de Contatos</center>
</div>

<script>
$('#convidando').click(function(){
	var numi = <?php echo $id_noeven; ?>;
		
		var dadospremio = {
			palavra1 : numi 
			}
		
		$.post('enviaplista.php', dadospremio, function(retorna){
			//Mostra dentro da ul os resultado obtidos 
			$('.mailenv').html(retorna);
		});
	
	$('#convidando').css({visibility:'hidden', display:'none'});
	
});
</script>

<center><h3>Participantes</h3>
<div id="maiszao">
+
</div>
<script>
var numma = 0;
$("#maiszao").click(function(){
	
	if(numma == 0){
		$('#contatospa').css({visibility:'visible', display:'block'});
		$('#maiszao').css({background:'red'});
		numma ++;
	}else{
		$('#contatospa').css({visibility:'hidden', display:'none'});
		$('#maiszao').css({background:'green'});
		numma = 0;
	}
});
</script>
<div id="contatospa">
<center>
<?php
include("conectarpdo.php");

$p = 0;

	$verreq5 = $pdo->prepare("SELECT * FROM participar WHERE evento = :evento");
	$verreq5->bindValue("evento", $numeven);

	$verreq5->execute();

	$partot = $verreq5->rowCount();
	
	echo "Total Participantes: <b style='color:red'>".$partot."</b><br>";
	if($verreq5->rowCount() > 0){
		echo "<a style='color:green;width:200px;font-size:16px;background:transparent;' target='_blank' id='csvpart' href='csvusus.php?ped=$numeven'>
		Exportar Participantes csv</a>";
	}
	
	if($verreq5->rowCount() > 0){while($rowpar = $verreq5->fetch(PDO::FETCH_OBJ)){
		$emaillista = $rowpar->email;
		$nomelista = $rowpar->nome;
		$p ++;
		
		echo "<b>".$p."</b> - ".$emaillista." - ".$nomelista."<br>";
	}}else{echo "Nenhum participante...";}
	
?>
</center>
</div>

</center>


<br><br>
</div>
</div>

<!--Início capa com confirma box!-->
<div class="respondendo">

</div>

<script>
$(document).ready(function(){
	$('#deletaqui').click(function(){
		var ident = 0;
		ident ++;
		if (ident == 1){
		$('.dadosvenx').css({visibility:'visible', display: 'block', marginTop:'100px'});
		$('.capax').css({visibility:'visible', display:'block'});
		}
		if (ident > 1){
		$('.dadosvenx').css({visibility:'hidden', display:'none'});
		$('.capax').css({visibility:'hidden', display:'none'});
		ident = 0;
		}
	});
	$('.fecharx').click(function(){
		$('.dadosvenx').css({visibility:'hidden', display:'none'});
		$('.capax').css({visibility:'hidden', display:'none'});
		ident = 0;
	});
});
</script>


<div class="capax">

<div class="dadosvenx">
<center>
<div class="fecharx">
<font style="font-size:21px;"><b>X</b></font>
</div>
<h3>Deseja realmente excluir o evento?</h3><br>
<div id="deletaqui2">
<center>Deletar</center>
</div>
<br>
<script>
$("#deletaqui2").click(function(){
	var numi = <?php echo $numeven; ?>;
			
		var dadospremio = {
			palavra1 : numi 
			}
		
		$.post('excluiev.php', dadospremio, function(retorna){
			//Mostra dentro da ul os resultado obtidos 
			$('.respondendo').html(retorna);
		});
});
</script>

</center>
</div>
</div>
<!--Fim capa com confirma box!-->

</body>
</html>