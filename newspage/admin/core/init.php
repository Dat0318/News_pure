<?php 
	// Require cac thu vien PHP
	require_once 'classes/DB.php';
	require_once 'classes/Session.php';
	require_once 'classes/Functions.php';

	// ket noi databse
	$db =new DB();
	$db ->connect();
	$db ->set_char('utf8');

	// Thong tin chung
	$_DOMAIN ='http://localhost/freetuts/PHP/Web_tin_tuc/newspage/admin/';

	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$date_current = '';
	$date_current = date('Y-m-d H:i:sa');

	// Khoi tao session
	$session = new Session();
	$session -> start();

	// Kiem tra session
	if ($session->get() != '') {
		$user = $session->get();
	}
	else {
		$user = '';
	}

	// Neu dang nhap
	if ($user) {
		// print_r($user);
		// die();
		// Lay du lieu tai khoan
		$sql_get_data_user = "SELECT * FROM accounts WHERE username = '$user'";
		if ($db->num_rows($sql_get_data_user)) {
			$data_user = $db->fetch_assoc($sql_get_data_user, 1);
		}
	}
?>