<?php 
    require_once('./config/dbconfig.php'); 
    $db = new operations();
    $result=$db->view_designation();
    //print_r($result);die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h3>REGISTER</h3>
    </div>
    <?php $db->Store_Record(); ?>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form method="POST" enctype="multipart/form-data">
        <div class="input-group mb-3">
        <input type="text" name="First" placeholder=" Full Name" class="form-control" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="Email" name="UserEmail" placeholder="Email" class="form-control" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select class="form-control" name="designation" required>
            <option value="0" >Select Designation</option>
            <?php
            while($data = mysqli_fetch_array($result))
            {
                echo "<option value='". $data['id'] ."'>" .$data['designation'] ."</option>";  // displaying data in option menu
            }	
            ?>
          </select>
        </div>
        <div class="input-group mb-3">
        <input type="file" class="form-control" name="image">
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="btn_save">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    

      <a href="index.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
