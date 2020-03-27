<!-- Dashboard bai viet -->
<h3>Bai viet</h3>
<div class="row">
	<?php 
		if ($data_user['position'] == '1') {
			// Lay tong so bai viet
			$sql_get_count_all_post = "SELECT id_post FROM posts";
			$count_all_post = $db->num_rows($sql_get_count_all_post);

			echo '
				<div class="col-md-4">
					<div class="alert alert-info">
						<h1>'.$count_all_post.'</h1>
						<p>Tong bai viet</p>
					</div>
				</div>
			';
		} else {
			// Lay so bai viet cua tac gia
			$sql_get_count_post_author = "SELECT id_post FROM posts WHERE author_id = '$data_user[id_acc]' ";
			$count_post_author = $db->num_rows($sql_get_count_post_author);

			echo '
				<div class="col-md-4">
					<div class="alert alert-info">
						<h1>'.$count_post_author.'</h1>
						<p>Bai viet cua ban</p>
					</div>
				</div>
			';
		}
	?>

	<div class="col-md-4">
		<div class="alert alert-success">
			<h1>
				<?php 
					// Lay tong bai viet xuat ban
					// Neu tai khoan la admin thi lay toan bo bai viet xuat ban
				if ($data_user['position'] == 1) {
					$sql_get_count_post_public = "SELECT id_post FROM posts WHERE status = '1' ";
				} else {
					$sql_get_count_post_public = "SELECT id_post FROM posts WHERE status = '1' AND author_id = '$data_user[id_acc]' ";
				}

				echo $db->num_rows($sql_get_count_post_public);
				?>
			</h1>
			<p>Bai viet xuat ban</p>
		</div>
	</div>

	<div class="col-md-4">
		<div class="alert alert-warning">
			<h1>
				<?php 
					// Lay tong bai viet an
					// Neu la tai khoan admin thi lay toan bo bai viet an
					if ($data_user['position'] == 1) {
						$sql_get_count_post_hide = "SELECT id_post FROM posts WHERE status = '0' " ;
						// Neu tai khoan la tac gia thi lay cac bai viet xuat ban cua tai khoan do
					} else {
						$sql_get_count_post_hide = "SELECT id_post FROM posts WHERE status = '1' AND author_id = '$data_user[id_acc]' ";
					}
					echo $db->num_rows($sql_get_count_post_hide);
				?>
			</h1>
			<p>Bai viet an</p>
		</div>
	</div>
</div>

<!-- Dashboard hinh anh -->
<h3>Hinh anh</h3>
<div class="row">
	<?php 
		if ($data_user['position'] == '1') {
			// lay thong tin hinh anh
			$sql_get_count_img = "SELECT id_img FROM images";
			$label = 'Tong hinh anh';
		} else {
			// Lay so hinh anh cua tac gia
			$sql_get_count_img = "SELECT id_img FROM images WHERE uploader_id = '$data_user[id_acc]' ";
			$label = 'Hinh anh';
		}
		$count_img = $db->num_rows($sql_get_count_img);

		echo '
			<div class="col-md-4">
				<div class="alert alert-info">
					<h1>'.$count_img.'</h1>
					<p>'.$label.'</p>
				</div>
			</div>
		';
	?>
	<?php 
		if ($data_user['position'] == '1') {
			// Lay tong dung luong anh
			$sql_get_size_img = "SELECT size FROM images";
			$label = 'Tong dung luong anh';
		} else {
			// Lay so dung luong anh cua tac gia
			$sql_get_size_img = "SELECT size FROM images WHERE uploader_id = '$data_user[id_acc]' ";
			$label = 'Dung luong anh';
		}

		// Tinh dung luong hinh anh
		if ($db->num_rows($sql_get_size_img)) {
			$count_size_img = 0;
			foreach ($db->fetch_assoc($sql_get_size_img, 0) as $data_img) {
				$count_size_img = $count_size_img + $data_img['size'];
			}
		} else {
			$count_size_img = 0 . ' B';
		}

		// Gan don vi cho dung luong
		if ($count_size_img < 1024) {
			$count_size_img = $count_size_img . ' B';
		} else if ($count_size_img < 1048576) {
			$count_size_img = round($count_size_img / 1024) . ' KB';
		} else if ($count_size_img < 1024) {
			$count_size_img = round($count_size_img / 1024/ 1024) . ' MB';
		} else if ($count_size_img < 1024) {
			$count_size_img = round($count_size_img / 1024/ 1024/ 1024) . ' GB';
		}

		echo '
			<div class="col-md-4">
				<div class="alert alert-success">
					<h1>'.$count_size_img.'</h1>
					<p>'.$label.'</p>
				</div>
			</div>
		';
	?>

	<?php 
		if ($data_user['position'] == '1') {
			// Lay tong so hinh anh
			$sql_get_count_img = "SELECT url FROM images";
			$label = 'Tong so hinh anh loi';
		} else {
			// Lay so bai viet cua tac gia
			$sql_get_count_img = "SELECT url FROM images WHERE uploader_id = '$data_user[id_acc]' ";
			$label = 'Hinh anh loi';
		}

		// Kiem tra danh sach hinh anh
		if ($db->num_rows($sql_get_count_img)) {
			$count_img_err = 0;
			foreach ($db->fetch_assoc($sql_get_count_img, 0) as $data_img ) {
				if (!file_exists('../'.$data_img['url'])) {
					$count_img_err++;
				}
			}
		}

		echo '
			<div class="col-md-4">
				<div class="alert alert-danger">
					<h1>'.$count_img_err.'</h1>
					<p>'.$label.'</p>
				</div>
			</div>
		';
	?>
