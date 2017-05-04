<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>مینو۹۶</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/dist/fonts/fonts-fa.css">
    <link rel="stylesheet" href="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/dist/css/rtl.css">
    <link rel="stylesheet" href="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/dist/css/skins/skin-black.css">
    <!-- jQuery 2.1.4 -->
    <script src="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/dist/js/app.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-black sidebar-mini">
<div class="wrapper">

    <header class="main-header skin-black">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>م</b>۹۶</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>مینو</b>۹۶</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-right">
                                                <img src="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/images/masoud.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li><!-- end message -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">۱۰</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">۹</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-left">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <!-- Control Sidebar Toggle Button -->
                    <li><a type="button" class="btn btn-danger btn-flat" href="{$smarty.const.DEFAULT_PATH}/?logout">خروج</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-right image">
                    <img src="{$smarty.const.DEFAULT_PATH}/Modules/Administrator/images/masoud.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{$admin.name} {$admin.last_name}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="جستوجو ...">
                    <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">ناوبری اصلی</li>
                <li class="active treeview">
                    <a href="{$smarty.const.DEFAULT_PATH}/Administrator">
                        <i class="fa fa-dashboard"></i> <span>پیشخوان</span> <i class="fa pull-left"></i>
                    </a>
                </li>
                <li>
                    <a href="{$smarty.const.DEFAULT_PATH}/Administrator/comments">
                        <i class="fa fa-comments"></i> <span>کامنت ها</span> <i class="fa pull-left"></i>
                    </a>
                </li>
                <li>
                    <a href="{$smarty.const.DEFAULT_PATH}/Administrator/posts">
                        <i class="fa fa-clone"></i> <span>پست ها</span> <i class="fa pull-left"></i>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>اخبار</span> <i class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{$smarty.const.DEFAULT_PATH}/Administrator/newnews"><i class="fa fa-list-alt"></i>خبر جدید</a></li>
                        <li><a href="{$smarty.const.DEFAULT_PATH}/Administrator/newslist"><i class="fa fa-list"></i> لیست خبرها</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>نامزدها</span> <i class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{$smarty.const.DEFAULT_PATH}/Administrator/newcandidate"><i class="fa fa-user-plus"></i>نامزد جدید</a></li>
                        <li><a href="{$smarty.const.DEFAULT_PATH}/Administrator/candidates"><i class="fa fa-users"></i> اصلاح اطلاعات نامزدها</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{$smarty.const.DEFAULT_PATH}/Administrator/setting">
                        <i class="fa fa-cogs"></i> <span>تنظیمات برنامه</span> <i class="fa pull-left"></i>
                    </a>
                </li>
                <li>
                    <a href="{$smarty.const.DEFAULT_PATH}/Administrator/dashboard/changepass">
                        <i class="fa fa-lock"></i> <span>تغییر کلمه عبور</span> <i class="fa pull-left"></i>
                    </a>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                پیشخوان
                <small>پنل مدیریت</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active">پیشخوان</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">