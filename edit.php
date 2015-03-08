<?php

	$db = new mysqli('localhost', $username, $password, 'redrobo2_prv');
		if($db->connect_errno){
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}
?>


<?php
foreach($_GET as $key => $value){
		$$key = htmlspecialchars(trim(strip_tags($value)));
}
switch($itemtype){

     case '1':
	$get_item = $db->query("SELECT il.itemid, il.itemtype, ib.imagedir, ib.imagename, ib.timeuploaded  FROM item_lookup as il LEFT JOIN image_tbl as ib ON il.itemid = ib.itemid WHERE il.itemid = $itemid");
	$row = mysqli_fetch_assoc($get_item); $pagename = $row['imagename']; $itemdir = $row['imagedir']; $itemtime = $row['timeuploaded'];
	break;

	   case '2':
	$get_item = $db->query("SELECT il.itemid, il.itemtype, ib.imagedir, ib.imagename, ib.timeuploaded  FROM item_lookup as il LEFT JOIN docs_tbl as ib ON il.itemid = ib.itemid WHERE il.itemid = $itemid");
	$row = mysqli_fetch_assoc($get_item); $pagename = $row['docsname'];  $itemdir = $row['docsdir']; $itemtime = $row['timeuploaded'];
	break;

	   case '3':
	$get_item = $db->query("SELECT il.itemid, il.itemtype, ib.imagedir, ib.imagename, ib.timeuploaded  FROM item_lookup as il LEFT JOIN video_tbl as ib ON il.itemid = ib.itemid WHERE il.itemid = $itemid");
	$row = mysqli_fetch_assoc($get_item); $pagename = $row['videoname'];  $itemndir = $row['videodir']; $itemtime = $row['timeuploaded'];
	break;
}
?>
<div class="main">
		<span class="title">Edit Page: <?php echo $pagename ?></span>
		<div class="pad">
	
		
			<form method="post" action="insert.php?id=<?php echo $itemid?>">
				<fieldset>
				


				</fieldset>
				<fieldset>
					<label for="title">Title</label>
					<input type="text" name="title" id="title" value="<?php echo $pagename;?>">
				</fieldset>
				<fieldset>
					<label for="url">Item Dir</label>
					<input type="text" name="url" id="url" value="<?php echo $itemdir;?>">
				</fieldset>
				<fieldset>
					<label for="h1">Time </label>
					<input type="text" name="h1" id="h1" value="<?php echo $row_stats['h1'];?>">
				</fieldset>
				
				<fieldset>
					<input type="submit" value="Save"> &nbsp;
					<input type="reset" value="Cancel">
				</fieldset>
			</form>
		</div>
	</div>
	<?php 

$db->close();
			
?>