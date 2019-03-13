var mappa=null;
var player=null;
var missiles=new Array();
var enemies=new Array();
var intervalArray=new Array();
var enemyMissiles=new Array();
var explosions=new Array();
var shields=new Array();
var score=0;
var level=0;
var lives=3;
var secondo;
var intervalloCountdown;
var bonusEnemy=null;
var game=true;//per non creare alieno bonus in schermata gameover
var timeoutBonus=null;
var audio;
var extraLife=false;
var playerColor;
var shieldsNumber;

function begin(){
	//inizializzaMappa();
	//inizializzaPlayer();
	playerColor=document.getElementById("player").getAttribute("class");
	audio=localStorage.getItem("audio");
	if(audio==null) audio=true;

	game=true;
	if(timeoutBonus){
		clearTimeout(timeoutBonus);
		timeoutBonus=null;
	}

	inizializzaEnemies();
	intervalArray.push(setInterval(loop,30));
	intervalArray.push(setInterval(animation,500));
	intervalArray.push(setInterval(newEnemyMissile,1000));
	intervalArray.push(setInterval(animateEnemyMissiles,50))
	intervalArray.push(setInterval(moveDown,4000-(level/2)*1000));
	
	var possibleTimes = [5000,10000,15000];
	var time = possibleTimes[Math.floor(Math.random() * possibleTimes.length)];

	intervalArray.push(setInterval(moveBonusEnemy,50));
	timeoutBonus=setTimeout(createBonusEnemy,time);
	document.onkeydown=saved_keydown;
	//setInterval(shoot,1000);
}

function inizializzaShields(){
	shieldsNumber=localStorage.getItem("shieldsNumber");
	//alert(shieldsNumber);
	var x=mappa.getX()+50;
	x+=218;
	for(var i=0;i<shieldsNumber;i++){
		var div=document.createElement("div");
		div.setAttribute("id","shield"+i);
		//x+=176;
		var shield=new Shield(div,176,128,x,mappa.getY()+500);
		shields.push(shield);
		x+=218+176;
	}
}

function beginCountdown(){
	inizializzaMappa();
	inizializzaPlayer();
	secondo=4;
	extraLife=localStorage.getItem("extraLife");
	if(extraLife == "true"){
		lives++;
	}
	document.onkeydown = null;
	intervalloCountdown=setInterval(countdown,1000);

}

function countdown(){
	secondo--;
	if(secondo==3){
		var testo=document.createElement("div");
		testo.setAttribute("id","secondo");
		testo.textContent=secondo;
		mappa.getMappaGioco().appendChild(testo);
	}
	else{
		document.getElementById("secondo").innerHTML=secondo;

	}


	if(secondo==0){
		document.getElementById("secondo").remove();
		clearInterval(intervalloCountdown);
		inizializzaShields();
		begin();
	}
}

function inizializzaMappa(){
	var mappaDiv=document.getElementById("map");
	var rect =mappaDiv.getBoundingClientRect();
    xMappa=rect.left;
    yMappa=rect.top;
    mappa=new Mappa(mappaDiv,1500,800,xMappa,yMappa);
}

function inizializzaPlayer(){
	var playerDiv=document.getElementById("player");


	var width=60;
  	var height=32;
  	var x=mappa.getX()+mappa.getWidth()/2-width/2;
  	var y=mappa.getY()+mappa.getHeight()-height;
  	player=new Player(playerDiv,width,height,x,y);
  	player.setX(x);
  	player.setY(y);
}

function nuovoMissile(){
	var div=document.createElement("div");
	div.setAttribute("class","missile");
	var m=new Missile(div,6,17,player.getX()+player.getWidth()/2-3,player.getY()-17);
	if(audio=="true"){
		var sound = new Audio('./../sounds/ShipBullet.wav');
		sound.play();
	}
	missiles.push(m);
}

var saved_keydown = document.onkeydown = function(e) {
            if (e.keyCode === 37) {
              player.muovi(0);
            }
            if (e.keyCode === 39) {
            	player.muovi(1);
            }
            if (e.keyCode === 32) {
            	nuovoMissile();
            }
}

function nuovoNemico(i,x,y){
	var div=document.createElement("div");
	div.setAttribute("class","enemy"+(i+1));
	var enemy=new Enemy(div,72,48,x,y);
	enemies.push(enemy);
}

