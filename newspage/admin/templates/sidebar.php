<div class="col-md-3 sidebar">
	<ul class="list-group">
		<li class="list-group-item">
			<div class="media">
				<a href="" class="pull-left">
					<img src="
						<?php
							// URL anh dai dien tai khoan
							if ($data_user['url_avatar'] == '') {
								echo $_DOMAIN.'images/profile.png';
							} else {
								echo str_replace('admin/','',$_DOMAIN).$data_user['url_avatar'];
							}
						 ?>
					" alt="
						Anh dai dien cua <?php
							echo $data_user['display_name'];
						?>
					" class="media-object" width="64" height="64">
				</a>
				<div class="media-body">
					<h4 class="media-heading"><?php echo $data_user['display_name']; ?></h4>
					<?php
						// Hien thi cap bac tai khoan
						// Neu tai khoan la admin
						if ($data_user['position'] == '1') {
							echo '<span class="label label-primary">Quan tri vien</span>';
						}
						// Nguoc lai tai khoan la tac gia
						else {
							echo '<span class="label label-success">Tac gia</span>';
						}
					?>
				</div>
			</div>
		</li>
		<a href="<?php echo $_DOMAIN ?>" class="list-group-item active">
			<span class="glyphicon-dashboard glyphicon"></span> Bang dieu khien
		</a>
		<a href="<?php echo $_DOMAIN ?>profile" class="list-group-item">
			<span class="glyphicon-user glyphicon"></span> Ho so ca nhan
		</a>
		<a href="<?php echo $_DOMAIN ?>posts" class="list-group-item">
			<span class="glyphicon-edit glyphicon"></span> Bai viet
		</a>
		<a href="<?php echo $_DOMAIN ?>photos" class="list-group-item">
			<span class="glyphicon-picture glyphicon"></span> Hinh anh
		</a>
		<a href="<?php echo $_DOMAIN ?>accounts" class="list-group-item">
			<span class="glyphicon-lock glyphicon"></span> Tai khoan
		</a>
		<?php
			// Phan quyen sidebar
			// Neu tai khoan la admin
			if ($data_user['position'] == '1') {
				echo '
					<a href=" '.$_DOMAIN.'categories " class="list-group-item">
						<span class="glyphicon-tag glyphicon"></span>Chuyen muc
					</a>
					<a href=" '.$_DOMAIN.'setting " class="list-group-item">
						<span class="glyphicon-cog glyphicon"></span>Cai dat chung
					</a>
				';
			}
		?>
		<a href="<?php echo $_DOMAIN; ?>signout.php " class="list-group-item">
			<span class="glyphicon-off glyphicon"></span>Thoat
		</a>
	</ul><!-- ul.list-group -->
</div><!-- div.sidebar -->
