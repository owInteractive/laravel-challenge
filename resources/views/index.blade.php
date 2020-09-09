<?php
session_start();
if(!isset($_SESSION["emaillog"]) || !isset($_SESSION["senha"]) || !isset($_SESSION["empr"]) || !isset($_SESSION["tipo"])) {
	header("Location: teste_login.php?pag=index.php");
	exit;
}

if((($_SESSION["empr"]) <> 'MaR14n0') || (($_SESSION["emaillog"]) == "") || (($_SESSION["tipo"]) <> "cliente")){
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
    <meta name="viewport" content="width=440">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
	<script type="text/javascript" src="js/jquery_min.js"></script>

    <title>Resultados Castrol</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="css/toolkit.css" rel="stylesheet">

    <style>
      body {
        width: 1px;
        min-width: 100%;
        *width: 100%;
		background:url('tambor_cas.jpg');background-size: 100%;
      }

	  @media screen and (min-width:201px) and (max-width:890px){
		body {background:url('castrol_alto.jpg') repeat;background-size: 100%;}
	  }
    </style>

<script type="text/javascript">
function abreJanela (URL) {
	location.href = URL;
}
</script>
	
  </head>
<body>
<div id="conteudo">

<style>
.menu{width:100%;height:50px;position:fixed;top:0;z-index:999;font-size:20px;left:0px;}

ul{position:fixed;width:100%;list-style:none;margin-top:0px;background:#4eb76e;}
li{float:left;text-decoration:none;list-style:none;text-align:center;
border-right: 2px solid #3d9558;}

a,h2{padding-top:5px;margin-top:0px;resize:true;font-size:22px;text-decoration:none;display:block;width:130px;height:50px;color:white;}
.clic, a:hover{color:white;background:#3d9558;text-decoration:none;}

@media screen and (min-width:201px) and (max-width:420px){
#conteudo{min-height:600px;}
}

</style>

<div class="menu">
<div id="nav">
<ul>
<li style="margin-left:-40px;"><a class="clic" style="float:left;width:160px;text-align:center;" 
href="<?php if(date('m') == 2 || date('m') == 3 || date('m') == 4){echo "index?tRi=1o";}
if(date('m') == 5 || date('m') == 6 || date('m') == 7){echo "index?tRi=2o";}
if(date('m') == 8 || date('m') == 9 || date('m') == 10){echo "index?tRi=3o";}
if(date('m') == 11 || date('m') == 12 || date('m') == 1){echo "index?tRi=4o";} ?>">
<h2 style="text-align:left;margin-left:15px;">Resultados</h2></a>
</li>

<li><a style="float:left;width:165px;text-align:center;" href="pqcastrol.php"><h2 style="text-align:left;margin-left:17px;">Pq Castrol?</h2></a>
</li>

<li style="float:right;border-right:none;"><a style="float:left;width:60px;text-align:center;" href="logout.php" ><h2 style="text-align:left;margin-left:10px;">Sair</h2></a>
</li>
</ul>
</div>

</div>

<?php
include("conectarpdo.php");

$login = $_SESSION["emaillog"];
$senha = $_SESSION["senha"];
$ecliver = $_SESSION["tipo"];

$tritablepre = (@$_GET["tRi"]);
if($tritablepre == ""){
	if(date('m') == 2 || date('m') == 3 || date('m') == 4){$tritable = "1o";}
	if(date('m') == 5 || date('m') == 6 || date('m') == 7){$tritable = "2o";}
	if(date('m') == 8 || date('m') == 9 || date('m') == 10){$tritable = "3o";}
	if(date('m') == 11 || date('m') == 12 || date('m') == 1){$tritable = "4o";}
	}else{$tritable = $tritablepre;}

		$sql = $pdo->prepare("SELECT * FROM users WHERE email = :login AND senha = :senha AND tipo = :ecliver ORDER BY id DESC LIMIT 1");
		$sql->bindValue("login", $login);
		$sql->bindValue("senha", $senha);
		$sql->bindValue("ecliver", $ecliver);
		$sql->execute();

		if($sql->rowCount() > 0){
		
		while($row = $sql->fetch(PDO::FETCH_OBJ)){
			
			$classe = $row->caracte;
			$nome_ven = $row->nome;
			$cliente = $row->cliente;
			
		}

		if($tritable == "1o"){
			$busca = $pdo->prepare("SELECT * FROM clientes_1tri WHERE cod_cli = :cliente LIMIT 1");
		}
		if($tritable == "2o"){
			$busca = $pdo->prepare("SELECT * FROM clientes_2tri WHERE cod_cli = :cliente LIMIT 1");
		}
		
		if($tritable == "3o"){
			$busca = $pdo->prepare("SELECT * FROM clientes_3tri WHERE cod_cli = :cliente LIMIT 1");
		}
		
		if($tritable == "4o"){
			$busca = $pdo->prepare("SELECT * FROM clientes_4tri WHERE cod_cli = :cliente LIMIT 1");
		}
		
		$busca->bindValue("cliente", $cliente);
		$busca->execute();

		if($busca->rowCount() > 0){
		
		while($row2 = $busca->fetch(PDO::FETCH_OBJ)){
		
			$razao = $row2->razao;
			$categ = $row2->stars;
			$volume = $row2->vol;
			$meta = $row2->meta;
			$vendedor = $row2->vendedor;
		}
		
		
		$bven = $pdo->prepare("SELECT * FROM vendedor WHERE cpf = :vendedor ORDER BY id DESC LIMIT 1");
		$bven->bindValue("vendedor", $vendedor);
		$bven->execute();

		if($bven->rowCount() > 0){
		
		while($row3 = $bven->fetch(PDO::FETCH_OBJ)){
		
			$nome = $row3->nome;
			$telefone = $row3->telefone;
			$email = $row3->email;

		}

		$premiar = $pdo->prepare("SELECT premio FROM premio WHERE tipo = :classe LIMIT 1");
		$premiar->bindValue("classe", $classe);
		$premiar->execute();
		
		while($row4 = $premiar->fetch(PDO::FETCH_OBJ)){
		
			$premiao = $row4->premio;

		}
?>

<style>
#result{margin:0 auto;width:396px;background:white;margin-top:80px;border-radius:6px;}
thead{font-size:16px;}
tbody{font-size:21px;background-color:white;}
td{width:132px;color:white;background-color:#4eb76e;font-weight:bold;border:1px solid #009A4E;}
</style>

<div class="resultadopre">

</div>

<div id="result">
<center><p style="font-size:18px;"><b>Trimestre: </b>

<select name="tri" style="border:none;cursor:pointer;margin-left:15px;order:1;" onchange="javasscript: abreJanela(this.value)">
<option value="#"><?php $tRimestre = (@$_GET['tRi']); 
if($tRimestre == ""){

if(date('m') == 2 || date('m') == 3 || date('m') == 4){echo "1o";}
if(date('m') == 5 || date('m') == 6 || date('m') == 7){echo "2o";}
if(date('m') == 8 || date('m') == 9 || date('m') == 10){echo "3o";}
if(date('m') == 11 || date('m') == 12 || date('m') == 1){echo "4o";}
}else{echo "$tRimestre";} ?></option>

<option value="index.php?<?php echo "tRi=1o"; ?>">1o</option>
<option value="index.php?<?php echo "tRi=2o"; ?>">2o</option>
<option value="index.php?<?php echo "tRi=3o"; ?>">3o</option>
<option value="index.php?<?php echo "tRi=4o"; ?>">4o</option>
</select>
</p></center>

<table>
<thead>
<td><center><b>Compras (Vol)</b></center></td>
<td><center><b>Meta</b></center></td>
<td><center><b>% da Meta</b></center></td>
</thead>

<?php
$rawporc = round(($volume/$meta)*100,2);
$porc = str_replace('.',',',(round(($volume/$meta)*100,2))); 
?>

<tbody>
<td <?php if($porc < 100){echo "style='color:green;background-color:white;'";} ?>><center><?php echo round($volume,0); ?></center></td>
<td <?php if($porc < 100){echo "style='color:green;background-color:white;'";} ?>><center><?php echo $meta; ?></center></td>
<td <?php if($porc < 100){echo "style='color:green;background-color:white;'";} ?>><center><?php 
echo $porc." %";
?></center></td>
</tbody>

</table>
		<?php }else{echo "<center>Nenhum resultado encontrado...</center>";}
		}else{echo "<center>Nenhum resultado encontrado...</center>";}
		}else{echo "<center>Nenhum resultado encontrado...</center>";}
		
$pdo = null;
?>
</div>	
<br>

<div id="caixas">
<style>
#caixas{display:block;width:440px;margin:0 auto;height:55px;}
#botaocham{width:100px;float:left;visibility:hidden;display:none;}
#solicitar{animation: glowing 2000ms infinite;
	font-size:16px;display:block;width:80px;height:80px;margin-top:-15px;border-radius:40px;color:white;background:#4eb76e;border:0px;}

@keyframes glowing {
  0% { box-shadow: 0 0 -20px green;}
  20% { box-shadow: 0 0 10px green; }
  40% { box-shadow: 0 0 20px green;background:#4eb76e;}
  50% { box-shadow: 0 0 25px green;background:#4CB06A;}
  60% { box-shadow: 0 0 25px green;background:#4CB06A; }
  70% { box-shadow: 0 0 20px green;background:#4eb76e;}
  80% { box-shadow: 0 0 10px green; }
  100% { box-shadow: 0 0 -20px green;}
}
	
#premio{display:block;background:#ED1B2D;color:white;margin:0 auto;border-radius:5px;height:40px;font-size:23px;
width:290px;font-weight:bold;}
</style>
<div id="botaocham">
<button id="solicitar"><b>Solicitar<br>
Prêmio</b></button>
</div>
<div id="premio">
<?php 
if($classe == "vendedor" && $rawporc < 100){
$fim_prem = 0;
}

if($classe == "vendedor" && $rawporc >= 100 && $rawporc <= 109.99){
$fim_prem = $premiao;
}

if($classe == "vendedor" && $rawporc >= 110 && $rawporc <= 119.99){
$fim_prem = $premiao + 20;
}

if($classe == "vendedor" && $rawporc >= 120 && $rawporc <= 129.99){
$fim_prem = $premiao + 40;
}

if($classe == "vendedor" && $rawporc >= 130){
$fim_prem = $premiao + 50;
}

if($classe == "proprietario" && $rawporc < 100){
$fim_prem = 0;
}

if($classe == "proprietario" && $rawporc >= 100 && $rawporc <= 109.99){
$fim_prem = $premiao * $categ;
}

if($classe == "proprietario" && $rawporc >= 110 && $rawporc <= 119.99){
$fim_prem = ($premiao + 40) * $categ;
}

if($classe == "proprietario" && $rawporc >= 120 && $rawporc <= 129.99){
$fim_prem = ($premiao + 80) * $categ;
}

if($classe == "proprietario" && $rawporc >= 130){
$fim_prem = ($premiao + 100) * $categ;
}

echo "<center>Premiação R$ ".$fim_prem.",00</center>";

if(date('m') == 4){$atualtri = 1;}
if(date('m') == 7){$atualtri = 2;}
if(date('m') == 10){$atualtri = 3;}
if(date('m') == 1){$atualtri = 4;}
if(date('m') == 2 || date('m') == 3 || date('m') == 5 || 
date('m') == 6 || date('m') == 8 || date('m') == 9 || 
date('m') == 11 || date('m') == 12){$atualtri = 0;}

$tri2vai = (@$_GET['tRi']);
if($tri2vai == ""){
if(date('m') == 2 || date('m') == 3 || date('m') == 4){$tricomp = 1;}
if(date('m') == 5 || date('m') == 6 || date('m') == 7){$tricomp = 2;}
if(date('m') == 8 || date('m') == 9 || date('m') == 10){$tricomp = 3;}
if(date('m') == 11 || date('m') == 12 || date('m') == 1){$tricomp = 4;}
}else{if($tri2vai == "1o"){
	$tricomp = 1;
}if($tri2vai == "2o"){
	$tricomp = 2;
}if($tri2vai == "3o"){
	$tricomp = 3;
}if($tri2vai == "4o"){
	$tricomp = 4;
}}

if($fim_prem > 0 && $atualtri == $tricomp){
include('conectarpdo.php');
	
$verreq = $pdo->prepare("SELECT * FROM solicitar WHERE cpf = :login AND trimestre = :tri ORDER BY id DESC LIMIT 1");
$verreq->bindValue("login", $login);
$verreq->bindValue("tri", $atualtri);
$verreq->execute();

if($verreq->rowCount() > 0){
	$viureqbd = 1;
}else{$viureqbd = 0;}

if($fim_prem > 0 && $viureqbd == 0){
	echo "<script>
	$(document).ready(function(){
		$('#botaocham').css({visibility: 'visible', display: 'block'});
	});
	</script>";
}
$pdo = null;
}
?>
</div>
</div>
<br>

<script>
$('#botaocham').click(function(){
	var cpf = <?php echo $login; ?>;
	var cli = <?php echo $cliente; ?>;
	var trimestre = <?php echo $atualtri; ?>;
	var premio = <?php echo $fim_prem; ?>;
		
		var dadospremio = {
			palavra1 : cpf + ";" + cli + ";" + trimestre + ";" + premio 
		}		
		$.post('regis_premio.php', dadospremio, function(retorna){
			//Mostra dentro da ul os resultado obtidos 
			$('.resultadopre').html(retorna);
		});
});
</script>

<div id="regulamento">
<center><p style="color:white;font-size:21px;font-weight:bold;">Regulamento:</p>

<p style="color:white;font-size:18px;">Premiação de acordo com <b>% da Meta</b>:
</p>

<table class="tablin" style="background:#4eb76e;opacity:.9;border:1px solid white;font-size:16px;width:320px;">
<tr>
<td style="background:#4eb76e;opacity:.9;border:1px solid white;">100 a 109,99%</td>
<td style="background:#4eb76e;opacity:.9;border:1px solid white;"><?php 

	if($classe == "proprietario"){$premin1 = $premiao * $categ;}
	if($classe == "vendedor"){$premin1 = $premiao;}

echo "<center>R$ ".$premin1.",00</center>"; ?></td></tr>
<tr><td style="background:#4eb76e;opacity:.9;border:1px solid white;">110 a 119,99%</td>
<td style="background:#4eb76e;opacity:.9;border:1px solid white;"><?php 

	if($classe == "proprietario"){$premin2 = ($premiao + 40) * $categ;}
	if($classe == "vendedor"){$premin2 = $premiao + 20;}

echo "<center>R$ ".$premin2.",00</center>"; ?></td>
</tr>
<tr><td style="background:#4eb76e;opacity:.9;border:1px solid white;">120 a 129,99%</td>
<td style="background:#4eb76e;opacity:.9;border:1px solid white;"><?php 

	if($classe == "proprietario"){$premin3 = ($premiao + 80) * $categ;}
	if($classe == "vendedor"){$premin3 = $premiao + 40;}

echo "<center>R$ ".$premin3.",00</center>"; ?></td>
</tr>
<tr><td style="background:#4eb76e;opacity:.9;border:1px solid white;"><center>Acima 130%</center></td>
<td style="background:#4eb76e;opacity:.9;border:1px solid white;"><?php 

	if($classe == "proprietario"){$premin4 = ($premiao + 100) * $categ;}
	if($classe == "vendedor"){$premin4 = $premiao + 50;}

echo "<center>R$ ".$premin4.",00</center>"; ?></td>
</tr>
</table>
<br>
<?php if($classe == "proprietario"){
echo "*obs.: Premiação em produtos Bonificados Castrol";}
?>
</center>
</div>

<style>
#regulamento{margin:0 auto;width:370px;background:#4eb76e;opacity:.9;height:auto;border-radius:5px;color:white;}

#chao{width:100%;position:fixed;bottom:30px;}
.contato{bottom:20px;border-radius:4px;cursor:pointer;color:white;background:#ED1B2D;margin:0 auto;width:235px;height:40px;font-size:22px;font-weight:bold;}
.contato:hover{background:red;}

.dadosven{color:white;font-size:19px;margin:0 auto;visibility:hidden;display:none;background:#4eb76e;width:390px;border-radius:6px;}
.fechar{float:right;border-radius:23px;opacity:.6;background-color:black;color:white;height:29px;width:29px;cursor:pointer;}

.capa{background: rgba(0, 0, 0, 0.8);width: 100%;height: 100%;position: fixed;top: 0;z-index:8999;display:none;visibility:hidden;scroll:none;}
.whats{height:30px;width:30px;}
</style>
<br>
<div id="chao">
<div class="contato">
<center>Contato Vendedor</center>
</div>


<script>
$(document).ready(function(){
	$('.contato').click(function(){
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
	});
	$('.fechar').click(function(){
		$('.dadosven').css({visibility:'hidden', display:'none'});
		$('.capa').css({visibility:'hidden', display:'none'});
		ident = 0;
	});
});
</script>
</div>
<br><br>
<div class="capa">
<div class="dadosven">
<center>
<div class="fechar">
<font style="font-size:21px;"><b>X</b></font>
</div>
<b>Vendedor: </b><?php echo $nome; ?><br>
<b>E-mail: </b><a class="email" style="color:white;font-size:16px;display:inline;" 
href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a><br>
<b>Telefone: </b><?php 

$tel1 = "(".$telefone;

$tel2 = substr_replace($tel1, ') ', 3, 0);
$tel3 = substr_replace($tel2, '-', 10, 0);

echo $tel3; ?> 

<a target="blank" class="whats" style="float:left;margin-top:-5px;margin-left:30px;" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $telefone; ?>" class="link_whats">
<img src="whats_logo.png" height="28px" title="entre em contato pelo whatsapp" width="28px"></a>

<br>


</center>
</div>
</div>

</div>

</body>
</html>