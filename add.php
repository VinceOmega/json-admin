<?php

 error_reporting(-1);

 include 'config.php';
 $db = new mysqli('localhost', $username, $password, 'redrobo2_prv');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}

foreach($_REQUEST as $key => $value){
		$$key = htmlspecialchars(trim(strip_tags($value)));
}

if(isset($_FILES['image']['name'])){


	if($_FILES['image']['error'] > 0){
		$errors = array(
				'error' => 'Something went wrong while uploading your file. Please try again.'
			);

		echo json_encode($errors);
		header("Location:/company/careers/apply/");
		die();
	}	


 	if($_FILES['image']['size'] < 0){
		$errors = array(
				'error' => 'We need you to upload your resume'
			);

		echo json_encode($errors);
		header("Location:/company/careers/apply/");
		die();
	}



		$path = $_FILES['image']['name'];
		$ext = trim(pathinfo($path, PATHINFO_EXTENSION));

		 // echo $ext;
		 // die();

		if($ext !=  'pdf' && 
		$ext !=  'doc' && 
		$ext != 'docx' && 
		$ext != 'rtf' ){
		$errors = array(
				'error' => 'This is the wrong type of file, Please upload a file that has the correct file types.'
			);
		echo $ext;
		echo json_encode($errors);
		header("Location:/company/careers/apply/");
		die();
	}




/* Handle the upload */
	$date = date("Y-m-d--H-i-s");
	$uploadpath = __DIR__."/img/".$date."-".$_FILES["image"]["name"];
		
	if(file_exists($uploadpath)){

	 echo "same file";
		header("Location:/cn/json-admin/?itemid=$itemid&itemtype=$itemtype");
		die();
			
	} else {
		// var_dump($_FILES['resume']['name']);
		// die();

		$normalpath = "http://preview.redrobotprogramming.com/cn/json-admin/img/".$date."-".$_FILES["resume"]["name"];
		move_uploaded_file($_FILES['resume']['tmp_name'], $uploadpath);
	}

$path = $uploadpath;
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
	/* Now to store all the data in the db */

	$sql = "INSERT into item_lookup
								SET itemtype = 1"; 
					$db->query($sql);



						$sql =	 "SELECT itemid FROM item_lookup WHERE MAX(itemid)";
						$result = $db->query($sql);

							while($row = $db->mysql_fetch_assoc($result)){

							$sql "INSERT into image_tbl
								
								SET itemid = $row[itemid],
								itemtype = 1,
								imagename = '$title',;
								imagedir = '$base64',;
								timeuploaded = NOW()";
								}
							$db->query($sql);
}