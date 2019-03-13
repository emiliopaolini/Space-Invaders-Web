function Shield(div,width,height,x,y){
	this.div=div;
	this.width=width;
	this.height=height;
	this.x=x;
	this.y=y;
	this.lives=5;
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

	this.hit = function(index){
		this.lives--;
		switch(this.lives) {
    		case 4:
        		this.div.style.backgroundImage="url(./../img/shield4.png)";
        		break;
    		case 3:
        		this.div.style.backgroundImage="url(./../img/shield3.png)";
        		break;
    		case 2:
        		this.div.style.backgroundImage="url(./../img/shield2.png)";
        		break;
        	case 1:
        		this.div.style.backgroundImage="url(./../img/shield1.png)";
        		break;
		} 
		if(this.lives==0){
			shields[index].div.remove();
			shields.splice(index,1);
		}
	}
}
