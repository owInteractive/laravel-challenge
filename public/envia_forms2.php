<?php
	header("Content-type: text/html; charset=utf-8");
	include("conectarpdo.php");
	
	
	$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_SPECIAL_CHARS);
	$senhapre = filter_input(INPUT_POST,'senha1',FILTER_SANITIZE_SPECIAL_CHARS);
	$nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_SPECIAL_CHARS);
	
	$senha = sha1($senhapre);
	
	try{
		
		$testelog = $pdo->prepare("SELECT * FROM users WHERE email = :emaillog AND senha = :senhalog");
		$testelog->bindValue("emaillog", $email);
		$testelog->bindValue("senhalog", $senha);
		
		$testelog->execute();
		
		if($testelog->rowCount() > 0){
			echo 		"<script>
			$(document).ready(function(){
				$('.resultado').css({visibility:'visible', display:'block'});
			});
			</script>
			<div class='fechar2'>
<center><font style='font-size:16px;'><b>X</b></font></center>
</div>
<b>Já Cadastrado!</b>


<style>
.fechar2{float:right;border-radius:21px;opacity:.5;background-color:black;color:white;height:24px;width:24px;cursor:pointer;}

.resultado{visibility:visible;border-radius:8px;padding:10px 10px 5px 10px;font-size:17px;color:white;background-color:red;height:50px;width:205px;display:block;right:0px;position:fixed;
top:70px;z-index:9999;}
</style>


			<script>
			$('.fechar2').click(function(){
				$('.resultado').css({visibility:'hidden', display:'none'});
			});
			</script>";
		}else{
		$insert2 = $pdo->prepare("INSERT INTO users (email, senha, nome, ativo) VALUES 
		(:email, :senha, :nome, 'A')");
				
		$insert2->bindValue("email", $email);
		$insert2->bindValue("senha", $senha);
		$insert2->bindValue("nome", $nome);

		$insert2->execute();
		
			echo "
			<script>
			$(document).ready(function(){
				$('.resultado').css({visibility:'visible', display:'block'});
			});
			</script>
			<div class='fechar2'>
<center><font style='font-size:16px;'><b>X</b></font></center>
</div>
<b>Usuário Cadastrado!</b>


<style>
.fechar2{float:right;border-radius:21px;opacity:.5;background-color:black;color:white;height:24px;width:24px;cursor:pointer;}

.resultado{visibility:visible;border-radius:8px;padding:10px 10px 5px 10px;font-size:17px;color:white;background-color:#8BC34A;height:50px;width:235px;display:block;right:0px;position:fixed;
top:70px;z-index:9999;}
</style>


			<script>
			$('.fechar2').click(function(){
				$('.resultado').css({visibility:'hidden', display:'none'});
			});
			</script>
			";
	}}catch(PDOException $e){echo "
		<script>
			$(document).ready(function(){
				$('.resultado').css({visibility:'visible', display:'block'});
			});
			</script>
			<div class='fechar2'>
<center><font style='font-size:16px;'><b>X</b></font></center>
</div>
<b>Erro!</b>


<style>
.fechar2{float:right;border-radius:21px;opacity:.5;background-color:black;color:white;height:24px;width:24px;cursor:pointer;}

.resultado{visibility:visible;border-radius:8px;padding:10px 10px 5px 10px;font-size:17px;color:white;background-color:red;height:50px;width:205px;display:block;right:0px;position:fixed;
top:70px;z-index:9999;}
</style>


			<script>
			$('.fechar2').click(function(){
				$('.resultado').css({visibility:'hidden', display:'none'});
			});
			</script>";
		}
		
$pdo = null;
?>