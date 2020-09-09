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

    <title>Lista Contatos</title>

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

.cg{text-decoration: none;padding:5px;font-weight:400;font-size:18px;color:white;background-color:black;
border-radius: 6px;}
.cg:hover{background-color:#454040;color:white;}

.cg2{text-decoration: none;padding:5px;font-weight:400;font-size:17px;color:white;background-color:green;
border-radius: 12px;border:none;}

.vermelhin{width:26px;height:26px;float:right;padding-right:6px;padding-left:6px;border-radius:13px;background-color:red;color:white;font-size:13px;text-decoration:none;font-family:arial;}
.vermelhin:hover{background-color:#C40000;text-decoration:none;color:white;}
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

<div id="dadosmoi">
<center><h3><b>Inserir contatos</b></h3>

<form name="contato" id="contatoenv">
<center>
<input type="text" id="email" class="form-control" name="email" style="width:280px;margin-bottom:8px;" placeholder="E-mail..." required>
<input type="text" id="nome" class="form-control" name="nome" style="width:280px;margin-bottom:15px;" placeholder="Nome..." required>

<button style="margin-bottom:8px;"class="cg" id="enviacadas" name="mandando" type="submit">Inserir</button>
<button style="margin-bottom:8px;margin-left:9px;"class="cg" id="resetcadas" type="reset">Reset</button></center>
</form>

<script>
$('#contatoenv').on('submit',function(event){

    event.preventDefault();
    var Dados=$(this).serialize();
	
    $.ajax({
        url: 'cadas_email.php',
        method:'post',
        dataType:'html',
		contentType: "application/x-www-form-urlencoded;charset=utf-8",
        data: Dados,
        success:function(Dados){
            $('.resultado2').html(Dados);
        },
		error: function (retorno) {
            // callback para chamadas que falharam.
			console.log("Erro no envio do Form");
		}
    });
	
		email.value = "";
		nome.value = "";

});
</script>

<hr>
<div class="resultado2">
<center><h3><b>Lista de Contatos</b></h3></center>

<?php
include("conectarpdo.php");

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

$pdo = null;
?>

</div>

<hr>
<center>
<form method="post" action="pagpoecsv.php" name="justin" enctype="multipart/form-data">

<input type="file" name="arqcsv" id="arqcsv" placeholder="Arquivo csv..." accept=".csv" required><br>

<button style="margin-bottom:8px;" class="cg2" id="enviacadas2" name="mandando2" type="submit"><b>Importar Contatos csv</b></button>

<script>
$('#enviacadas2').click(function(){
	$('#enviacadas2').css({visibility: 'hidden', display: 'none'});
});
</script>

</center>
</form>


</center>
<br><br>
</div>


<div class="resultado">
</div>
</div>

</body>
</html>