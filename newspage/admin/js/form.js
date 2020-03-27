$_DOMAIN ='http://localhost/freetuts/PHP/Web_tin_tuc/newspage/admin/';

// Dang nhap
$('#formSignin button').on('click', function() {
	$this = $('#formSignin button');
	$this.html('Dang tai ...');

	// Gan cac gia trii trong cac bien
	$user_signin = $('#formSignin #user_signin').val();
	$pass_signin = $('#formSignin #pass_signin').val();
	console.log($user_signin);
	console.log($pass_signin);

	// Neu cac gia tri rong
	if ($user_signin == '' || $pass_signin == '') {
		$('#formSignin .alert').removeClass('hidden');
		$('#formSignin .alert').html('Vui long dien day du thong tin.');
		$this.html('Dang nhap');
	}
	// Nguoc lai
	else {
		$.ajax({
			url : $_DOMAIN + 'signin.php',
			type : 'POST',
			data : {
				user_signin : $user_signin,
				pass_signin : $pass_signin,
 			}, success : function (data) {
 				$('#formSignin .alert').removeClass('hidden');
 				$('#formSignin .alert').html(data);
 			}, error : function() {
 				$('#formSignin .alert').removeClass('hidden');
 				$('#formsignin .alert').html('Khong the dang nhap vao luc nay, hay thu lai sau');
 				$this.html('Dang nhap');
 			}
		});
	}
});

// Tu dong tao slug
function ChangeToSlug() {
  var title, slug;
  title = $('.title').val();
  slug = title.toLowerCase();
  slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
  slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
  slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
  slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
  slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
  slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
  slug = slug.replace(/đ/gi, 'd');
  slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
  slug = slug.replace(/ /gi, "-");
  slug = slug.replace(/\-\-\-\-\-/gi, '-');
  slug = slug.replace(/\-\-\-\-/gi, '-');
  slug = slug.replace(/\-\-\-/gi, '-');
  slug = slug.replace(/\-\-/gi, '-');
  slug = '@' + slug + '@';
  slug = slug.replace(/\@\-|\-\@|\@/gi, '');
  $('.slug').val(slug);
}

$('slug').on('click', function() {
	ChangeToSlug();
});

// Tai chuc nang chuyen muc cha o chuc nang them chuyen muc
$('#formAddCate input[type="radio"]').on('click', function() {
	if ($('#formAddCate .type-add-cate-1:checked').prop("checked") == true) {
		$('.parent-add-cate').addClass('hidden');
		$('.parent-add-cate select').html('');
	}
	else if ($('#formAddCate .type-add-cate-2:checked').prop("checked") == true) {
		// console.log($_DOMAIN+ 'categories.php');
		$type_add_cate = $('#formAddCate .type-add-cate-2').val();

		$.ajax({
			type : 'POST',
			url : $_DOMAIN + 'categories.php',
			data : {
				action : 'load_add_parent_cate',
				type_add_cate : $type_add_cate
			}, success : function(data) {
				$('.parent-add-cate').removeClass('hidden');
				$('.parent-add-cate select').html(data);
			}, error : function() {
				$('.parent-add-cate').removeClass('hidden');
				$('.parent-add-cate').html('Da co loi xay ra, hay thu lai sau.');
			}
		});
	}
	else if ($('#formAddCate .type-add-cate-3:checked').prop("checked") == true) {
		$type_add_cate = $('#formAddCate .type-add-cate-3').val();
		$.ajax({
			type: 'POST',
			url : $_DOMAIN + 'categories.php',
			data : {
				action : 'load_add_parent_cate',
				type_add_cate : $type_add_cate
			}, success : function(data) {
				$('.parent-add-cate').removeClass('hidden');
				$('.parent-add-cate select').html(data)
			}, error : function() {
				$('.parent-add-cate').removeClass('hidden');
				$('.parent-add-cate').html('Da co loi xay ra, hay thu lai sau.');
			}
		});
	}
});

