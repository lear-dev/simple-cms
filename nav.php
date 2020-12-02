	<ul id="nav">
		<select id="shortnav" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
			<option value="">-Navigation-</option>
			<?php
			$res=$dbcon->query("SELECT * FROM main_menu ORDER BY m_menu_order ASC");
			while($row=$res->fetch_array()){
			?>
			<option value="<?php echo $row['m_menu_link']; ?>"><?php echo $row['m_menu_name']; ?></option>
			<?php
			$res_pro=$dbcon->query("SELECT * FROM sub_menu WHERE m_menu_id=".$row['m_menu_id']." ORDER BY s_menu_order ASC");
			?>
			<?php while($pro_row=$res_pro->fetch_array()){?>
				<option value="<?php echo $pro_row['s_menu_link']; ?>">&nbsp;&nbsp;-&nbsp;<?php echo $pro_row['s_menu_name']; ?></option>
			<?php } ?>
			<?php } ?>
		</select>
	
		<?php
		$res=$dbcon->query("SELECT * FROM main_menu ORDER BY m_menu_order ASC");
		while($row=$res->fetch_array()){
		?>
			<li class="topli"><a href="<?php echo $row['m_menu_link']; ?>" class="topa"><?php echo $row['m_menu_name']; ?></a>
			<?php
			$res_pro=$dbcon->query("SELECT * FROM sub_menu WHERE m_menu_id=".$row['m_menu_id']." ORDER BY s_menu_order ASC");
			?>
			<ul>				
				<?php while($pro_row=$res_pro->fetch_array()){?>
					<li class="subli"><a href="<?php echo $pro_row['s_menu_link']; ?>" class="suba"><?php echo $pro_row['s_menu_name']; ?></a></li>
				<?php } ?>
			</ul>
			</li>
			
		<?php } ?>
	</ul>