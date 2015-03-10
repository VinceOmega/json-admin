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
			//$get_item = $db->query("SELECT il.itemid, il.itemtype  FROM item_lookup as il");
			if($get_item = $db->query("SELECT il.itemid, il.itemtype  FROM item_lookup as il")){
				printf(mysqli_error($db));
			}
			// print_r($get_item);
	while($row = mysqli_fetch_assoc($get_item)){
			$rows[] = $row;
	}
		foreach($rows as $row){
			$itemid = $row['itemid'];
			$itemtype = $row['itemtype'];
				// echo $itemid;

				switch($row['itemtype']){

					  case '1':
					  $get_item = $db->query("SELECT il.itemid, il.itemtype, ib.imagedir, ib.imagename, ib.timeuploaded  FROM item_lookup as il LEFT JOIN image_tbl as ib ON il.itemid = ib.itemid WHERE il.itemid = $itemid AND il.itemtype = $itemtype");
					$row = mysqli_fetch_assoc($get_item); 
					?>
					  				<li <?php if($_GET['id'] === $row['itemid']){
					echo "class = current";
			}?>><a href="?itemid=<?php echo $row['itemid'] ?>&itemtype=<?php echo $row['itemtype']?>"><?php echo $row['imagename'] ?></a></li>
				<?php	  break;


					  case '2':
					  $get_item = $db->query("SELECT il.itemid, il.itemtype, ib.imagedir, ib.imagename, ib.timeuploaded  FROM item_lookup as il LEFT JOIN docs_tbl as ib ON il.itemid = ib.itemid WHERE il.itemid = $itemid AND il.itemtype = $itemtype");
					  $row = mysqli_fetch_assoc($get_item);
?>		  				<li <?php if($_GET['id'] === $row['itemid']){
					echo "class = current";
			}?>><a href="?itemid=<?php echo $row['itemid'] ?>&itemtype=<?php echo $row['itemtype']?>"><?php echo $row['docsname'] ?></a></li>
<?php					  break;


					  case '3':
					  	$get_item = $db->query("SELECT il.itemid, il.itemtype, ib.imagedir, ib.imagename, ib.timeuploaded  FROM item_lookup as il LEFT JOIN video_tbl as ib ON il.itemid = ib.itemid WHERE il.itemid = $itemid AND il.itemtype = $itemtype");
						$row = mysqli_fetch_assoc($get_item);
?>		  				<li <?php if($_GET['id'] === $row['itemid']){
					echo "class = current";
			}?>><a href="?itemid=<?php echo $row['itemid'] ?>&itemtype=<?php echo $row['itemtype']?>"><?php echo $row['videoname'] ?></a></li>
<?php					  break;
				}
			}
		
			?>

			<ul>

</nav><?php 
$db->close();

?>