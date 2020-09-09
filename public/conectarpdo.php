<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "laravel";

global $pdo;

try{
//orientado a objetos com pdo
$pdo = new PDO("mysql:dbname=".$database."; host=".$host, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
	echo "ERRO: ",$e->getMessage();
	exit;
}

//sistemas
//$sql = $pdo->query("SELECT * FROM login");
//$sql->execute();

//echo $sql->rowCount();
?>
