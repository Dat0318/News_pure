<?php
// Ket noi database va thong tin chung
require_once 'core/init.php';

// Neu dang nhap
if ($user) {
  // Neu ton tai POST action
  if (isset($_POST['action'])) {
    // xu ly POST action
    $action = trim(addslashes(htmlspecialchars($_POST['action'])));

    // Tham tai khoan
    $if ($action == 'add_acc') {
      // xu ly cac gia tri
      $un_add_acc = trim(htmlspecialchars(addslashes($_POST['un_add_acc'])));
      $pw_add_acc = trim(htmlspecialchars(addslashes($_POST['pw_add_acc'])));
      $repw_add_acc = trim(htmlspecialchars(addslashes($_POST['repw_add_acc'])));

      // Cac bien xu ly thong bao
      $show_alert = '<script>$("#formAddAcc .alert").removeClass("hidden")</script>';
      $hide_alert = '<script>$("#formAddAcc .alert").addClass("hidden")</script>';
      $success = '<script>$("#formAddAcc .alert").attr("class", "alert alert-success")</script>';

      // Kiem tra ten danh nhap
      $sql_check_un_exist = "SELECT username FROM accounts WHERE username = '$un_add_acc'";

      if ($un_add_acc == '' || $pw_add_acc == '' || $repw_add_acc == '') {
        echo $show_alert.'Vui long dien day du thong tin';
      } else if (strlen($un_add_acc) < 6 || strlen($un_add_acc) > 32) {
        echo $show_alert.'Ten dang nhap phai nam trong khoang 6 - 32 ky tu.';
      } else if (preg_match('/\W/', $un_add_acc)) {
        echo $show_alert.'Ten dang nhap khong chua ky tu dac viet va khoang trang';
      } else if ($db->num_rows($sql_check_un_exist)) {
        echo $show_alert.'Ten dang nhap da ton tai';
      } else if (strlen($pw_add_acc) < 6) {
        echo $show_alert.'Mat khau phai lon hon 6 ky tu';
      } else if ($pw_add_acc != $repw_add_acc) {
        echo $show_alert.'Mat khau nhap lai khong khop.';
      } else {
        $pw_add_acc = md5($pw_add_acc);
        $sql_add_acc = "INSERT INTO accounts VALUES(
          '',
          '$un_add_acc',
          '$pw_add_acc',
          '',
          '',
          '0',
          '0',
          '$date_current',
          '',
          '',
          '',
          '',
          '',
          ''
        )";
        $db->query($sql_add_acc);
        $db->close();

        echo $show_alert.$success.'Them tai khoan thanh cong.';
        new Redirect($_DOMAIN.'accounts');
      }
    }
    // Mo tai khoan
    // Mo khoa nhieu tai khoan cung luc
    else if ($action == 'unlock_acc_list') {
      foreach ($_POST['id_acc'] as $key => $id_acc) {
        $sql_check_id_acc_exist = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc' ";

        if ($db->num_rows($sql_check_id_acc_exist)) {
          $sql_unlock_acc = "UPDATE accounts SET satatus = '0' WHERE id_acc = '$id_acc' ";
          $db->query($sql_unlock_acc);
        }
      }
      $db->close();
    }
    // Mo khoa 1 tai khoan
    else if ($action == 'unlock_acc') {
      $id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));

      $sql_check_id_acc_exist = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc' ";
      if ($db->num_rows($sql_check_id_acc_exist)) {
        $sql_unlock_acc = "UPDATE accounts SET status = '0' WHERE id_acc = '$id_acc' ";
        $db->query($sql_unlock_acc);
        $db->close();
      }
    }
    // Khoa tai khoan
    // Khoa nhieu tai khoan cung luc
    else if ($action == 'lock_acc_list') {
      foreach ($_POST['id_acc'] as $key => $id_acc) {
        $sql_check_id_acc_exit = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc' ";
        if ($db->num_rows($sql_check_id_acc_exit)) {
          $sql_lock_acc = "UPDATE accounts SET status = '1' WHERE id_acc ='$id_acc' ";
          $db->query($sql_lock_acc);
        }
      }
      $db->close();
    }
    // Khoa 1 tai khoan
    else if ($action == 'lock_acc') {
      $id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));
      $sql_check_id_acc_exit = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc' ";

      if ($db->num_rows($sql_check_id_acc_exit)) {
        $sql_lock_acc = "UPDATE accounts SET status = '1' WHERE id_acc = '$id_acc' ";
        $db->query($sql_lock_acc);
        $db->close();
      }
    }
    // Xoa tai khoan
    // Xoa nhieu tai khoan cung luc
    else if ($action == 'del_acc_list') {
      foreach ($_POST['id_acc'] as $key => $id_acc) {
        $sql_check_id_acc_exist = "SELECT id_acc FROM accounts WHERE id_acc = '$id_acc' ";

        if ($db->num_rows($sql_check_id_acc_exist)) {
          $sql_del_acc = "DELETE FROM accounts id_acc = '$id_acc' ";
          $db->query($sql_del_acc);
        }
      }
      $db->close();
    }
    // Xoa mot tai khoan
    else if ($action == 'del_acc') {
      $id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));
      $sql_check_id_acc_exist = "SELECT id_acc FROM accounts WHERE id_acc =  '$id_acc' ";

      if ($db->num_rows($sql_check_id_acc_exist)) {
        $sql_del_acc = "DELETE FROM accounts id_acc = '$id_acc' ";
        $db->query($sql_del_acc);
        $db->close();
      }
    }
  } else {
    new Redirect($_DOMAIN); // Tro ve trang index
  }
} else {
  new Redirect($_DOMAIN); // Tro ve trang index
}
?>
