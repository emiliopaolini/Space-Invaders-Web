function BonusEnemy(div,width,height,x,y){
		this.div=div;
		this.width=width;
		this.height=height;
		this.x=x;
		this.y=y;
		mappa.getMappaGioco().appendChild(this.div);
		this.div.style.left=this.x+'px';
		this.div.style.top=this.y+'px';
		this.speed=1;

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

	this.animate = function(){
		var newX=this.x-10;
		this.setX(newX);
		var changed=false;
		if(newX<mappa.getX()){
			this.div.remove();
			return true;
		}
		return false;
	}
}
