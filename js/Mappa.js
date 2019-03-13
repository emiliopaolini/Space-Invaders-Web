function Mappa(mappaGioco,width,height,x,y){
	this.mappaGioco=mappaGioco;
	this.width=width;
	this.height=height;
	this.x=x;
	this.y=y;
	this.getWidth = function(){
		return this.width;
	} 
	this.getHeight = function(){
		return this.height;
	}
	this.getMappaGioco = function(){
		return this.mappaGioco;
	}
	this.getX = function(){
		return this.x;
	}
	this.getY = function(){
		return this.y;
	}
}
