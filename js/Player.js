function Player(div,width,height,x,y){
	this.div=div;
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

	this.die = function(){
		document.getElementById("life"+lives).style.visibility = "hidden";
		lives--;
		if(lives==0){
			gameOver();
		}
		else{
			restart(true);
		}
	}
	this.muovi = function(direction){
		//direction == 0 -> sx
		//direction == 1 -> dx
		if(direction==0){
			if(this.getX()-20>mappa.getX()){
				this.setX(this.getX()-20);
			}
			else{
				var differenza=Math.abs(mappa.getX()-this.getX())-5;
				this.setX(this.getX()-differenza);
			}
        }
        if(direction==1){
        	if(this.x+this.width+20<mappa.getX()+mappa.getWidth()){
                  this.setX(this.getX()+20);
            }
            else{
            	var differenza=(mappa.getX()+mappa.getWidth()-this.getX()-this.getWidth())+5;
				this.setX(this.getX()+differenza);
            }
        }
    }
}
