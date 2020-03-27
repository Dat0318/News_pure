<?php 
	// Ket noi database va thong tin chung
	require_once 'core/init.php';

	// Neu dang nhap
	if ($user) {
		// Neu co file upload
		if (isset($_FILES['img_up'])) {
			foreach ($_FILES['img_up']['name'] as $name => $value) {
				$dir = "../upload/";
				$name_img = stripcslashes($_FILES['img_up']['name'][$name]);
				$source_img = $_FILES['img_up']['tmp_name'][$name];

				// Lay ngay thang nam hien tai
				$day_current = substr($date_current, 8, 2);
				$month_current = substr($date_current, 5, 2);
				$year_current = substr($date_current, 0, 4);

				if (!is_dir('../upload')){
					mkdir('../upload');
				}
				// Tao folder nam hien tai
				if (!is_dir($dir.$year_current)) {
					mkdir($dir.$year_current.'/');
				}
				// Tao folder thang hien tai
				if (!is_dir($dir.$year_current.'/'.$month_current)) {
					mkdir($dir.$year_current.'/'.$month_current.'/');
				}
				// Tao folder ngay hien tai
				if (!is_dir($dir.$year_current.'/'.$month_current.''.$day_current)) {
					mkdir($dir.$year_current.'/'.$month_current.'/'.$day_current.'/');
				}

				$path_img = $dir.$year_current.'/'.$month_current.'/'.$day_current.'/'.$name_img; // duong dan thu muc chua file
				move_uploaded_file($source_img, $path_img); //Upload file
				$type_img = array_pop(explode("\.", $name_img)); // loai file
				$url_img = substr($path_img, 3); // duong dan file
				$size_img = $_FILES['img_up']['size'][$name]; // Dung luong file

				echo "string";
				echo "url for you".$url_img;
				// Them du lieu vao table
				$sql_up_file = "INSERT INTO images VALUES (
					'',
					'$url_img',
					'$type_img',
					'$size_img',
					'$data_current'
				)";
				$db->query($sql_up_file);
			}
			echo 'Upload thanh cong.';
			$db->close();
			new Redirect($_DOMAIN.'photos');
		}

		// Neu ton tai POST action
		if (isset($_POST['action'])) {
			$action = trim(addslashes(htmlspecialchars($_POST['action'])));

			// Xoa nhieu hinh anh
			if ($action == 'delete_img_list') {
				foreach ($_POST['id_img'] as $key => $id_img) {
					$sql_check_id_img_exist = "SELECT * FROM images WHERE id_img = '$id_img' ";
					if ($db->num_rows($sql_check_id_img_exist)) {
						$data_img = $db->fetch_assoc($sql_check_id_img_exist, 1);
						if (file_exists('../'.$data_img['url'])) {
							unlink('../'.$data_url['url']);
						}

						$sql_delete_img = "DELETE FROM images WHERE id_img = '$id_img' ";
						$db->query($sql_delete_img);
					}
				}
				$db->close();
			}
			
			// Xoa anh chi dinh
			else if ($action == 'delete_img') {
				$id_img = trim(htmlspecialchars(addslashes($_POST['id_img'])));
				$sql_check_id_img_exist = "SELECT * FROM images WHERE  id_img = '$id_img' ";
				if ($db->num_rows($sql_check_id_img_exist)) {
					$data_img = $db->fetch_assoc($sql_check_id_img_exist, 1);
					if (file_exists('../'.$data_img['url'])) {
						unlink('../'.$data_img['url']);
					}

					$sql_delete_img = "DELETE FROM images WHERE id_img = '$id_img' ";
					$db->query($sql_delete_img);
					$db->close();
				}
			}
		} else {
			new Redirect($_DOMAIN.'photos');
		}
	}
	// Nguoc lai chua dang nhap
	else {
		new Redirect($_DOMAIN); // Tro ve trang index
	}
?>
