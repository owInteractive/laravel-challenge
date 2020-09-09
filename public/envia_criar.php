<?php
	header("Content-type: text/html; charset=utf-8");
	include("conectarpdo.php");
	
	$usuario = filter_input(INPUT_POST,'idusuvai',FILTER_SANITIZE_SPECIAL_CHARS);
	$titulo = filter_input(INPUT_POST,'titulo',FILTER_SANITIZE_SPECIAL_CHARS);
	$descr = filter_input(INPUT_POST,'descr',FILTER_SANITIZE_SPECIAL_CHARS);
	
	$data1 = filter_input(INPUT_POST,'inicio1',FILTER_SANITIZE_SPECIAL_CHARS);
	$tempo1 = filter_input(INPUT_POST,'hora1',FILTER_SANITIZE_SPECIAL_CHARS);
	
	$partes1 = explode(':', $tempo1);
	$segundos1 = $partes1[0] * 3600 + $partes1[1] * 60;
	
	$data2 = filter_input(INPUT_POST,'fim2',FILTER_SANITIZE_SPECIAL_CHARS);
	$tempo2 = filter_input(INPUT_POST,'hora2',FILTER_SANITIZE_SPECIAL_CHARS);
	
	$partes2 = explode(':', $tempo2);
	$segundos2 = $partes2[0] * 3600 + $partes2[1] * 60;
	
	$inicio = strtotime($data1) + $segundos1;
	
	$fim = strtotime($data2) + $segundos2;
		
	try{

		$insert2 = $pdo->prepare("INSERT INTO eventos (titulo, descr, comeco, fim, usu) VALUES 
		(:titulo, :descr, :comeco, :fim, :usu)");
				
		$insert2->bindValue("titulo", $titulo);
		$insert2->bindValue("descr", $descr);
		$insert2->bindValue("comeco", $inicio);
		$insert2->bindValue("fim", $fim);
		$insert2->bindValue("usu", $usuario);

		$insert2->execute();
		
			echo "
			<script>
			$(document).ready(function(){
				$('.resultado2').css({visibility:'visible', display:'block'});
			});
			</script>
			<div class='fechar2'>
<center><font style='font-size:16px;'><b>X</b></font></center>
</div>
<b>Evento Criado!</b>


<style>
.fechar2{float:right;border-radius:21px;opacity:.5;background-color:black;color:white;height:24px;width:24px;cursor:pointer;}

.resultado2{visibility:visible;border-radius:8px;padding:10px 10px 5px 10px;font-size:17px;color:white;background-color:#8BC34A;height:50px;width:235px;display:block;right:0px;position:fixed;
top:70px;z-index:9999;}
</style>


			<script>
			$('.fechar2').click(function(){
				$('.resultado2').css({visibility:'hidden', display:'none'});
			});
			</script>
			";
		}catch(PDOException $e){echo "
		<script>
			$(document).ready(function(){
				$('.resultado2').css({visibility:'visible', display:'block'});
			});
			</script>
			<div class='fechar2'>
<center><font style='font-size:16px;'><b>X</b></font></center>
</div>
<b>Erro!</b>


<style>
.fechar2{float:right;border-radius:21px;opacity:.5;background-color:black;color:white;height:24px;width:24px;cursor:pointer;}

.resultado2{visibility:visible;border-radius:8px;padding:10px 10px 5px 10px;font-size:17px;color:white;background-color:red;height:50px;width:205px;display:block;right:0px;position:fixed;
top:70px;z-index:9999;}
</style>


			<script>
			$('.fechar2').click(function(){
				$('.resultado2').css({visibility:'hidden', display:'none'});
			});
			</script>";
		}
		
$pdo = null;
?>