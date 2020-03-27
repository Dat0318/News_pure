<?php 
	// Require database & thong tin chung
	require_once 'core/init.php';
	// Require header
	require_once 'includes/header.php';

	// neu dang nhap
	if ($user) {
		// Hien thi sidebar
		require_once 'templates/sidebar.php';

		// Hien thi content
		require_once 'templates/content.php';
	}
	// neu khong dang nhap
	else {
		// hien thi form dang nhap
		require_once 'templates/signin.php';
	}

	// Require footer
	require_once 'includes/footer.php';

?>