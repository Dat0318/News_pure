<div class="col-md-9 content">
	<?php
		// Phan trang content
		// Lay tham so tab
		if (isset($_GET['tab'])) {
			$tab = trim(addslashes(htmlspecialchars($_GET['tab'])));
		}
		else {
			$tab ='';
		}

		// neu co tham so tab
		if ($tab != '') {
			// Hien thi template chuc nang theo tham so tab
			if ($tab == 'profile') {
				// Hien thi template ho so ca nhan
				require_once 'templates/profile.php';
			}
			else if ($tab == 'posts') {
				// Hien thi template bai viet
				require_once 'templates/posts.php';
			}
			else if ($tab == 'photos') {
				// Hien thi template bai viet
				require_once 'templates/photos.php';
			}
			else if ($tab == 'categories') {
				// Hien thi template bai viet
				require_once 'templates/categories.php';
			}
			else if ($tab == 'setting') {
				// Hien thi template bai viet
				require_once 'templates/setting.php';
			}
			else if ($tab == 'accounts') {
				// Hien thi template bai viet
				require_once 'templates/accounts.php';
			}
		}
		// Nguoc lai khong co tham so tab
		else {
			// Hien thi template bang dieu khien
			require_once 'templates/dashboard.php';
		}
	?>
</div>
