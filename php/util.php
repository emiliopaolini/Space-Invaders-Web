<?php

	function get_my_db(){
		$dbHost="";
		$user="";
		$pass="";
		$nomeDb="";
 	   	static $db;
    	if (!$db) {
        	$db = new mysqli($dbHost, $user, $pass,$nomeDb);
    	}
    	if($db->connect_error) 
			die('Errore di connessione'.$db->connect_errno.'-'. $db->connect_error);
    	return $db;
	}

	function loggato(){
		if(isset($_SESSION["username"])){
			return $_SESSION["username"];
		}
		else
			return false;
	}

	function getAllPosts($db){
		$query="SELECT * FROM post ORDER BY time DESC;";
		$counter=0;
		$result=eseguiQuery($db,$query);
		while($row = $result->fetch_array()){
			$postOwnerId=$row['userId'];
			$query2="SELECT * FROM user WHERE userId='".$postOwnerId."';";
			$result2=eseguiQuery($db,$query2);
			$row2=$result2->fetch_assoc();
			echo "<div class=posts id=post".$counter.">";
			echo "<div class=postBody id=postText".$counter.">";
			$counter++;
			$text=utf8_encode($row['text']);
			echo $text;
			echo "</div>";
			echo "<div class=postOwner id=postOwner".$counter.">";
			echo "Author: ".$row2['username'];
			echo "</div>";
			echo "</div>";
		}
	}

	function getAllMsg($db){
		$query="SELECT * FROM msg_for_admin;";
		$counter=0;
		$result=eseguiQuery($db,$query);
		while($row = $result->fetch_array()){
			$msgOwnerId=$row['userId'];
			$query2="SELECT * FROM user WHERE userId='".$msgOwnerId."';";
			$result2=eseguiQuery($db,$query2);
			$row2=$result2->fetch_assoc();
			echo "<div class=msgs id=msg".$counter.">";
			echo "<div class=msgBody id=msgText".$counter.">";
			$text=utf8_encode($row['text']);
			echo $text;
			echo "</div>";
			echo "<div class=msgOwner id=msgOwner".$counter.">";
			echo "Author: ".$row2['username'];
			echo "</div>";
			echo "</div>";
		}
	}

	function getAllPostsForAdmin($db){
		$query="SELECT * FROM post ORDER BY time DESC;";
		$counter=0;
		$result=eseguiQuery($db,$query);
		while($row = $result->fetch_array()){
			$postOwnerId=$row['userId'];
			$query2="SELECT * FROM user WHERE userId='".$postOwnerId."';";
			$result2=eseguiQuery($db,$query2);
			$row2=$result2->fetch_assoc();
			echo "<div class=posts id=post".$counter.">";
			echo "<div class=postBody id=postText".$counter.">";
			$counter++;
			$text=utf8_encode($row['text']);
			echo $text;
			echo "</div>";
			echo "<div class=deleteButton id=deleteButton".$counter.">";
			echo "<img onclick=deletePost(this) src=./../img/deleteButton.png id=".$row['postId']."-".$counter.">";
			echo "</div>";
			echo "<div class=postOwner id=postOwner".$counter.">";
			echo "Author: ".$row2['username'];
			echo "</div>";
			echo "</div>";
		}
	}

	function iniziaSessione($username){
		$_SESSION["username"]=$username;
	}

	function controllaMysqli($db,$param){
		return $db->real_escape_string($param);
	}

	function eseguiQuery($db,$query){ 
		$queryResult=$db->query($query);
		return $queryResult;
	}

	function getUserId($db,$user){
		$query="SELECT userId FROM user WHERE username='".$user."';";
		$queryResult=eseguiQuery($db,$query);
		$row=$queryResult->fetch_assoc();
		return $row['userId'];
	}

	function checkExtraLife($db,$user){
		$userId=getUserId($db,$user);
		$query="SELECT * FROM buy WHERE userId='".$userId."';";
		$queryResult=eseguiQuery($db,$query);
		while($row = $queryResult->fetch_array()){
			$itemId=$row['itemId'];
			$query2="SELECT * FROM shop WHERE itemId='".$itemId."';";
			$result2=eseguiQuery($db,$query2);
			$riga=$result2->fetch_assoc();
			if($riga['name']=="Life")
				return true AND $row['equipped'];
		}
		return false;
	}

	function getShieldsNumber($db,$user){
		$userId=getUserId($db,$user);
		$count=0;
		$query="SELECT * FROM buy WHERE userId='".$userId."';";
		$queryResult=eseguiQuery($db,$query);
		while($row = $queryResult->fetch_array()){
			$itemId=$row['itemId'];
			$query2="SELECT * FROM shop WHERE itemId='".$itemId."';";
			$result2=eseguiQuery($db,$query2);
			$riga=$result2->fetch_assoc();
			if($riga['name']=="Shield" AND $row['equipped'])
				$count++;
		}
		return $count;
	}

	function getUserData($db,$user){
		$queryData="SELECT * FROM user WHERE username='$user';";
		$queryResult=eseguiQuery($db,$queryData);
		$data="";
		
		if(mysqli_num_rows($queryResult)>=1){
			$row=$queryResult->fetch_assoc();
			$_SESSION["color"]=$row['color'];
			$_SESSION["extra"]=checkExtraLife($db,$user);
			$best=$row['best'];
			$numPartite=$row['numeroPartite'];
			$data = "BEST SCORE: ".$best."-PARTITE GIOCATE: ".$numPartite."-";
			$_SESSION["coins"]=$row['coins'];
			$_SESSION["shieldsNumber"]=getShieldsNumber($db,$user);
		}

		

		//var_dump($_SESSION);
		$queryData="SELECT rank 
				FROM (SELECT username, best, FIND_IN_SET( best, (
				SELECT GROUP_CONCAT( best
				ORDER BY best DESC ) 
				FROM user )
				) AS rank
				FROM user) a
				WHERE username='$user';";
		if ($result = eseguiQuery($db, $queryData)) {
			if(mysqli_num_rows($result)>=1){
				$row=$result->fetch_assoc();
				$rank=$row['rank'];
				$data.= "RANK: ".$rank;

			}
		}
		return $data;			
	}

	function getShopItems($db){
		$queryData="SELECT * FROM shop;";
		$queryResult=eseguiQuery($db,$queryData);
		$items = [];
		$i=0;
		while($row = $queryResult->fetch_array()){
			$riga=[];
			$riga['name']=$row['name'];
			$riga['description']=$row['description'];
			$link="./../img/".$row['img'];
			$riga['link']=$link;
			$riga['cost']=$row['cost'];
			$items[]=$riga;
		}
		return $items;
	}

	function getBoughtItems($db,$user){
		$userId=getUserId($db,$user);
		$queryData="SELECT * FROM buy WHERE userId='".$userId."';";
		$queryResult=eseguiQuery($db,$queryData);
		$i=0;
		echo "<div id=boughtItems>";

		while($row = $queryResult->fetch_array()){
			$itemId=$row['itemId'];
			$query="SELECT * FROM shop WHERE itemId='".$itemId."';";
			$result=eseguiQuery($db,$query);
			$row2=$result->fetch_assoc();
			if($row['equipped']==0)
				echo "<div onclick=equipaggia(this) class=boughtItems id=boughtItem".$row['itemId']." >";
			else{
				echo "<div onclick=equipaggia(this) class=boughtItemsEquipped id=boughtItem".$row['itemId']." >";
			}
			$link="./../img/".$row2["img"];
			echo "<img src=".$link." alt=immagine width=200 height=128 >";
			echo "<div  class=boughItemName id=boughtItemName".$i.">";
			echo $row2['name'];
			echo "</div>";
			echo "</div>";
			if(($i+1)%2==0){
				echo "<br/>";
			}
			$i++;
		}
		echo "</div>";
	}
?>
