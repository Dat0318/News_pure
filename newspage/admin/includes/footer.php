<?php
	// Active sidebar
	// Lay tham so cho tab
	if (isset($_GET['tab'])) {
		$tab = trim(addslashes(htmlspecialchars($_GET['tab'])));
	}
	else {
		$tab = '';
	}

	// Neu co tham so tab
	if ($tab != '') {
		// Thao active cho bang dieu khien
		echo '
			<script>$(".sidebar ul a:eq(1)").removeClass("active");</script>
		';
		// Active theo gia trị tham so tab
		if ($tab == 'profile') {
			echo '
				<script>$(".sidebar ul a:eq(2)").addClass("active");</script>
			';
		}
		else if ($tab == 'posts') {
			echo '
				<script>$(".sidebar ul a:eq(3)").addClass("active");</script>
				<script>
					config = {};
					config.entities_latin = false;
					config.language = "vi";
					CKEDITOR.replace("body_edit_post", config);
				</script>
			';
		}
		else if ($tab == 'photos') {
			echo '
				<script>$(".sidebar ul a:eq(4)").addClass("active");</script>
			';
		}
		else if ($tab == 'accounts')
		{
		  echo '
				<script>$(".sidebar ul a:eq(5)").addClass("active");</script>
				';
		}
		else if ($tab == 'categories') {
			echo '
				<script>$(".sidebar ul a:eq(6)").addClass("active");</script>
			';
		}
		else if ($tab == 'setting') {
			echo '
				<script>$(".sidebar ul a:eq(7)").addClass("active");</script>
			';
		}
	}
?>
<!-- Lien ket thu vien JQuery Form -->
<script src="<?php echo $_DOMAIN; ?>js/jquery.form.min.js"></script>
<!-- Lien ket thu vien ham xu ly form -->
<script src="<?php echo $_DOMAIN; ?>js/form.js"></script>
<script src="<?php echo $_DOMAIN; ?>ckeditor/ckeditor.js"></script>
</body>
</html>
