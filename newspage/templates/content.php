<?php 
	
	// Trang noi dung bai viet
	if (isset($_GET['sp']) && isset($_GET['id'])) {
		require 'templates/posts.php';
		// Trang chuyen muc
	} else if (isset($_GET['sc'])) {
		require 'templates/categories.php';
		// Trang tim kiem
	} else if (isset($_GET['s'])) {
		require 'templates/search.php';
		// Trang chu
	} else {
		// code
		require 'templates/lastest-news.php';
	}
?>