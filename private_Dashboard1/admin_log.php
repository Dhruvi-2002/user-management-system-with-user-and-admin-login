<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['admin_user'])) {
  header('Location: index.html');
  exit;
}

require_once("include/connection.php");

$id = mysqli_real_escape_string($conn, $_SESSION['admin_user']);
$r = mysqli_query($conn, "SELECT * FROM admin_login WHERE id = '$id'") or die(mysqli_error($conn));
$row = mysqli_fetch_array($r);
$id = $row['admin_user'];
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>TOYOTA admin dashboard</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
  <script src="js/jquery-3.4.0.min.js"></script>
  <script src="medias/js/jquery.dataTables.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#dtable').dataTable({
        "aLengthMenu": [
          [5, 10, 15, 25, 50, 100, -1],
          [5, 10, 15, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 10
      });
    });
  </script>
</head>

<body class="grey lighten-3">
  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">
        <a class="navbar-brand waves-effect" href="#">
          <strong class="blue-text"></strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
          </ul>
          <ul class="navbar-nav nav-flex-icons">
            <li style="margin-top: 10px;">Welcome, <?php echo ucwords(htmlentities($id)); ?></li>
            <li>
              <a href="logout.php" class="nav-link border border-light rounded waves-effect">
                <i class="far fa-user-circle"></i> Sign Out
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="sidebar-fixed position-fixed">
      <a class="logo-wrapper waves-effect">
        <img src="img/images.jpg" width="150px" height="200px;" class="img-fluid" alt="">
      </a>
      <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item active waves-effect">
          <i class="fas fa-chart-pie mr-3"></i> Dashboard
        </a>
        <a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#modalRegisterForm">
          <i class="fas fa-user mr-3"></i> Add Admin
        </a>
        <a href="view_admin.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-users"></i> View Admin
        </a>
        <a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#modalRegisterForm2">
          <i class="fas fa-user mr-3"></i> Add User
        </a>
        <a href="add_document.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-file-medical"></i> Add/ View Document
        </a>
        <a href="admin_log.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-chalkboard-teacher"></i> Admin logged
        </a>
        <a href="user_log.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-chalkboard-teacher"></i> User logged
        </a>
      </div>
    </div>
    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form action="create_Admin.php" method="POST">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-plus"></i> Add Admin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body mx-3">
              <div class="md-form mb-5">
                <input type="hidden" id="orangeForm-name" name="status" value="Admin" class="form-control validate">
              </div>
              <div class="md-form mb-5">
                <i class="fas fa-user prefix grey-text"></i>
                <input type="text" id="orangeForm-name" name="name" class="form-control validate" required="">
                <label data-error="wrong" data-success="right" for="orangeForm-name">Your name</label>
              </div>
              <div class="md-form mb-5">
                <i class="fas fa-envelope prefix grey-text"></i>
                <input type="email" id="orangeForm-email" name="admin_user" class="form-control validate" required="">
                <label data-error="wrong" data-success="right" for="orangeForm-email">Your email</label>
              </div>
              <div class="md-form mb-4">
                <i class="fas fa-lock prefix grey-text"></i>
                <input type="password" id="orangeForm-pass" name="admin_password" class="form-control validate" required="">
                <label data-error="wrong" data-success="right" for="orangeForm-pass">Your password</label>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button class="btn btn-info" name="reg">Sign up</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="modal fade" id="modalRegisterForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form action="create_user.php" method="POST">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold"><i class="fas fa-user-plus"></i> Add User Employee</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body mx-3">
              <div class="md-form mb-5">
                <input type="hidden" id="orangeForm-name" name="status" value="Employee" class="form-control validate" required="">
              </div>
              <div class="md-form mb-5">
                <i class="fas fa-user prefix grey-text"></i>
                <input type="text" id="orangeForm-name" name="name" class="form-control validate">
                <label data-error="wrong" data-success="right" for="orangeForm-name">Your name</label>
              </div>
              <div class="md-form mb-5">
                <i class="fas fa-envelope prefix grey-text"></i>
                <input type="email" id="orangeForm-email" name="email_address" class="form-control validate" required="">
                <label data-error="wrong" data-success="right" for="orangeForm-email">Your email</label>
              </div>
              <div class="md-form mb-4">
                <i class="fas fa-lock prefix grey-text"></i>
                <input type="password" id="orangeForm-pass" name="user_password" class="form-control validate" required="">
                <label data-error="wrong" data-success="right" for="orangeForm-pass">Your password</label>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button class="btn btn-info" name="reguser">Sign up</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </header>

  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
      <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="dashboard.php">Home Page</a>
            <span>/</span>
            <span>Dashboard</span>
          </h4>
        </div>
      </div>
      <div class="">
        <a href="add_document.php"><button type="button" class="btn btn-info"><i class="fas fa-chevron-circle-left"></i> Document</button></a>
      </div>
      <hr>
      <div class="col-md-12">
        <table id="dtable" class="table table-striped">
          <thead>
            <th>ADMIN LOGGED</th>
            <th>YOUR IP</th>
            <th>HOST</th>
            <th>ACTION</th>
            <th>TIME IN</th>
            <th>ACTION</th>
            <th>TIME OUT</th>
          </thead>
          <tbody>
            <?php
            require_once("include/connection.php");
            $query = mysqli_query($conn, "SELECT * from history_log1") or die(mysqli_error($conn));
            while ($file = mysqli_fetch_array($query)) {
              $name = $file['admin_user'];
              $ip = $file['ip'];
              $host = $file['host'];
              $action = $file['action'];
              $logintime = $file['login_time'];
              $actions = $file['actions'];
              $logouttime = $file['logout_time'];
            ?>
              <tr>
                <td><?php echo $name; ?></td>
                <td><?php echo $ip; ?></td>
                <td><?php echo $host; ?></td>
                <td><?php echo $action; ?></td>
                <td><?php echo $logintime; ?></td>
                <td><?php echo $actions; ?></td>
                <td><?php echo $logouttime; ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <footer>
    <!-- Add your footer content here -->
  </footer>
  <!-- Add your scripts here -->

  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css">
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script>
</body>

</html>
