<?php
	require_once("util.php");
	$idUtente=$_POST["idUtente"];
	$password=$_POST["password"];
	$email=$_POST["mail"];
	$risultatoReg=risultatoReg($idUtente,$password,$email);
	//var_dump($_GET);
	if($risultatoReg==null)
		header('location: ./home.php');
	else
		header('location: ./../index.php?errorMessageRegister=' . $risultatoReg );
	
	function risultatoReg($idUtente,$password,$email){
		$mysqliConn=get_my_db();
		if($idUtente != null && $password != null && $email!=null){
				$idUtente=controllaMysqli($mysqliConn,$idUtente);
				$password=controllaMysqli($mysqliConn,$password);
				$email=controllaMysqli($mysqliConn,$email);
				$password=md5($password);
				$query="select * from user where username='" . $idUtente . "' OR email='" . $email."';"; 
				$queryResult=eseguiQuery($mysqliConn,$query);
				
				$rowNumber = mysqli_num_rows($queryResult);
				if ($rowNumber > 0)
					return 'Username o email gia utilizzati';
				$query="INSERT INTO user(username, password, email) VALUES ('".$idUtente."','".$password."','".$email."');"; 
				$queryResult=eseguiQuery($mysqliConn,$query);
				session_start();
				iniziaSessione($idUtente);
				return null;
			
		}
		return 'Campi Vuoti';
	}
?>
