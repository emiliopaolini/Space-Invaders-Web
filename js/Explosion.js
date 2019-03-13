function Explosion(div,x,y){
	this.div=div;
	this.x=x;
	this.y=y;
	mappa.getMappaGioco().appendChild(this.div);
	this.div.style.left=this.x+'px';
	this.div.style.top=this.y+'px';

	this.getDiv = function () {
		return this.div;
	}
	this.getX = function () {
		return this.x;
	}
	this.getY = function () {
		return this.y;
	}
	this.setX = function (x) {
		this.x=x;
		this.div.style.left=this.x+'px';
	}
	this.setY = function (y) {
		this.y=y;
		this.div.style.top=this.y+'px';
	}
}