// Them chuyen muc
$('#formAddCate button').on('click', function() {
	$this = $('#formAddCate button');
	$this.html('Dang tai ...');

	// Gan cac gia tri trong bien
	$label_add_cate = $('#formAddCate #label_add_cate').val();
	$url_add_cate = $('#formAddCate #url_add_cate').val();
	$type_add_cate = $('#formAddCate input[name="type_add_cate"]:radio:checked').val();
	$parent_add_cate = $('#formAddCate #parent_add_cate').val();
	$sort_add_cate = $('#formAddCate #sort_add_cate').val();
	// console.log($label_add_cate);
	// console.log($url_add_cate);
	// console.log($type_add_cate);
	// console.log($parent_add_cate);
	// console.log($sort_add_cate);

	// Neu cac gia tri rong
	if ($label_add_cate == '' || $url_add_cate == '' || $type_add_cate == '' || $sort_add_cate == '' ) {
		$('#formAddCate .alert').removeClass('hidden');
		$('#formAddCate .alert').html('Vui long dien day du thong tin.');
	}
	// Nguoc lai
	else {
		$.ajax({
			url :  $_DOMAIN + 'categories.php',
			type : 'POST',
			data : {
				label_add_cate : $label_add_cate,
				url_add_cate : $url_add_cate,
				type_add_cate : $type_add_cate,
				parent_add_cate : $parent_add_cate,
				sort_add_cate : $sort_add_cate,
				action : 'add_cate'
			}, success: function(data) {
				$('#formAddCate .alert').removeClass('hidden');
				$('#formAddCate .alert').html(data);
				$this.html('Tao');
			}, error  :function() {
				$('#formAddCate .alert').removeClass('hidden');
				$('#formAddCate .alert').html('Khong the tao chuyen muc vao luc nay, hay thu lai sau.');
				$this.html('Tao');
			}
		});
	}
});

// Tải chuyên mục cha ở chức năng chỉnh sửa chuyên mục
$('#formEditCate input[type="radio"]').on('click', function() {
	$id_edit_cate = $('#formEditCate').attr('data-id');
	if ($('#formEditCate .type-edit-cate-1:checked').prop("checked") == true)
	{
			$('.parent-edit-cate').addClass('hidden');
			$('.parent-edit-cate select').html('');
	}
	else if ($('#formEditCate .type-edit-cate-2:checked').prop("checked") == true)
	{
			$type_edit_cate = $('#formEditCate .type-edit-cate-2').val();

			$.ajax({
					type : 'POST',
					url : $_DOMAIN + 'categories.php',
					data : {
							action : 'load_edit_parent_cate',
							type_edit_cate : $type_edit_cate,
							id_edit_cate : $id_edit_cate
					}, success : function(data) {
							$('.parent-edit-cate').removeClass('hidden');
							$('.parent-edit-cate select').html(data);
					}, error : function() {
							$('.parent-edit-cate').removeClass('hidden');
							$('.parent-edit-cate').html('Đã có lỗi xảy ra, hãy thử lại sau.');
					}
			});
	}
	else if ($('#formEditCate .type-edit-cate-3:checked').prop("checked") == true)
	{
			$type_edit_cate = $('#formEditCate .type-edit-cate-3').val();
			$.ajax({
					type : 'POST',
					url : $_DOMAIN + 'categories.php',
					data : {
							action : 'load_edit_parent_cate',
							type_edit_cate : $type_edit_cate,
							id_edit_cate : $id_edit_cate
					}, success : function(data) {
							$('.parent-edit-cate').removeClass('hidden');
							$('.parent-edit-cate select').html(data);
					}, error : function() {
							$('.parent-edit-cate').removeClass('hidden');
							$('.parent-edit-cate').html('Đã có lỗi xảy ra, hãy thử lại sau.');
					}
			});
	}
});

// Chinh sua chuyen muc
$('#formEditCate button').on('click', function() {
	$(this) = $('#formEditCate button');
	$(this).html('Dang tai ...');

	// gan cac gia tri trong cac bien
	$label_edit_cate = $('#formEditCate #label_edit_cate').val();
	$url_edit_cate = $('#formEditCate #url_edit_cate').val();
	$type_edit_cate = $('#formEditCate input[name="type_edit_cate"]:radio:checked').val();
	$parent_edit_cate = $('#formEditCate #parent_edit_cate').val();
	$sort_edit_cate = $('#formEditCate #sort_edit_cate').val();
	$id_edit_cate = $('#formEditCate').attr('data-id');

	// Neu cac gia tri rong
	if ($label_edit_cate == '' || $url_edit_cate == '' || $type_edit_cate == '' || $parent_edit_cate == '' || $sort_edit_cate == '') {
		$('#formEditCate .alert').removeClass('hidden');
		$('#formEditCate .alert').html('Vui long dien day du thong tin');
		$this.html('Luu Thay doi');
		// $(this).html('Luu Thay doi');
	}
	// Nguoc lai
	else {
		$.ajax({
			url : $_DOMAIN + 'categories.php',
			type: 'POST',
			data : {
				label_edit_cate : $label_edit_cate,
				url_edit_cate : $url_edit_cate,
				type_edit_cate : $type_edit_cate,
				parent_edit_cate : $parent_edit_cate,
				sort_edit_cate : $sort_edit_cate,
				id_edit_cate : $id_edit_cate,
				action : 'edit_cate'
			}, success : function(data) {
				$('#formEditCate .alert').removeClass('hidden');
				$('#formEditCate .alert').html(data);
				$this.html('Luu thay doi');
			}, error : function() {
				$('#formEditCate .alert').removeClass('hidden');
				$('#formEditCate .alert').html(data);
				$this.html('Luu thay doi');
			}
		});
	}
});

