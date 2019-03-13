function Enemy(div,width,height,x,y){
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

	this.animate = function(index){
		var type=this.div.getAttribute("class");
		if(type=="enemy1"){
			var img=this.div.style.backgroundImage;
			img = img.replace(/(url\(|\)|")/g, '');
			if(img == "./../img/InvaderC2.png"){
				this.div.style.backgroundImage="url(./../img/InvaderC1.png)";
			}
			else{
				this.div.style.backgroundImage="url(./../img/InvaderC2.png)";
			} 
		}
		if(type=="enemy2"){
			var img=this.div.style.backgroundImage;
			img = img.replace(/(url\(|\)|")/g, '');
			if(img == "./../img/InvaderB2.png"){
				this.div.style.backgroundImage="url(./../img/InvaderB1.png)";
			}
			else{
				this.div.style.backgroundImage="url(./../img/InvaderB2.png)";
			} 
		}
		if(type=="enemy3"){
			var img=this.div.style.backgroundImage;
			img = img.replace(/(url\(|\)|")/g, '');
			if(img == "./../img/InvaderA2.png"){
				this.div.style.backgroundImage="url(./../img/InvaderA1.png)";
			}
			else{
				this.div.style.backgroundImage="url(./../img/InvaderA2.png)";
			} 
		}

		var newX=this.x+10*this.speed;
		this.setX(newX);
		var changed=false;
		if(newX<mappa.getX()+10){
			this.speed=1;
			changed=true;
			this.setX(this.x+20);
			//for(var i=index+1;i<enemies.length;i++)
				//enemies[i].setX(enemies[i].x+10);
			for(var i=0;i<enemies.length;i++){
				enemies[i].speed=1;
			}
		}
		
		else {
			if(newX+this.width>=mappa.getX()+mappa.getWidth()){
				changed=true;
				this.speed=-1;
				//this.setX(this.x-10);
				for(var i=0;i<=index;i++)
					enemies[i].setX(enemies[i].x-20);
				for(var i=0;i<enemies.length;i++){
					//enemies[i].setX(enemies[i].x-20);
					enemies[i].speed=-1;
				}
				
			}
		}

		
	}

}

