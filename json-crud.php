<?php
include 'config.php';
$db = new mysqli('localhost', $username, $password, 'redrobo2_prv');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}
define("CRUDIR", __DIR__."/json/");
$imagetype = {'image/gif', 'image/png', 'image/jpeg', 'image/jpg'};
$videotype = {'video/avi', 'video/mpeg', 'video/webm', 'video/flv', 'video/mp4'};
$audiotype = {'audio/mp3', 'audio/ogg','audio/wav'}
$docstype = {"file/pdf", "file/doc", "file/docx", "file/oot"};

echo CRUDIR;

if(empty($_POST['json'])){
	$files = scandir(CRUDIR);
		foreach($files as $key => $file){
			//echo $file;
			$json = json_decode(file_get_contents(CRUDIR.$file));
			 $data = $json->bannerimage;
			 $pos  = strpos($data, ';');
			 $type = explode(':', substr($data, 0, $pos))[1];

			// echo "<pre>";
			// print_r($type);
			// echo "</pre>";
		}
} else {
	$json = json_decode($_POST['json']);
}
		switch($json->command){

			case "insert":
						$sql = "INSERT into item_lookup
								SET itemtype = 1"; 
					$db->query($sql);



						$sql =	 "SELECT itemid FROM item_lookup WHERE MAX(itemid)";
						$result = $db->query($sql);

							while($row = $db->mysql_fetch_assoc($result)){

							$sql "INSERT into image_tbl
								
								SET itemid = $row[itemid],
								itemtype = 1,
								imagename = '$json->bannername',;
								imagedir = '$json->bannerimage',;
								timeuploaded = NOW()";
								}
							$db->query($sql);

							// foreach($videotype as $key => $video){
							// 	if(trim($type) === trim($image)){
							// 		$sql.= "2";
							// 	}


						

							// foreach($docstype as $key => $docs){
							// 	if(trim($type) === trim($image)){
							// 		$sql.= "3";
							// 	}

								// 	foreach($audiotype as $key => $audio){
								// if(trim($type) === trim($image)){
								// 	$sql.= "4";
								// }
							}



								
			break;


			case "delete":
					$sql = "DELETE il.itemid, il.itemtype, ib.imageid, ib.imagename, ib.imagedir, ib.timeuploaded
					FROM item_lookup as il
					LEFT JOIN image_tbl  as ib
					ON il.itemid = ib.itemtype
					WHERE il.itemid = '$json->bannerid'";
					$db->query($sql);
			break;


			case "modify":
					$sql = "INSERT into image_tbl
							SET imagedir = '$json->bannerimage',
							imagename = $json->bannername
							WHERE itemid = $json->bannerid";
							$db->query($sql);
			break;


			case 'list';
					$sql = "SELECT * FROM image_tbl WHERE itemid = '$json->bannerid'";
					$db->query($sql);

			break;


		}
}


?>

	<html>
			<head></head>
			<body>
			<img src="<?php echo $json->bannerimage;?>">
			<?php echo base64_decode($json->bannerimage); ?>
 			<?php
?>			
			</body>
	</html>