// checkbox all
$('.list input[type="checkbox"]:eq(0)').change(function() {
	$('.list input[type="checkbox"]').prop('checked', $(this).prop("checked"));
});

// xoa nhieu chuyen muc cung mot luc
$("#del_cate_list").on('click', function() {
	$confirm = confirm('Ban co chac chan muon xoa cac chuyen muc da chon hay khong?');
	if ($confirm ==  true) {
		$id_cate = [];

		$('#list_cate input[$.type="checkbox"]:checkbox:checked').each(function(i) {
			$id_cate[i] = $(this).val();
		});

		if ($id_cate.length === 0) {
			alert('Vui long chon it nhat mot chuyen muc.');
		} else {
			$.ajax({
				url : $_DOMAIN + 'categories.php',
				type : 'POST',
				data : {
					id_cate : $id_cate,
					action : 'delete_cate_list'
				}, success : function( data ) {
					location.reload();
				}, error : function() {
					alert('Da co loi xay ra, hay thu lai!.');
				}
			});
		}
	} else {
		return false;
	}
});

// Xoa chuyen muc chi dinh trong bang danh sach
$('.del-cate-list').on('click', function() {
	$confirm = confirm('Ban co chac chan muon xoa chuyen muc nay khong?');
	if ($confirm == true) {
		$id_cate = $(this).attr('data-id');

		$.ajax({
			url : $_DOMAIN + 'categories.php',
			type : 'POST',
			data : {
				id_cate : $id_cate,
				action : 'delete_cate'
			}, success : function() {
				location.reload();
			}
		});
	} else {
		return false;
	}
});

// Xoa chuyen muc chi dinh trong trang chinh sua
$('#del_cate').on('click', function() {
	$confirm = confirm('Ban co chac muon xoa chuyen muc nay khong?');
	if ($confirm == true) {
		$id_cate = $(this).attr('date-id');

		$.ajax({
			url : $_DOMAIN + 'categories.php',
			type : 'POST',
			data : {
				id_cate : $id_cate,
				action : 'delete_cate'
			}, success : function() {
				location.href = $_DOMAIN + 'categories/';
			}
		});
	} else {
		return false;
	}
});

// Xem anh truoc khi upload
function preUpImg() {
	img_up = $('#img_up').val();
	cont_img_up = $('#img_up').val();
	count_img_up = $('#img_up').get(0).files.length;
	$('#formUpImg .box-pre-img').html('<p><strong>Anh xem truoc</strong></p>');
	$('#formUpImg .box-pre-img').removeClass('hidden');

	// Neu da chon hinh anh
	if (img_up != '') {
		$('#formUpImg .box-pre-img').html('<p><strong>Anh xem truoc</strong></p>');
		$('#formUpImg .box-pre-img').removeClass('hidden');
		for (var i = 0; i <= count_img_up - 1; i++) {
			$('#formUpImg .box-pre-img').append('<img src = "'+ URL.createObjectURL(event.target.files[i]) +'" style = "border:1px solid #ddd; width: 50px; height: 50px; margin-right:5px; margin-bottom:5px;"/>');
		}
	}
	// Nguoc lai chua chon anh
	else {
		$('#formUpImg .box-pre-img').html('');
		$('#formUpImg .box-pre-img').addClass('hidden');
	}
}

// Nut resret form hinh anh
$('#formUpImg button[type=reset]').on('click', function() {
	$('#formUpImg .box-pre-img').html('');
	$('#formUpImg .box-pre-img').addClass('hidden');
});

