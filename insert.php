<?php

include 'config.php';

$db = new mysqli('localhost', $username, $password, 'redrobo2_prv');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}


foreach($_REQUEST as $key => $value){

		$$key = htmlspecialchars(trim(strip_tags($value)));
}
	//var_dump($delete);
if(intval($delete) != 1){
$stmt = $db->prepare(
	"UPDATE image_tbl  
	SET imagedir = TRIM(?),
		imagename = TRIM(?)
	WHERE itemid = TRIM(?)"
	);

if($stmt === false){
	printf(mysqli_error($db));
 }
//echo 'true';
 $stmt->bind_param('ssi', $image, $title, $itemid);
 $stmt->execute();
 $stmt->close();
} else {
	$sql = "DELETE FROM image_tbl WHERE itemid = '$itemid'";
	if($result = $db->query($sql)){
		printf(mysqli_error($db));
	}
	$sql = "DELETE FROM item_lookup WHERE itemid = '$itemid'";
	if($result = $db->query($sql)){
		printf(mysqli_error($db));
	}
}
 $db->close();
 $itemid++;
 $itemtype++;
 header("Location: /cn/json-admin/?itemid=$itemid&itemtype=$itemtype&changed=1");
	
	


?>