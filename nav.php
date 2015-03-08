<?php
include 'config.php';
$db = new mysqli('localhost', $username, $password, 'redrobo2_prv');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}
	//$ulitems = array(array());


?>
<nav class="pad">
	<ul>
		<?php
			$get_item = $db->query("SELECT il.itemid, il.itemtype  FROM item_lookup");
	while($row = mysqli_fetch_assoc($get_item){
				switch($row['itemtype']){

					  case '1':
					?>
					  				<li <?php if($_GET['id'] === $row['itemid']){
					echo "class = current";
			}?>><a href="?itemid=<?php echo $row['itemid'] ?>&itemtype=<?php echo $row['itemtype']?>"><?php echo $row['imagename'] ?></a></li>
				<?php	  break;


					  case '2':
?>		  				<li <?php if($_GET['id'] === $row['itemid']){
					echo "class = current";
			}?>><a href="?itemid=<?php echo $row['itemid'] ?>&itemtype=<?php echo $row['itemtype']?>"><?php echo $row['docsname'] ?></a></li>
<?php					  break;


					  case '3':
?>		  				<li <?php if($_GET['id'] === $row['itemid']){
					echo "class = current";
			}?>><a href="?itemid=<?php echo $row['itemid'] ?>&itemtype=<?php echo $row['itemtype']?>"><?php echo $row['videoname'] ?></a></li>
<?php					  break;
				}
			?>

			<ul>

</nav><?php 
$db->close();

?>