function Missile(div,width,height,x,y){
	this.div=div;
	this.width=width;
	this.height=height;
	this.x=x;
	this.y=y;
	mappa.getMappaGioco().appendChild(this.div);
	this.div.style.left=this.x+'px';
	this.div.style.top=this.y+'px';

	this.getWidth = function(){
		return this.width;
	} 
	this.getHeight = function(){
		return this.height;
	}
	this.getDiv = function(){
		return this.div;
	}
	this.getX = function(){
		return this.x;
	}
	this.getY = function(){
		return this.y;
	}
	this.setX = function(x){
		this.x=x;
		this.div.style.left=this.x+'px';
	}
	this.setY = function(y){
		this.y=y;
		this.div.style.top=this.y+'px';
	}

	this.checkBound = function(index){
		if(this.y<=mappa.getY()){
        	missiles[index].div.remove();
			missiles.splice(index,1);
      	}
	}

	this.animate = function(){
		this.setY(this.y-25);
	}

	this.collide = function(xMissile,xEnemy,missileWidth,enemyWidth){
  		if(xEnemy<=xMissile && xEnemy+enemyWidth>=xMissile)
    		return true;
  		if(xMissile<=xEnemy && xMissile+missileWidth>=xEnemy)
    		return true;
 		return false;
	}


	this.checkCollision = function(index){
		for(var i=0;i<shields.length;i++){
			if(this.collide(this.x,shields[i].getX(),this.width,shields[i].getWidth())){
				if(shields[i].getY()+shields[i].getHeight()>=this.y){
					shields[i].hit(i);
					missiles[index].div.remove();
					missiles.splice(index,1);
					return true;
				}
			}	
		}
		for(var i=0;i<enemies.length;i++){
			if(this.collide(this.x,enemies[i].getX(),this.width,enemies[i].getWidth())){
				 if(enemies[i].getY()+enemies[i].getWidth()>=this.y){
				 	var type=enemies[i].getDiv().getAttribute("class");
				 	if(type=="enemy3"){
				 		score+=10;
				 	}
				 	if(type=="enemy2"){
				 		score+=20;
				 	}
				 	if(type=="enemy1"){
				 		score+=40;
				 	}

				 	var e=document.createElement("div");
			        e.setAttribute("id","explosion");
			       // e.setAttribute("id","explosion"+explosions.length);
					var explosion=new Explosion(e,enemies[i].getX(),enemies[i].getY());
   					setTimeout(function(){ document.getElementById("explosion").remove();}, 200);
   					if(audio=="true"){
						var sound = new Audio('./../sounds/InvaderHit.wav');
						sound.play();
					}



				 	document.getElementById("score").textContent=score;
					enemies[i].getDiv().remove();
					enemies.splice(i, 1);		
					missiles[index].div.remove();
					missiles.splice(index,1);
					if(enemies.length==0){
						level++;
						restart(false);
					}


					return true;
				 }
				
			}
		}
		if(bonusEnemy){
			if(this.collide(this.x,bonusEnemy.getX(),this.width,bonusEnemy.getWidth())){
				if(bonusEnemy.getY()+bonusEnemy.getWidth()>=this.y){
					var scores=[50,100,150,200];
					score += scores[Math.floor(Math.random() * scores.length)];
					document.getElementById("score").textContent=score;
					bonusEnemy.getDiv().remove();
					bonusEnemy=null;
					var possibleTimes = [5000,10000,15000];
					var time = possibleTimes[Math.floor(Math.random() * possibleTimes.length)];
					clearTimeout(timeoutBonus);
					if(audio=="true"){
						var sound = new Audio('./../sounds/InvaderHit.wav');
						sound.play();
					}
					timeoutBonus=setTimeout(createBonusEnemy,time);
					return true;
				}
			}
		}
		return false;
	}
}
