<?php

include 'config.php';

$db = new mysqli('localhost', $username, $password, 'arifleet');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}


foreach($_REQUEST as $key => $value){
		$$key = htmlspecialchars(trim(strip_tags($value)));
}
	
if($delete != 1){
$stmt = $db->prepare(
	"UPDATE image_tbl  
	 SET
	SET imagedir = TRIM(?),
		imagename = TRIM(?)
	WHERE itemid = TRIM(?)"
	);

if($stmt === false){
	printf(mysqli_error($db));
 }

 $stmt->bind_param('ssi', $title, $img, $itemid);
 $stmt->execute();
 $stmt->close();
} else {
	$sql = "DELETE * FROM image_tbl as ib LEFT JOIN item_lookup as il ON il.itemid = ib.itemid WHERE il.itemid = '$itemid'"
	if($result = $db->query()){
		printf(mysqli_error($db));
	}
}
 $db->close();
 header("Location: /cn/json-admin/?itemid=$itemid&itemtype=$itemtype&changed=1");
}	
	


?>