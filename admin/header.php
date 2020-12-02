<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control Panel</title>
<link rel="stylesheet" type="text/css" href="../css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="../css/component.css" />
<script src="../js/modernizr.custom.js"></script>
</head>
<body>
<div id="header">
	<div class="wrap"><br />
		<h1>Control Panel</h1>
		<label>
			<ul id="cbp-tm-menu" class="cbp-tm-menu">
				<li><a href=".">Control Panel</a></li>
				<li>
					<a href="javascript:void(0)">Menu Manager</a>
					<ul class="cbp-tm-submenu">
						<li><a href="add_menu.php">Add Menu</a></li>
						<li><a href="edit_menu.php">Edit Menu</a></li>
					</ul>
				</li>
				<li><a href="logout.php">Logout <?php echo $login_session; ?></a></li>
				<li><a href="../">View Web Site</a></li>
			</ul>
		</label>
	</div>
</div>