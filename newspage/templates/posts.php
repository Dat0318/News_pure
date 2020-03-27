<?php 

	// Get tham so post
	$sp = trim(htmlspecialchars(addslashes($_GET['sp'])));
	$id = trim(htmlspecialchars(addslashes($_GET['id'])));

	// Lay thong tin bai viet
	$sql_get_data_post = "SELECT * FROM posts WHERE id_post = '$id' ";
	if ($db->num_rows($sql_get_data_post)) {
		$data_post = $db->fetch_assoc($sql_get_data_post,1);
	} else {
		// neu khong ton tai
		require 'templates/404.php';
		exit;
	}
?>

<div class="container">
	<div class="row">
		<h1><?php echo $data_post['title']; ?></h1>
		<div class="body-post">
			<?php echo htmlspecialchars_decode($data_post['body']); ?>
		</div>
		<div class="cate-post">
			<?php 

				// In chuyen muc cua bai viet
				for ($i=1; $i <= 3 ; $i++) { 
					$id_cate = $data_post['cate_'.$i.'_id'];
					if ($id_cate) {
						$sql_get_data_cate = "SELECT label, url FROM categories WHERE $id_cate = '$id_cate' AND type = '$i' ";
						if ($db->num_rows($sql_get_data_cate)) {
							$data_cate = $db->fetch_assoc($sql_get_data_cate, 1);

							echo '<a href="'.$_DOMAIN.'category/'.$data_cate['url'].'" class="btn btn-primary btn-sm">'.$data_cate['label'].'</a>';
						}
					}
				}
			?>
		</div>
	</div>
	<hr>
	<div class="row">
		<h3>Bai viet lien quan</h3>
		<?php 

			// Hien thi cac bai viet lien quan theo chuyen muc bai viet chi dinh
			$sql_get_invole_post = "SELECT DISTINCT * FROM posts WHERE (cate_1_id = '$data_post[cate_1_id]' OR cate_2_id = '$data_post[cate_2_id]' OR cate_3_id = '$data_post[cate_3_id]') AND status = '1' AND id_post !=  '$id' ";
			// $sql_get_invole_post = "SELECT DISTINCT * FROM posts WHERE (cate_1_id = '$data_post[cate_1_id]' OR cate_2_id = '$data_post[cate_2_id]' OR cate_3_id = '$data_post[cate_3_id]') AND status = '1' AND id_post != '$id'";
			// Neu ton tai cac bai viet lien quan
			if ($db->num_rows($sql_get_invole_post)) {
				// In danh sach bai viet lien quan
				foreach ($db->fetch_assoc($sql_get_invole_post, 0) as $data_post ) {
					echo '
						<div class="col-md-3">
							<div class="thumbnail">
								<a href="'.$_DOMAIN.$data_post['slug'].'-'.$data_post['id_post'].'.html">
									<img src="'.$data_post['url_thumb'].'" alt="">
								</a>
								<div class="caption">
									<h3><a href="'.$_DOMAIN.$data_post['slug'].'-'.$data_post['id_post'].'.html">'.$data_post['title'].'</a></h3>
									<p>'.$data_post['descr'].'</p>
								</div>
							</div>
						</div>
					';
				}
			}
			// Khong ton tai thi thong bao
			else {
				echo '<div class="well well-lg">Khong co bai viet lien quan nao.</div>';
			}
		?>
	</div>
</div>