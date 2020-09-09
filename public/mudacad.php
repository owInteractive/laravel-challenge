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
    <meta name="viewport" content="width=420">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
	<script type="text/javascript" src="js/jquery_min.js"></script>

    <title>Busca Eventos</title>

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

.cg{text-decoration: none;padding:5px;font-weight:400;font-size:18px;color:white;background-color:black;
border-radius: 6px;}
.cg:hover{background-color:#454040;color:white;}
#msg{margin:0 auto;color:red;font-size:17px;font-weight:bold;height:25px;}
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
<br>

<?php
if(isset($_POST['mandando'])){

$newemail = (@$_POST['novomail']);
$newnome = (@$_POST['novonome']);

$senhapre = (@sha1($_POST['novasenha']));

if($senhapre == ""){
	$envsenha = $senha;
}else{$envsenha = $senhapre;}

$querin = $pdo->prepare("UPDATE users SET email = :vaiemail, senha = :vaisenha, nome = :vainome WHERE email = :email AND senha = :senha");
$querin->bindValue("vaiemail", $newemail);
$querin->bindValue("vaisenha", $envsenha);
$querin->bindValue("vainome", $newnome);
$querin->bindValue("email", $login);
$querin->bindValue("senha", $senha);

$querin->execute();

echo '<script>
	alert("Dados de cadastro alterado(s). Você será redirecionado para a página de login!");
</script>';

echo '<script>
	window.location="logout.php";
</script>';
}
$pdo = null;
?>

<div id="dadosmoi">
<center><h3><b>Alterar dados</b></h3></center>

<form name="contato" name="enviaformo" target method="post">
<b>E-mail: </b><br>
<input type="text" name="novomail" value="<?php echo $email; ?>" class="form-control" placeholder="E-mail..." required><br>

<b>Senha: </b><br>
<input type="password" name="novasenha" value="" id="senha1" class="form-control" placeholder="Senha..."><br>

<b>Repetir Senha: </b><br>
<input type="password" value="" id="senha2" class="form-control" placeholder="Senha..."><br>

<b>Nome: </b><br>
<input type="text" name="novonome" value="<?php echo $nome; ?>" class="form-control" placeholder="Nome..." required><br>

<div id="msg">
</div>
<center>
<button style="margin-bottom:8px;" class="cg" id="enviacadas" name="mandando" type="submit">Alterar</button>
<button style="margin-left:10px;margin-bottom:8px;" class="cg" type="reset">Reset</button>
</center>
</form>

<br><br>
</div>

</div>
<script>
$('#senha2').on('keyup',function(){
	var pass1 = $('#senha1').val();
	var pass2 = $('#senha2').val();
	
	if(pass1 != pass2){
		document.getElementById('msg').innerHTML = '<center>Alerta: Senhas diferentes!</center>';
		$('#enviacadas').css({visibility:'hidden'});
	}else{document.getElementById('msg').innerHTML = '';
	$('#enviacadas').css({visibility:'visible'});
	}
});
</script>



</body>
</html>