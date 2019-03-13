var mappa;
var player;
var tutorialNumber=0;
var missile;
var alien;
var intervallo1;
var intervallo2;
var missileInterval;
var alienInterval;
var tutorial;
var enemyMissiles=new Array();
var avoid=0;
var alienMoveArbitrarly=true;

function beginTutorial(){
  avoid=0;
  alienMoveArbitrarly=true;
  tutorial=true;

  if(document.getElementById("gameOverContainer")){
    document.getElementById("gameOverContainer").remove();
  }
  tutorialNumber=0;
  inizializzaMappa();
  inizializzaPlayer();
  player.getDiv().style.visibility="visible";
  var testo=document.createElement("div");
  testo.setAttribute("id","testoTutorial");
  testo.textContent="Press left arrow key to move left";
  mappa.getMappaGioco().appendChild(testo);

  missileInterval=setInterval(animateMissile,30);
  alienInterval=setInterval(animateAlien,500);
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

document.onkeydown = function(e) {
            if (e.keyCode === 37) {
              if(tutorial){
                player.muovi(0);
                if(alien && !alienMoveArbitrarly)
                  alien.setX(player.getX());
              }
              if(tutorialNumber==0)
                nextTutorial(1);
            }
            if (e.keyCode === 39) {
              if(tutorial){
                player.muovi(1);
                if(alien && !alienMoveArbitrarly)
                  alien.setX(player.getX());
              }
              if(tutorialNumber==1)
                nextTutorial(2);
            }
            if (e.keyCode === 32) {
              newMissile();
              if(tutorialNumber==2)
                nextTutorial(3);
            }
}
function nextTutorial(i){
  tutorialNumber=i;
  switch(i){
    case 1:
      document.getElementById("testoTutorial").textContent="Press right arrow key to move right";
      break;
    case 2:
      document.getElementById("testoTutorial").textContent="Press space to fire a missile";
      break;
    case 3:
      document.getElementById("testoTutorial").textContent="Kill the alien with a missile";
      setTimeout(createAlien(mappa.getY()+200),200);
      break;
    case 4:
      document.getElementById("testoTutorial").innerHTML="Avoid 3 alien's missiles<br>Pay attention: in the real game you will lose a life if you are hit!";
      setTimeout(createAlien(mappa.getY()+350),200);
      alienMoveArbitrarly=false;
      player.setX(mappa.getX()+mappa.getWidth()/2-player.getWidth()/2);
      intervallo1=setInterval(createAlienMissile,3000);
      intervallo2=setInterval(moveAlienMissiles,50);

  }
}

function newMissile(){
  if(tutorial)
    if(missile==null){
      var div=document.createElement("div");
      div.setAttribute("id","missile");
      missile=new Missile(div,6,17,player.getX()+player.getWidth()/2-3,player.getY()-17);
    }
}

function animateMissile(){
  if(missile){
    missile.animate();
    if(tutorialNumber==3){
      if(alien)
        if(missile.collide(missile.getX(),alien.getX(),missile.getWidth(),alien.getWidth())){
          if(alien.getY()+alien.getWidth()>=missile.getY()){
            alien.getDiv().remove();
            alien=null;
            missile.getDiv().remove();
            missile=null;
            nextTutorial(4);
            return;
          }
        }
    }
    if(missile.getY()<=mappa.getY()){
        missile.getDiv().remove();
        missile=null;

    }
  }
}

function createAlien(y){
  var x=mappa.getX();
  if(tutorialNumber==4){
    x=mappa.getX()+mappa.getWidth()/2-72/2;
  }
  var div=document.createElement("div");
  div.setAttribute("id","enemy");
  alien=new Enemy(div,72,48,x,y);
}

function createAlienMissile(){
  
  if(alien){
    var div=document.createElement("div");
    div.setAttribute("id","enemyMissile"+enemyMissiles.length);
    div.setAttribute("class","enemyMissile");
    var em=new EnemyMissile(div,6,17,alien.getX()+alien.getWidth()/2-3,alien.getY()+alien.getHeight());
    enemyMissiles.push(em);
  }
}

function moveAlienMissiles(){
  for(var i=0;i<enemyMissiles.length;i++){
    enemyMissiles[i].setY(enemyMissiles[i].y+25);

    if(enemyMissiles[i].collide(enemyMissiles[i].getX(),player.getX(),enemyMissiles[i].getWidth(),player.getWidth())){
      if(player.getY()<=enemyMissiles[i].getY()){
        enemyMissiles[i].div.remove();
        enemyMissiles.splice(i,1);

      }
    }
    if(enemyMissiles[i].getY()>=mappa.getY()+mappa.getHeight()){
      enemyMissiles[i].div.remove();
      enemyMissiles.splice(i,1);
      avoid++;
      if(avoid==3){
        clearInterval(intervallo1);
        clearInterval(intervallo2);
        removeEverything();
      }
    }
  }
}

function removeEverything(){
  if(alien){
    alien.div.remove();
    alien=null;
  }
  for(var i=0;i<enemyMissiles.length;i++){
    enemyMissiles[i].div.remove();
    enemyMissiles.splice(i,1);
  }
  if(missile){
    missile.getDiv().remove();
    missile=null;
  }
  clearInterval(missileInterval);
  clearInterval(alienInterval);
  tutorial=false;
  player.getDiv().style.visibility="hidden";
  document.getElementById("testoTutorial").remove();
  finalScreen();
}

function finalScreen(){
  var gameOverContainer=document.createElement("div");
  gameOverContainer.setAttribute("id","gameOverContainer");

  var finalText=document.createElement("div");
  finalText.setAttribute("id","finalText");
  finalText.textContent="That's all! Now play the real game, challenge your skill and earn money to buy new item in the shop!";

  var restartButton=document.createElement("input");
  restartButton.setAttribute("type","button");
  restartButton.setAttribute("value","RESTART");
  restartButton.setAttribute("id","restartButton");
  restartButton.setAttribute("onClick","beginTutorial()");

  var homeLink=document.createElement("a");
  homeLink.setAttribute("id","homeLink");
  homeLink.setAttribute("href","./home.php");
  var homeButton=document.createElement("input");
  homeButton.setAttribute("type","button");
  homeButton.setAttribute("value","HOME");
  homeButton.setAttribute("id","homeButton");
  homeLink.appendChild(homeButton);

  gameOverContainer.appendChild(finalText);
  gameOverContainer.appendChild(restartButton);
  gameOverContainer.appendChild(homeLink);
  mappa.getMappaGioco().appendChild(gameOverContainer);

}

function animateAlien(){
  if(alien){
    var img=alien.div.style.backgroundImage;
    img = img.replace(/(url\(|\)|")/g, '');
    if(img == "./../img/InvaderC1.png"){
      alien.div.style.backgroundImage="url(./../img/InvaderC2.png)";
    }
    else{
        alien.div.style.backgroundImage="url(./../img/InvaderC1.png)";
    }
    if(alienMoveArbitrarly){
      var newX=alien.getX()+10*alien.speed;
      alien.setX(newX);
      var changed=false;
      if(newX<mappa.getX()+10){
        alien.speed=1;
        this.setX(this.x+20);
      }
      
      else {
        if(newX+alien.width>=mappa.getX()+mappa.getWidth()){
          alien.speed=-1;
            alien.setX(alien.x-20); 
        }
      }
    }


  }
}