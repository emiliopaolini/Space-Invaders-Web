
function loop(){
	for(var i=0;i<missiles.length;i++){
		missiles[i].animate();
		if(!missiles[i].checkCollision(i))
			missiles[i].checkBound(i);
	}
}

function animation(){
	for(var i=0;i<enemies.length;i++){
		enemies[i].animate(i);
	}
}

function moveDown(){
	for(var i=0;i<enemies.length;i++){
		enemies[i].setY(enemies[i].getY()+10);
		for(var j=0;j<shields.length;j++){
			if(enemies[i].getY()+enemies[i].getHeight()>=shields[j].getY()){
				removeShields();
			}
		}
		if(enemies[i].getY()+enemies[i].getHeight()>=player.getY()){
			player.die();
		}
	}

}



function newEnemyMissile(){
	var max=enemies.length-1;
	var min=0;
	var casuale=Math.floor(Math.random() * (max - min)) + min;
	var div=document.createElement("div");
	div.setAttribute("id","enemyMissile"+enemyMissiles.length);
	div.setAttribute("class","enemyMissile");
	var em=new EnemyMissile(div,6,17,enemies[casuale].getX()+enemies[casuale].getWidth()/2-3,enemies[casuale].getY()+enemies[casuale].getHeight());

	if(audio == "true"){
		var sound = new Audio('./../sounds/InvaderBullet.wav');
		sound.play();
	}
	enemyMissiles.push(em);
}

function animateEnemyMissiles(){
	for(var i=0;i<enemyMissiles.length;i++){
		enemyMissiles[i].animate();
		if(!enemyMissiles[i].checkCollision(i))
			enemyMissiles[i].checkBound(i);
	}
}

function createBonusEnemy(){
	if(bonusEnemy==null){
		if(game){
			var div=document.createElement("div");
			div.setAttribute("id","bonusEnemy");
			bonusEnemy=new BonusEnemy(div,48,32,mappa.getX()+mappa.getWidth()-48,mappa.getY()+30);
		}
	}
}

function moveBonusEnemy(){
	if(bonusEnemy!=null){
		if(bonusEnemy.animate()){
			if(game){
				bonusEnemy=null;
				var possibleTimes = [5000,10000,15000];
				var time = possibleTimes[Math.floor(Math.random() * possibleTimes.length)];
				timeoutBonus=setTimeout(createBonusEnemy,time);
			}
		}
	}
}