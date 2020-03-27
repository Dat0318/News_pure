<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Newspage Administeration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

  <!-- Liên kết Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo $_DOMAIN; ?>bootstrap/css/bootstrap.min.css"/> 

  <!-- Liên kết thư viện jQuery -->
  <script src="<?php echo $_DOMAIN; ?>js/jquery.min.js"></script> 
</head>
<body>
	<?php 
	// Neu dang nhap thanh cong
	if (!$user) {
		echo '
			<div class="container">
				<div class="page-header">
					<h1>Newspage <small>Administration</small></h1>
				</div><!-- div.page-header -->
			</div><!-- div.container -->
		';
	}
	// Neu dang nhap
	else {
		echo '
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<a href="'.$_DOMAIN.'" class="nav-brand">Newspage Adnibustration</a>
					</div><!-- div.nav-header -->
				</div><!-- div.container-fluid -->
			</nav>
		';
	}
	?>