</div>

<?php 
	
	if ($data_user['position'] == '1') {
	
?>

<!-- Dashboard Chuyen muc -->
<h3>Chuyen muc</h3>
<div class="row">
	<?php 
		// Lay tong so chuyen muc
	$sql_get_count_cate = "SELECT id_cate FROM categories ";
	$count_cate = $db->num_rows($sql_get_count_cate);

	echo '
		<div class="col-md-3">
			<div class="alert alert-info">
				<h1>'.$count_cate.'</h1>
				<p>Tong chuyen muc</p>
			</div>
		</div>
	';
	?>

	<?php 
		// Lay so chuyen muc lon
		$sql_get_count_cate_1 = "SELECT id_cate FROM categories WHERE type = '1' ";
		$count_cate_1 = $db->num_rows($sql_get_count_cate_1);

		echo '
			<div class="col-md-3">
				<div class="alert alert-danger">
					<h1>'.$count_cate_1.'</h1>
					<p>Chuyen muc lon</p>
				</div>
			</div>
		';
	?>

	<?php 
		// Lay so chuyen muc vua
		$sql_get_count_cate_2 = "SELECT id_cate FROM categories WHERE type = '2' ";
		$count_cate_2 = $db->num_rows($sql_get_count_cate_2);

		echo '
			<div class="col-md-3">
				<div class="alert alert-danger">
					<h1>'.$count_cate_2.'</h1>
					<p>Chuyen muc vua</p>
				</div>
			</div>
		';
	?>

	<?php 
		// Lay so chuyen muc nho
		$sql_get_count_cate_3 = "SELECT id_cate FROM categories WHERE type = '3' ";
		$count_cate_3 = $db->num_rows($sql_get_count_cate_3);

		echo '
			<div class="col-md-3">
				<div class="alert alert-danger">
					<h1>'.$count_cate_3.'</h1>
					<p>Chuyen muc nho</p>
				</div>
			</div>
		';
	?>
</div>

<!-- Dashboard tai khoan -->
<h3>Tai khoan</h3>
<div class="row">
	<?php 

		// lay tong so tai khoan
		$sql_get_count_acc = "SELECT id_acc FROM accounts WHERE position = '0' ";
		$count_acc = $db->num_rows($sql_get_count_acc);

		echo '
			<div class="col-md-4">
				<div class="alert alert-info">
					<h1>'.$count_acc.'</h1>
					<p>Tong tai khoan</p>
				</div>
			</div>
		';
	?>

	<?php 

		// Lay so tai khoan hoat dong
		$sql_get_count_acc_active = "SELECT id_acc FROM accounts WHERE status = '0' AND position = '0' ";
		$count_acc_active = $db->num_rows($sql_get_count_acc_active);

		echo '
			<div class="col-md-4">
				<div class="alert alert-success">
					<h1>'.$count_acc_active.'</h1>
					<p>Tai khoan hoat dong</p>
				</div>
			</div>
		';
	?>

	<?php 

		// Lay tai khoan bi khoa
		$sql_get_count_acc_locked = "SELECT id_acc FROM accounts WHERE status = '1' AND position = '0' ";
		$count_acc_locked = $db->num_rows($sql_get_count_acc_locked);

		echo '
			<div class="col-md-4">
				<div class="alert alert-success">
					<h1>'.$count_acc_locked.'</h1>
					<p>Tai khoan bi khoa</p>
				</div>
			</div>
		';
	?>
</div>

<?php 
	
	}

?>