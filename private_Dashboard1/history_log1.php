<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION["admin_user"])) {
    header("location: index.html");
    exit();
}

require_once("include/connection.php");

function formatTimestamp($timestamp) {
    return date("Y-m-d H:i:s", strtotime($timestamp));
}

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Logged History</title>
    <!-- Add your head content here -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="media/css/dataTable.css" />
    <script src="media/js/jquery.dataTables.js" type="text/javascript"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){
            $('#dtable').dataTable({
                "aLengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                "iDisplayLength": 10
            });
        })
    </script>
    <style type="text/css">
        select[multiple], select[size] {
            height: auto;
            width: 20px;
        }
        .pull-right {
            float: right;
            margin: 2px !important;
        }
        #loader{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('img/lg.flip-book-loader.gif') 50% 50% no-repeat rgb(249,249,249);
            opacity: 1;
        }
    </style>
</head>
<body>
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color fixed-top">
        <a class="navbar-brand" href="#"><img src="js/img/Files_Download.png" width="33px" height="33px"> <font color="#F0B56F">F</font>ile <font color="#F0B56F">M</font>anagement <font color="#F0B56F">S</font>ystem</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
            aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <font color="black">Welcome!,</font> <?php echo ucwords(htmlentities($id)); ?> <i class="fas fa-user-circle"></i> Login
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                        <a class="dropdown-item" href="admin_history_log.php"> <i class="fas fa-chalkboard-teacher"></i> Admin Logged</a>
                        <a class="dropdown-item" href="Logout.php"><i class="fas fa-sign-in-alt"></i> LogOut</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>Admin Logged History</h1>
                <table id="dtable" class="table table-striped">
                    <thead>
                        <th>ADMIN LOGGED</th>
                        <th>ADMIN IP</th>
                        <th>HOST</th>
                        <th>ACTION</th>
                        <th>TIMEIN</th>
                        <th>ACTION</th>
                        <th>TIMEOUT</th>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM history_log1") or die(mysqli_error($conn));
                        while ($file = mysqli_fetch_array($query)) {
                            $name = $file['admin_user'];
                            $ip = $file['ip'];
                            $host = $file['host'];
                            $action = $file['action'];
                            $logintime = formatTimestamp($file['login_time']);
                            $actions = $file['actions'];
                            $logouttime = formatTimestamp($file['logout_time']);
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
    </div>

    <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css">
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script>
</body>
</html>
