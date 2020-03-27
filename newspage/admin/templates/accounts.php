<?php
  // Neu dang nhap
  if ($user) {
    // Neu tai khoan la tac gia
    if ($data_user['position'] == 0) {
      echo '<div class="alert alert-danger">Ban khong co du quyen de vao trang nay.</div>';
    }
    // Nguoc lai la tai khoan admin
    else if ($data_user['position'] == '1') {
      echo '<h3>Tai khoan</h>';
      if (isset($_GET['ac'])) {
        $ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
      } else {
        $ac = '';
      }
      // Lay tham so id
      if (isset($_GET['id'])) {
        $id = trim(addslashes(htmlspecialchars($_GET['id'])));
      } else {
        $id = '';
      }
      // Neu co tham so la ac
      if ($ac != '') {
        // Trang them tai khoan
        if ($ac == 'add') {
          // Day nut cua them tai khoan
          echo '
            <a href="'.$_DOMAIN.'accounts" class="btn btn-default">
              <span class="glyphicon glyphicon-arrow-left"></span> Tro ve
            </a>
          ';
          // Content them tai khoan
          echo '
            <p class="form-add-acc">
              <form method="POST" id="formAddAcc" onsubmit="return false;">
                <div class="form-group">
                  <label>Ten danh nhap</label>
                  <input type="text" class="form-control title" id="un_add_acc">
                </div>
                <div class="form-group">
                  <label>Mat khau</label>
                  <input type="password" class="form-control title" id="pw_add_acc">
                </div>
                <div class="form-group">
                  <label>Nhap lai mat khau</label>
                  <input type="password" class="form-control title" id="repw_add_acc">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Them</button>
                </div>
                <div class="alert alert-danger hidden"></div>
              </form>
            </p>
          ';
        }
      }
      // Nguoc lai khong co tham so ac
      // Trang danh sach tai khoan
      else {
        // Day nut cua danh sach tai khoan
        echo '
          <a href="'.$_DOMAIN.'accounts/add" class="btn btn-default">
            <span class="glyphicon glyphicon-plus"></span> Them
          </a>
          <a href="'.$_DOMAIN.'accounts" class="btn btn-default">
            <span class="glyphicon glyphicon-repeat"></span> Reload
          </a>
          <a class="btn btn-warning" id="lock_acc_list">
            <span class="glyphicon glyphicon-lock"></span> Khoa
          </a>
          <a class="btn btn-success" id="unlock_acc_list">
            <span class="glyphicon glyphicon-lock"></span> Mo khoa
          </a>
          <a class="btn btn-danger" id="del_acc_list">
            <span class="glyphicon glyphicon-trash"></span> Xoa
          </a>
        ';
        // Content danh sach tai khoan
        $sql_get_list_acc = "SELECT * FROM accounts WHERE accounts WHERE position = '1' ORDER BY id_acc DESC";
        // Neu co tai khoan
        if ($db->num_rows($sql_get_list_acc)) {
          echo '
            <br><br>
            <div class = "table-responsive">
              <table class="table table-striped list" id="list_acc">
                <tr>
                  <td><input type="checkbox"></td>
                  <td><strong>ID</strong></td>
                  <td><strong>Ten dang nhap</strong></td>
                  <td><strong>Trang thai</strong></td>
                  <td><strong>Tools</strong></td>
                </tr>
          ';

          // In danh sach tai khoan
          foreach ($db->fetch_assoc($sql_get_list_acc, 0) as $key => $data_acc) {
            // Trang thai tai khoan
            if ($data_acc['status'] == 0) {
              $stt_acc = '<label class = "label label-success">hoat dong</label>';
            } else if ($data_acc['status'] == 1) {
              $stt_acc = '<label class="label label-warning">Khoa</label>';
            }

            echo '
              <tr>
                <td><input type="checkbox" name="id_acc[]" value="'.$data_acc['id_acc'].'"></td>
                <td>'.$data_acc['id_acc'].'</td>
                <td>'.$data_acc['username'].'</td>
                <td>'.$stt_acc.'</td>
                <td>
                  <a data-id="'.$data_acc['id_acc'].'" class="bn btn-sm btn-warninng lock-acc-list">
                    <span class="glyphicon glyphicon-lock"></span>
                  </a>
                  <a data-id="'.$data_acc['id_acc'].'" class="bn btn-sm btn-success unlock-acc-list">
                    <span class="glyphicon glyphicon-lock"></span>
                  </a>
                  <a data-id="'.$data_acc['id_acc'].'" class="bn btn-sm btn-danger del-acc-list">
                    <span class="glyphicon glyphicon-trash"></span>
                  </a>
                </td>
              </tr>
            ';
          }
          echo '
              </table>
            </div>
          ';
        }
        // Neu khong co tai khaon
        else {
          echo '<br><br><div class="alert alert-info">Chua co tai khoan nao.</div>';
        }
      }
    }
  }
  // Nguoc lai chua dang nhap
  else {
    new Redirect($_DOMAIN); // Tro ve trang index
  }
?>