// Upload hinh anh
$('#formUpImg').submit(function(e) {
	img_up = $('#img_up').val();
	count_img_up = $('#img_up').get(0).files.length;
	error_size_img = 0;
	error_type_img = 0;
	$('#formUpImg button[type=submit]').html('Dang tai ...');

	// Neu co anh duoc chon
	if (img_up) {
		e.preventDefault();

		// Kiem tra dung luong anh
		for (var i = 0; i < count_img_up - 1; i++) {
			size_img_up = $('#img_up')[0].files[i].size;
			if (count_img_up > 5242880) {
				// 5242880 byte = 5MB
				error_size_img += 1; // loi
			} else {
				error_size_img += 0; // khong loi
			}
		}

		// Kiem tra dinh dang anh
		for (var i = 0; i < count_img_up - 1 ; i++) {
			type_img_up = $('#img_up')[0].files[i].type;
			if (type_img_up === 'image/jpeg' || type_img_up == 'image/png' || type_img_up == 'image/gif') {
				error_type_img += 0;
			} else {
				error_type_img += 1;
			}
		}

		// Neu loi ve size anh
		if (error_size_img >= 1) {
			$('#formUpImg button[type=submit]').html('Upload');
			$('#formUpImg .alert').removeClass('hidden');
			$('#formUpImg .alert').html('Mot trong cac tep da chon co dung luong lon hon muc cho phep');

			// Neu vuot qua 20 file
		} else if( count_img_up > 20) {
			$('#formUpImg button[type=submit]').html('Upload');
			$('#formUpImg .alert').removeClass('hidden');
			$('#formUpImg .alert').html('So file Upload cho moi lan vuot qua muc cho phep.');
		} else if( error_type_img >= 1) {
			$('#formUpImg button[type=submit]').html('Upload');
			$('#formUpImg .alert').removeClass('hidden');
			$('#formUpImg .alert').html('Mot trong nhung file anh khong dung dinh dang cho phep')
		} else {
			$(this).ajaxSubmit({
        beforeSubmit: function() {
          target:   '#formUpImg .alert',
          $("#formUpImg .box-progress-bar").removeClass('hidden');
          $("#formUpImg .progress-bar").width('0%');
        },
        uploadProgress: function (event, position, total, percentComplete){
          $("#formUpImg .progress-bar").animate({width: percentComplete + '%'});
          $("#formUpImg .progress-bar").html(percentComplete + '%');
        },
        success: function (data) {
          $('#formUpImg button[type=submit]').html('Upload');
          $('#formUpImg .alert').attr('class', 'alert alert-success');
          $('#formUpImg .alert').html(data);
        },
        error: function() {
          $('#formUpImg button[type=submit]').html('Upload');
          $('#formUpImg .alert').removeClass('hidden');
          $('#formUpImg .alert').html('Không thể upload hình ảnh vào lúc này, hãy thử lại sau.');
      	},
        resetForm: true
	    });
	    return false;
		}
		// Nguoc lai khong chon hinh anh
	} else {
		$("#formUpImg button[type=submit]").html('Upload');
		$("#formUpImg .alert").removeClass('hidden')
		$("#formUpImg .alert").html('Vui long chon tep hinh anh.');
	}
});

// Xoa nhieu hinh anh cung luc
$('#del_img_list').on('click', function() {
	$confirm = confirm('Ban co chac chan muon xoa cac hinh anh da chon khong?');
	if ($confirm == true) {
		$id_img = [];

		$('#list_img input[type="checkbox"]:check:checked').each(function(i) {
			$id_img[i] = $(this).val();
		});

		if ($id_img.length === 0) {
			alert('Vui long chon it nhat mot hinh anh.');
		} else {
			$.ajax({
				url : $_ + 'photos.php',
				type : 'POST',
				data : {
					id_img : $id_img,
					action : 'delete_img_list'
				}, success : function( data ) {
					location.reload();
				}, error : function() {
					alert('Da co loi xay ra, hay thu lai.');
				}
			});
		}
	} else {
		return false;
	}
});

// Xoa anh chi dinh
$('.del-img').on('click', function() {
	$confirm = confirm('Ban co chac muon xoa anh nay khong?');
	if ($confirm == true) {
		$id_img = $(this).attr('data-id');

		$.ajax({
			url : $_DOMAIN + 'photos.php',
			type : 'POST',
			data : {
				id_img : $id_img,
				action : 'delete_img'
			}, success : function() {
				location.reload();
			}
		});
	} else {
		return false;
	}
});

// Them bai viet
$('#formAddPost button').on('click', function() {
	$title_add_post = $('#title_add_post').val();
	$slug_add_post = $('#slug_add_post').val();

	if ( $title_add_post == '' || $slug_add_post == '') {
		$('#formAddPost .alert').removeClass('hidden');
		$('#formAddPost .alert').html('Vui long dien day du thong tin.');
	} else {
		$.ajax({
			url : $_DOMAIN + 'posts.php',
			type: 'POST',
			data : {
				title_add_post : $title_add_post,
				slug_add_post : $slug_add_post,
				action : 'add_post'
			}, success : function( data ) {
				$('#formAddPost .alert').html(data);
			}, error : function() {
				$('#formAddPost .alert').removeClass('hidden');
				$('#formAddPost .alert').html('Da co loi xay ra, hay thu lai sau');
			}
		});
	}
});

// Tim kiem bai viet
$('#formSearchPost button').on('click', function() {
	$kw_search_post = $('#kw_search_post').val();

	if ($kw_search_post != '') {
		$.ajax({
			url : $_DOMAIN + 'posts.php',
			type : 'POST',
			data : {
				kw_search_post : $kw_search_post,
				action : 'search_post'
			}, success : function( data ) {
				$('#list_post').html(data);
				$('#list_post').hide()
			}
		});
	}
});

