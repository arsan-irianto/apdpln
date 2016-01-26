<?php
/**
 * Created by PhpStorm.
 * User: Arsan Irianto
 * Date: 06/11/2015
 * Time: 22:20
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>APD PLN | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


    <link href="../plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../font-awesome/css/fonts.googleapis.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../font-awesome/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- date picker -->
    <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Multiselect -->
    <link  href="../plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style -->

    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="../dist/css/skins/skin-red.min.css" rel="stylesheet" type="text/css" />

   <!-- <script src="../plugins/datatables/jQuery-2.1.4/jquery-2.1.4.min.js" type="text/javascript"></script> -->
    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="../plugins/datatables/datatables_sum.js" type="text/javascript"></script>

    <script src="../plugins/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" language="javascript" src="../dist/js/common.js"></script>

    <script type="text/javascript" src="../plugins/fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="../plugins/fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#alertalldel").on("show.bs.modal", function (e) {
                var form = $(e.relatedTarget).closest('form');
                $(this).find('.modal-footer #confirmdel').data('form', form);
            });

            $("#alertalldel").find(".modal-footer #confirmdel").on('click', function(){
                $(this).data('form').submit();
            });
        })
    </script>
</head>
<body class="skin-red">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo"><img src="../dist/img/PLN_logo.jpg">&nbsp;&nbsp;&nbsp;&nbsp;<b>APD</b> PLN</a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Login Menu -->
                    <?php

                        if($_SESSION['USERNAME'] == ''){
                    ?>
                    <li class="dropdown user user-menu">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="fa fa-sign-in"></i>
                            Login<strong class="caret"></strong>
                        </a>
                        <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                            <form action="../pages/login.php" method="post">
                                <div class="form-group has-feedback">
                                    <input class="form-control input-sm" placeholder="USERNAME" name="USERNAME" type="text" required>
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input class="form-control input-sm" placeholder="PASSWORD" name="PASSWORD" type="password" required>
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                    </div><!-- /.col -->
                                    <div class="col-xs-4">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Sign In</button>
                                    </div><!-- /.col -->
                                </div>
                            </form><br>
                        </div>
                    </li>
                    <?php } else {?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../dist/img/user.png" class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?php echo $_SESSION['USERNAME']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="../dist/img/user.png" class="img-circle" alt="User Image" />
                                <p>
                                    <?php echo $_SESSION['USERNAME']; ?>
                                    <small><?php echo $_SESSION['DESCR']; ?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>