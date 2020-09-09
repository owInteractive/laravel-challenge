<?php
class Usuario{
	
	public function login($email, $senha){
		global $pdo;
		$sql = "SELECT * FROM users WHERE email = :email AND senha = :senha AND ativo = 'A'";
		$sql = $pdo->prepare($sql);
		$sql->bindValue("email", $email);
		$sql->bindValue("senha", $senha);
		$sql->execute();
		
		if($sql->rowCount() > 0){
			$dado = $sql->fetch();
			
			setcookie('adenX9Tro', $dado['email'], time() + (3600*24*730));
			setcookie('sinH3Nta', $dado['senha'], time() + (3600*24*730));
			setcookie('emP3rsta', 'MaR14n0', time() + (3600*24*730));
			setcookie('aleatOLogin', uniqid(NULL, true), time() + (3600*24*730));
			setcookie('tementrapag', date("Y-m-d H:i:s"), time() + (3600*24*730));

			session_start();
			
			$_SESSION['emaillog'] = $dado['email'];
			$_SESSION['senha'] = $dado['senha'];

			$_SESSION['empr'] = 'MaR14n0';
			
			return true;
		}else{
			return false;
		}
	}
	
}
?>