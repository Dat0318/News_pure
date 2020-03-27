<?php 
	// Neu dang nhap
	if ($user) {
		echo '<h3>Hinh anh</h3>';
		// Lay tham so ac
		if (isset($_GET['ac'])) {
			$ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
		} else {
			$ac = '';
		}

		// Neu co tham so ac
		if ($ac != '') {
			// Trang upload hinh anh
			if ($ac == 'add') {
				// Day nut upload hinh anh
				echo '
					<a href="'.$_DOMAIN.'photos" class="btn btn-default">
						<span class="glyphicon glyphicon-arrow-left"></span>Tro ve
					</a>
				';
				// Content upload hinh anh
				echo '
					<p class="form-up-img">
						<div calss="alert alert-info"> Moi lan upload toi day 20 file anh. Moi file anh dung luong khong vuot qua 5MB va cos dinh dang la .jpg, .png, .gif</div>
						<form action="'.$_DOMAIN.'photos.php" method="POST" id="formUpImg" enctype="multi[art/form-data" onsubmit="return false;">
							<div class="form-group">
								<label>Chon hinh anh:</label>
								<input type="file" calss="form-control" accept="image/*" name="img_up[]" multiple="true" id="img_up" onchange="preUpImg();">
							</div>
							<div class="form-group box-pre-img hidden">
								<p><strong>Anh xem truoc</stronng></p>
							</div>
							<div class="form-group">
								<div class="progress">
									<div class="pregress-bar" role="progressbar"></div>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Upload</button>
								<button type="reset" class="btn btn-default">Chon lai</button>
							</div>
							<div class="alert alert-danger hidden"></div>
						</form>
					</p>
				';
			}
		}
		// nguoc lai khong co thm so ac
		// Trang danh sach hinh anh
		else {
			// Day nut cua danh sach hinh anh
			echo '
				<a href="'.$_DOMAIN.'photos/add" class="btn btn-default">
					<span class="glyphicon glyphicon-plus"><span> Them
				</a>
				<a href="'.$_DOMAIN.'photos" class="btn btn-default">
					<span class="glyphicon glyphicon-repeat"><span> Reload
				</a>
				<a add" class="btn btn-danger" id="del_img_list">
					<span class="glyphicon glyphicon-trash"><span> Xoa
				</a>
			';

			// content danh sach hinh anh

			$sql_get_img = "SELECT * FROM images ORDER BY id_img DESC";
			if ($db->num_rows($sql_get_img)) {
				echo '
					<div class="row list" id="list_img">
						<div class="col-md-12">
							<div class="checkbox"><label><input type="checkbox">Chon/ Bo chon tat ca</label></div>
						</div>
				';
				foreach ($db->fetch_assoc($sql_get_img, 0) as $key => $data_img) {
					// Trang thai anh
					if (file_exists('../'.$data_img['url'])) {
						$status_img = '<label class="label label-success">Ton tai</label>'; 
					} else {
						$status_img = '<label class="label label-danger">Hong</label>';
					}

					// Dung luong anh
					if ($data_img['size'] < 1024) {
						$size_img = $data_img['size'].'B';
					} else if ($data_img['size'] < 1048576) {
						$size_img = round($data_img['size'] / 1024).'KB';
					} else if ($data_img['size'] < 1048576) {
						$size_img = round($data_img['size'] / 1024/ 1024).'MB';
					}
					echo '
						<div class="col-md-3">
							<div class="thumbnail">
								<a href="'.str_replace('admin/', '', $_DOMAIN) . $data_img['url'].'">
									<img src="'.str_replace('admin/', '', $_DOMAIN) . $data_img['url'].'" style="height: 150px;">
								</a>
								<div class="caption">
									<div class="input-group">
										<span class="input-group-addon">
											<input type="checkbox" name="id_img[]" value="'.$data_img['id_img'].'">
										</span>
										<input type="text" class="form-control" value="'.str_replace('admin/', '',$_DOMAIN).$data_img['url'].'" disabled>
										<span class="input-group-btn">
											<button class="btn btn-danger del-img" data-id="'.$data_img['id_img'].'">
												<span class="glyphicon glyphicon-trash">
											</button>
										</span>
									</div>
									<p>Trang thai: '.$status_img.'</p>
									<p>Dung luong: '.$size_img.'</p>
									<p>Dinh luong: '.strtoupper($data_img['type']).'</p>
								</div>
							</div>
						</div>
					';
				}
				echo '</div>';
			} else {
				echo '<br><br><div class="alert alert-info">Chua co hinh anh nao.</div>';
			}
		}
	}
	// Nguoc lai chua dang nhap
	else {
		new Redirect($_DOMAIN); // Tro ve trang index
	}
?>