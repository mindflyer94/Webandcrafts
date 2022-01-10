<?php

require_once('./config/dbconfig.php');
$db = new operations();
$result = $db->view_record();

if (!isset($_SESSION["role"])) {
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/datatables.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <script type="text/javascript">
    function delete_center() {
      var r = confirm("Are you sure want to delete this Web Site?");
      if (r == true) {
        x = "You pressed OK!";
      } else {
        x = "You pressed Cancel!";
        return false;
      }
    }
  </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="view.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo "uploads/" . $_SESSION['image'] ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['name'] ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


            <li class="nav-header">LABELS</li>
            <li class="nav-item">
              <a href="view.php" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Employees</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Logout</p>
              </a>
            </li>



          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


      <!-- Main content -->
      <section class="content">


        <div class="row">
          <div class="col">
            <div class="card mt-5">
              <div class="card-header">
                <h2 class="text-center text-dark"> Employees Record </h2>

              </div>
              <div class="card-body">
                <?php
                $db->display_message();

                ?>


                <table class="display wrap" id="table" style="width:100%">
                  <thead>
                    <tr>
                      <td> # </td>
                      <td> Name </td>
                      <td> Designation </td>
                      <td>Email</td>
                      <td>Profile Image</td>
                      <?php if ($_SESSION['role'] == 'ADMIN') { ?>
                        <td>Operations</td>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php $i = 1;
                      while ($data = mysqli_fetch_assoc($result)) {
                      ?>
                        <td><?php echo  $i; ?></td>
                        <td><?php echo $data['FirstName'] ?></td>
                        <td><?php echo $data['designation'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <?php if ($data['ProfileImage'] == null) { ?>
                          <td>Image Not Uploaded</td>
                        <?php } else { ?>
                          <td><img src="<?php echo 'uploads/' . $data['ProfileImage'] ?>" width="140px" height="80px"></td>
                        <?php } ?>
                        <?php if ($_SESSION['role'] == 'ADMIN') { ?>
                          <td><a href="edit.php?U_ID=<?php echo $data['id'] ?>" class="btn btn-success mr-3">Edit</a>
                            <a href="del.php?D_ID=<?php echo $data['id'] ?>" class="btn btn-danger" onclick="return delete_center();">Del</a>
                          </td>
                          <!-- <td><a href="" onclick="return delete_center();">delete</a></td> -->
                        <?php } ?>
                    </tr>
                  <?php
                        $i++;
                      }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>


      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">

      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/datatables.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <script>
    $(document).ready(function() {
      $("#table").DataTable({
        responsive: true,
        colReorder: true
      });
    });
  </script>
</body>

</html>