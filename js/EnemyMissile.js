function EnemyMissile(div,width,height,x,y){
	this.div=div;
	this.width=width;
	this.height=height;
	this.x=x;
	this.y=y;
	mappa.getMappaGioco().appendChild(this.div);
	this.div.style.left=this.x+'px';
	this.div.style.top=this.y+'px';

	this.getWidth = function (){
		return this.width;
	} 
	this.getHeight = function (){
		return this.height;
	}
	this.getDiv = function () {
		return this.div;
	}
	this.getX = function() {
		return this.x;
	}
	this.getY = function () {
		return this.y;
	}
	this.setX = function (x) {
		this.x=x;
		this.div.style.left=this.x+'px';
	}
	this.setY = function(y) {
		this.y=y;
		this.div.style.top=this.y+'px';
	}

	this.checkBound = function (index){
		if(this.y>=mappa.getY()+mappa.getHeight()){
        	enemyMissiles[index].div.remove();
			enemyMissiles.splice(index,1);
      	}
	}

	this.animate = function(){
		this.setY(this.y+25);
	}

	this.collide = function(xMissile,xPlayer,missileWidth,playerWidth){
  		if(xPlayer<=xMissile && xPlayer+playerWidth>=xMissile)
    		return true;
  		if(xMissile<=xPlayer && xMissile+missileWidth>=xPlayer)
    		return true;
 		return false;
	}


	this.checkCollision = function(index){
		for(var i=0;i<shields.length;i++){
			if(this.collide(this.x,shields[i].getX(),this.width,shields[i].getWidth())){
				if(shields[i].getY()<=this.y){
					shields[i].hit(i);
					enemyMissiles[index].div.remove();
					enemyMissiles.splice(index,1);
					return true;
				}
			}	
		}
		
		if(this.collide(this.x,player.getX(),this.width,player.getWidth())){
			if(player.getY()<=this.y){
				if(audio){
					var sound = new Audio('./../sounds/ShipHit.wav');
					sound.play();
				}
				enemyMissiles[index].div.remove();
				enemyMissiles.splice(index,1);
				player.die();
				return true;
			}
		}
		return false;
	}

}
