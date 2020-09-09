<?php
session_start();
if(!isset($_SESSION["emaillog"]) || !isset($_SESSION["senha"]) || !isset($_SESSION["empr"]) || !isset($_SESSION["tipo"])) {
	header("Location: teste_login.php?pag=cadastro_cli.php");
	exit;
}

if((($_SESSION["empr"]) <> 'MaR14n0') || (($_SESSION["emaillog"]) == "") || (($_SESSION["tipo"]) <> "cliente")){
	header("Location: teste_login.php");
	exit;
}
?>
<html>
<head>
<link rel="icon" href="myrano_icon.png">
<meta name="viewport" content="width=430">
<script type="text/JavaScript" src="js/jquery_min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link href="css/toolkit.css" rel="stylesheet">

<title>Cadastrar no APP Castrol</title>

</head>
<body>
<style>
.select-qnt-parcelas{display: none;}
<!--Retirar barra lateral form number Chrome, Safari, Edge, Opera-->
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;margin: 0;}

<!--Retirar barra lateral form number Firefox-->
input[type=number] {
  -moz-appearance: textfield;}
</style>

<style>
#bar{width:300px;margin:0 auto;height:15px;border-radius:6px;border:1px solid grey;background-color:white;}
.prog{width:0%;height:13px;background-color:#8BC34A;border-radius:6px;}
.texpro{font-size:15px;float:right;margin-right:-44px;margin-top:-21px;}

body{min-height:800px;}
#topo{height:50px;position:fixed;width:100%;background:white;padding-top:15px;padding-bottom:10px;}

input {
	outline: 0;
	border-width: 0 0 2px;
	border-color: grey;
}
.chamacpf{font-size:10px;visibility:hidden;margin-left:-290px;}

.chamatipo{font-size:10px;visibility:hidden;margin-left:-70px;margin-right:100px;}
.chamafuncao{font-size:10px;visibility:hidden;}

.chamanome{font-size:10px;visibility:hidden;margin-left:-300px;}
.chamaclie{font-size:10px;visibility:hidden;margin-left:-270px;}
.chamail{font-size:10px;visibility:hidden;margin-left:-300px;}
.chamatel{font-size:10px;visibility:hidden;margin-left:-290px;}
.chamapass1{font-size:10px;visibility:hidden;margin-left:-300px;}
.chamapass2{font-size:10px;visibility:hidden;margin-left:-250px;}

#msg{color:red;font-weight:bold;margin:0 auto;text-align:center;}
#vaiin{visibility:hidden;}

input:focus{border-color:#8BC34A;}
</style>

<div id="topo">

<div id="bar">
<div class="prog">
</div>
<div class="texpro">
0%
</div>

</div>
<div id="msg">
</div>
</div>

<div class="resultado">

</div>
<br>

<center>

<br>
<center><h2><b>Cadastro No App</b></h2></center><br>

<label class="chamacpf">CPF/CNPJ</label><br>
<form id='testejq' name='testejq'>
<input type="number" style="width:330px;" placeholder="CPF/CNPJ..." name="login" id="testecpf" autocomplete="off" required autofocus><br><br>

<label class="chamatipo">Tipo</label><label class="chamafuncao">Função</label><br>

<select style="cursor:pointer;" name="tipo" id="poetipo" required>
<option value="">Tipo...</option>
<option value="cliente">Cliente</option>
<option value="unidade">Unidade</option>
</select>

<select style="cursor:pointer;margin-left:40px;" name="funcao" id="poefuncao" required>
<option value="">Função...</option>
<option value="vendedor">Vendedor</option>
<option value="proprietario">Proprietário</option>
</select><br><br>

<label class="chamanome">Nome</label><br>
<input type="text" style="width:330px;" placeholder="Nome..." name="nome" id="testenome" autocomplete="off" required ><br><br>

<label class="chamaclie">Cliente (Cód)</label><br>
<input type="number" style="width:330px;" placeholder="Cliente (Cód)..." name="cliente" id="testeclie" autocomplete="off" required><br><br>

<label class="chamail">E-mail</label><br>
<input type="text" style="width:330px;" placeholder="E-mail..." name="email" id="testetex" autocomplete="off" required><br><br>

<label class="chamatel">Telefone</label><br>
<input type="number" style="width:330px;" placeholder="Telefone..." name="telefone" id="testetel" autocomplete="off" required><br><br>

<label class="chamapass1">Senha</label><br>
<input type="password" style="width:330px;" placeholder="Senha..." name="senha" id="testepass1" autocomplete="off" required><br><br>

<label class="chamapass2">Confirmar Senha</label><br>
<input type="password" style="width:330px;" placeholder="Senha..." name="senha2" id="testepass2" autocomplete="off" required><br><br>

<button style="margin-top:10px;font-size:18px;" class="cg fq" id="vaiin" type="submit">Inserir</button>
<button style="margin-left:15px;margin-top:10px;font-size:18px;" class="cg fq" id="reset" type="reset">Reset</button>
</form>
<br><br><br>
</center>

<script>
var barpro = 0;
var avismail = 0;
var aviscpf = 0;
var avistipo = 0;
var avisfuncao = 0;
var avisnome = 0;
var avisclie = 0;
var avistel = 0;
var avispass1 = 0;
var avispass2 = 0;

//input CPF/CNPJ
$('#testecpf').on('keyup', function(){
	var pretam1 = $('#testecpf').val();
	var taman1 = pretam1.length;
	$('.chamacpf').css({visibility: 'visible'});
	
	if(taman1 == 0){
		$('.chamacpf').css({visibility: 'hidden'});
	}
	
	if(taman1 > 10){
		var dadospre = {
			palavrapre : pretam1 
		}		
			$.post('cons_cpf.php', dadospre, function(retorna1){
				//Mostra dentro da ul os resultado obtidos 
				$("#msg").html(retorna1);
			});
	}
	
	if(taman1 > 10 && aviscpf == 0 && barpro < 100){
		barpro += parseFloat(12.5);
		aviscpf ++;		
	}
	if(taman1 < 11 && aviscpf == 1 && barpro > 0){
		barpro -= parseFloat(12.5);
		aviscpf --;
	}
	
	if(barpro > 100){
		barpro = 100;
	}
	
	var jogala = barpro + '%';
	$('.prog').css({width: jogala});
	console.log(parseFloat(barpro));
	$(".texpro").html(Math.ceil(barpro) + '%');
	
});

//Select Tipo
$('select[name=tipo]').change(function(){
	var dentipo = $('select[name=tipo]').val();
	
	if(dentipo != "" && avistipo == 0){
		barpro += parseFloat(12.5);
		avistipo ++;
		$('.chamatipo').css({visibility: 'visible'});
	}
	
	if(dentipo == "" && avistipo == 1){
		barpro -= parseFloat(12.5);
		avistipo --;
		$('.chamatipo').css({visibility: 'hidden'});
	}
	
	var jogala = barpro + '%';
	$('.prog').css({width: jogala});
	console.log(parseFloat(barpro));
	$(".texpro").html(Math.ceil(barpro) + '%');
	
});

//Select Funcao
$('select[name=funcao]').change(function(){
	var denfuncao = $('select[name=funcao]').val();
	
	if(denfuncao != "" && avisfuncao == 0){
		barpro += parseFloat(12.5);
		avisfuncao ++;
		$('.chamafuncao').css({visibility: 'visible'});
	}
	
	if(denfuncao == "" && avisfuncao == 1){
		barpro -= parseFloat(12.5);
		avisfuncao --;
		$('.chamafuncao').css({visibility: 'hidden'});
	}
	
	var jogala = barpro + '%';
	$('.prog').css({width: jogala});
	console.log(parseFloat(barpro));
	$(".texpro").html(Math.ceil(barpro) + '%');
	
});

//Input Nome
$('#testenome').on('keyup', function(){
	var pretamnome = $('#testenome').val();
	var tamannome = pretamnome.length;
	$('.chamanome').css({visibility: 'visible'});
	
	if(tamannome == 0){
		$('.chamanome').css({visibility: 'hidden'});
	}
	if(tamannome > 8 && avisnome == 0 && barpro < 100){
		barpro += parseFloat(12.5);
		avisnome ++;
	}
	if(tamannome < 9 && avisnome == 1 && barpro > 0){
		barpro -= parseFloat(12.5);
		avisnome --;
	}
	
	if(barpro > 100){
		barpro = 100;
	}
	
	var jogala = barpro + '%';
	$('.prog').css({width: jogala});
	console.log(parseFloat(barpro));
	$(".texpro").html(Math.ceil(barpro) + '%');
	
});

//input Cliente
$('#testeclie').on('keyup', function(){
	var pretamclie = $('#testeclie').val();
	var tamanclie = pretamclie.length;
	$('.chamaclie').css({visibility: 'visible'});
	
	if(tamanclie == 0){
		$('.chamaclie').css({visibility: 'hidden'});
	}
	if(pretamclie != "" && barpro < 100 && avisclie == 0){
		barpro += parseFloat(12.5);
		avisclie ++;
	}
	if(pretamclie == "" && barpro > 0 && avisclie == 1){
		barpro -= parseFloat(12.5);
		avisclie --;
	}
	
	if(barpro > 100){
		barpro = 100;
	}
	
	var jogala = barpro + '%';
	$('.prog').css({width: jogala});
	console.log(parseFloat(barpro));
	$(".texpro").html(Math.ceil(barpro) + '%');
	
});

//Input Email
$('#testetex').on('keyup', function(){
	var pretam = $('#testetex').val();
	var taman = pretam.length;
	$('.chamail').css({visibility: 'visible'});
	
	if(taman == 0){
		$('.chamail').css({visibility: 'hidden'});
	}
	if(taman > 8 && avismail == 0 && barpro < 100){
		barpro += parseFloat(12.5);
		avismail ++;
	}
	if(taman < 9 && avismail == 1 && barpro > 0){
		barpro -= parseFloat(12.5);
		avismail --;
	}
	
	if(barpro > 100){
		barpro = 100;
	}
	
	var jogala = barpro + '%';
	$('.prog').css({width: jogala});
	console.log(parseFloat(barpro));
	$(".texpro").html(Math.ceil(barpro) + '%');
	
});

//Input Telefone
$('#testetel').on('keyup', function(){
	var pretamtel = $('#testetel').val();
	var tamantel = pretamtel.length;
	$('.chamatel').css({visibility: 'visible'});
	
	if(tamantel == 0){
		$('.chamatel').css({visibility: 'hidden'});
	}
	if(tamantel > 7 && avistel == 0 && barpro < 100){
		barpro += parseFloat(12.5);
		avistel ++;
	}
	if(tamantel < 8 && avistel == 1 && barpro > 0){
		barpro -= parseFloat(12.5);
		avistel --;
	}
	
	if(barpro > 100){
		barpro = 100;
	}
	
	var jogala = barpro + '%';
	$('.prog').css({width: jogala});
	console.log(parseFloat(barpro));
	$(".texpro").html(Math.ceil(barpro) + '%');
	
});

//Input Senha
$('#testepass1').on('keyup', function(){
	var pretampass1 = $('#testepass1').val();
	var tamanpass1 = pretampass1.length;
	$('.chamapass1').css({visibility: 'visible'});
	
	if(tamanpass1 == 0){
		$('.chamapass1').css({visibility: 'hidden'});
	}
	
});

//Input Senha2
$('#testepass2').on('keyup', function(){
	var pretampass2 = $('#testepass2').val();
	var tamanpass2 = pretampass2.length;
	$('.chamapass2').css({visibility: 'visible'});
	
	if(tamanpass2 == 0){
		$('.chamapass2').css({visibility: 'hidden'});
	}
	
});

//Confirmar Senhas
$('#testepass2').on('keyup', function(){
	
	var pretampass1 = $('#testepass1').val();
	var pretampass2 = $('#testepass2').val();
	
	if(pretampass1 != pretampass2){
		setTimeout(function(){
		$("#msg").html('Aviso: Senhas não são iguais!'); 
			$('#vaiin').css({visibility: "hidden"});
		}, 1000);
	}
	
		if(pretampass1 == pretampass2){
			setTimeout(function(){$("#msg").html(' '); 
				$('#vaiin').css({visibility: "visible"});
			}, 1500);
			
			var tamanpass2 = pretampass2.length;
	
			if(pretampass1 != "" && avispass1 == 0 && barpro < 100){
				barpro += parseFloat(12.5);
				avispass1 ++;
			}
			if(pretampass1 == "" && avispass1 == 1 && barpro > 0){
				barpro -= parseFloat(12.5);
				avispass1 --;
			}
	
			if(barpro > 100){
				barpro = 100;
			}
	
			var jogala = barpro + '%';
			$('.prog').css({width: jogala});
			console.log(parseFloat(barpro));
			$(".texpro").html(Math.ceil(barpro) + '%');
			
			}
});

//Inserir no BD
$("#reset").click(function(){
	
	barpro = 0;
	barpro = 0;
	avismail = 0;
	aviscpf = 0;
	avistipo = 0;
	avisfuncao = 0;
	avisnome = 0;
	avisclie = 0;
	avistel = 0;
	avispass1 = 0;
	avispass2 = 0;
	
	testecpf.value = "";
	poetipo.value = "";
	poefuncao.value = "";
	testenome.value = "";
	testeclie.value = "";
	testetex.value = "";
	testetel.value = "";
	testepass1.value = "";
	testepass2.value = "";
	
	var jogala = barpro + '%';
	$('.prog').css({width: jogala});
	console.log(parseFloat(barpro));
	$(".texpro").html(Math.ceil(barpro) + '%');
});


$("#vaiin").click(function(){
	if(barpro == 100){
		$('#vaiin').css({visibility: "hidden"});
	}
});

//Teste JQuery (Criei form testejq)
$('#testejq').on('submit',function(event){

    event.preventDefault();
    var Dados=$(this).serialize();
	
    $.ajax({
        url: 'envia_cadas.php',
        method:'post',
        dataType:'html',
        data: Dados,
        success:function(Dados){
            $('.resultado').html(Dados);
        },
		error: function (retorno) {
            // callback para chamadas que falharam.
			console.log("Erro no envio do Form");
		}
    });
	
		barpro = 0;
		barpro = 0;
		avismail = 0;
		aviscpf = 0;
		avistipo = 0;
		avisfuncao = 0;
		avisnome = 0;
		avisclie = 0;
		avistel = 0;
		avispass1 = 0;
		avispass2 = 0;
	
		testecpf.value = "";
		poetipo.value = "";
		poefuncao.value = "";
		testenome.value = "";
		testeclie.value = "";
		testetex.value = "";
		testetel.value = "";
		testepass1.value = "";
		testepass2.value = "";
				
		var jogala = barpro + '%';
		$('.prog').css({width: jogala});
		console.log(parseFloat(barpro));
		$(".texpro").html(Math.ceil(barpro) + '%');
});
</script>

</body>
</html>