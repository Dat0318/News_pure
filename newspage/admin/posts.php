<?php
	// ket noi database va thong tin chung
	require_once 'core/init.php';

	// Neu dang nhap
	if ($user) {
		//Neu ton tai POST action
		if (isset($_POST['action'])) {
			// Cu ly POST action
			$action = trim(addslashes(htmlspecialchars($_POST['action'])));
			// Them bai viet
			if ($action == 'add_post') {
				// xu ly cac gia tri
				$title_add_post = trim(addslashes(htmlspecialchars($_POST['title_add_post'])));
				$slug_add_post = trim(addslashes(htmlspecialchars($_POST['slug_add_post'])));

				// cac bien xu ly thong bao
				$show_alert = '<script>$("#formAddPost .alert").removeClass("hidden");</script>';
				$hide_alert = '<script>$("#formAddPost .alert").addClass("hidden");</script>';
				$success = '<script>$("#formAddPost .alert").attr("class", "alert alert success");</script>';

				// Neu cac gia tri rong
				if ($title_add_post == '' || $slug_add_post == '') {
					echo $show_alert.'Vui long dien day du thong tin';
				}
				// Nguoc lai
				else {
					// Kiem tra bai viet ton tai
					$sql_check_post_exist = "SELECT title, slug FROM posts WHERE title = '$title_add_post' OR slug = '$slug_add_post' ";
					// Neu bai viet ton tai
					if ($db->num_rows($sql_check_post_exist)) {
						echo $show_alert.'Bai viet co tieu de hoac slug da ton tai';
					} else {
						// Thuc thi them bai viet
						$sql_add_post = "INSERT INTO posts VALUES (
							'',
							'$title_add_post',
							'',
							'',
							'$slug_add_post',
							'',
							'',
							'',
							'',
							'',
							'$data_user[id_acc]',
							'0',
							'0',
							'$date_current'
						)";
						$db->query($sql_add_post);
						echo $show_alert.$success.'Them bai viet thanh cong.';
						$db->close(); // Giai phong
						new Redirect($_DOMAIN.'posts'); // Tro ve trang danh sach bai viet
					}
				}
			}

			// Tai chuyen muc trong chinh sua bai viet
			// Chuyen muc vua
			else if ($action = 'load_cate_2') {
				$parent_id = trim(htmlspecialchars(addslashes($_POST['parent_id'])));

				$sql_get_cate_2 = "SELECT id_cate, label FROM categories WHERE type='2' AND parent_id = '$parent_id' ";
				if ($db->num_rows($sql_get_cate_2)) {
					foreach ($db->fetch_assoc($sql_get_cate_2, 0) as $key => $data_cate_2) {
						echo '<option value="'.$data_cate_2['id_cate'].'">'.$data_cate_2['label'].'</option>';
					}
				} else {
					echo '<option value="">Chua co chuyen muc vua nao</option>';
				}
			}

			// Chuyen muc nho
			else if ($action == 'load_cate_3') {
				$parent_id = trim(htmlspecialchars(addslashes($_POST['parent_id'])));

				$sql_get_cate_3 = "SELECT id_cate, label FROM categories WHERE type = '3' AND parent_id = '$parent_id' ";
				if ($db->num_rows($sql_get_cate_3)) {
					foreach ($db->fetch_assoc($sql_get_cate_3, 0) as $key => $data_cate_3) {
						echo '<option value="'.$data_cate_3['id_cate'].'">'.$data_cate_3['label'].'</option>';
					}
				} else {
					echo '<option value="">Chua co chuyen muc nho nao</option>';
				}
			}

			// Chinh sua bai viet
			else if ($action == 'edit_post') {
				// Xu ly cac gia tri
				$id_post = trim(htmlspecialchars(addslashes($_POST['id_post'])));
				$stt_edit_post = trim(htmlspecialchars(addslashes($_POST['stt_edit_post'])));
				$slug_edit_post = trim(htmlspecialchars(addslashes($_POST['slug_edit_post'])));
				$url_thumb_edit_post = trim(htmlspecialchars(addslashes($_POST['url_thumb_edit_post'])));
				$desc_edit_post = trim(htmlspecialchars(addslashes($_POST['desc_edit_post'])));
				$keywords_edit_post = trim(htmlspecialchars(addslashes($_POST['keywords_edit_post'])));
				$cate_1_edit_post = trim(htmlspecialchars(addslashes($_POST['cate_1_edit_post'])));
				$cate_2_edit_post = trim(htmlspecialchars(addslashes($_POST['cate_2_edit_post'])));
				$cate_3_edit_post = trim(htmlspecialchars(addslashes($_POST['cate_3_edit_post'])));
				$body_edit_post = trim(htmlspecialchars(addslashes($_POST['body_edit_post'])));

				// Cac bien cu ly thong bao
				$show_alert = '<script>$("#formEditPost .alert").removeClass("hidde")</script>';
				$hide_alert = '<script>$("#formEditPost .alert").addClass("hidden")</script>';
				$success = '<script>$("#formEditPost .alert").attr("class", "alert alert-success")</script>';

				// Kiem tra ud bai viet
				$sql_check_id_post = "SELECT id_post FROM posts WHERE id_post = '$id_post' ";

				// Neu cac gia tri rong
				if ($stt_edit_post == '' || $title_edit_post == '' || $slug_edit_post == '' || $cate_1_edit_post == '' || $cate_2_edit_post == '' || $cate_3_edit_post == '' || $body_edit_post == '') {
					echo $show_alert.' Vui long dien day du thong tin.';
				} else if (!$db->num_rows($sql_check_id_post)) {
					echo $show_alert.' Da co loi xay ra, vui long thu lai sau.';
				}

				// Kiem tra url anh
				else if ($url_thumb_edit_post != '' && filter_var($url_thumb_edit_post, FILTER_VALIDATE_URL) === false ) {
						echo $show_alert.'Vui long nhap url thumbnail hop le';
				} else {
					// Sua bai viet
					$sql_edit_post = "UPDATE posts SET
					status = '$stt_edit_post',
					title = '$title_edit_post',
					slug = '$slug_edit_post',
					url_thumb = '$url_thumb_edit_post',
					descr = '$desc_edit_post',
					keywords = '$keywords_edit_post',
					cate_1_id = '$cate_1_edit_post',
					cate_2_id = '$cate_2_edit_post',
					cate_3_id = '$cate_3_edit_post',
					body = '$bosy_edit_post'
					WHERE id_post = '$id_post';
					";
					$db->query($sql_edit_post);
					$db->close();
					echo $show_alert.$success.'Chinh sua bai viet thanh cong.';
					new Redirect($_DOMAIN.'posts/edit/'.$id_post);
				}
			}
			// Xoa bai viet
			//Xoa nhieu bai viet cung luc
			else if ($action == 'delete_post_list') {
				foreach ($_POST['id_post'] as $key => $id_post) {
					$sql_check_id_post_exist - "SELECT id_post FROM posts WHERE id_post = $id_post";
					if ($db->num_rows($sql_check_id_post_exist)) {
						$sql_delete_post = "DELETE FROM posts WHERE id_post = '$id_post' ";
						$db->query($sql_delete_post);
					}
				}
				$db->close();
			}
			// Xoa 1 chuyen muc
			else if ($action == 'delete_post') {
				$id_post = trim(htmlspecialchars(addslashes($_POST['id_post'])));
				$sql_check_id_post_exist = "SELECT id_post FROM posts WHERE id_post = '$id_post' ";
				if ($db->num_rows($sql_check_id_post_exist)) {
					$sql_delete_post = "DELETE FROM posts WHERE id_post = '$id_post'";
					$db->query($sql_delete_post);
					$db->close();
				}
			}
			// Tim kiem bai viet
			else if ($action == 'search_post') {
				$kw_search_post = trim(htmlspecialchars(addslashes($_POST['kw_search_post'])));

				if ($kw_search_post != '') {
					$sql_search_post = "SELECT * FROM posts WHERE
					id_post LIKE '%$kw_search_post%' OR
					title LIKE '%$kw_search_post%' OR
					slug LIKE '%$kw_search_post%'
					ORDER BY id_post DESC
					";

					// Neu co ket qua
					if ($db->num_rows($sql_search_post)) {
						echo '
							<table class="table table-striped list">
								<tr>
									<td><input type="checkbox"></td>
									<td><strong>ID</strong></td>
									<td><strong>Tieu De</strong></td>
									<td><strong>Trang Thai</strong></td>
									<td><strong>Chuyen Muc</strong></td>
									<td><strong>Luot Xem</strong></td>
						';

						// Neu tai khoan la admin
						if ($data_user['position'] == '1') {
							echo '<td><strong>Tac Gia<strong><td>';
						}

						echo '
								<td><strong>Tool</strong></td>
							</tr>
						';

						// In danh sach ket qua bai viet
						foreach ($$db->fetch_assoc($sql_search_post, 0) as $key => $data_post) {
							// Trang thai bai viet
							if ($data_post['status'] == 0) {
								$stt_post = '<label class="label label-warning">An</label>';
							} else if ($data_post['status'] == 1) {
								$stt_post = '<label class="label label-success">Xuat ban</label>';
							}

							// Chuyen muc bai viet
							$cate_post = '';
							$sql_check_id_cate_1 = "SELECT label, id_cate FROM categories WHERE id_cate = '$data_post[cate_1_id]' AND type= '1'";
							if ($db->num_rows($sql_check_id_cate_1)) {
								$data_cate_1 = $db->fetch_assoc($sql_check_id_cate_1, 1);
								$cate_post .= $data_cate_1['label'];
							} else {
								$cate_post .= '<label class="text-danger">Loi</label>';
							}

							$sql_check_id_cate_2 = "SELECT label, id_cate FROM categories WHERE id_cate = '$data_post[cate_2_id]' AND type= '2'";
							if ($db->num_rows($sql_check_id_cate_2)) {
								$data_cate_2 = $db->fetch_assoc($sql_check_id_cate_2, 1);
								$cate_post .= $data_cate_2['label'];
							} else {
								$cate_post .= '<label class="text-danger">Loi</label>';
							}

							$sql_check_id_cate_3 = "SELECT label, id_cate FROM categories WHERE id_cate = '$data_post[cate_3_id]' AND type= '3'";
							if ($db->num_rows($sql_check_id_cate_3)) {
								$data_cate_3 = $db->fetch_assoc($sql_check_id_cate_3, 1);
								$cate_post .= $data_cate_3['label'];
							} else {
								$cate_post .= '<label class="text-danger">Loi</label>';
							}

							// Tac gia bai viet
							$sql_get_author = "SELECT display_name FROM accounts WHERE id_acc = '$data_post[author_id]' ";
							if ($db->num_rows($sql_get_author)) {
								$data_author = $db->fetch_assoc($sql_get_author, 1);$author_post = $data_author['display_name'];
							} else {
								$author_post = '<span class="text-danger">Loi</span>';
							}
							echo '
								<tr>
								  <td><input type="checkbox" name="id_post[]" value="'.$data_post['id_post'].'"></td>
									<td>'.$data_post['id_post'].'</td>
									<td style="width: 30%;"><a href="'.$_DOMAIN.'posts/edit/'.$data_post['id_post'].'">'.$data_post['title'].'</a></td>
									<td>'.$stt_post.'</td>
									<td>'.$cate_post.'</td>
									<td>'.$data_post['view'].'</td>
								</tr>
							';

							// tac gia bai viet
							if ($data_user['position'] == '1') {
								echo '<td>'.$author_post.'</td>';
							}

							echo '
									<td>
									  <a href="'.$_DOMAIN.'posts/edit/'.$data_post['id_post'].'" class="btn btn-primary btn-sm">
										  <span class="glyphicon glyphicon-edit"></span>
										</a>
										<a class="btn btn-danger btn-sm del-post-list" data-id="'.$data_post['id_post'].'">
											<span class="glyphicon glyphicon-trash"></span>
										</a>
									</td>
								</tr>
							';
						}
						echo '</table>';
					}
					// Nguoc lai co ket qua
					else {
						echo '<div class="alert alert-info">Khong tim thay ket qua nao cho tu khoa <strong>'.$kw_search_post.'</strong></div>';
					}
				}
			}
		}
		// Nguoc lai khong ton tai POST action
		else {
			new Redirect($_DOMAIN);
		}
	}
	// New khong dang nhap
	else {
		new Redirect($_DOMAIN);
	}
?>
