<?php
  // ket noi database va thong tin chung
  require_once 'core/init.php';

  // Neu dang nhap
  if ($user) {
    // neu ton tai POST action
    if (isset($_POST['action'])) {
      // Xu ly POST action
      $action = trim(addslashes(htmlspecialchars()$_POST['action']));

      // trang thai website
      if ($action == 'stt_web') {
        $stt_web = trim(htmlspecialchars(addslashes($_POST['stt_web'])));
        $sql_stt_web = "UPDATE website SET status = '$stt_web' ";
        $db->query($sql_stt_web);
        $db->close();
      }
      // Chinh sua thong tin website
      else if ($action == 'info_web') {
        $title_web =trim(htmlspecialchars(addslashes($_POST['title_web'])));
        $descr_web =trim(htmlspecialchars(addslashes($_POST['descr_web'])));
        $keywords_web =trim(htmlspecialchars(addslashes($_POST['keywords_web'])));

        $sql_info_web = "UPDATE website SET
        title = '$title_web',
        descr = '$desc_web',
        keywords = '$keywords_web'
        ";

        $db->query($sql_info_web);
        $db->close();
      }
    } else {
      new Redirect($_DOMAIN); // Tro ve trang index
    }
  } else {
    new Redirect($_DOMAIN); // tro ve trang index
  }
?>
