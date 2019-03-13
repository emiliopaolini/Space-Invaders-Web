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
		<link rel="stylesheet" href="./../css/styleSocial.css" type="text/css" media="screen">
		<title>Space Invaders - Social</title>

	</head>
	<body>
		<div id="game">

			<div id="title">
				<img id="immagineTitolo" src="./../img/title.png" alt="Space invaders text" >
			</div>
			<div id="contentArea">
				<div id="title">
					Timeline
				</div>
				<div id="postContainer">
				<?php
					getAllPosts($mysqliConn);
				?>
				</div>
			</div>
			<div id="floatingDiv" >
				  <div class="content">
				    <div class="header">
				      <span id="close">&times;</span>
				      <p id="titoloHeader">Recap</p>
				    </div>
				    <div class="body">
				      <div id="info">

				      </div>
				      <div id="buttonContainer">
				      	
 				      </div> 
 				      <br>
				    </div>
				    
		 		 </div>

			</div>	
			<div id="newPost">
	
				<div id="labelPost">Write something about the game</div>
				<textarea id="postText" rows="4" ></textarea> 
				<input id="sendPostButton" type="button" value="post" onclick="showDialogBox(this)">
				<input id="sendMsgButton" type="button" value="Send to the admin" onclick="showDialogBox(this)">
			</div>
		</div>
		<div id="footer">
				<div id="homeContainer">
					<a id="homeLink" href="./home.php">HOME</a>
				</div>
				<a href="./admin.php"><img width="45" height="45" id="audioButton" src="./../img/key.png" alt="key">ADMIN</a>
		</div>	
		<script>
			var closeButton = document.getElementById("close");
			var text;
			closeButton.onclick = closeDiv;

			function closeDiv(){
				document.getElementById("floatingDiv").style.display = "none";
			}

			function send(){
	
				var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
						document.getElementById("floatingDiv").style.display = "none";
						document.getElementById("postContainer").innerHTML=this.responseText;
						document.getElementById("postText").value="";
			   		}
			  	};
				xhttp.open("GET", "./sendPost.php?text="+text, true);
				xhttp.send();
			}

			function sendToAdmin(){
				var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
						document.getElementById("floatingDiv").style.display = "none";
						document.getElementById("postText").value="";
			   		}
			  	};
				xhttp.open("GET", "./sendMsgAdmin.php?text="+text, true);
				xhttp.send();
			}

			
			function showDialogBox(button){
				text=document.getElementById("postText").value;
				if(text.length==0){
					document.getElementById("info").innerHTML="Text is empty! <br>Write something in your post!";
					if(document.getElementById("yesButton")){
						document.getElementById("yesButton").remove();
						document.getElementById("noButton").remove();
					}
					if(document.getElementById("okButton")==null){

						var button1=document.createElement("input");
						button1.setAttribute("type","button");
						button1.setAttribute("id","okButton");
						button1.setAttribute("onclick","closeDiv()");
						button1.setAttribute("value","OK");

						document.getElementById("buttonContainer").appendChild(button1);
					}
				}
				else{
					if(button.id=="sendPostButton"){	
						document.getElementById("info").innerHTML="<div id=firstLine>You are sending this post:</div>"+"-<div id=confirmText>"+text+"</div>-"+"<div id=lastLine>Do you want to continue?</div>";
						if(document.getElementById("okButton")){
							document.getElementById("okButton").remove();
						}
						if(document.getElementById("yesButton")==null){
							var button1=document.createElement("input");
							button1.setAttribute("type","button");
							button1.setAttribute("id","yesButton");
							button1.setAttribute("onclick","send()");
							button1.setAttribute("value","YES");
							var button2=document.createElement("input");
							button2.setAttribute("type","button");
							button2.setAttribute("id","noButton");
							button2.setAttribute("onclick","closeDiv()");
							button2.setAttribute("value","NO");
							document.getElementById("buttonContainer").appendChild(button1);
							document.getElementById("buttonContainer").appendChild(button2);
						}
					}
					if(button.id=="sendMsgButton"){
						document.getElementById("info").innerHTML="<div id=firstLine>You are sending this message:</div>"+"-<div id=confirmText>"+text+"</div>-"+"<div id=lastLine>Do you want to continue?</div>";
						if(document.getElementById("okButton")){
							document.getElementById("okButton").remove();
						}
						if(document.getElementById("yesButton")==null){
							var button1=document.createElement("input");
							button1.setAttribute("type","button");
							button1.setAttribute("id","yesButton");
							button1.setAttribute("onclick","sendToAdmin()");
							button1.setAttribute("value","YES");
							var button2=document.createElement("input");
							button2.setAttribute("type","button");
							button2.setAttribute("id","noButton");
							button2.setAttribute("onclick","closeDiv()");
							button2.setAttribute("value","NO");
							document.getElementById("buttonContainer").appendChild(button1);
							document.getElementById("buttonContainer").appendChild(button2);
						}
					}
				}
				document.getElementById("floatingDiv").style.display = "block";
			}
		</script>	
	</body>
</html>	