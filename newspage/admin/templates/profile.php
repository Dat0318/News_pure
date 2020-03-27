<?php 
	
	// Neu dang nhap
	if ($user) {
		// URL anh dai dien tai khoan
		if ($data_user['url_avatar'] == '') {
			$data_user['url_avatar'] = $_DOMAIN.'images/profile.png';
		} else {
			$data_user['url_avatar'] = str_replace('admin/','',$_DOMAIN).$data_user['url_avatar'];
		}

		// Form Upload anh dai dien
		echo '
			<h3>Ho so ca nhan</h3>
			<div class="panel panel-default">
				<div class="panel-body">
					<form action="'.$_DOMAIN.'profile.php" method="POST" onsubmit="return false;" id="formUpAvt" enctype="multipart/form-data">
						<div class="form-group box-current-img">
							<p><strong>Anh hien tai</strong></p>
							<img src="'.$data_user['url_avatar'].'" alt="Anh dai dien cua '.$data_user['display_name'].'" width="80" height="80">
						</div>
						<div class="alert alert-info">Vui long chom file anh co duoi .jpg, .png, .gif va co dung luong duoi 5MB.</div>
						<div class="form-group">
							<label>Chon hinh anh</label>
							<input type="file" class="form-control" id="img_avt" name="img_avt" onchange="preUpAvt();">
						</div>
						<div class="form-group box-pre-img hidden">
							<p><strong>Anh xem truoc</strong></p>
						</div>
						<div class="form-group hidden box-progress-bar">
							<div class="progress">
								<div class="progress-bar" role="progressbar"></div>
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-primary pull-left" type="submit">Upload</button>
							<a class="btn btn-danger pull-right" id="del_avt"><span class="glyphicon glyphicon-trash"></span> Xoa</a>
						</div>
						<div class="clearfix"></div>
						<div class="alert alert-danger hidden"></div>
					</form>
				</div>
			</div>
		';

		// Form cap nhap cac thong tin con lai

		echo '
			<div class="panel panel-default">
				<div class="panel-heading">Cap nhap thong tin</div>
				<div class="panel-body">
					<form method="POST" onsubmit="return false;" id="formUpdateInfo">
						<div class="form-group">
							<label>Ten hien thi:</label>
							<input type="text" class="form-control" id="dn_update" value="'.$data_user['display_name'].'">
						</div>
						<div class="form-group">
							<label>Email: *</label>
							<input type="text" class="form-control" id="email_update" value="'.$data_user['email'].'">
						</div>
						<div class="form-group">
							<label>URL facebook:</label>
							<input type="text" class="form-control" id="fb_update" value="'.$data_user['facebook'].'">
						</div>
						<div class="form-group">
							<label>URL google:</label>
							<input type="text" class="form-control" id="gg_update" value="'.$data_user['google'].'">
						</div>
						<div class="form-group">
							<label>URL twitter:</label>
							<input type="text" class="form-control" id="tt_update" value="'.$data_user['twitter'].'">
						</div>
						<div class="form-group">
							<label>So dien thoai</label>
							<input type="text" class="form-control" id="phone_update" value="'.$data_user['phone'].'">
						</div>
						<div class="form-group">
							<label>Gioi thieu</label>
							<textarea id="desc_update" class="form-control">'.$data_user['description'].'</textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Luu thay doi</button>
						</div>
						<div class="alert alert-danger hidden"></div>
					</form>
				</div>
			</div>
		';
		// Form doi mat khau

		echo '
			<div class="panel panel-default">
				<div class="panel-heading">Doi mat khau</div>
				<div class="panel-body">
					<form method="POST" id="formChangePw" onsubmit="return false;">
						<div class="form-group">
							<label>Mat khau cu</label>
							<input type="password" class="form-control" id="oldPwChange">
						</div>
						<div class="form-group">
							<label>Mat khau moi</label>
							<input type="password" class="form-control" id="onewPwChange">
						</div>
						<div class="form-group">
							<label>Nhap lai mat khau moi</label>
							<input type="password" class="form-control" id="reNewPwChange">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Luu thay doi</button>
						</div>
						<div class="alert alert-danger hidden"></div>
					</form>
				</div>
			</div>
		';
	}
	// Nguoc lai chua dang nhap
	else {
		new Redirect($_DOMAIN); // Tro ve trang index
	}
?>