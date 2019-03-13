<?php

	session_start();
	require_once("./php/util.php");
    if (loggato()){
		    header('Location: ./php/home.php');
		    exit;
    }	
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "PWEB">
    	<meta name = "keywords" content = "game">
   	 	<link rel="shortcut icon" type="image/x-icon" href="./css/img/favicon.ico" />
   	 	<link rel="stylesheet" href="./css/styleIndex.css" type="text/css" media="screen">
		<title>Space Invaders</title>
	</head>
	<body>
		<div id="title">
			<img id="immagineTitolo" src="./img/title.png" alt="Space invaders text" >
		</div>
		<section id="loginContent">
		<div id="loginTitle">
			LOGIN
		</div>
		<br>	
		<div id="login_form">
			<form name="login" action="./php/login.php" method="post">
				<div>
					<label>Username</label>
					<input type="text" placeholder="Username" name="idUtente" required>
				</div>
				<div>
					<label>Password</label>
					<input type="password" placeholder="Password" name="password" required>
				</div>	
				<input type="submit" value="LOGIN">
				<?php
					if (isset($_GET['errorMessage'])){
						echo '<div class="error">';
						echo '<span>' . $_GET['errorMessage'] . '</span>';
						echo '</div>';
					}
				?>
			</form>
		</div>
		</section>
		
		<section id="registerContent">
		<div id="registerTitle">
			REGISTER
		</div>
		<br>	
		<div id="register_form">
			<form name="register" action="./php/register.php" method="post">
				<div>
					<label>E-mail</label>
					<input type="text" placeholder="E-mail" name="mail" required>
				</div>
				<div>
					<label>Username</label>
					<input type="text" placeholder="Username" name="idUtente" required>
				</div>
				<div>
					<label>Password</label>
					<input type="password" placeholder="Password" name="password" required>
				</div>	
				<input type="submit" value="REGISTER">
				
			</form>

		</div>
		<?php
					if (isset($_GET['errorMessageRegister'])){
						echo '<div  class="error">';
						echo  $_GET['errorMessageRegister'];
						echo '</div>';
					}
				?>
		</section>
	</body>
</html>
