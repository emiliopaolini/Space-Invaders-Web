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
		<link rel="stylesheet" href="./../css/styleShop.css" type="text/css" media="screen">
		<title>Space Invaders - Shop</title>
		
	</head>
	<body onload="checkColor()">


			<div id="title">
				<img id="immagineTitolo" src="./../img/title.png" alt="Space invaders text" >
			</div>
			<div id="infoContainer">
				<div id="coins">
					Coins: 	<?php
						echo $_SESSION["coins"]."$";
					?>	
				</div><br />
				Your Items:
				<div id="boughtItemsContainer">
					
					<?php
						getBoughtItems($mysqliConn,$username);	
					?>	
				</div>
			</div>

			<div id="shopContainer">
				Items:<br/>
	
				<div id="itemContainer">
					
					<?php
						$items=getShopItems($mysqliConn);
						$quanteRighe=count($items);

						for($i=0;$i<$quanteRighe;$i++){
							echo "<div class=item id=item".$i." onclick=mostraInfo(this)>";

							//echo $items[$i]["name"];
							//echo $items[$i]["description"];*/
							
							echo "<div id=itemImage>";	
							echo "<img id=immagine src=".$items[$i]["link"]." width=264 height=192 alt=immagine >";
							echo "</div>";
							echo "<div id=itemName>";
							echo $items[$i]["name"];
							echo "</div>";
							echo "</div>";
							if(($i+1)%4==0)
								echo "<br/>";
							
						}
						//print_r($items);
					?>
					
					
				</div>

				<div id="colorsContainer">
					Colors:

					<div id="green" class="colors" onclick="selectColor(this)">
					</div>
					<div id="red" class="colors" onclick="selectColor(this)">
					</div>
					<div id="yellow" class="colors" onclick="selectColor(this)">
					</div>
					<div id="pink" class="colors" onclick="selectColor(this)">
					</div>
				</div>
			</div>
			
			
			<div id="footer">
				<a href="./home.php">HOME</a>
				
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
		    </div>
		    
		  </div>

		</div>

		<script type="text/javascript">
	

		var closeButton = document.getElementById("close");
		var div = document.getElementById("floatingDiv");
		var availableCoins=<?php echo $_SESSION["coins"]; ?>;
		var colorSelected="<?php echo $_SESSION["color"]; ?>";

		function mostraInfo(i){
			var id = i.id.substring(4);
			//alert(id);
			var xhttp;
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					div.style.display = "block";
					document.getElementById("info").innerHTML=this.responseText;

		   		}
		  	};
			xhttp.open("GET", "./mostraInfo.php?id="+id, true);
			xhttp.send();
		}
		function conferma(id,cost){
			div.style.display = "none";
			//alert(cost);
			
			if(availableCoins>=cost){
				var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
						if(this.responseText!="null"){
							availableCoins-=cost;
							document.getElementById("coins").textContent="Coins: "+availableCoins+"$";
							div.style.display = "block";
						document.getElementById("info").textContent="Purchase made! You will find the item in Your Item";
							document.getElementById("boughtItemsContainer").innerHTML=this.responseText;
							//alert(availableCoins);
						}
						else{
							div.style.display = "block";
							document.getElementById("info").textContent="You have already purchased this item!"
						}
			   		}	
			  	};
				xhttp.open("GET", "./buy.php?itemId="+id+"&cost="+cost, true);
				xhttp.send();
			}
			else{
				div.style.display = "block";
				document.getElementById("info").innerHTML="You don't have enough money to buy this item!<br> Keep playing!";
				
			}
		}
		function checkColor(){
			//alert(colorSelected);
			switch(colorSelected) {
			    case "green":
			        document.getElementById("green").setAttribute("class","colorSelected");
			        break;
			    case "yellow":
			        document.getElementById("yellow").setAttribute("class","colorSelected");
			        break;
			    case "red":
			        document.getElementById("red").setAttribute("class","colorSelected");
			        break;
			    case "pink":
			        document.getElementById("pink").setAttribute("class","colorSelected");
			        break;        
			}

		}
		function selectColor(e){
			//alert(e.id);
			if(e.id!=colorSelected){
				var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
						document.getElementById(colorSelected).setAttribute("class","colors");
						document.getElementById(e.id).setAttribute("class","colorSelected");
						colorSelected=e.id;
			   		}
			  	};
				xhttp.open("GET", "./changeColor.php?colorSelected="+e.id, true);
				xhttp.send();
			}
		}
		function equipaggia(i){
			var xhttp;
			var id = i.id.substring(10);
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if(i.getAttribute("class")=="boughtItems"){
						i.setAttribute("class","boughtItemsEquipped");
					}
					else{
						i.setAttribute("class","boughtItems");
					}
				}	
			};
			if(i.getAttribute("class")=="boughtItems"){
				xhttp.open("GET", "./equip.php?itemId="+id+"&equipped=1", true);
				xhttp.send();	
			}
			else{
				xhttp.open("GET", "./equip.php?itemId="+id+"&equipped=0", true);
				xhttp.send();
			}
			

		}

		closeButton.onclick = function() {
				div.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == close) {
    			div.style.display = "none";
			}
		}
		</script>
	</body>
</html>	