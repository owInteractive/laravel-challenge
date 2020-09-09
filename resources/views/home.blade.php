@extends('layouts.app')

@section('content')
 <center><h1>Home</h1></center>
<?php
include("conectarpdo.php");

$lojas = $pdo->prepare("select * from users");
$lojas->execute();

	while($row_lojas = $lojas->fetch(PDO::FETCH_OBJ)){
		echo $row_lojas->nome;
	}
	
$pdo = null;
?>
 
@endsection