// tai chuyen muc vua va nho trong chinh sua bai viet
$('#cate_post_1').on('change', function() {
	$parent_id = $(this).val();

	$.ajax({
		url : $_DOMAIN + "posts.php",
		type: 'POST',
		data : {
			parent_id : $parent_id,
			action : 'load_cate_2'
		}, success : function( data ) {
			$('#cate_post_2').html(data);

			// Sau khi tai xong chuyen muc vua se tai chuyen muc nho
			$parent_id = $('#cate_post_2').val();

			$.ajax({
				url : $_DOMAIN + 'posts.php',
				type: 'POST',
				data : {
					parent_id : $parent_id,
					action : 'load_cate_3'
				}, success : function( data ) {
					$('#cate_post_3').html( data );
				}
			});
		}
	});
});

// tai chuyen muc nho trong chinh sua bai viet
$('#cate_post_2').on('change', function() {
	$parent_id = $(this).val();

	$.ajax({
		url : $_DOMAIN + 'posts.php',
		type: 'POST',
		data : {
			parent_id : $parent_id,
			action : 'load_cate_3'
		}, success : function( data ) {
			$('#cate_post_3').html( data );
		}
	});
});

// Chinh sua bai viet
$('#formEditPost button').on('click', function() {
	$id_post = $('#formEditPost').attr('data-id');
	$stt_edit_post = $('#formEditPost input[name="stt_edit_post"]:radio:checked').val();
	$title_edit_post = $('#title_edit_post').val();
	$slug_edit_post = $('#slug_edit_post').val();
	$url_thumb_edit_post = $('#url_thumb_edit_post').val();
	$desc_edit_post = $('#desc_edit_post').val();
	$keywords_edit_post = $('#keywords_edit_post').val();
	$cate_1_edit_post = $('#cate_post_1').val();
	$cate_2_edit_post = $('#cate_post_2').val();
	$cate_3_edit_post = $('#cate_post_3').val();
	$body_edit_post = CKEDITOR.instances['body_edit_post'].getData();
// Note Error:  || $cate_2_edit_post == '' ||$cate_3_edit_post == ''
	if ($stt_edit_post == '' || $title_edit_post == '' || $slug_edit_post == '' || $cate_1_edit_post == '' || $cate_2_edit_post == '' ||$cate_3_edit_post == '' || $body_edit_post == '') {
		$('#formEditPost .alert').removeClass('hidden');
		$('#formEditPost .alert').html('Vui long dien day du thong tin');
	} else {
		$.ajax({
			url : $_DOMAIN + 'posts.php',
			type: 'POST',
			data : {
				$id_post : $id_post,
				stt_edit_post : $stt_edit_post,
				title_edit_post : $title_edit_post,
				slug_edit_post : $slug_edit_post,
				url_thumb_edit_post : $url_thumb_edit_post,
				keywords_edit_post: $keywords_edit_post,
				desc_edit_post : $desc_edit_post,
				cate_1_edit_post : $cate_1_edit_post,
				cate_2_edit_post : $cate_2_edit_post,
				cate_3_edit_post : $cate_3_edit_post,
				body_edit_post : $body_edit_post,
				action : 'edit_post'
			}, success : function( data ) {
				$('#formEditPost .alert').removeClass('hidden');
				$('#formEditPost .alert').html(data);
			}, error : function() {
				$('#formEditPost .alert').removeClass('hidden');
				$('#formEditPost .alert').html('Da co loi xay ra, hay thu lai sau.');
			}
		});
	}
});

// Xoa nhieubai viet cung luc
$('#del_post_list').on('click', function() {
	$confirm = confirm('Ban co chac muon xoa cac bai viet da chon khong?');

	if ($confirm == true) {
		$id_post = [];
		$('#list_post input[type="checkbox"]:checkbox:checked').each(function(i) {
			$id_post[i] = $(this).val();
		});

		if ($id_post.length == 0) {
			alert('Vui long chon it nhat mot bai viet.');
		} else {
			$.ajax({
				url : $_DOMAIN + 'posts.php',
				type: 'POST',
				data : {
					id_post : $id_post,
					action : 'delete_post_list'
				}, success : function( data ) {
					location.reload();
				}, error : function() {
					alert ('Da co loi xay ra, hay thu lai.');
				}
			});
		}
	} else {
		return false;
	}
});

// Xoa bai ciet chi dinh trong bang danh sach
$('.del-post-list').on('click', function() {
	$confirm = confirm('Ban co chac muon xoa bai viet nay khong?');

	if ($confirm == true) {
		$id_post = $(this).attr('data-id');

		$.ajax({
			url : $_DOMAIN + 'posts.php',
			type : 'POST',
			data : {
				id_post : $id_post,
				action : 'delete_post'
			}, success : function() {
				location.reload();
			}
		});
	} else {
		return false;
	}
});

