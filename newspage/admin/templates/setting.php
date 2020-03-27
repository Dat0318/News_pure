<?php
  // Neu dang nhap
  if ($user) {
    // Neu tai khoan la tac gia
    if ($data_user['position'] == 0) {
      echo '<div class="alert alert-danger">ban khong co du quyen de vao trang nay</div>';
      // Nguoc lai tai khoan la admin
    } else if ($data_user['position'] == 1) {
      echo '<h3>Cai dat chung </h3>';
      // Mo dong hoat dong cua website
      echo '
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class= "panel-title">Trang thai hoat dong</h3>
          </div>
          <div class="panel-body">
            <form method="POST" id="formStatusWeb" onsubmit="return false;">
      ';
      // trang thai website
      $sql_get_stt_web = "SELECT status FROM website";
      if ($db->num_rows($sql_get_stt_web)) {
        $data_web = $db->fetch_assoc($sql_get_stt_web, 1);

        if ($data_web['status'] == '0') {
          echo '
            <div class="radio">
              <label><input type="radio" value="1" name="stt_web">Mo</label>
            </div>
            <div class="panel-body">
              <form method="POST" id="formStatusWeb" onsubmit="return false;">
          ';
        } else if($data_web['status'] == '1') {
          echo '
            <div class="radio">
              <label><input type="radio" value="1" name="stt_web" checked> Mo</label>
            </div>
            <div class="radio">
              <label><input type="radio" value="0" name="stt_web" checked> Dong</label>
            </div>
          ';
        }
      }

      echo '
              <button typs="submit" class="btn btn-primary">Luu</button><br><br>
              <div class="alert alert-danger hidden"></div>
            </form>
          </div>
        </div>
      ';

      // Chinh sua thong tin website
      $sqlGetInfoWeb = "SELECT title, descr, keywords FROM website";
      if ($db->num_rows($sqlGetInfoWeb)) {
        $data_web = $db->fetch_assoc($sqlGetInfoWeb, 1);
      }

      echo '
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Chinh sua thong tin</h3>
          </div>
          <div class="panel-body">
            <form method="POST" id="formInfoWeb" onsubmit="return false;">
              <div class="form-group">
                <label>Tieu de Website</label>
                <input type="text" class="form-control" value="'.$data_web['title'].'" id="title_web">
              </div>
              <div class="form-group">
                <label>mo ta Website</label>
                <textarea class="form-control" id="descr_web">'.$data_web['descr'].'</textarea>
              </div>
              <div class="form-group">
                <label>Tu khoa Website</label>
                <input type="text" class="form-control" value="'.$data_web['keywords'].'" id="keywords_web">
              </div>
              <button class="btn btn-primary" type="submit">Luu</button><br><br>
              <div class="alert alert-danger hidden"></div>
            </form>
          </div>
        </div>
      ';
    }
  } else {
    new Redirect($_DOMAIN); // Tro ve trang index
  }
?>