function inizializzaEnemies(){
	var x=mappa.getX();
	var y=mappa.getY()+75;
	for(var i=0;i<3;i++){
		for(var j=0;j<11;j++){
			if(j==0)
				x+=44;
			else
				x+=88+48;
			nuovoNemico(i,x,y);

		}
		x=mappa.getX();
		y+=98;
	}
}

function restart(dead){
	for(var i=0;i<intervalArray.length;i++)
		clearInterval(intervalArray[i]);
	removeAllMissiles();
	if(!dead)
		document.getElementById("level").textContent=(level+1);
	else{
		removeAllRemainingEnemies();
	}
	begin();

}

function removeShields(){
	for(var i=0;i<shields.length;i++){
		shields[i].div.remove();
		shields.splice(i,1);
	}
}

function removeAllMissiles(){
	for(var i=0;i<missiles.length;i++){
		missiles[i].div.remove();
	}
	for(var i=0;i<enemyMissiles.length;i++){
		enemyMissiles[i].div.remove();
	}
	missiles=[];
	enemyMissiles=[];
}
function removeAllRemainingEnemies(){
	for(var i=0;i<enemies.length;i++){
		enemies[i].div.remove();
	}
	if(bonusEnemy){
		bonusEnemy.getDiv().remove();
		bonusEnemy=null;
	}
	enemies=[];
}

function gameOver(){
	removeShields();
	removeAllMissiles();
	removeAllRemainingEnemies();
	removePlayer();
	for(var i=0;i<intervalArray.length;i++)
		clearInterval(intervalArray[i]);
	showGameOverScreen();
}
function removePlayer(){
	lives=3;
	player.getDiv().remove();
}

function redraw(){
	for(var i=0;i<intervalArray.length;i++)
		clearInterval(intervalArray[i]);
	document.getElementById("gameOverContainer").remove();
	for(var i=0;i<3;i++){
		document.getElementById("life"+(i+1)).style.visibility = "visible";
	}
	if(extraLife == "true"){
		document.getElementById("life4").style.visibility = "visible";
	}
	var playerDiv=document.createElement("div");
	playerDiv.setAttribute("id","player");
	playerDiv.setAttribute("class",playerColor);

	player.div = playerDiv;

	mappa.getMappaGioco().appendChild(player.div);
	level=0;
	document.getElementById("score").textContent=0;
	score=0;
	//begin();
	beginCountdown();
}

function showGameOverScreen(){
	var coinsEarned=score/10;
	document.onkeydown=null;

	var gameOverContainer=document.createElement("div");
	gameOverContainer.setAttribute("id","gameOverContainer");
	var scoreText=document.createElement("div");
	scoreText.setAttribute("id","scoreText");
	scoreText.textContent="Il tuo score e': "+score;
	var coinText=document.createElement("div");
	coinText.setAttribute("id","coinText");
	coinText.textContent="Hai guadagnato: "+coinsEarned+" $";

	var shopLink=document.createElement("a");
	shopLink.setAttribute("id","shopLink");
	shopLink.setAttribute("href","./shop.php");
	var shopButton=document.createElement("input");
	shopButton.setAttribute("type","button");
	shopButton.setAttribute("value","GO TO SHOP");
	shopButton.setAttribute("id","shopButton");
	shopLink.appendChild(shopButton);

	var restartButton=document.createElement("input");
	restartButton.setAttribute("type","button");
	restartButton.setAttribute("value","RESTART");
	restartButton.setAttribute("id","restartButton");
	restartButton.setAttribute("onClick","redraw()");

	var homeLink=document.createElement("a");
	homeLink.setAttribute("id","homeLink");
	homeLink.setAttribute("href","./home.php");
	var homeButton=document.createElement("input");
	homeButton.setAttribute("type","button");
	homeButton.setAttribute("value","HOME");
	homeButton.setAttribute("id","homeButton");
	homeLink.appendChild(homeButton);
	game=false;
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
			if(this.responseText=="migliorato"){
				var record=document.createElement("div");
			    record.setAttribute("id","recordBattuto");
			    record.textContent="Hai migliorato il tuo record!";
			    gameOverContainer.appendChild(record);
			}
			gameOverContainer.appendChild(scoreText);
			gameOverContainer.appendChild(coinText);
			gameOverContainer.appendChild(restartButton);
			gameOverContainer.appendChild(homeLink);
			gameOverContainer.appendChild(shopLink);

	    }
	  };
	xhttp.open("GET", "./../php/update.php?coinsEarned="+coinsEarned+"&score="+score, true);
	xhttp.send();


	mappa.getMappaGioco().appendChild(gameOverContainer);
}