// Xoa bai viet chi dinh trong trang chinh sua
$('#del_post').on('click', function() {
	$confirm = confirm('Ban co chac chan muon xoa bai viet nay khong?');
	if ($confirm == true) {
		$id_post = $(this).attr('data_id');

		$.ajax({
			url : $_DOMAIN + 'posts.php',
			type : 'POST',
			data : {
				id_post : $id_post,
				action : 'delete_post'
			}, success : function () {
				location.href = $_DOMAIN + 'posts/';
			}
		});
	} else {
		return false;
	}
});


// Trang thai website
$('#formStatusWeb button').on('click', function() {
	$stt_web = $('#formStatusWeb input[name="stt_web"]:radio:checked').val();

	$.ajax({
		url : $_DOMAIN + 'setting.php',
		type: 'POST',
		data : {
			stt_web : $stt_web,
			action : 'stt_web'
		}, success : function() {
			$('#formStatusWeb .alert').attr("class", "alert alert-success");
			$('#formStatusWeb .alert').html('Thay doi thanh cong');
		}, error : function() {
			$('#formStatusWeb .alert').removeClass('hidden');
			$('#formStatusWeb .alert').html('Da co loi xay ra, hay thu lai sau.');
		}
	});
});

// Chinh sua thong tin website
$('#formInfoWeb button').on('click', function() {
	$title_web = $('#title_web').val();
	$descr_web = $('#descr_web').val();
	$keywords_web = $('#keywords_web').val();

	$.ajax({
		url : $_DOMAIN + 'setting.php',
		type: 'POST',
		data : {
			title_web : $title_web,
			descr_web : $descr_web,
			keywords : $keywords_web,
			action : 'info_web'
		}, success : function() {
			$('#formInfoWeb .alert').attr('class', 'alert alert-success');
			$('#formInfoWeb .alert').html('Thay doi thanh cong.');
			location.reload();
		}, error : function() {
			$('#formInfoWeb .alert').removeClass('hidden');
			$('#formInfoWeb .alert').html('Da co loi xay ra hay thu lai.');
		}
	});
});

// Tham tai khoan
$('#formAddAcc button').on('click', function() {
	$un_add_acc = $('#un_add_acc').val();
	$pw_add_acc = $('#pw_add_acc').val();
	$repw_add_acc = $('#repw_add_acc').val();

	if ($un_add_acc == '' || $pw_add_acc == '' || $repw_add_acc == '') {
		$('#formAddAcc .alert').removeClass('hidden');
		$('#formAddAcc .alert').html('Vui long dien day du thong tin');
	} else {
		$.ajax({
			url : $_DOMAIN + 'accounts.php',
			type : 'POST',
			data : {
				un_add_acc : $un_add_acc,
				pw_add_acc : $pw_add_acc,
				repw_add_acc : $repw_add_acc,
				action : 'add_acc'
			}, success : function( data ) {
				$('#formAddAcc .alert').html(data);
			}, error : function() {
				$('#formAddAcc .alert').removeClass('hidden');
				$('#formAddAcc .alert').html('Da co loi xay ra, hay thu lai sau');
			}
		});
	}
});

// khoa nhieu tai khoan cung luc
$('#lock_acc_list').on('click', function() {
	$confirm = confirm('Ban co chac chan muon khoa cac tai khoan da chon hay khong?');
	if ($confirm == true) {
		$id_acc = [];

		$('#list_acc input[type="checkbox"]:checkbox:checked').each(function(i) {
			$id_acc[i] = $(this).val();
		});

		if ($id_acc.length === 0) {
			alert('Vui long chon it nhat mot tai khoan.');
		} else {
			$.ajax({
				url : $_DOMAIN + 'accounts.php',
				type: "POST",
				data : {
					id_acc : $id_acc,
					action : 'lock_acc_list'
				}, success : function(data) {
					location.reload();
				}, error : function() {
					alert('Da xay ra loi, hay thu lai.');
				}
			});
		}
	} else {
		return false;
	}
});

// Khoa tai khoa chi dinh trong bang danh sach
$('.lock-acc-list').on('click', function() {
	$confirm = confirm('Ban co chac muon xoa tai khoan nay khong?');
	if ($confirm == true) {
		$id_acc = $(this).attr('data-id');

		$.ajax({
			url : $_DOMAIN + 'accounts.php',
			type: "POST",
			data: {
				id_acc : $id_acc,
				action : 'lock_acc'
			}, success : function() {
				location.reload();
			}
		});
	}
});

