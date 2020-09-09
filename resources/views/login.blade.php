<html lang="en">
  <head>
	<link rel="icon" href="myrano_icon.png">
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=400">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>Eventos Login</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="css/toolkit.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery_min.js"></script>
    <link href="css/ionicons.css" rel="stylesheet">
    <style>
      body {
        width: 1px;
        min-width: 100%;
        *width: 100%;
		background:url('brassai.jpg');background-size: 100%;
      }
      .form-signin {
          max-width: 330px;
          padding: 15px;
          margin: 30px auto;
          background: #fff;
          border-radius: 5px;
      }
	  @media screen and (min-width:201px) and (max-width:1000px){
		body {
        width: 1px;
        min-width: 100%;
        *width: 100%;

      }
	  }
    </style>

<style>
.select-qnt-parcelas{display: none;}
<!--Retirar barra lateral form number Chrome, Safari, Edge, Opera-->
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;margin: 0;}

<!--Retirar barra lateral form number Firefox-->
input[type=number] {
  -moz-appearance: textfield;}
  
.cg{text-decoration: none;padding:5px;font-weight:400;font-size:18px;color:white;background-color:black;
border-radius: 6px;}
.cg:hover{background-color:#454040;color:white;}
</style>
	
  </head>
<body>

   <div class="by">

    <form class="form-signin" method="post" action="buscacadastro.php">
      <img src="myrano_logo.png" style="width:240px;max-height:60px;margin:15px 0 3px 30px">

      <input type="hidden" name="pagina" value="<?php $abrir = (@$_GET["pag"]); echo $abrir; ?>">
<br>

	  <?php 
	  if(!empty(@$_COOKIE['valsalmail']) && !empty(@$_COOKIE['valsalpass'])){
		  $valmail = $_COOKIE['valsalmail'];
		  $valpass = $_COOKIE['valsalpass'];
	  }else{
		  $valmail = "";
		  $valpass = "";
	  }

	  ?>
  
      <label for="inputEmail" class="sr-only">Login</label>
      <input type="text" id="inputEmail" name="email" value="<?php echo $valmail; ?>" class="form-control" placeholder="E-mail..." required autofocus>
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" id="inputPassword" name="senha" value="<?php echo $valpass; ?>" class="form-control" placeholder="Senha..." required>
      <br>
	  <center><input type="checkbox" name="salvifica" style="cursor:pointer;" value="salvar"> Salvar dados de acesso</input></center><br>
            <center><button class="cg" type="submit">Entrar</button>
			<button style="margin-left:3px;" class="cg" type="reset">Reset</button><br><br>
    </form>
	<a id="jamelao"><b>Criar usuário</b></a>
	</center>
  </div> <!-- /container -->

<style>
.dadosven{color:grey;font-size:18px;margin:0 auto;visibility:hidden;display:none;background:#eeeeee;width:390px;border-radius:6px;}
.fechar{float:right;border-radius:23px;opacity:.6;background-color:black;color:white;height:29px;width:29px;cursor:pointer;}

.capa{background: rgba(0, 0, 0, 0.8);width: 100%;height: 100%;position: fixed;top: 0;z-index:8999;display:none;visibility:hidden;scroll:none;}
#jamelao{cursor:pointer;}

#enviacadas{visibility:hidden;}
#msg{margin:0 auto;color:red;font-size:17px;font-weight:bold;height:25px;}
</style>

<script>
$(document).ready(function(){
	$('#jamelao').click(function(){
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
<br>
<div class="capa">

<div class="resultado">
</div>

<div class="dadosven">
<center>
<div class="fechar">
<font style="font-size:21px;"><b>X</b></font>
</div>

<center><h3><b>Cadastrar Usuário</b></h3></center>

<form name="contato" id="contatoenv">
<b style="float:left;margin-left:20px;">E-mail: </b><br>
<input type="text" id="email" class="form-control" name="email" style="margin-left:20px;margin-right:20px;width:340px;" placeholder="E-mail..." required>
<b style="float:left;margin-left:20px;">Senha: </b><br>
<input type="password" id="senha1" class="form-control" name="senha1" style="margin-left:20px;margin-right:20px;width:340px;" placeholder="Senha..." required>
<b style="float:left;margin-left:20px;">Confirmar Senha: </b><br>
<input type="password" id="senha2" class="form-control" name="senha2" style="margin-left:20px;margin-right:20px;width:340px;" placeholder="Senha..." required>
<b style="float:left;margin-left:20px;">Nome: </b><br>
<input type="text" id="nome" class="form-control" name="nome" style="margin-left:20px;margin-right:20px;width:340px;" placeholder="Nome..." required><br>

<div id="msg">
</div>

<center><button class="cg" id="enviacadas" name="mandando" type="submit">Cadastrar</button>
<button style="margin-left:7px;" class="cg" type="reset">Reset</button></center>

</form>
<br>

<script>
$('#senha2').on('keyup',function(){
	var pass1 = $('#senha1').val();
	var pass2 = $('#senha2').val();
	
	if(pass1 != pass2){
		document.getElementById('msg').innerHTML = 'Alerta: Senhas diferentes!';
		$('#enviacadas').css({visibility:'hidden'});
	}else{document.getElementById('msg').innerHTML = '';
	$('#enviacadas').css({visibility:'visible'});
	}
});

$('#nome').on('keydown',function(){
	$('#enviacadas').css({visibility:'visible'});
});

$('#contatoenv').on('submit',function(event){

    event.preventDefault();
    var Dados=$(this).serialize();
	
    $.ajax({
        url: 'envia_forms2.php',
        method:'post',
        dataType:'html',
		contentType: "application/x-www-form-urlencoded;charset=utf-8",
        data: Dados,
        success:function(Dados){
            $('.resultado').html(Dados);
        },
		error: function (retorno) {
            // callback para chamadas que falharam.
			console.log("Erro no envio do Form");
		}
    });
	
		nome.value = "";
		email.value = "";
		senha1.value = "";
		senha2.value = "";
		
		$('#enviacadas').css({visibility:'hidden'});

});
</script>

</center>
</div>
</div>
  
</body>
</html>