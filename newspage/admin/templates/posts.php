<?php
	// Neu dang nhap
	if ($user) {
		echo '<h3>Bai viet</h3>';
		// lay tham so ac
		if (isset($_GET['ac'])) {
			$ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
		} else {
			$ac = '';
		}

		// Lay tham so id
		if (isset($_GET['id'])) {
			$id = trim(addslashes(htmlspecialchars($_GET['id'])));
		} else {
			$id = '';
		}

		// Neu co tham so ac
		if ($ac != '') {
			// Trang them bai viet
			if ($ac == 'add') {
				// Day nut them bai viet
				echo '
					<a href="'.$_DOMAIN.'posts" class="btn btn-default">
						<span class="glyphicon glyphicon-arrow-left"></span> Tro ve
					</a>
				';

				// Content them bai viet
				echo '
					<p class="form-add-post">
						<form method="POST" id="formAddPost" onsubmit="return false;">
							<div class="form-group">
								<label>Tieu de bai viet</label>
								<input type="text" class="form-control title" id="title_add_post">
							</div>
							<div class="form-group">
								<label>URL Chuyen muc</label>
								<input type="text" class="form-control slug" placeholder="Nhap vao de tu tao" id="slug_add_post">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Tao</button>
							</div>
							<div class="alert alert-danger hidden"></div>
						</form>
					</p>
				';
			}
			// Trang chinh sua bai viet
			else if ($ac == 'edit') {
				$sql_check_id_cate = "SELECT id_post, author_id FROM posts WHERE id_post = '$id' ";
				// Neu ton tai tham so id trong table
				if ($db->num_rows($sql_check_id_cate)) {
					$data_post = $db->fetch_assoc($sql_check_id_cate, 1);

					if ($data_post['author_id'] == $data_user['id_acc'] || $data_user['']) {
						// Day nut cua chinh sua bai viet
						echo '
							<a href="'.$_DOMAIN.'posts" class="btn btn-default">
								<span class="glyphicon glyphicon-arrow-left"></span> Tro ve
							</a>
							<a class="btn btn-danger" id="del-post" data-id="'.$id.'">
								<span class="glyphicon glyphicon-trash"></span> Xoa
							</a>
						';

						// Content chinh sua bai viet
						$sql_get_data_post = "SELECT * FROM posts WHERE id_post = '$id' ";
						$data_post = $db->fetch_assoc($sql_get_data_post, 1);

						echo '
							<p class="form-edit-post">
							  <form method="POST" id="formEditPost" data-id="'.$id.'" onsubmit="return false;">
								  <div class="form-group">
									  <label>Trang thai bai viet</label>
						';

						// Trang thai bai viet
						// Neu da xuat ban
						if ($data_post['status'] == '1') {
							echo '
								<div class="radio">
								  <label>
									  <input type="radio" name="stt_edit_post" value="1" checked > Xuat ban
									</label>
								</div>
								<div class="radio">
								  <label>
									  <input type="radio" name="stt_edit_post" value="1"> An
									</label>
								</div>
							';

							// Neu dang an
						} else if ($data_post['status'] == '0') {
							echo '
								<div class="radio">
									<label>
									  <input type="radio" name="stt_edit_post" value="1"> Xuat ban
									</label>
								</div>
								<div class="radio">
									<label>
									  <input type="radio" name="stt_edit_post" value="0"> An
									</label>
								</div>
							';
						}

						echo '
							</div>
							<div class="form-group">
								<label>Tieu de bai viet</label>
								<input type="text" class="form-control title" value="'.$data_post['title'].'" id="title_edit_post">
							</div>
							<div class="form-group">
								<label>Slug bai viet</label>
								<input type="text" class="form-control slug" value="'.$data_post['slug'].'" id="slug_edit_post">
							</div>
							<div class="form-group">
								<label>Url Thumbnail</label>
								<input type="text" class="form-control" value="'.$data_post['url_thumb'].'" id="url_thumb_edit_post">
							</div>
							<div class="form-group">
								<label>Mo ta bai viet</label>
								<textarea id="desc_edit_post" class="form-control">'.$data_post['descr'].'</textarea>
							</div>
							<div class="form-group">
								<label>tu khoa bai viet</label>
								<input type="text" class="form-control" value="'.$data_post['keywords'].'" id="keywords_edit_post">
							</div>
							<div class="form-group cate_post_1">
								<label>Chuyen muc lon</label>
								<select class="form-control" id="cate_post_1">
						';

						// Tai chuyen muc lon bai viet
						$sql_get_cate_post_1 = "SELECT label, id_cate FROM categories WHERE type = '1' ";
						if ($db->num_rows($sql_get_cate_post_1)) {
							if ($data_post['cate_1_id'] == '0') {
								echo '<option value="">Vui long chon chuyen muc</option>';
							}
							foreach ($db->fetch_assoc($sql_get_cate_post_1, 0) as $key => $data_cate_1) {
								if ($data_cate_1['id_cate'] == $data_post['cate_1_id']) {
									echo '<option value="'.$data_cate_1['id_cate'].'" selected>'.$data_cate_1['label'].'</option>';
								} else {
									echo '<option value="'.$data_cate_1['id_cate'].'">'.$data_cate_1['label'].'</option>';
								}
							}
						} else {
							echo '<option value="">Chua co chuyen muc lon nao</option>';
						}

						echo '
								</select>
							</div>
							<div class="form-group cate_post_2">
								<label>Chuyen muc vua</label>
								<select class="from-control" id="cate_post_2">
						';

						// Tai chuyen muc vua bai viet
						$sql_get_cate_post_2 = "SELECT label, id_cate FROM categories WHERE type = '2' AND parent_id = '$data_post[cate_1_id]' ";
						if ($db->num_rows($sql_get_cate_post_2)) {
							if ($data_post['cate_2_id'] == '0') {
								echo '<option value>Vui long chon chuyen muc</option>';
							}
							foreach ($eb->fetch_assoc($sql_get_cate_post_2, 0) as $key => $data_cate_2) {
								if ($data_cate_2['id_cate'] == $data_post['cate_2_id']) {
									echo '<option value="'.$data_cate_2['id_cate'].'" selected>'.$data_cate_2['label'].'</option>';
								} else {
									echo '<option value="'.$data_cate_2['id_cate'].'">'.$data_cate_2['label'].'</option>';
								}
							}
						} else {
							echo '<option value="">Chua co chuyen muc vua nao</option>';
						}

						echo '
								</select>
							</div>
							<div class="form-group cate_post_3">
								<label>Chuyen muc nho</label>
								<select class="form-control" id="cate_post_3"></select>
						';

						// Tai chuyen muc vua bai viet
						$sql_get_cate_post_3 = "SELECT label, id_cate FROM categories WHERE type = '3' AND parent_id = '$data_post[cate_2_id]' ";
						if ($db->num_rows($sql_get_cate_post_3)) {
							if ($data_post['cate_3_id'] == '0') {
								echo '<option value="">Vui long chon chuyen muc</option>';
							}
							foreach ($db->fetch_assoc($sql_get_cate_post_3) as $key => $data_cate_3) {
								if ($data_cate_3['id_cate'] == $data_post['cate_3_id']) {
									echo '<option value="'.$data_cate_3['id_cate'].'" selected>'.$data_cate_3['label'].'</option>';
								} else {
									echo '<option value="'.$data_cate_3['id_cate'].'">'.$data_cate_3['label'].'</option>';
								}
							}
						} else {
							echo '<option value="">Chua co chuyen muc nho nao</option>';
						}

						echo '
										</select>
									</div>
									<div class="form-group">
										<label>Nou dung bai viet</label>
										<textarea id="body_edit_post" class="form-control">'.$data_post['body'].'</textarea>
									</div>
									<div>
										<button type="submit" class="btn btn-primary">Luu thay doi</button>
									</div>
									<div class="alert alert-danger hidden"><div>
								</form>
							</p>
						';
					} else {
						echo '<div class="alert alert-danger">ID bai viet khong thuoc quyen so huu cua ban.</div>';
					}
				} else {
					// hien thi thong bao loi
					echo '
						<div class="alert alert-danger">Id bai viet da xoa hoac khong ton tai</div>
					';
				}
			}
		}
		// Nguoc lai khong co tham so ac
		// Trang danh sach bai viet
		else {
			// Day nut cua danh sach bai viet
			echo '
				<a href="'.$_DOMAIN.'posts/add" class="btn btn-default">
					<span class="glyphicon glyphicon-plus"></span> Them
				</a>
				<a href="'.$_DOMAIN.'posts" class="btn btn-default">
					<span class="glyphicon glyphicon-repeat"></span> Reload
				</a>
				<a class="btn btn-danger" id="del_post_list">
					<span class="glyphicon glyphicon-trash"></span> Xoa
				</a>
			';

			// Content danh sach bai viet

			// Nếu là admin thì lấy toàn bộ bài viết
			if ($data_user['position'] == '1') {
			    $sql_get_list_post = "SELECT * FROM posts ORDER BY id_post DESC";
			// Nếu là tác giả thì chỉ lấy những bài thuộc sở hữu
			} else {
			    $sql_get_list_post = "SELECT * FROM posts WHERE author_id = '$data_user[id_acc]' ORDER BY id_post DESC";
			}
			// Nếu có bài viết
			if ($db->num_rows($sql_get_list_post))
			{
			    // Lấy số trang
			    if (isset($_GET['page'])) {
			        $current_page = trim(htmlspecialchars(addslashes($_GET['page'])));
			    } else {
			        $current_page = '1';
			    }

			    $limit = 10; // Giới hạn số bài viết trong 1 trang
			    $total_page = ceil($db->num_rows($sql_get_list_post) / $limit); // Tổng trang
			    $start = ($current_page - 1) * $limit; // Vị trí bắt đầu lấy trang

			    // Nếu số trang hiện tại > tổng trang
			    if (($current_page > $total_page) && $time < 1) {
			        new Redirect($_DOMAIN . 'posts?page=' . $total_page); // Tới số trang lớn nhất
			    // Nếu số trang hiện tại < 1
			    } else if ($current_page < 1 && $time < 1){
			        new Redirect($_DOMAIN . 'posts?page=1'); // Tới trang đầu tiên
			    }

			    // Form tìm kiếm
			    echo
			    '
			        <p>
			            <form method="POST" id="formSearchPost" onsubmit="return false;">
			                <div class="input-group">
			                    <input type="text" class="form-control" id="kw_search_post" placeholder="Nhập ID, tiêu đề, slug ...">
			                    <span class="input-group-btn">
			                        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			                    </span>
			                </div>
			            </form>
			        </p>
			    ';

			    echo
			    '
			        <div class="table-responsive" id="list_post">
			            <table class="table table-striped list">
			                <tr>
			                    <td><input type="checkbox"></td>
			                    <td><strong>ID</strong></td>
			                    <td><strong>Tiêu đề</strong></td>
			                    <td><strong>Trạng thái</strong></td>
			                    <td><strong>Chuyên mục</strong></td>
			                    <td><strong>Lượt xem</strong></td>
			    ';

			    // Nếu tài khoản là admin
			    if ($data_user['position'] == '1') {
			        echo '<td><strong>Tác giả</strong></td>';
			    }

			    echo '
			                    <td><strong>Tools</strong></td>
			                </tr>
			    ';


			    // Nếu là admin thì lấy toàn bộ bài viết
			    if ($data_user['position'] == '1') {
			        $sql_get_list_post_limit = "SELECT * FROM posts ORDER BY id_post DESC LIMIT $start, $limit";
			    // Nếu là tác giả thì chỉ lấy những bài thuộc sở hữu
			    } else {
			        $sql_get_list_post_limit = "SELECT * FROM posts WHERE author_id = '$data_user[id_acc]' ORDER BY id_post DESC LIMIT $start, $limit";
			    }
			    // In danh sách bài viết
			    foreach ($db->fetch_assoc($sql_get_list_post_limit, 0) as $key => $data_post)
			    {
			        // Trạng thái bài viết
			        if ($data_post['status'] == 0) {
			            $stt_post = '<label class="label label-warning">Ẩn</label>';
			        } else if ($data_post['status'] == 1) {
			            $stt_post = '<label class="label label-success">Xuấn bản</label>';
			        }

			        // Chuyên mục bài viết
			        $cate_post = '';
			        $sql_check_id_cate_1 = "SELECT label, id_cate FROM categories WHERE id_cate = '$data_post[cate_1_id]' AND type = '1'";
							if ($db->num_rows($sql_check_id_cate_1)) {
			            $data_cate_1 = $db->fetch_assoc($sql_check_id_cate_1, 1);
			            $cate_post .= $data_cate_1['label'];
			        } else {
			            $cate_post .= '<span class="text-danger">Lỗi</span>';
			        }

			        $sql_check_id_cate_2 = "SELECT label, id_cate FROM categories WHERE id_cate = '$data_post[cate_2_id]' AND type = '2'";
			        if ($db->num_rows($sql_check_id_cate_2)) {
			            $data_cate_2 = $db->fetch_assoc($sql_check_id_cate_2, 1);
			            $cate_post .= ', ' . $data_cate_2['label'];
			        } else {
			            $cate_post .= ', <span class="text-danger">Lỗi</span>';
			        }

			        $sql_check_id_cate_3 = "SELECT label, id_cate FROM categories WHERE id_cate = '$data_post[cate_3_id]' AND type = '3'";
			        if ($db->num_rows($sql_check_id_cate_3)) {
			            $data_cate_3 = $db->fetch_assoc($sql_check_id_cate_3, 1);
			            $cate_post .= ', ' . $data_cate_3['label'];
			        } else {
			            $cate_post .= ', <span class="text-danger">Lỗi</span>';
			        }

			        // Tác giả bài viết
			        $sql_get_author = "SELECT display_name FROM accounts WHERE id_acc = '$data_post[author_id]'";
			        if ($db->num_rows($sql_get_author)) {
			            $data_author = $db->fetch_assoc($sql_get_author, 1);
			            $author_post = $data_author['display_name'];
			        } else {
			            $author_post = '<span class="text-danger">Lỗi</span>';
			        }

			        echo
			        '
			            <tr>
			                <td><input type="checkbox" name="id_post[]" value="' . $data_post['id_post'] .'"></td>
			                <td>' . $data_post['id_post'] . '</td>
			                <td style="width: 30%;"><a href="' . $_DOMAIN . 'posts/edit/' . $data_post['id_post'] . '">' . $data_post['title'] . '</a></td>
			                <td>' . $stt_post . '</td>
			                <td>' . $cate_post . '</td>
			                <td>' . $data_post['view'] . '</td>
			        ';

			        // Tác giả bài viết
			        if ($data_user['position'] == '1') {
			            echo '<td>' . $author_post . '</td>';
			        }

			        echo '
			                <td>
			                    <a href="' . $_DOMAIN . 'posts/edit/' . $data_post['id_post'] .'" class="btn btn-primary btn-sm">
			                        <span class="glyphicon glyphicon-edit"></span>
			                    </a>
			                    <a class="btn btn-danger btn-sm del-post-list" data-id="' . $data_post['id_post'] . '">
			                        <span class="glyphicon glyphicon-trash"></span>
			                    </a>
			                </td>
			            </tr>
			        ';
			    }

			    echo
			    '
			            </table>
			    ';

			    // Nút phân trang
			    echo '<div class="btn-group" id="paging_post"> So trang: <br>';
			    // Nếu trang hiện tại > 1 và tổng trang > 1 thì hiển thị nút prev
			    if ($current_page > 1 && $total_page > 1){
			        echo '<a class="btn btn-default" href="' . $_DOMAIN . 'posts?page=' . ($current_page - 1) . '"><span class="glyphicon glyphicon-chevron-left"></span> Prev</a>';
			    }

			    // In số nút trang
			    for ($i = 1; $i <= $total_page; $i++){
			        // Nếu trùng với trang hiện tại thì active
			        if ($i == $current_page){
			            echo '<a class="btn btn-default active">' . $i . '</a>';
			        // Ngược lại
			        } else {
			            echo '<a class="btn btn-default" href="' . $_DOMAIN . 'posts?page=' . $i . '">' . $i . '</a>';
			        }
			    }

			    // Nếu trang hiện tại < tổng số trang > 1 thì hiển thị nút next
			    if ($current_page < $total_page && $total_page > 1){
			        echo '<a class="btn btn-default" href="' . $_DOMAIN . 'posts?page=' . ($current_page + 1) . '">Next <span class="glyphicon glyphicon-chevron-right"></span></a>';
			    }
			    echo '<br><br><br></div>';

			    echo '
			        </div>
			    ';
			}
			// Nếu không có bài viết
			else
			{
			    echo '<br><br><div class="alert alert-info">Chưa có bài viết nào.</div>';
			}

		}
	}
	// Nguoc lai chua dang nhap
	else {
		new Redirect($_DOMAIN); // Tro ve trang index
	}
?>