// mo khoa nhieu tai khoan cung luc
$('#unlock_acc_list').on('click', function() {
	$confirm = confirm('Ban co chac muon mo khoa cac tai khoan da chon hay khong?');

	if ($confirm == true) {
		$id_acc = [];

		$('#list_acc input[type="checkbox"]:checkbox:checked').each(function(i) {
			$id_acc[i] = $(this).val();
		});

		if ($id_acc.length === 0) {
			alert('Vui long chon it nhat mot tai khoan.');
		} else {
			$.ajax({
				url : $_DOMAIN + 'accounts.php',
				type: 'POST',
				data : {
					id_acc : $id_acc,
					action : 'unlock_acc_list'
				}, success : function( data ) {
					location.reload();
				}, error : function() {
					alert('Da co loi xay ra, hay thu lai.');
				}
			});
		}
	} else {
		return false;
	}
});

// Mo tai khoan chi dinh trong bang dang sach
$('#unlock-acc-list').on('click', function() {
	$confirm = confirm('Ban co chac muon mo khoa tai khoan nay khong?');

	if ($confirm == true) {
		$id_acc = $(this).attr('data-id');

		$.ajax({
			url : $_DOMAIN + 'accounts.php',
			type: 'POST',
			data : {
				id_acc : $id_acc,
				action : 'unlock_acc'
			}, success : function() {
				location.reload();
			}
		});
	} else {
		return false;
	}
});

// Xoa nhieu tai khoan cung luc
$('#del_acc_list').on('click', function() {
	$confirm = confirm('Ban co chac muon xoa cac tai khoan da chon hay khong?');

	if ($confrim == true) {
		$id_acc = [];

		$('#list_acc input[type="checkbox"]:checkbox:checked').each(function(i) {
			$id_acc[i] = $(this).val();
		});

		if ($id_acc.length === 0 ) {
			alert('Vui long chon it nhat mot tai khoan');
		} else {
			$.ajax({
				url  : $_DOMAIN + 'accounts.php',
				type : 'POST',
				data :  {
					id_acc : $id_acc,
					action : 'del_acc_list'
				}, success : function(data) {
					location.reload();
				}, error : function() {
					alert('Da co loi xay ta, hay thu lai sau.');
				}
			});
		}
	} else {
		return false;
	}
});

//Xoa tai khoan chi dinh trong bang danh sach
$('.del-acc-list').on('click', function() {
	$confirm = confirm('Ban co chac chan muon xoa tai khoan nay hay khong?');

	if ($confirm == true) {
		$id_acc = $(this).attr('data-id');

		$.ajax({
			url  : $_DOMAIN + 'accounts.php',
			type : 'POST',
			data : {
				id_acc : $id_acc,
				action : 'del_acc'
			}, success : function() {
				location.reload();
			}
		});
	} else {
		return false;
	}
});

// Xem truoc anh khi upload
function preUpAvt() {
	console.log(111);
	img_avt = $('#img_avt').val();
	$('#formUpAvt .box-pre-img').html('<p><strong>Anh xem truoc</strong></p>');
	$('#formUpAvt .box-pre-img').removeClass('hidden');

	// Neu da chon anh
	if (img_avt != '') {
		$('#formUpAvt .box-pre-img').html('<p><strong>Anh xem truoc</strong></p>');
		$('#formUpAvt .box-pre-img').removeClass('hidden');
		$('#formUpAvt .box-pre-img').append('<img src="' + URL.createObjectURL(event.target.files[0]) + '" style="border: 1px solid #ddd; width: 50px; height: 50px; margin-right: 5px; margin-bottom; 5px;" />');
	}
	// Nguoc lai chua chon anh
	else {
		$('#formUpAvt .box-pre-img').html('');
		$('#formUpAvt .box-pre-img').addClass('hidden');
	}
}

