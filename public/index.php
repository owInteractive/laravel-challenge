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

@media screen and (min-width:201px) and (max-width:420px){
#conteudo{min-height:650px;}
}

</style>

<div class="menu">
<div id="nav">
<ul>
<li style="margin-left:-40px;"><a class="clic" style="float:left;width:130px;text-align:center;" 
href="index.php"><h2 style="text-align:left;margin-left:20px;">Eventos</h2></a>
</li>

<li><a style="float:left;width:100px;text-align:center;" href="perfil.php"><h2 style="text-align:left;margin-left:20px;">Perfil</h2></a>
</li>

<li style="float:right;border-right:none;"><a style="float:left;width:60px;text-align:center;" href="logout.php" ><h2 style="text-align:left;margin-left:10px;">Sair</h2></a>
</li>
</ul>
</div>

</div>

<style>
#result{margin:0 auto;width:440px;background:white;margin-top:80px;border-radius:6px;}
thead{font-size:16px;background:black;color:white;}
tbody{font-size:16px;background-color:#eeeeee;color:grey;}
td{font-weight:bold;border:1px solid grey;}

#regulamento{margin:0 auto;width:370px;background:#4eb76e;opacity:.9;height:auto;border-radius:5px;color:white;}

#chao{width:100%;position:fixed;bottom:30px;}
.contato{bottom:20px;border-radius:4px;cursor:pointer;color:white;background:#ED1B2D;margin:0 auto;width:235px;height:40px;font-size:22px;font-weight:bold;}
.contato:hover{background:red;}

.fechar{float:right;border-radius:23px;opacity:.6;background-color:black;color:white;height:29px;width:29px;cursor:pointer;}

.capa{background: rgba(0, 0, 0, 0.8);width: 100%;height: 100%;position: fixed;top: 0;z-index:8999;display:none;visibility:hidden;scroll:none;}

#guardabu{display:block;height:40px;width:327px;margin:0 auto;margin-bottom:-51px;}
</style>
<br><br><br><br>
<div id="guardabu">
<center>
<form name="holland" target method="post">
<input type="date" style="width:160px;" name="buscando" class="form-control" id="buscando" value="<?php echo (@$_POST['buscando']); ?>" placeholder="Buscar...">
<button style="float:right;margin-top:-38px;" type="submit" value="" name="Buscar" class="cg">Buscar</button>
</form>
</center>
</div>

<div id="result">
<table>
<thead>
<td style="width:250px;"><center><b>Título</b></center></td>
<td style="width:80px;"><center><b>Início</b></center></td>
<td style="width:80px;"><center><b>Fim</b></center></td>

</thead>

<tbody>

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
		
		date_default_timezone_set ("America/Sao_Paulo");
		
		if((@$_POST['buscando']) != ""){
			$dataref = strtotime(date("Y-m-d H:i"));
			$somador = 30000000;
			$limiteminpre = strtotime(@$_POST['buscando']);
			if($limiteminpre > $dataref){
			$limitemin = $limiteminpre;}else{$limitemin = $dataref;}			
						
			$limitemax = $dataref + $somador;
		}else{
			$dataref = strtotime(date("Y-m-d H:i"));
			$somador = 432000;
			$limitemin = $dataref;
			$limitemax = $dataref + $somador;
		}

		
		$busca = $pdo->prepare("SELECT * FROM eventos WHERE fim < :max AND comeco > :min ORDER BY comeco ASC");
		
		$busca->bindValue("max", $limitemax);
		$busca->bindValue("min", $limitemin);
		$busca->execute();
		
		if($busca->rowCount() > 0){while($row2 = $busca->fetch(PDO::FETCH_OBJ)){
			$ideven = $row2->id;
			$titulo = $row2->titulo;
			$descricao = $row2->descr;
			$comeco = $row2->comeco;
			$final = $row2->fim;
			$usu_cad = $row2->usu;
			
			$f++;
?>
<tr>
<td id="abrir<?php echo $f; ?>"><center><?php echo $titulo; ?></center></td>
<td id="ajudapri<?php echo $f; ?>" style="width:95px;"><center><?php echo date("d-m-Y H:i", $comeco); ?></center></td>
<td id="ajudaseg<?php echo $f; ?>" style="width:95px;"><center><?php echo date("d-m-Y H:i", $final); ?></center></td>
<td id="ajudater<?php echo $f; ?>" style="background:white;border:none;width:50px;"><center><?php 

	$verreq31 = $pdo->prepare("SELECT * FROM eventos WHERE id = :evento AND usu = :usuario");
	$verreq31->bindValue("evento", $ideven);
	$verreq31->bindValue("usuario", $id_usu);

	$verreq31->execute();

	if($verreq31->rowCount() > 0){
		$moistatus = "<b style='color:black;font-size:10px;'>Meu Evento</b>";
	}else{
	$verreq32 = $pdo->prepare("SELECT * FROM participar WHERE evento = :evento AND usu = :usuario");
	$verreq32->bindValue("evento", $ideven);
	$verreq32->bindValue("usuario", $id_usu);

	$verreq32->execute();

	if($verreq32->rowCount() > 0){	
		$moistatus = "<b style='color:blue;font-size:10px;'>Participando</b>";
	}else{$moistatus = "";}}

echo $moistatus; ?></center></td>
</tr>
<!--Abrir caixa entrar ou sair do evento!-->
<script>
$('#abrir<?php echo $f; ?>').click(function(){
	var numi = <?php echo $f; ?>;
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
#abrir<?php echo $f; ?>:hover{cursor:pointer;}
</style>
<!--Fim Abrir caixa entrar ou sair do evento!-->
<?php } }else{echo "<tr><td colspan='4'><center>Nenhum resultado encontrado...</center></td></tr>";} ?>
</tbody>
		
</table>
		<?php
		
		}else{echo "<center>Nenhum resultado encontrado...</center>";}
		
$pdo = null;
?>
</div>	
<br>

<style>
#juntaa{height:20px;display:block;width:110px;margin:0 auto;}
#menos{float:left;cursor:pointer;}
#mais{float:right;cursor:pointer;}
</style>
<div id="juntaa">
<center>
<img id="menos" src="setaesq.png" width="25" height="25">

<input type="text" style="width:55px;font-weight:bold;border:none;" readonly="true" value="1" id="pagta">

<img id="mais" src="setadir.png" width="25" height="25">

</center>
</div>
<br>
<script>
$(document).ready(function(){
	var eventotal = <?php echo $f; ?>;
	var pagtota = 5;
	var refpag = 0;
	var pagta = 1;
	var todaspag = Math.ceil(eventotal/pagtota);
	
	
		for (var j = 0; j < eventotal + 1; j++) {
			$('#abrir' + j).css({visibility:'hidden', display:'none'});

			$('#ajudapri' + j).css({visibility:'hidden', display:'none'});
			$('#ajudaseg' + j).css({visibility:'hidden', display:'none'});
			$('#ajudater' + j).css({visibility:'hidden', display:'none'});
		}
		
		for (var j = refpag; j < pagtota + 1; j++) {
			$('#abrir' + j).css({visibility:'visible', display:'table-cell'});

			$('#ajudapri' + j).css({visibility:'visible', display:'table-cell'});
			$('#ajudaseg' + j).css({visibility:'visible', display:'table-cell'});
			$('#ajudater' + j).css({visibility:'visible', display:'table-cell'});
		}
		
		document.getElementById("pagta").value = pagta + " de " + todaspag;
	
	$("#mais").click(function(){
		pagta ++;
		var vaiprafim = (pagta * pagtota) + 1;
		var vaipracom = vaiprafim - 5;
		var eventotalof = eventotal + 1;
		
		if((vaiprafim - 1) < (eventotal + 5)){
		
		for (var j = 0; j < eventotalof; j++) {
			$('#abrir' + j).css({visibility:'hidden', display:'none'});

			$('#ajudapri' + j).css({visibility:'hidden', display:'none'});
			$('#ajudaseg' + j).css({visibility:'hidden', display:'none'});
			$('#ajudater' + j).css({visibility:'hidden', display:'none'});
		}
		
		for (var j = vaipracom; j < vaiprafim; j++) {
			$('#abrir' + j).css({visibility:'visible', display:'table-cell'});

			$('#ajudapri' + j).css({visibility:'visible', display:'table-cell'});
			$('#ajudaseg' + j).css({visibility:'visible', display:'table-cell'});
			$('#ajudater' + j).css({visibility:'visible', display:'table-cell'});
		}
		
		document.getElementById("pagta").value = pagta + " de " + todaspag;
		}else{pagta --;}
		
	});
	
	$("#menos").click(function(){
		pagta --;
		var vaiprafim = (pagta * pagtota) + 1;
		var vaipracom = vaiprafim - 5;
		var eventotalof = eventotal + 1;
		
		if((vaiprafim - 1) > 0){
		
		for (var j = 0; j < eventotalof; j++) {
			$('#abrir' + j).css({visibility:'hidden', display:'none'});

			$('#ajudapri' + j).css({visibility:'hidden', display:'none'});
			$('#ajudaseg' + j).css({visibility:'hidden', display:'none'});
			$('#ajudater' + j).css({visibility:'hidden', display:'none'});
		}
		
		for (var j = vaipracom; j < vaiprafim; j++) {
			$('#abrir' + j).css({visibility:'visible', display:'table-cell'});

			$('#ajudapri' + j).css({visibility:'visible', display:'table-cell'});
			$('#ajudaseg' + j).css({visibility:'visible', display:'table-cell'});
			$('#ajudater' + j).css({visibility:'visible', display:'table-cell'});
		}
				
		document.getElementById("pagta").value = pagta + " de " + todaspag;
		}else{pagta ++;}
	});
});

</script>

<br>

<style>
#editarev{width:120px;height:30px;border-radius:12px;background:#1E90FF;color:white;cursor:pointer;}
#partev{width:120px;height:30px;border-radius:12px;background:#1E90FF;color:white;cursor:pointer;}
#sairev{width:120px;height:30px;border-radius:12px;background:red;color:white;cursor:pointer;}
	
.dadosven{color:grey;font-size:18px;margin:0 auto;visibility:hidden;display:none;background:#eeeeee;width:390px;border-radius:6px;}
.fechar{float:right;border-radius:23px;opacity:.6;background-color:black;color:white;height:29px;width:29px;cursor:pointer;}

.capa{background: rgba(0, 0, 0, 0.8);width: 100%;height: 100%;position: fixed;top: 0;z-index:8999;display:none;visibility:hidden;scroll:none;}
</style>

<div class="resultado">

</div>
	
	<center><a id="jamelao"><b>+ Criar Evento</b></a>
	</center>
  </div> <!-- /container -->

<style>
.dadosvenx{color:grey;font-size:18px;margin:0 auto;visibility:hidden;display:none;background:#eeeeee;width:390px;border-radius:6px;}
.fecharx{float:right;border-radius:23px;opacity:.6;background-color:black;color:white;height:29px;width:29px;cursor:pointer;}

.capax{background: rgba(0, 0, 0, 0.8);width: 100%;height: 100%;position: fixed;top: 0;z-index:8999;display:none;visibility:hidden;scroll:none;}
#jamelao{cursor:pointer;color:blue;width:200px;font-size:16px;}
#jamelao:hover{color:purple;background:transparent;}

.cg{text-decoration: none;padding:5px;font-weight:400;font-size:18px;color:white;background-color:black;
border-radius: 6px;}
.cg:hover{background-color:#454040;color:white;}

#datala{display:block;height:40px;width:380px;}
</style>

<script>
$(document).ready(function(){
	$('#jamelao').click(function(){
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

<br>
<div class="capax">

<div class="resultado2">
</div>

<div class="dadosvenx">
<center>
<div class="fecharx">
<font style="font-size:21px;"><b>X</b></font>
</div>

<center><h3><b>Criar Evento</b></h3></center>

<form name="contato" id="contatoenv">
<input type="text" id="idusuvai" class="form-control" name="idusuvai" style="display:none;visibility:hidden;" value="<?php echo $id_usu; ?>">
<b style="float:left;margin-left:20px;">Título: </b><br>
<input type="text" id="titulo" class="form-control" name="titulo" style="margin-left:20px;margin-right:20px;width:340px;" placeholder="Título..." required>
<b style="float:left;margin-left:20px;">Descrição: </b><br>
<textarea id="descr" class="form-control" name="descr" rows="6" style="margin-left:20px;margin-right:20px;width:340px;" 
placeholder="Descrição..." required></textarea>

<b style="float:left;margin-left:20px;">Início: </b><br>
<div id="datala">
<input type="date" id="inicio1" name="inicio1" style="float:left;margin-left:20px;width:170px;" required>
<input type="time" id="hora1" name="hora1" style="float:left;margin-left:20px;margin-right:20px;width:110px;" required>
</div>

<b style="float:left;margin-left:20px;">Término: </b><br>
<div id="datala">
<input type="date" id="fim2" name="fim2" style="float:left;margin-left:20px;width:170px;" required>
<input type="time" id="hora2" name="hora2" style="float:left;margin-left:20px;margin-right:20px;width:110px;" required>
</div>
<br>
<center><button style="margin-bottom:8px;"class="cg" id="enviacadas" name="mandando" type="submit">Criar</button>
<button style="margin-left:7px;margin-bottom:8px;" class="cg" type="reset">Reset</button></center>

</form>

<script>
$('#contatoenv').on('submit',function(event){

    event.preventDefault();
    var Dados=$(this).serialize();
	
    $.ajax({
        url: 'envia_criar.php',
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
	
		titulo.value = "";
		descr.value = "";
		inicio1.value = "";
		fim2.value = "";
		hora2.value = "";
		hora1.value = "";


});

$('.fecharx').click(function(){
	location.reload();
});
</script>

</center>
</div>
</div>

</div>

</body>
</html>