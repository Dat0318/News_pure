<?php 
	
	// Require cac thu vien php
	require_once 'admin/classes/DB.php';
	require_once 'admin/classes/Session.php';
	require_once 'admin/classes/Functions.php';

	// Ket noi database
	$db = new DB();
	$db->connect();
	$db->set_char('utf8');

	$_DOMAIN = 'http://localhost/freetuts/PHP/Web_tin_tuc/newspage/';
	// Lay thong tin website
	$sql_get_data_web = "SELECT * FROM website";
	if ($db->num_rows($sql_get_data_web)) {
		$data_web = $db->fetch_assoc($sql_get_data_web, 1);
	}
?>