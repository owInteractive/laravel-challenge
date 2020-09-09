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
header("Content-Disposition: attachment; filename=\"lista_participantes.csv\"");
header("Pragma: no-cache");
header("Expires: 0");

outputCSV(array(
    array('Contador', 'Email', 'Nome'),
));

		$f1 = 0;
		
		$numeven = $_GET["ped"];
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
	
		$sql2 = $pdo->prepare("SELECT * FROM eventos WHERE id = :neven AND usu = :idodu ORDER BY id DESC LIMIT 1");
		$sql2->bindValue("neven", $numeven);
		$sql2->bindValue("idodu", $id_usu);

		$sql2->execute();

		if($sql2->rowCount() > 0){while($row2 = $sql2->fetch(PDO::FETCH_OBJ)){
			
			$id_noeven = $row2->id;
			$titulo = $row2->titulo;
			$descricao = $row2->descr;
			$inicio = $row2->comeco;
			$fim = $row2->fim;
			
		}}else{exit;}
			
	$verreq5 = $pdo->prepare("SELECT * FROM participar WHERE evento = :evento");
	$verreq5->bindValue("evento", $numeven);

	$verreq5->execute();

	$partot = $verreq5->rowCount();
	
	if($verreq5->rowCount() > 0){while($rowpar = $verreq5->fetch(PDO::FETCH_OBJ)){
		$emaillista = $rowpar->email;
		$nomelista = $rowpar->nome;
		$f1++;
		
outputCSV(array(
    array($f1, $emaillista, $nomelista),
));

		} }

$pdo = null;

function outputCSV($data) {

    $output = fopen("php://output", "w");
    foreach ($data as $row) {
        fputcsv($output, $row, ";"); // here you can change delimiter/enclosure
    }
    fclose($output);
}
?>