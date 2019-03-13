<?php
	require_once("util.php");
	session_start();
    if (!loggato()){
		    header('Location: ./../index.php');
		    exit;
    }
    $mysqliConn=get_my_db();
    $username=$_SESSION["username"];
    

?>
<html lang="it">
	<head>
		<meta charset="utf-8">
    	<meta name = "author" content = "PWEB">
    	<meta name = "keywords" content = "game">
   	 	<link rel="icon" href="./../img/favicon.png">
		<link rel="stylesheet" href="./../css/styleHome.css" type="text/css" media="screen">
		<title>Space Invaders - Home</title>
		<script>
			var audioOn=true;
			function changeIcon(){
				var audioImage=document.getElementById("audioButton");
				if(audioOn){
					audioImage.setAttribute("src","./../img/audioOff.png");
					audioOn=false;
				}
				else{
					audioImage.setAttribute("src","./../img/audioOn.png");
					audioOn=true;
				}
				localStorage.setItem("audio",audioOn);
			}
		</script>
	</head>
	<body>
		<div id="game">

			<div id="title">
				<img id="immagineTitolo" src="./../img/title.png" alt="Space invaders text" >
			</div>
			<div id="infoDiv">
				<div id="invader1Container" class="invaderContainer">
					<img id="invader1Img" class="alienImage" src="./../img/InvaderA1.png" alt="Invader A1 Img" >
					<div id="invader1Text" class="textPoints">
						= 10 POINTS
					</div>
				</div>
				<div id="invader2Container" class="invaderContainer">
					<img id="invader2Img" class="alienImage" src="./../img/InvaderB1.png" alt="Invader B1 Img" >
					<div id="invader2Text" class="textPoints">
						= 20 POINTS
					</div>
				</div>
				<div id="invader3Container" class="invaderContainer">
					<img id="invader3Img" class="alienImage" src="./../img/InvaderC1.png" alt="Invader C1 Img" >
					<div id="invader3Text" class="textPoints">
						= 40 POINTS
					</div>
				</div>
				<div id="redInvaderContainer" class="invaderContainer">
					<img id="redInvaderImg" class="alienImage" src="./../img/RedInvader.png" alt="Red Invader Img" >
					<div id="RedInvaderText" class="textPoints">
						= ??? POINTS
					</div>
				</div>
				<div id="instructionContainer">
					SPACE TO SHOOT<br />
					ARROW KEYS TO MOVE
				</div>
				<div id="audioButtonContainer">
					<img onclick="changeIcon()" id="audioButton" src="./../img/audioOn.png" alt="audio on Img" >
				</div>
			</div>
			<div id="buttonContainer">
				<div id="startButtonContainer" class="buttonContent">
					<a id="linkPlay" href="./game.php"><input type="button" value="CLICK TO PLAY" id="startButton"></a>
				</div>
				<div id="tutorialButtonContainer" class="buttonContent">
					<a id="linkTutorial" href="./tutorial.php"><input type="button" value="TUTORIAl" id="tutorialButton"></a>
				</div>
				<div id="shopButtonContainer" class="buttonContent">
					<a id="linkShop" href="./shop.php"><input type="button" value="SHOP" id="shopButton"></a>
				</div>
				<div id="socialButtonContainer" class="buttonContent">
					<a id="linkSocial" href="./social.php"><input type="button" value="SOCIAL CONTENT" id="socialButton"></a>
				</div>

			</div>
			<div id="footer">
				<div id="userInfo">
					<?php
						$info=getUserData($mysqliConn,$username);
						echo $info;
					?>

				</div>
				<a href="./logout.php" >
					<input type="button" value="LOGOUT" id="logoutButton">
				</a>

			</div>
		</div>
	</body>
</html>
