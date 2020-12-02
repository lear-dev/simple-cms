<?php
include('lock.php');
if(isset($_POST['edit_main_menu'])){
	// find out how many records there are to update 
	$size = count($_POST['m_menu_name']);
	//echo $size;
	// start a loop in order to update each record
	$i = 0;
	while ($i < $size) {
		// define each variable
		$m_menu_name = $_POST['m_menu_name'][$i];
		$m_menu_link = $_POST['m_menu_link'][$i];
		$m_menu_order = $_POST['m_menu_order'][$i];
		$m_menu_id = $_POST['m_menu_id'][$i];
		// do the update
		$sql=$dbcon->query("UPDATE main_menu SET m_menu_name='$m_menu_name', m_menu_link='$m_menu_link', m_menu_order='$m_menu_order' WHERE m_menu_id='$m_menu_id' LIMIT 1");
		++$i;
	}
}
if(isset($_POST['edit_sub_menu'])){
	// find out how many records there are to update 
	$size = count($_POST['s_menu_name']);
	//echo $size;
	// start a loop in order to update each record
	$i = 0;
	while ($i < $size) {
		// define each variable
		$s_menu_name = $_POST['s_menu_name'][$i];
		$s_menu_link = $_POST['s_menu_link'][$i];
		$s_menu_order = $_POST['s_menu_order'][$i];
		$s_menu_id = $_POST['s_menu_id'][$i];
		// do the update
		$sql=$dbcon->query("UPDATE sub_menu SET s_menu_name='$s_menu_name', s_menu_link='$s_menu_link', s_menu_order='$s_menu_order' WHERE s_menu_id='$s_menu_id' LIMIT 1");
		++$i;
	}
}
if(isset($_POST['delete_main_menu'])){
	// define variable
	$m_menu_id = $_POST['delete_main_menu'];
	// do the delete
	$sql=$dbcon->query("DELETE FROM main_menu WHERE m_menu_id='$m_menu_id'");
	$sql2=$dbcon->query("DELETE FROM sub_menu WHERE m_menu_id='$m_menu_id'");
}
if(isset($_POST['delete_sub_menu'])){
	// define variable
	$s_menu_id = $_POST['delete_sub_menu'];
	// do the delete
	$sql=$dbcon->query("DELETE FROM sub_menu WHERE s_menu_id='$s_menu_id'");
}
?>
<?php include("header.php"); ?>
<div class="wrap">
	<div id="content">
		<?php
		$res=$dbcon->query("SELECT * FROM main_menu ORDER BY m_menu_order ASC");
		if(mysqli_num_rows($res)>0){
			echo "<p><strong>Preview Menu</strong></p>";
			echo "<ul>";
			while($row=$res->fetch_array()){
				$m_menu_id = $row['m_menu_id'];
				$m_menu_name = $row['m_menu_name'];
				$m_menu_link = $row['m_menu_link'];
				echo "<li>";
				if ($m_menu_link !== "") {
					echo "<a href='".$m_menu_link."' target='_blank'>";
				}
				echo $m_menu_name;
				if ($m_menu_link !== "") {
					echo "</a>";
				}
				$res2=$dbcon->query("SELECT * FROM sub_menu WHERE m_menu_id = '$m_menu_id'");
				if(mysqli_num_rows($res2)>0){
					echo "<ul>";
					while($row2=$res2->fetch_array()){
						$s_menu_name = $row2['s_menu_name'];
						$s_menu_link = $row2['s_menu_link'];
						echo "<li>";
						if ($s_menu_link !== "") {
							echo "<a href='".$s_menu_link."' target='_blank'>";
						}
						echo $s_menu_name;
						if ($s_menu_link !== "") {
							echo "</a>";
						}
						echo "</li>";
					}
					echo "</ul>";
				}
				echo "</li>";
				
			}
			echo "</ul>";
		}
		?>
		<br />
		<p><strong>Top Level Menu</strong></p>
		<br />
		<form method="post">
			<?php
			$res=$dbcon->query("SELECT * FROM main_menu ORDER BY m_menu_order ASC");
			while($row=$res->fetch_array()){
			?>
			<input name="m_menu_name[]" value="<?php echo $row['m_menu_name']; ?>" placeholder="menu name :" /> <input name="m_menu_link[]" value="<?php echo $row['m_menu_link']; ?>" placeholder="menu link :" /> <input class="smaller" name="m_menu_order[]" value="<?php echo $row['m_menu_order']; ?>" placeholder="order :" /><input name="m_menu_id[]" type="hidden" value="<?php echo $row['m_menu_id']; ?>"><button type="submit" name="delete_main_menu" value="<?php echo $row['m_menu_id']; ?>">Delete</button><br />
			<?php
			}
			if(mysqli_num_rows($res)>0){
				echo '<button type="submit" name="edit_main_menu">Edit top level menu</button>';
			}
			?>
			<?php if(isset($_POST['edit_main_menu'])){ echo "<br /><em>Updated!</em>"; } ?>
			<?php if(isset($_POST['delete_main_menu'])){ echo "<br /><em>Deleted!</em>"; } ?>
		</form>
		<form method="post">
			<?php
			//$res=$dbcon->query("SELECT * FROM sub_menu ORDER BY m_menu_id ASC, s_menu_order ASC");
			$res=$dbcon->query("SELECT sub_menu.*, main_menu.* FROM sub_menu LEFT JOIN main_menu ON sub_menu.m_menu_id = main_menu.m_menu_id ORDER BY main_menu.m_menu_order ASC, sub_menu.s_menu_order ASC");
			$m_menu_name2 = "";
			while($row=$res->fetch_array()){
			?>
			<?php
			$m_menu_name = $row['m_menu_name'];
			if ($m_menu_name!==$m_menu_name2) {
			echo "<p><br><strong>".$row['m_menu_name']."</strong><br><br></p>";
			}
			$m_menu_name2 = $m_menu_name;
			?>
			<input name="s_menu_name[]" value="<?php echo $row['s_menu_name']; ?>" placeholder="menu name :" /> <input name="s_menu_link[]" value="<?php echo $row['s_menu_link']; ?>" placeholder="menu link :" /> <input class="smaller" name="s_menu_order[]" value="<?php echo $row['s_menu_order']; ?>" placeholder="order :" /><input name="s_menu_id[]" type="hidden" value="<?php echo $row['s_menu_id']; ?>"><button type="submit" name="delete_sub_menu" value="<?php echo $row['s_menu_id']; ?>">Delete</button><br />
			<?php
			}
			if(mysqli_num_rows($res)>0){
				echo '<button type="submit" name="edit_sub_menu">Edit sub menu</button>';
			}
			?>
			<?php if(isset($_POST['edit_sub_menu'])){ echo "<br /><em>Updated!</em>"; } ?>
			<?php if(isset($_POST['delete_sub_menu'])){ echo "<br /><em>Deleted!</em>"; } ?>
		</form>
		<br />
	</div>
</div>
<?php include("footer.php"); ?>