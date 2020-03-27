<?php
	// Neu dang nhap
	if ($user) {
			// Neu tai khoan la tac gia
		if ($data_user['position'] == 0) {
			echo '
				<div class="alert alert-danger">Ban khong du tham quyen de vao trang nay.</div>
			';
		}
		// Nguoc lai tai khaon la admin
		else if ($data_user['position'] == 1) {
			echo '<h3>Chuyen muc</h3>';

			// Lay tham so ac
			if (isset($_GET['ac'])) {
				$ac =trim(addslashes(htmlspecialchars($_GET['ac'])));
			}
			else {
				$ac ='';
			}
			// Lay tham so id
			if (isset($_GET['id'])) {
				$id = trim(addslashes(htmlspecialchars($_GET['id'])));
			}
			else {
				$id ='';
			}
			// Neu co tham so ac
			if ($ac != '') {
				// Trang them chuyen muc
				if ($ac == 'add') {
					// Day nut cua them chuyen muc
					echo '
						<a href=" ' .$_DOMAIN. 'categories" class="btn btn-default">
							<span class="glyphicon-arrow-left glyphicon"></span> Tro ve
						</a>
					';
					// Content them chuyen muc

					echo '
						<p class="form-add-cate">
							<form method="POST" id="formAddCate" onsubmit="return false;">
								<div class="form-group">
									<label for="">Ten chuyen muc</label>
									<input type="text" class="form-control title" id="label_add_cate">
								</div>
								<div class="form-group">
									<label for="">URL Chuyen muc</label>
									<input type="text" class="form-control slug" placeholder="Nhap vao de tu tao" id="url_add_cate">
								</div>
								<div class="form-group">
									<label for="">Loai Chuyen muc</label>
									<div class="radio">
										<label for="">
											<input type="radio" name="type_add_cate" value="1" checked="" class="type-add-cate-1"> Lon
										</label>
									</div>
									<div class="radio">
										<label for="">
											<input type="radio" name="type_add_cate" value="2" class="type-add-cate-2"> Vua
										</label>
									</div>
									<div class="radio">
										<label for="">
											<input type="radio" name="type_add_cate" value="3" class="type-add-cate-3"> Nho
										</label>
									</div>
								</div>

								<div class="form-group hidden parent-add-cate">
									<label for="">Parent chuyen muc</label>
									<select id="parent_add_cate" class="form-control"></select>
								</div>
								<div class="form-group">
									<label for="">Sort Chuyen muc</label>
									<input type="text" class="form-control" id="sort_add_cate">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-default">Tao</button>
								</div>
								<div class="alert alert-danger hidden"></div>
							</form>
						</p>
					';
				}
				// Trang chinh sua chuyen muc 
				else if ($ac  == 'edit') {
					$sql_check_id_cate = "SELECT id_cate FROM categories WHERE  id_cate = '$id' ";
					// Neu ton tai tham so id trong table
					if ($db->num_rows($sql_check_id_cate)) {
						// Day nut chinh sua chuyen muc
						echo '
							<a href=" ' .$_DOMAIN. 'categories" class="btn btn-default">
								<span class="glyphicon-arrow-left glyphicon"></span> Tro ve
							</a>
							<a class="btn btn-default" id="del-cate" date-id=" ' .$id. ' " >
								<span class="glyphicon-trash glyphicon"></span> Xoa
							</a>
						';
						// Content chinh sua chuyen muc

						$sql_get_data_cate = "SELECT * FROM categories WHERE id_cate = '$id' ";
						if($db->num_rows($sql_get_data_cate)) {
							$data_cate = $db->fetch_assoc($sql_get_data_cate, 1);

							// Chinh sua chuyen muc
							$checked_type_1 = '';
							$checked_type_2 = '';
							$checked_type_3 = '';
							if ($data_cate['type'] == 1) {
								$checked_type_1 = 'checked';
								$parent_edit_cate .= '
									<div class="form-group parent-edit-cate">
										<label for="">Parnet chuyen muc</label>
										<select name="" id="parent_edit_cate" class="form-control">
								';
							}
							else if ($data_cate['type'] == 2){
								$checked_type_2 = 'checked';
								$parent_edit_cate .= 
								'
										<div class="form-group parent-edit-cate">
												<label>Parent chuyên mục</label>
												<select id="parent_edit_cate" class="form-control">
								';
								$sql_get_cate_parent = "SELECT * FROM categories WHERE type='1' ";
								if ($db->num_rows($sql_get_cate_parent)) {
									// In danh sach cac chuyen muc loai 1
									foreach ($db->fetch_assoc($sql_get_cate_parent, 0) as $key => $data_cate_parent) {
										if ($data_cate['parent_id'] == $data_cate_parent['id_cate']) {
											$parent_edit_cate .='<option value = "'.$data_cate_parent['id_cate'].'" selected>'.$data_cate_parent['label'].'</option>';
										}
										else {
											$parent_edit_cate .='<option value = "'.$data_cate_parent['id_cate'].'">'.$data_cate_parent['label'].'</option>';
										}
									}
								}
								else {
									echo '<option value="0">Hien chua co chuyen muc cha nao</option>';
								}
								$parent_edit_cate .= '
									</select>
								</div>
								';
							}
							else if ($data_cate['type'] == 3) {
								$checked_type_3 = 'checked';
								$parent_edit_cate .= '
								<div class="form-group parent-edit-cate">
									<label for="">Parent chuyen muc</label>
									<select name="" id="parent_edit_cate" class="form-control">
								';
								$sql_get_cate_parent = "SELECT * FROM categories WHERE type ='2'";
								if ($db->num_row($sql_get_cate_parent)) {
									// In danh sach loai 2
									foreach ($db->fetch_assoc($sql_get_cate_parent, 0) as $key => $data_cate_parent) {
										if ($data_cate['parent_id'] == $data_cate_parent['id_cate']) {
											$parent_edit_cate .= '<option value="'.$data_cate_parent['id_cate'].'"selected>'.$data_cate_parent['label'].'</option>';
										}
										else {
											$parent_edit_cate .= '<option value="'.$data_care_parent['id-cate'].'">'.$data_cate_parent['label'].'</option>';
										}
									}
								}
								else {
									echo '<option value="0">Hien chua co muc cha nao</option>';
								}
								$parent_edit_cate .= '
										</select>
									</div>
								'; 
							}
							echo '
								<p class="form-edit-cate">
									<form id="formEditCate" method="POST" data-id="'.$data_cate['id_cate'].'" onsubmit="return false;" class="form-cate">
										<div class="form-group">
											<label for="">Ten chuyen muc</label>
											<input type="text" class="form-control title" value="'.$data_cate['label'].'" id="label_eidt_cate">
										</div>
										<div class="form-group">
											<label for="">URL chuyen muc</label>
											<input type="text" class="form-control slug" value="'.$data_cate['url'].'" id="url_eidt_cate">
										</div>
										<div class="form-group">
											<label for="">Loai chuyen muc</label>
											<div class="radio">
												<label for="">
													<input type="radio" name="type_edit_cate" value="1" class="type-cate-1"'.$checked_type_1.'>Lon
												</label>
											</div>
											<div class="radio">
												<label for="">
													<input type="radio" name="type_edit_cate" value="2" class="type-cate-2"'.$checked_type_2.'>Vua
												</label>
											</div>
											<div class="radio">
												<label for="">
													<input type="radio" name="type_edit_cate" value="3" class="type-cate-3"'.$checked_type_3.'>Nho
												</label>
											</div>
										</div>
										<div>
											'.$parent_edit_cate.'
											<div class="form-group">
												<label for="">Sort Chuyen muc</label>
												<input type="text" class="fomr-control" value="'.$data_cate['sort'].'" id="sort_edit_cate">
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-primary">Luu thay doi</button>
											</div>
											<div class="alert alert-danger hidden"></div>
										</div>
									</form>
								</p>
							';
						}
					}
					else {
						// Hien thi thong bao loi
						echo '
							<div class="alert-danger alert">ID chuyen muc da bi xoa hoac khong ton tai</div>							
						';
					}
				}
			}
			// Nguoc lai khong co tham so ac
			// rTrang danh sach chuyen muc
			else {
				// Day nut cua danh sach chuyen muc
				echo '
					<a href=" ' .$_DOMAIN. 'categories/add" class="btn btn-default">
						<span class="glyphicon-plus glyphicon"></span> Them
					</a>
					<a href=" ' .$_DOMAIN. 'categories" class="btn btn-default">
						<span class="glyphicon-repeat glyphicon"></span> Reload
					</a>
					<a href=" ' .$_DOMAIN. 'categories/add" class="btn btn-default">
						<span class="glyphicon-trash glyphicon"></span> Xoa
					</a>
				';
				// Content danh sach chuyen muc
				$sql_get_list_cate = "SELECT * FROM categories ORDER BY id_cate DESC";
				// Neu co chuyen muc
				if ($db->num_rows($sql_get_list_cate)){
					echo '
					<br><br>
					<div class="table-responsive">
						<table class="table table-triped list" id="list_cate">
							<tr>
								<td><input type="checkbox"></td>
								<td><strong>ID</strong></td>
								<td><strong>Ten chuyen muc</strong></td>
								<td><strong>Loai</strong></td>
								<td><strong>Chuyen muc cha</strong></td>
								<td><strong>Sort</strong></td>
								<td><strong>Tools</strong></td>
							</tr>
					';
					// In danh sach chuyen muc
					foreach ($db->fetch_assoc($sql_get_list_cate, 0) as $key => $data_cate) {
						// Hien thi chuyen muc cha
						$sql_get_cate_parent = "SELECT * FROM categories WHERE id_cate = '$data_cate[parent_id]' ";
						if ($db -> num_rows($sql_get_cate_parent)) {
							$data_cate_parent = $db->fetch_assoc($sql_get_cate_parent, 1);
							if($data_cate_parent['type'] == '1' && $data_cate['type'] == '3') {
								$label_cate_parent = '<p class="text-danger">Loi</p>';
							}
							else if($data_cate_parent['type'] == '3' && $data_cate['type'] == '2') {
								$label_cate_parent = '<p class="text-danger">Loi</p>';
							}
							else if($data_cate_parent['type'] == '3' && $data_cate['type'] == '1') {
								$label_cate_parent = '<p class="text-danger">Loi</p>';
							} else {
								$label_cate_parent = $data_cate_parent['label'];
							}
						}
						else {
							$label_cate_parent = '';
						}
						// Hien thi loai chuyen muc
						if ($data_cate['type'] == 1) {
							$data_cate['type'] = 'Lon';
						} else if ($data_cate['type'] == 2) {
							$data_cate['type'] = 'Vua';
						} else if ($data_cate['type'] == 3) {
							$data_cate['type'] = 'Nho';
						}
						echo '
							<tr>
								<td><input type="checkbox" name="id_cate[]" value=" '.$data_cate['id_cate'].' "></td>
								<td>'.$data_cate['id_cate'].'</td>
								<td><a href="'.$_DOMAIN.'categories/edit/'.$data_cate['id_cate'].' ">'.$data_cate['label'].'</a></td>
								<td>'.$data_cate['type'].'</td>
								<td>'.$label_cate_parent.'</td>
								<td>'.$data_cate['sort'].'</td>
								<td>
									<a href="'.$_DOMAIN.'caregories/edit/'.$data_cate['id_cate'].' " class="btn btn-primary btn-sm">
										<span class="glyphicon-edit glyphicon"></span>
									</a>
									<a class="btn btn-danger btn-sm del-cate-list" data-id=" '.$data_cate['id_cate'].' ">
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</td>
							</tr>
						';
					}
					echo '
							</table>
						</div>
					';
				}
				// Neu khong co chuyen muc
				else {
					echo '<br><br><div class="alert alert-info">Chua co chuyen muc nao.</div>';
				}
			}
		}
	}
// Nguoc lai neu chua dang nhap
else {
	new Redirect($_DOMAIN); // tro ve trang index
}	

?>
