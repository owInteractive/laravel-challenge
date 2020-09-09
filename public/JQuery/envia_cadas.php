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

include("conectarpdo.php");
	
	$login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_SPECIAL_CHARS);
	$tipo = filter_input(INPUT_POST,'tipo',FILTER_SANITIZE_SPECIAL_CHARS);
	$funcao = filter_input(INPUT_POST,'funcao',FILTER_SANITIZE_SPECIAL_CHARS);
	$nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_SPECIAL_CHARS);
	$cliente = filter_input(INPUT_POST,'cliente',FILTER_SANITIZE_SPECIAL_CHARS);
	$email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_SPECIAL_CHARS);
	$telefone = filter_input(INPUT_POST,'telefone',FILTER_SANITIZE_SPECIAL_CHARS);
	$senha = sha1(filter_input(INPUT_POST,'senha',FILTER_SANITIZE_SPECIAL_CHARS));

	try{

		$sql = $pdo->prepare("SELECT * FROM login WHERE email = :login");
		$sql->bindValue("login", $login);

		$sql->execute();
		
		if($sql->rowCount() > 0){
		echo "
		<script>
			$(document).ready(function(){
				$('.resultado').css({visibility:'visible', display:'block'});
			});
			</script>
			<div class='fechar2'>
<center><font style='font-size:16px;'><b>X</b></font></center>
</div>
<b>J? Cadastrado!</b>


<style>
.fechar2{float:right;border-radius:21px;opacity:.5;background-color:black;color:white;height:24px;width:24px;cursor:pointer;}

.resultado{visibility:visible;border-radius:8px;padding:10px 10px 5px 10px;font-size:17px;color:white;background-color:red;height:50px;width:205px;display:block;right:0px;position:fixed;
top:35px;}
</style>


			<script>
			$('.fechar2').click(function(){
				$('.resultado').css({visibility:'hidden', display:'none'});
			});
		</script>";
		}else{
		$insert = "INSERT INTO login (email, senha, tipo, caracte, nome, cliente, email_usu, telefone, ativo) VALUES 
		(:login, :senha, :tipo, :funcao, :nome, :cliente, :email, :telefone, 'A')";
		$insert = $pdo->prepare($insert);
		$insert->bindValue("login", $login);
		$insert->bindValue("senha", $senha);
		$insert->bindValue("tipo", $tipo);
		$insert->bindValue("funcao", $funcao);
		$insert->bindValue("nome", $nome);
		$insert->bindValue("cliente", $cliente);
		$insert->bindValue("email", $email);
		$insert->bindValue("telefone", $telefone);

		$insert->execute();
		
			echo "
			<script>
			$(document).ready(function(){
				$('.resultado').css({visibility:'visible', display:'block'});
			});
			</script>
			<div class='fechar2'>
<center><font style='font-size:16px;'><b>X</b></font></center>
</div>
<b>Login Cadastrado!</b>


<style>
.fechar2{float:right;border-radius:21px;opacity:.5;background-color:black;color:white;height:24px;width:24px;cursor:pointer;}

.resultado{visibility:visible;border-radius:8px;padding:10px 10px 5px 10px;font-size:17px;color:white;background-color:#8BC34A;height:50px;width:205px;display:block;right:0px;position:fixed;
top:35px;}
</style>


			<script>
			$('.fechar2').click(function(){
				$('.resultado').css({visibility:'hidden', display:'none'});
			});
			</script>
			";
		}
		}catch(PDOException $e){echo "
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
top:35px;}
</style>


			<script>
			$('.fechar2').click(function(){
				$('.resultado').css({visibility:'hidden', display:'none'});
			});
			</script>";
		}
$pdo = null;
?>