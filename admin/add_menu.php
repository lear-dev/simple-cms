<?php
include('lock.php');
if(isset($_POST['add_main_menu'])){
	$menu_name = $_POST['menu_name'];
	$menu_link = $_POST['mn_link'];
	$wasmenunamegiven = "";
	if ($_POST['menu_name']=="") {
		$wasmenunamegiven = "false";
	} else {
		$res=$dbcon->query("SELECT * FROM main_menu ORDER BY m_menu_order DESC LIMIT 1");
		while($row=$res->fetch_array()){
			$m_menu_order = $row['m_menu_order']+1;
		}
		if(mysqli_num_rows($res)>0){
			$sql=$dbcon->query("INSERT INTO main_menu(m_menu_name,m_menu_link,m_menu_order) VALUES('$menu_name','$menu_link','$m_menu_order')");
		} else {
			$sql=$dbcon->query("INSERT INTO main_menu(m_menu_name,m_menu_link,m_menu_order) VALUES('$menu_name','$menu_link','1')");
		}
	}
}
if(isset($_POST['add_sub_menu'])){
	$parent = $_POST['parent'];
	$proname = $_POST['sub_menu_name'];
	$menu_link = $_POST['sub_menu_link'];
	$wasparentpicked = "";
	$wassubmenunamegiven = "";
	if ($_POST['parent']=="") {
		$wasparentpicked = "false";
	} else {
		if ($proname !== "") {
			$wassubmenunamegiven = "true";
			$res=$dbcon->query("SELECT * FROM sub_menu WHERE m_menu_id = $parent ORDER BY s_menu_order DESC LIMIT 1");
			while($row=$res->fetch_array()){
				$s_menu_order = $row['s_menu_order']+1;
			}
			if(mysqli_num_rows($res)>0){
				$sql=$dbcon->query("INSERT INTO sub_menu(m_menu_id,s_menu_name,s_menu_link,s_menu_order) VALUES('$parent','$proname','$menu_link','$s_menu_order')");
			} else {
				$sql=$dbcon->query("INSERT INTO sub_menu(m_menu_id,s_menu_name,s_menu_link,s_menu_order) VALUES('$parent','$proname','$menu_link','1')");
			}
		}
	}
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
		<form method="post">
			<input type="text" placeholder="menu name :" name="menu_name" /><br />
			<input type="text" placeholder="menu link :" name="mn_link" /><br />
			<button type="submit" name="add_main_menu">Add top level menu</button>
			<?php if(isset($_POST['add_main_menu']) && $wasmenunamegiven == ""){ echo "<br /><em>Added!</em>"; } ?>
			<?php if(isset($_POST['add_main_menu']) && $wasmenunamegiven == "false"){ echo "<br /><em>Not added! Menu name was not given.</em>"; } ?>
		</form>
		<br />
		<?php
		$res=$dbcon->query("SELECT * FROM main_menu ORDER BY m_menu_order ASC");
		if(mysqli_num_rows($res)>0){
		?>
		<form method="post">
			<select name="parent">
			<option value="" selected="selected">select parent menu</option>
			<?php
			while($row=$res->fetch_array()){
			?>
				<option value="<?php echo $row['m_menu_id']; ?>"><?php echo $row['m_menu_name']; ?></option>
			<?php
			}
			?>
			</select><br />
			<input type="text" placeholder="sub menu name :" name="sub_menu_name" /><br />
			<input type="text" placeholder="sub menu link :" name="sub_menu_link" /><br />
			<button type="submit" name="add_sub_menu">Add sub menu</button>
			<?php if(isset($_POST['add_sub_menu']) && $wasparentpicked == "" && $wassubmenunamegiven == "true"){ echo "<br /><em>Added!</em>"; } ?>
			<?php if(isset($_POST['add_sub_menu']) && $wasparentpicked == "" && $wassubmenunamegiven == ""){ echo "<br /><em>Not added! Sub menu name was not given.</em>"; } ?>
			<?php if(isset($_POST['add_sub_menu']) && $wasparentpicked == "false"){ echo "<br /><em>Not added! Parent menu was not selected.</em>"; } ?>
		</form>
		<?php
		}
		?>
	</div>
</div>
<?php include("footer.php"); ?>