<?php
include "connection.php";
$levelsstring = "";
$songsstring  = "";
$accountID = htmlspecialchars($_POST["accountID"],ENT_QUOTES);
$page = htmlspecialchars($_POST["page"],ENT_QUOTES);
	$query = "SELECT * FROM friendreqs WHERE toAccountID = '$accountID'";
	$query = $db->prepare($query);
	$query->execute();
	$requests = $query->rowCount();
	$result = $query->fetchAll();
	$startreqs = $page*10;
	$finalreqs = $page+1;
	$finalreqs = $finalreqs*10;
	$finalreqs = $finalreqs-1;
	if($finalreqs > $requests){
		$shownreqs = $requests;
	}else{
		$shownreqs = $finalreqs;
	}
	for ($x = $startreqs; $x < $requests; $x++) {
	if($x != 0){
		echo "|";
	}
	$request = $result[$x];
	$requester = $request["accountID"];
	$query = "SELECT * FROM users WHERE extID = '$requester'";
	$query = $db->prepare($query);
	$query->execute();
	$result = $query->fetchAll();
	$user = $result[0];
	$uploadTime = 0;
	if(is_numeric($user["extID"])){
		$extid = $user["extID"];
	}else{
		$extid = 0;
	}
$xi = $x + 1;
	echo "1:".$user["userName"].":2:".$user["userID"].":9:".$user["icon"].":10:".$user["color1"].":11:".$user["color2"].":14:".$user["iconType"].":15:".$user["special"].":16:".$extid.":32:".$request["ID"].":35:".$request["comment"].":41:1:37:".$uploadTime;

}
	echo "#".$requests.":".$startreqs.":".$shownreqs;
?>