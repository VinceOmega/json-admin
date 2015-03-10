<?php
include 'config.php';
$db = new mysqli('localhost', $username, $password, 'redrobo2_prv');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}
define("CRUDIR", __DIR__."/json/");
$imagetype = array('image/gif', 'image/png', 'image/jpeg', 'image/jpg');
$videotype = array('video/avi', 'video/mpeg', 'video/webm', 'video/flv', 'video/mp4');
$audiotype = array('audio/mp3', 'audio/ogg','audio/wav');
$docstype = array("file/pdf", "file/doc", "file/docx", "file/oot");

echo CRUDIR;


// $_POST['json'] = '
// {
//   "command": "list"
// }';

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

		echo "<pre>";
		print_r($json); 
		echo '</pre>';
		//die();
}
		switch($json->command){

			case "insert":
						$sql = "INSERT into item_lookup
								SET itemtype = '1'"; 
					if($result = $db->query($sql)){
								printf(mysqli_error($db));
							}



						$sql =	 "SELECT MAX(itemid) FROM item_lookup WHERE itemtype = 1";
						if($result = $db->query($sql)){
								printf(mysqli_error($db));
							}

							while($row = mysqli_fetch_row($result)){
										echo "<pre>";
										print_r($row);
										echo "</pre>";

							$sql = "INSERT into image_tbl 
							SET itemid = '$row[0]',
								itemtype = '1',
								imagename = '$json->bannername',
								imagedir = '$json->bannerimage',
								timeuploaded = NOW()";

									if(!$result = $db->query($sql)){
									printf(mysqli_error($db));
								}else{
									echo 'success';
									}
								}
						

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
							



								
			break;


			case "delete":
					$sql = "DELETE FROM image_tbl WHERE itemid = '$json->bannerid'";
	if($result = $db->query($sql)){
		printf(mysqli_error($db));
	}
	$sql = "DELETE FROM item_lookup WHERE itemid = '$json->bannerid'";
	if($result = $db->query($sql)){
		printf(mysqli_error($db));
	}
	echo 'success';
			break;


			case "modify":
					$sql = "UPDATE image_tbl
							SET imagedir = '$json->bannerimage',
							imagename = '$json->bannername'
							WHERE itemid = '$json->bannerid'";
						if(!$result = $db->query($sql)){
								printf(mysqli_error($db));
							}
							echo 'success';
			break;


			case 'list';
					$sql = "SELECT * FROM image_tbl";
						if(!$result = $db->query($sql)){
								printf(mysqli_error($db));
							}
						while($row = mysqli_fetch_row($result)){
							$rows[] = $row;
						}

						print_r($rows);
						$pathto = CRUDIR.'response/read.json';
						echo $pathto;
						$fp = fopen($pathto, 'w+');
						$json = json_encode($rows);
						fwrite($fp, $json);
						fclose($fp);
echo 'success';
			break;


		}

$db->close();

?>

		
	