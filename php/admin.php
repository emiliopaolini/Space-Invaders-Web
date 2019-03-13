
<?php
	require_once("util.php");
	session_start();
	if($_SESSION["admin"]!=1){
		echo "<script>
			alert('Non sei un admin!');
			window.location.href='./social.php';
		</script>";
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
		<link rel="stylesheet" href="./../css/styleAdmin.css" type="text/css" media="screen">
		<title>Space Invaders - ADMIN</title>
	</head>
	<body>
		<br>	

		<div id="title">
			Messages
		</div>
		<div id="msgContainer">
			<?php
				getAllMsg($mysqliConn);
			?>
		</div>
		<br>	
		<div id="title2">
			Posts
		</div>
		<div id="postContainer">
			<?php
				getAllPostsForAdmin($mysqliConn);
			?>
		</div>
		<div id="footer">
			<div id="homeContainer">
				<a id="homeLink" href="./home.php">HOME</a>
			</div>
			<div id="socialContainer">
				<a id="socialLink" href="./social.php">SOCIAl</a>
			</div>
		</div>
		<script>
			function deletePost(image){
				var r = confirm("Do you want to delete this post?");
			  	if (r == true) {
			    	var id = image.id;
					var splitted = id.split("-");
					id = splitted[0];
					var xhttp;
					xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
							document.getElementById("postContainer").innerHTML=this.responseText;
				   		}
				  	};
					xhttp.open("GET", "./removePost.php?id="+id, true);
					xhttp.send();
			  	}
			}
		</script>
	</body>
</html>
