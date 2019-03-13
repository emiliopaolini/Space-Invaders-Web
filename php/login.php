<?php
	require_once("util.php");
	$idUtente=$_POST["idUtente"];
	$password=$_POST["password"];
	$result=risultato($idUtente,$password);
	if($result==null)
		header('location: ./home.php');
	else
		header('location: ./../index.php?errorMessage=' . $result );

	function risultato($idUtente,$password){
		$mysqli=get_my_db();
		if($idUtente != null && $password != null){
				$idUtente=controllaMysqli($mysqli,$idUtente);
				$password=controllaMysqli($mysqli,$password);
				$password=md5($password);
				$queryResult=eseguiQuery($mysqli,"select * from user where username='" . $idUtente . "' AND password='" . $password."';");
				$rowNumber = mysqli_num_rows($queryResult);
				if ($rowNumber == 0)
					return 'Username o password non validi';
				$utente = $queryResult->fetch_assoc();
				session_start();
				iniziaSessione($utente["username"]);
				$_SESSION["admin"]=$utente["admin"];
				return null;
		}
		return 'Campi Vuoti';
	}
?>