// Upload anh dai dien
$('#formUpAvt').submit(function(e) {
	img_avt = $('#img_avt').val();
	$('#formUpAvt button[type=submit]').html('Dang Tai ...');

	// Neu cp chon anh
	if (img_avt) {
		size_img_avt = $('#img_avt')[0].files[0].size;
		type_img_avt = $('#img_avt')[0].files[0].type;

		e.preventDefault();
		// Neu loi ve size anh
		if (size_img_avt > 5242880) {
			// 5242880 byte = 5mb
			$('#formUpAvt button[type=submit]').html('Upload');
			$('#formUpAvt button[type=submit]').removeClass('hidden');
			$('#formUpAvt button[type=submit]').html('Tep da chon co dung luong lon hon muc cho phep.');
			// Neu loi ve dinh dang anh
		} else  if (type_img_avt != 'image/jpeg' && type_img_avt != 'image/png' && type_img_avt != 'image/gif') {
			$('#formUpAvt button[type=submit]').html('Upload');
			$('#formUpAvt button[type=submit]').removeClass('hidden');
			$('#formUpAvt button[type=submit]').html('File hinh anh khong dung dinh dang cho phep.');
		} else {
			$(this).ajaxSubmit({
				beforeSubmit : function() {
					target : '#formUpAvt .alert-danger',
					$('#formUpAvt .box-progress-bar').removeClass('hidden');
					$('#formUpAvt .box-progress-bar').width('0%');
				}, uploadProgress : function(event, position, total, percentComplete) {
					$('#formUpAvt .box-progress-bar').animate({width: percentComplete + '%'});
					$('#formUpAvt .box-progress-bar').html(percentComplete + '%');
				}, success : function( data ) {
					$('#formUpAvt button[type=submit]').html('Upload');
					$('#formUpAvt .alert-danger').attr('class', 'alert alert-success');
					$('#formUpAvt .alert-danger').html(data);
				}, error :function(){
					$('#formUpAvt button[type=submit]').html('Upload');
					$('#formUpAvt .alert-danger').removeClass('hidden');
					$('#formUpAvt .alert-danger').html('Khong the upload hinh anh vao luc nay');
				},
				resetForm: true
			});
			return false;
		}
		// Nguoc lai khong chon anh
	} else {
		$('#formUpAvt button[type=submit]').html('Upload');
		$('#formUpAvt .alert-danger').removeClass('hidden');
		$('#formUpAvt .alert-danger').html('Vui long chon tep hinh anh.');
	}
});

// Xoa anh dai dien
$('#del_avt').on('click', function() {
	$confirm = confirm('ban co chac muon xoa anh dai dien nay khong?');

	if ($confirm == true) {
		$.ajax({
			url  : $_DOMAIN + 'profile.php',
			type : 'POST',
			data :  {
				action : 'delete_avt'
			}, success : function() {
				location.reload();
			}, error : function() {
				alert('Da co loi xay ra, hay thu lai sau.');
			}
		});
	} else {
		return false;
	}
});

// Cap nhap thong tin khac
$('#formUpdateInfo button').on('click', function() {
	$('#formUpdateInfo').html('Dang Tai ...');
	$dn_update = $('#dn_update').val();
	$email_update = $('#email_update').val();
	$fb_update = $('#fb_update').val();
	$gg_update = $('#gg_update').val();
	$tt_update = $('#tt_update').val();
	$phone_update = $('#phone_update').val();
	$desc_update = $('#desc_update').val();

	if ($dn_update && $email_update) {
		$.ajax({
			url : $_DOMAIN + 'profile.php',
			type : 'POST',
			data : {
				dn_update : $dn_update,
				email_update : $email_update,
				fb_update : $fb_update,
				gg_update : $gg_update,
				tt_update : $tt_update,
				phone_update : $phone_update,
				desc_update : $desc_update,
				action : 'update_info'
			}, success : function(data) {
				$('#formUpdateInfo .alert').removeClass('hidden');
				$('#formUpdateInfo .alert').html(data);
			}, error : function() {
				$('#formUpdateInfo .alert').removeClass('hidden');
				$('#formUpdateInfo .alert').html('Da co loi xay ra, vui long thu lai sau');
			}
		});
		$('#formUpdateInfo button').html('Luu thay doi');
	} else {
		$('#formUpdateInfo button').html('Luu thay doi');
		$('#formUpdateInfo .alert').removeClass('hidden');
		$('#formUpdateInfo .alert').html('Vui long dien day du thong tin.');
	}
});

// Doi mat khau
$('#formChangePw button').on('click', function() {
	$('#formChangePw button').html('Dang tai...');
	$old_pw_change = $('#old_pw_change').val();
	$new_pw_change = $('#new_pw_change').val();
	$re_new_pw_change = $('#re_new_pw_change').val();

	if ($old_pw_change && $new_pw_change && $re_new_pw_change) {
		$.ajax({
			url  : $_DOMAIN + 'profile.php',
			type : 'POST',
			data : {
				old_pw_change : $old_pw_change,
				new_pw_change : $new_pw_change,
				re_new_pw_change : $re_new_pw_change,
				action : 'change_pw'
			}, success : function(data) {
				$('#formChangePw .alert').removeClass('hidden');
				$('#formChangePw .alert').html(data);
			}, error : function() {
				$('#formChangePw .alert').removeClass('hidden');
				$('#formChangePw .alert').html('Da co loi xay ra, vui long thu lai sau.');
			}
		});
		$('#formChangePw button').html('Luu thay doi');
	} else {
		$('#formChangePw button').html('Luu thay doi');
		$('#formChangePw button').removeClass('hidden');
		$('#formChangePw button').html('Vui long dien day du thong tin');
	}
});
