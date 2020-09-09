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

include("conectarpdo.php");
chr(255) . chr(254);
header("Content-type:application/csv;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"participando_eventos.csv\"");
header("Pragma: no-cache");
header("Expires: 0");

outputCSV(array(
    array('Contador', 'Evento', 'Titulo', 'Descr', 'Inicio', 'Fim'),
));

		$f1 = 0;
		
		date_default_timezone_set ("America/Sao_Paulo");
		
			$dataref = strtotime(date("Y-m-d H:i"));

			$limitemin = $dataref;

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
		
		$busca = $pdo->prepare("SELECT evento FROM participar WHERE usu = :idusu ORDER BY id ASC");
		
		$busca->bindValue("idusu", $id_usu);
		
		$busca->execute();
		
		if($busca->rowCount() > 0){while($row2 = $busca->fetch(PDO::FETCH_OBJ)){
			$evento = $row2->evento;

			
		$busca2 = $pdo->prepare("SELECT * FROM eventos WHERE id = :evento AND comeco > :min");
		
		$busca2->bindValue("evento", $evento);
		$busca2->bindValue("min", $limitemin);

		$busca2->execute();
		
		if($busca2->rowCount() > 0){while($rowb = $busca2->fetch(PDO::FETCH_OBJ)){
			$ideven = $rowb->id;
			$titulo = mb_convert_encoding($rowb->titulo, 'UTF-16LE', 'UTF-8');
			$descricao = mb_convert_encoding($rowb->descr, 'UTF-16LE', 'UTF-8');
			$comecopre = $rowb->comeco;
			$finalpre = $rowb->fim;
			$usu_cad = $rowb->usu;
			
			$comeco = date("d-m-Y H:i", $comecopre);
			$final = date("d-m-Y H:i", $finalpre);
			
			$f1++;

						
outputCSV(array(
    array($f1, $ideven, $titulo, $descricao, $comeco, $final),
));

		} } } }

$pdo = null;

function outputCSV($data) {

    $output = fopen("php://output", "w");
    foreach ($data as $row) {
        fputcsv($output, $row, ";"); // here you can change delimiter/enclosure
    }
    fclose($output);
}

?>