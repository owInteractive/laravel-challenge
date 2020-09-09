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

include("conectarpdo.php");

include "PHPMailer-master/PHPMailerAutoload.php";
require_once("PHPMailer-master/class.phpmailer.php");
require_once("PHPMailer-master/class.smtp.php");

	$f = 0;

	$login = $_SESSION["emaillog"];
	$senha = $_SESSION["senha"];

	$classe = (@$_POST['palavra1']);
	
	$campos = explode(";", $classe);
	$evento = $campos[0];
	
	if($evento != ""){
		$dataref = strtotime(date("Y-m-d H:i"));

		$limitemin = $dataref;

		$busca2 = $pdo->prepare("SELECT * FROM eventos WHERE id = :evento AND comeco > :min");
		
		$busca2->bindValue("evento", $evento);
		$busca2->bindValue("min", $limitemin);

		$busca2->execute();
		
		if($busca2->rowCount() > 0){while($rowb = $busca2->fetch(PDO::FETCH_OBJ)){
			$ideven = $rowb->id;
			$titulo = $rowb->titulo;
			$descricao = $rowb->descr;
			$comeco = $rowb->comeco;
			$final = $rowb->fim;
			$usu_cad = $rowb->usu;
			
			$comecovai = date("d-m-Y H:i", $comeco);
			$finalvai = date("d-m-Y H:i", $final);
		}}
		
			echo "
			<script>
			$(document).ready(function(){
				$('.mailenv').css({visibility:'visible', display:'block'});
			});
			</script>
			<div class='fechar2'>
<center><font style='font-size:16px;'><b>X</b></font></center>
</div>
<b>Convites Enviados!</b>

<style>
.fechar2{float:right;border-radius:21px;opacity:.5;background-color:black;color:white;height:24px;width:24px;cursor:pointer;}

.mailenv{visibility:visible;border-radius:8px;padding:10px 10px 5px 10px;font-size:17px;color:white;background-color:#8BC34A;height:50px;width:235px;display:block;right:0px;position:fixed;
top:70px;z-index:9999;}
</style>


			<script>
			$('.fechar2').click(function(){
				$('.mailenv').css({visibility:'hidden', display:'none'});
			});
			</script>
			";
			}
		
	$puxin = $pdo->prepare("SELECT * FROM lista WHERE emailusu = :emailusu AND senhausu = :senhausu ORDER BY id DESC");
	$puxin->bindValue(":emailusu", $login);
	$puxin->bindValue(":senhausu", $senha);

	$puxin->execute();

while($row = $puxin->fetch(PDO::FETCH_OBJ)){
	$id_ref = $row->id;
	$emailden = $row->email;
	$nomeden = $row->nome;
	$f++;

ob_start();

$mail = new PHPMailer(); 
 
$mail->IsSMTP(); 
// Enviar por SMTP 
$mail->Host = "192.185.222.150"; 
$mail->Port = 587; 
$mail->SMTPAuth = true;

$mail->Username = 'marketing@nicher.com.br'; 
$mail->Password = 't39425044'; 
 
// Configurações de compatibilidade para autenticação em TLS 
$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );

//$mail->SMTPDebug = 3;

// Seu e-mail
$mail->From = "marketing@nicher.com.br";
// Seu nome 
$mail->FromName = "Eventos Gerais - Convite";
// Define o(s) destinatário(s)
//lohanafelix0@gmail.com
$mail->AddAddress($emailden); 
// Opcionais: CC e BCC
//$mail->AddCC('octavio.cesar91@gmail.com'); 

$mail->IsHTML(true); 
$mail->CharSet = 'UTF-8'; 
$mail->Subject = "Convite Evento :: Eventos Gerais"; 
 
// Corpo do email 
$mail->Body = '<p style="font-size:20px;text-align:center;">Eventos Gerais</p>
O site Eventos Gerais o convida para um evento:<br><br>
<strong>Assunto:</strong> '.$titulo.'<br>
<strong>Descrição:</strong> '.$descricao.'<br><br>
<strong>Início:</strong> '.$comecovai.'<br>
<strong>Término:</strong> '.$finalvai.'<br><br>

<strong>Acesse o site Eventos Gerais e garanta sua vaga no evento!</strong><br><br>

Gerado automaticamente. Data: '.date("Y-m-d H:i").' [Nao responda este email]'; 
// Envia o e-mail 
$enviado = $mail->Send();

ob_end_flush();
sleep(8);

}

$pdo = null;
?>