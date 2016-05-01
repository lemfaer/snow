<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<!-- REQUIRED -->
  <!-- $client -->
  <!-- $contentPath -->
  <!-- $compact -->
<!-- REQUIRED END -->

<?php $name = $client->getFirstName()." ".$client->getLastName(); ?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Starter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/template/css/admin.css">
    <link rel="stylesheet" href="/template/css/skin-blue.css">

    <!-- jQuery 2.1.4 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/template/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/template/js/admin.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="/admin" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Snow</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a style="cursor: default;">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?= $name; ?></span>
                </a>
              </li>
              <li>
                <a href="/">На главную</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">Tables</li>
            <!-- Optionally, you can add icons to the links -->
            
            <?php 
              $url = explode("/", trim($_SERVER['REQUEST_URI'], "/"));
              $url = array(array_shift($url), array_shift($url));
              $url = "/".implode("/", $url);
            ?>

            <?php $linkArr = array(
              array("Продукты",       "/admin/product"),
              array("Категории",      "/admin/category"),
              array("Пользователи",   "/admin/user"),
              array("Заказы",         "/admin/indent"),
              array("Изготовители",   "/admin/producer"),
              array("Характеристики", "/admin/char"),
              array("Размеры",        "/admin/size"),
              array("Цвета",          "/admin/color"),
            ); ?>

            <?php foreach ($linkArr as list($name, $link)): ?>
              <?php $active = ($url === $link) ? ("active") : (null); ?>
              <li class="<?= $active; ?>">
                <a href="<?= $link; ?>">
                  <i class="fa fa-table"></i> 
                  <span><?= $name; ?></span>
                </a>
              </li>
            <?php endforeach ?>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        
          <?php View::empty("admin/".$contentPath, $compact); ?>

        <!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <a href="/">На главную</a>
        </div>
        <!-- Default to the left -->
        <strong>Hello World!</strong>
      </footer>

    </div><!-- ./wrapper -->
  </body>

  <!-- Theme style -->
  <link rel="stylesheet" href="/template/css/admin.css">
  <link rel="stylesheet" href="/template/css/skin-blue.css">
  <link rel="stylesheet" href="/template/css/myadmin.css">

</html>
