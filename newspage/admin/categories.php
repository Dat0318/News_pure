<?php

// Ket noi database va thong tin chung
require_once 'core/init.php';
// Neu dang nhap
if($user) {
  //neu ton tai POST action
  if (isset($_POST['action'])) {
    echo $_POST['action'];
    // Xu ly POST action
    $action = trim(addslashes(htmlspecialchars($_POST['action'])));
    echo $action;
    // Tai chuyen muc cha trong chuc nang them chuyen muc
    if($action == 'load_add_parent_cate') {
      // Xu ly gia tri
      $type_add_cate = trim(addslashes(htmlspecialchars($_POST['type_add_cate'])));

      // Neu type dung dang so
      if (!preg_match('/\D/', $type_add_cate)) {
        $type_add_parent_cate = $type_add_cate -1; // lay type parent
        $sql_get_cate = "SELECT * FROM categories WHERE type = '$type_add_parent_cate' ";
        if($db->num_rows($sql_get_cate)) {
          // In danh sach cac chuyen muc cha theo type parent
          foreach ($db->fetch_assoc($sql_get_cate, 0) as $key => $data_cate) {
            echo '<option value="'.$data_cate['id_cate'].'">'.$data_cate['label'].'<option>';
          }
        }
        else {
          echo '<option value="0">Hien chua co chuyen muc cha nao</option>';
        }
      }
    }
    // Tao chuyen muc
    else if($action = 'add_cate') {
      // xu ly cac gia tri
      $label_add_cate = trim(addslashes(htmlspecialchars($_POST['label_add_cate'])));
      $url_add_cate = trim(addslashes(htmlspecialchars($_POST['url_add_cate'])));
      $type_add_cate = trim(addslashes(htmlspecialchars($_POST['type_add_cate'])));
      $parent_add_cate = trim(addslashes(htmlspecialchars($_POST['parent_add_cate'])));
      $sort_add_cate = trim(addslashes(htmlspecialchars($_POST['sort_add_cate'])));
      
      // Cac bien xu ly thong bao
      $show_alert = '<script>$("#formAddCate .alert").removeClass("hidden");</script>';
      $hide_alert = '<script>$("#formAddCate .alert").addClass("hidden");</script>';
      $success = '<script>$("#formAddCate .alert").attr("class", "alert alert-success");</script>';

      // New cac gia tri rong
      if($label_add_cate == '' || $url_add_cate == '' || $type_add_cate == ''|| $sort_add_cate == '') {
        echo $show_alert.'Vui long dien day du thong tin';
      }
      // Nguoc lai
      else {
        // Neu type chuyen mcu khong phai so
        if(preg_match('/\D/', $type_add_cate)) {
          echo $show_alert.'Da co loi xay ra, hay thu lai sau.';
        }
        // Neu sort chuyen muc khong phai so nguyen duong
        else if (preg_match('/\D/', $sort_add_cate) || $sort_add_cate < 1) {
          echo $show_alert.'Sort chuyen muc phai la mot so nguyen duong.';
        }
        // Neu id chuyen muc khong phai la so
        else if(preg_match('/\D/', $parent_add_cate)) {
          echo $show_alert.'Da co loi xay ra hay thu lai sau.1';
        }
        // Neu dung
        else {
          // thuc thi tao chuyen muc
          $sql_add_create = "INSERT INTO categories VALUES (
            '',
            '$label_add_cate',
            '$url_add_cate',
            '$type_add_cate',
            '$sort_add_cate',
            '$parent_add_cate',
            '$date_current'
          )";
          $db->query($sql_add_create);
          echo $show_alert.$success.'Tao chuyen muc thanh cong';
          $db->close(); // Giai phong
          new Redirect($_DOMAIN.'categories'); // tro ve trang danh sach chuyen muc
        }
      }
    }
    // Tai chuyen muc cha trong chuc nang chinh sua chuyen muc
    else if ( $action == 'load_edit_parent_cate') {
      // xu ly gia tr
      $type_edit_cate = trim(addslashes(htmlspecialchars($_POST['type_edit_cate'])));
      $id_edit_cate = trim(addslashes(htmlspecialchars($_POST['id_edit_cate'])));

      // Neu type dung dan tham so
      if (!preg_match('/\D', $type_edit_cate)) {
        $type_edit_parent_cate =- $type_edit_cate - 1; // lay typr parent
        $sql_get_cate = "SELECT * FROM categories WHERE  type = '$type_edit_parent_cate'";
        if ($db -> num_rows($sql_get_cate)) {
          // in dang sach chuyen muc cha theo type parent
          foreach ($db->fetch_assoc($sql_get_cate, 0) as $key => $data_cate) {
            if ($id_edit_cate != $data_cate['id_cate']) {
              echo '<option value="'. $data_cate['id_cate'].'">'.$data_cate['label'].'</option>';
            }
          }
        } else {
          echo '<option value="0">hien chua co chuyen muc cha nao'.$type_edit_cate.'</option>';
        }
      }
    }
    // Chinh sua chuyen muc 
    else if ($action == 'edit_cate') {
      // Xu ly cac gia tri
      $label_edit_cate = trim(addslashes(htmlspecialchars($_POST['label_edit_cate'])));
      $url_edit_cate = trim(addslashes(htmlspecialchars($_POST['url_edit_cate'])));
      $type_edit_cate = trim(addslashes(htmlspecialchars($_POST['type_edit_cate'])));
      $parent_edit_cate = trim(addslashes(htmlspecialchars($_POST['parent_edit_cate'])));
      $sort_edit_cate = trim(addslashes(htmlspecialchars($_POST['sort_edit_cate'])));
      $id_edit_cate = trim(addslashes(htmlspecialchars($_POST['id_edit_cate'])));

      // Cac bien xu ly thong bao
      $show_alert = '<script>$("#formEditCate .alert").removeClass("hidden");</script>';
      $hidden_alert = '<script>$("#formEditCate .alert").addClass("hidden");</script>';
      $success = '<script>$("#formEditCate .alert").attr("class", "alert alert-success");</script>';

      // Neu cac gia tri rong
      if ($label_edit_cate == '' || $url_edit_cate == '' || $type_edit_cate == '' || $sort_edit_cate == '') {
        echo $show_alert.'Vui long dien day du thong tin';
      }
      // Nguoc lai
      else {
        // Neu type chuyen muc khong phai so
        if (preg_match('/\D', $type_edit_cate)) {
          echo $show_alert.'Da co loi xay ra hay thu lai sau.';
        }
        // Neu sort chuyen muc khong phai so nguyen duong
        else if (preg_match('/\D', $sort_edit_cate) || $sort_edit_cate < 1) {
          echo $show_alert.'Sort chuyen muc phai la mot so nguyen duong.';
        }
        // Neu id parent chuyen muc khong phai so
        else if( preg_match('/\D', $parent_edit_cate)) {
          echo $show_alert.'Da co loi xay ra, hay thu lai sau';
        }
        // Neu dung
        else {
          // Thuc thi chinh sua chuyen muc
          $sql_edit_cate = "UPDATE categories SET
            label = '$label_edit_cate',
            url = '$url_edit_cate',
            type = '$type_edit_cate',
            parent_id = '$parent_edit_cate',
            sort = '$sort_edit_cate',
            WHERE id_cate = '$id_edit_cate'
          ";

          $db->query($sql_edit_cate);
          echo $show_alert.$success.'Tao chuyen muc thanh cong.';
          $db->close(); // Giai phong
          new Redirect($_DOMAIN.'categories'); // Tro ve trang danh sach chuyen muc
        }
      }
    }
    // Xoa nhieu chuyen muc cung 1 luc
    else if ($action == 'delete_cate_list') {
      foreach ($_POST['id_cate'] as $key => $id_cate) {
        $sql_check_id_cate_exist = "SELECT id_cate FROM categories WHERE id_cate = '$id_cate'";
        if($db->num_rows($sql_check_id_cate_exist)) {
          $sql_delete_cate = "DELETE FROM categories WHERE id_cate = '$id_cate'";
          $db->query($sql_delete_cate);
        }
      }
      $db->close();
    }
    // Xoa 1 chuyen muc
    else if ($action == 'delete_cate') {
      $id_cate == trim(htmlspecialchars(addslashes($_POST['id_cate'])));
      $sql_check_id_cate_exist = "SELECT id_cate FROM categories WHERE id_cate = '$id_cate' ";
      if ($db->num_rows($sql_check_id_cate_exist)) {
        $sql_delete_cate = "DELETE FROM categories WHERE id_cate = '$id_cate' ";
        $db->query($sql_delete_cate);
        $db->close();
      }
    }
  }
  // Nguoc lai khong ton tai POST action
  else {
    new Redirect($_DOMAIN);
  }
}
// Neu khong dang nhap
else {
  new Redirect($_DOMAIN);
}
?>