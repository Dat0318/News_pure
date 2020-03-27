<?php 
	// Require database & thong tin chung
	require_once 'core/init.php';

	// Xoa session
	$session->destroy();
	new Redirect($_DOMAIN); // Tro ve trang index
?>