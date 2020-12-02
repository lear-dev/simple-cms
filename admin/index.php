<?php
include('lock.php');
if(isset($_POST['add_admin'])){
	$username = $_POST['username'];
	$passcode = $_POST['passcode'];
	if ($username!=="" && $passcode!=="") {
		$sql=$dbcon->query("INSERT INTO admin(username,passcode) VALUES('$username','$passcode')");
	}
}
$onenotright = "";
if(isset($_POST['edit_admin'])){
	// find out how many records there are to update 
	$size = count($_POST['passcode']);
	//echo $size;
	// start a loop in order to update each record
	$i = 0;
	while ($i < $size) {
		// define each variable
		$username = $_POST['username'][$i];
		$passcode = $_POST['passcode'][$i];
		$id = $_POST['id'][$i];
		if ($username=="" || $passcode=="") {
			$onenotright = "true";
		}
		// do the update
		if ($username!=="" && $passcode!=="") {
			$sql=$dbcon->query("UPDATE admin SET username='$username', passcode='$passcode' WHERE id='$id' LIMIT 1");
		}
		++$i;
	}
}
if(isset($_POST['edit_sub_admin'])){
	// define each variable
	$username = $_POST['username'];
	$passcode = $_POST['passcode'];
	// do the update
	if ($username!=="" && $passcode!=="") {
		$sql=$dbcon->query("UPDATE admin SET username='$username', passcode='$passcode' WHERE id='$login_id'");
	}
}
if(isset($_POST['delete_admin'])){
	// define variable
	$id = $_POST['delete_admin'];
	// do the delete
	$sql=$dbcon->query("DELETE FROM admin WHERE id='$id'");
}
?>
<?php include("header.php"); ?>
<div class="wrap">
	<div id="content">
		<?php
		//echo $login_id;
		if ($login_session=="admin"){
		$res=$dbcon->query("SELECT * FROM admin ORDER BY username ASC");
		if(mysqli_num_rows($res)>0){
		?>
			<form method="post">
				<strong>Edit admin users:</strong><br>
				Can't rename original admin's username or delete original admin, but can change original admin's password.<br>
				<?php
				while($row=$res->fetch_array()){
					if ($row['id']==1) {
						echo '
						<label class="fakeinput">'.$row['username'].'</label>
						<input type="hidden" name="username[]" value="'.$row['username'].'" readonly />
						<input type="text" name="passcode[]" value="'.$row['passcode'].'" placeholder="password :" />
						<input type="hidden" name="id[]" value="'.$row['id'].'">
						<br>
						';
					} else {
						echo '
						<input type="text" name="username[]" value="'.$row['username'].'" placeholder="username :" />
						<input type="text" name="passcode[]" value="'.$row['passcode'].'" placeholder="password :" />
						<input name="id[]" type="hidden" value="'.$row['id'].'">
						<button type="submit" name="delete_admin" value="'.$row['id'].'">Delete</button><br>
						';
					}
				}
				?>
				<button type="submit" name="edit_admin">Edit admin(s)</button>
				<?php if(isset($_POST['edit_admin']) && $onenotright==""){ echo "<br /><em>Updated!</em>"; } ?>
				<?php if($onenotright=="true"){ echo "<br /><em>One or more logins did not update, because name or password was empty!</em>"; } ?>
				<?php if(isset($_POST['delete_admin'])){ echo "<br /><em>Deleted!</em>"; } ?>
			</form>
		<br><strong>Add an admin user:</strong><br>
		<form method="post">
			<input type="text" placeholder="admin name :" name="username" /><br />
			<input type="text" placeholder="admin password :" name="passcode" /><br />
			<button type="submit" name="add_admin">Add admin</button>
			<?php if(isset($_POST['add_admin']) && $_POST['username']!=="" && $_POST['passcode']!==""){ echo "<br /><em>Added!</em>"; } ?>
			<?php if(isset($_POST['add_admin']) && ($_POST['username']=="" || $_POST['passcode']=="")){ echo "<br /><em>Not Added! Username or password was empty.</em>"; } ?>
		</form>
		<?php }} else {
		//echo $login_id;
		$res=$dbcon->query("SELECT * FROM admin WHERE id = $login_id");
		?>
			<form method="post">
				<strong>Edit your login info:</strong><br>
				<?php
				while($row=$res->fetch_array()){
					//if ($row['id']==1) {
					//	echo $row['username'].'
					//	<input type="hidden" name="username[]" value="'.$row['username'].'" readonly />
					//	<input type="text" name="passcode[]" value="'.$row['passcode'].'" placeholder="password :" />
					//	<input type="hidden" name="id[]" value="'.$row['id'].'">
					//	<br>
					//	';
					//} else {
						echo '
						<input type="text" name="username" value="'.$row['username'].'" placeholder="username :" />
						<input type="text" name="passcode" value="'.$row['passcode'].'" placeholder="password :" />
						';
					//}
				}
				?>
				<button type="submit" name="edit_sub_admin">Edit</button>
				<?php if(isset($_POST['edit_sub_admin']) && $_POST['username']!=="" && $_POST['passcode']!==""){ echo "<br /><em>Updated! You will need to login again if you changed your username.</em>"; } ?>
				<?php if(isset($_POST['edit_sub_admin']) && ($_POST['username']=="" || $_POST['passcode']=="")){ echo "<br /><em>Not Updated! Username or password was empty.</em>"; } ?>
			</form>
		<?php } ?>
	</div>
</div>
<?php include("footer.php"); ?>