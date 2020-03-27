<?php 
	
	// Ket noi datbase va thong tin chung
	require_once 'core/init.php';

	// Neu dang nhap
	if ($user) {
		// Neu nhu co file upload
		if (isset($_FILES['img_avt'])) {
			$dir = "../upload/";
			$name_img = stripslashes($_FILES['img_avt']['name']);
			$source_img = $_FILES['img_avt']['tmp_name'];

			// Lay ngay thang nam hien tai
			$day_current = substr($date_current, 8, 2);
			$month_current = substr($date_current, 5, 2);
			$year_current = substr($date_current, 0, 4);

			//Tao folder nam hien tai
			if (!is_dir($dir.$year_current)) {
				mkdir($dir.$year_current.'/');
			}

			// Tao folder thang hien tai
			if (!is_dir($dir.$year_current.'/'.$month_current)) {
				mkdir($dir.$year_current.'/'.$month_current.'/');
			}

			// Tao folder ngay hien tai
			if (!is_dir($dir.$year_current.'/'.$month_current.'/'.$day_current)) {
				mkdir($dir.$year_current.'/'.$month_current.'/'.$day_current.'/');
			}

			$path_img = $dir.$year_current.'/'.$month_current.'/'.$day_current.'/'.$name_img; // Duong dan toi thu muc chua file
			move_uploaded_file($source_img, $path_img); //Upload file
			$url_img = substr($path_img, 3); // duong dan file
			// echo "url".$url_img;
			$sql_up_avt = "UPDATE accounts SET url_avatar = '$url_img' WHERE id_acc = '$data_user[id_acc]' ";
			$db->query($sql_up_avt);
			echo 'Upload thanh cong';
			$db->close();
			new Redirect($_DOMAIN.'profile');
		}
		// Neu ton tai POST action
		else if (isset($_POST['action'])) {
			$action = trim(htmlspecialchars(addslashes($_POST['action'])));

			// Xoa anh dai dien
			if ($action == 'delete_avt') {
				if (file_exists('../'.$data_user['url_avatar'])) {
					unlink('../'.$data_user['url_avatar']);
				}

				$sql_delete_avt = "UPDATE accounts SET url_avatar = '' WHERE id_acc = '$data_user[id_acc]' ";
				$db->query($sql_delete_avt);
				$db->close();
			}
			// Cap nhap cac thong tin
			else if ($action == 'update_info') {
				// Xu ly cac gia tri
				$dn_update = trim(htmlspecialchars(addslashes($_POST['dn_update'])));
				$email_update = trim(htmlspecialchars(addslashes($_POST['email_update'])));
				$fb_update = trim(htmlspecialchars(addslashes($_POST['fb_update'])));
				$gg_update = trim(htmlspecialchars(addslashes($_POST['gg_update'])));
				$tt_update = trim(htmlspecialchars(addslashes($_POST['tt_update'])));
				$phone_update = trim(htmlspecialchars(addslashes($_POST['phone_update'])));
				$desc_update = trim(htmlspecialchars(addslashes($_POST['desc_update'])));
				
				// Cac bien xu ly thong bao
				$show_alert = '<script>$("#formUpdateInfo .alert").removeClass("hidden");</script>';
				$hide_alert = '<script>$("#formUpdateInfo .alert").addClass("hidden");</script>';
				$success = '<script>$("#formUpdateInfo .alert").attr("class","alert alert-success");</script>';

				if ($dn_update && $email_update) {
					// Kiem tra ten hien thi
					if (strlen($dn_update) < 3 || strlen($dn_update) > 50) {
						echo $show_alert.'Ten hien thi phai nam trong khoang 3 den 50 ky tu.';
						// Kiem tra email
					} else if (filter_var($email_update, FILTER_VALIDATE_EMAIL) === FALSE) {
						echo $show_alert.'Email khong hop le.';
						// Kiem tra so dien thoai
					} else if ($phone_update && (strlen($phone_update) < 10 || strlen($phone_update) > 11 || preg_match('/^[0-9]+$/', $phone_update) == false)) {
						echo $show_alert.strlen($phone_update).'So dien thoai khong hop le.';
					} else {
						$sql_update_info = "UPDATE accounts SET 
							display_name = '$dn_update',
							email = '$email_update',
							facebook = '$fb_update',
							google = '$gg_update',
							twitter = '$tt_update',
							phone = '$phone_update',
							description = '$desc_update'
							WHERE id_acc = '$data_user[id_acc]'
						";
						$db->query($sql_update_info);
						echo $success.'Cap nhap thong tin thanh cong.';
						new Redirect($_DOMAIN.'profile');
					}
				} else {
					echo $show_alert.'Vui long dien day du thong tin.';
				}
			}
			// Doi mat khau
			else if ($action == 'change_pw') {
				echo "string";
				die();
				// xy ly cac gia tri
				$old_pw_change = md5($_POST['old_pw_change']);
				$new_pw_change = trim(htmlspecialchars(addslashes($_POST['new_pw_change'])));
				$re_new_pw_change = trim(htmlspecialchars(addslashes($_POST['re_new_pw_change'])));
				echo $old_pw_change;
				// Cac bien xu ly thong bao
				$show_alert = '<script>$("#formChangePw .alert").removeClass("hidden");</script>';
				$hide_alert = '<script>$("#formChangePw .alert").addClass("hidden");</script>';
				$success = '<script>$("#formChangePw .alert").attr("class", "alert alert-success");</script>';
				echo $old_pw_change." ".$new_pw_change." ".$re_new_pw_change;
				if ($old_pw_change && $new_pw_change && $re_new_pw_change) {
					// Kiem tra mat khau cu chinh xac
					if ($old_pw_change != $data_user['password']) {
						echo $show_alert.'Mat khau cu khong chinh xac.';
						// Kiem tra mat khau moi
					} else if (strlen($new_pw_change) < 6) {
						echo $show_alert.'mat khau moi qua ngan';
						// kiem tra mat khau moi phai trung voi mat khau moi nhap lai
					} else if ($new_pw_change != $re_new_pw_change) {
						echo $show_alert.'mat khau moi nhap lai khong khop.';
					} else {
						$new_pw_change = md5($new_pw_change);
						$sql_change_pw = "UPDATE accounts SET password = '$new_pw_change' WHERE id_acc = '$data_user[id_acc]' ";
						$db->query($sql_change_pw);
						echo $success.'Thay doi may khau thanh cong.';
						new Redirect($_DOMAIN.'profile');
					}
				} else {
					echo $show_alert.'Vui long dien day du thong tin.';
				}
			}
		} else {
			new Redirect($_DOMAIN);
		}
	}
	// Nguoc lai chua dang nhap
	else {
		new Redirect($_DOMAIN); //Tro ve trang index
	}
?>