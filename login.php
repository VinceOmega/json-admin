<?php
if(!isset($_SESSION['admin'])){
	session_start();
}
// echo $_SESSION['admin'];
// echo SID;
// die();
include 'config.php';
error_reporting(E_ALL);

if(
isset($_POST['username']) &
isset($_POST['password']) &
$_POST['username'] != '' &
$_POST['password'] != ''


){
	$username_f = trim(strip_tags($_POST['username']));
	$password_f = trim(md5(strip_tags($_POST['password'])));
	$hash_f = trim(md5(strip_tags($_POST['username'])));

	// var_dump($username_f);
	// var_dump($password_f);
	// var_dump($hash_f);
	// die();

//var_dump($_SESSION['admin']);


$_SESSION['admin'] = '';

	$db = new mysqli('localhost', $username, $password, 'redrobo2_prv');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}

$stmt = $db->prepare("SELECT username, password, hash FROM meta_users WHERE username = ? AND password = ? AND hash = ?");
$stmt->bind_param("sss", $username_f, $password_f, $hash_f);
$stmt->execute();
$stmt->bind_result($user, $pass, $hash);
  while ($stmt->fetch()) {
  	$username = $user;
  	$password = $pass;
  	$hashvalue = $hash;
        
    }
   // printf("%s %s\n", $user, $pass, $hash);
$stmt->close();
$db->close();
// var_dump($username);
// var_dump($passname);
// var_dump($hashvalue);
//die();
	if($password === NULL OR $hashvalue === NULL){
		$_SESSION['admin'] = 0;
		header("Location: /cn/json-admin");
		die();
	}else{
		$_SESSION['admin'] = 1;
		header("Location: /cn/json-admin?itemid=1&itemtype=1");
		die();
	}
}else{
		echo "Error on the previous page.";
		session_unset();
		session_destroy();
	}

?>