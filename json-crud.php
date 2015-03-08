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

	$files = scandir(CRUDIR);
		foreach($files as $key => $file){
			//echo $file;
			$json = json_decode(file_get_contents(CRUDIR.$file));
			 $data = $json->bannerimage;
			 $pos  = strpos($data, ';');
			 $type = explode(':', substr($data, 0, $pos))[1];

			echo "<pre>";
			print_r($type);
			echo "</pre>";
		}
		
		switch($json->command){

			case "insert":
						$sql = "INSERT into item_lookup
								SET itemtype = "; 
								<?php 
							foreach($imagetype as $key => $image){
								if(trim($type) === trim($image)){
									$sql.= "1;";
								$sql .= "



									INSERT into image_tbl
								SET itemtype = 1";
								}

							foreach($videotype as $key => $video){
								if(trim($type) === trim($image)){
									$sql.= "2";
								}


						

							foreach($docstype as $key => $docs){
								if(trim($type) === trim($image)){
									$sql.= "3";
								}

								// 	foreach($audiotype as $key => $audio){
								// if(trim($type) === trim($image)){
								// 	$sql.= "4";
								// }
							}



								
			break;


			case "delete":

			break;


			case "modify":

			break;


			case 'list';


			break;


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