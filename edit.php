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
	
		
			<form method="post" action="insert.php?itemid=<?php echo $itemid?>&itemtype=<?php echo $itemtype?>">
				<fieldset>
					<label for="title">Title</label>
					<input type="text" name="title" id="title" value="<?php echo $pagename;?>">
				</fieldset>
				<fieldset>
					<label for="url">Image</label>
					<img src="<?php echo $itemdir?>" alt="<?php echo $pagename?>">
					<input type="text" name="image" id="image" value="<?php echo $itemdir;?>">
				</fieldset>
				<fieldset>
					<label for="h1">Time </label>
					<input type="text" name="time" id="time" value="<?php echo $timeuploaded;?>">
				</fieldset>
				<fieldset>
				<label>Want to delete this entry?</label>
				<input type="radio" name="delete" value="1">Yes<br>
				<input type="radio" name="delete" value="0">No
				</fieldset>
				<fieldset>
					<input type="submit" value="Save"> &nbsp;
					<input type="reset" value="Cancel">
				</fieldset>
			</form>
			<form method="post" action="add.php?itemid=<?php echo $itemid?>&itemtype=<?php echo $itemtype?>">
				<fieldset>
					<label for="title">Title</label>
					<input type="text" name="title" id="title" value="">
				</fieldset>
				<fieldset>
					<label for="url">Image</label>
					<input type="file" name="image" id="image" value="">
				</fieldset>
				<fieldset>
					<input type="hidden" name="time" id="time" value="<?php echo date("Y-m-d H:i:s")?>">
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