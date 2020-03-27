<?php 
	// Ket noi database va thong tin chung
	require_once 'core/init.php';

	// Neu co ton tai phuomh thuc post
	if (isset($_POST['user_signin']) && isset($_POST['pass_signin'])) {
		// Xu ly cac gia tri
		$user_signin =  trim(htmlspecialchars(addslashes($_POST['user_signin'])));
		$pass_signin =  trim(htmlspecialchars(addslashes($_POST['pass_signin'])));

		// Cac bien xu ly cac thong bao
		$show_alert = '<script>$("#formSignin .alert").removeClass("hidden");</script>';
		$hidden_alert = '<script>$("#formSignin .alert").addClass("hidden");</script>';
		$success = '<script>$("#formSignin .alert").attr("class", "alert alert-success");</script>';

		// Neu cac gia tri rong
		if ($user_signin =='' || $pass_signin == '') {
			echo $show_alert.'Vui long dien day du thong tin';
		}
		// Nguoc lai
		else {
			$sql_check_user_exist = "SELECT username FROM accounts WHERE username = '$user_signin' ";
			// Neu ton tai username
			if ($db-> num_rows($sql_check_user_exist)) {
				$pass_signin = md5($pass_signin);
				$sql_check_signin = "SELECT username, password FROM accounts WHERE username = '$user_signin' AND password = '$pass_signin' ";
				if ($db-> num_rows($sql_check_signin)) {
					$sql_check_stt = "SELECT username, password, status FROM accounts WHERE username = '$user_signin' AND password = '$pass_signin' AND status ='0' ";
					// neu username va password khoi va tai khoan khong bi khoa (status = 0)
					if ($db->num_rows($sql_check_stt)) {
						// Luu Session
						$session -> send($user_signin);
						$db->close(); // giai phong;

						echo $show_alert.$success.'Dang nhap thanh cong';
						// print_r($_DOMAIN);
						// die();
						new Redirect($_DOMAIN); // Tra ve trang index
					}
					else {
						echo $show_alert.'Tai khoan cua ban da bi khoa vui long lien he quan tri vien de biet them chi tiet.';
					}
				}
				else {
					echo $show_alert.'Mat khau khong chinh xac';
				}
			}
		// Nguoc lai khong ton tai user
			else {
				echo $show_alert.'Ten dang nhap khong ton tai.';
			}
		}
	}
	// Nguoc lai khong ton tai phuong thuc post
	else {
		new Redirect($_DOMAIN); // tro ve trang index
	}

?>
