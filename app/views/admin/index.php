<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="http://site/assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://site/assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://site/assets/admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="http://site/assets/admin/dist/css/skins/_all-skins.min.css">
    <?php if (isset($edit)): ?>
        <link rel="stylesheet" href="http://site/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <?php endif; ?>
    <link rel="stylesheet" href="http://site/assets/admin/mystyle.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <a href="#" class="logo">
            <span class="logo-mini"><b>A</b>LT</span>
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="logout">
                <a href="/logout" class="btn btn-primary pull-right btn-lg">Logout</a>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar ">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left my-admin-name">
                    <p>Alexander Pierce</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="http://site/admin/users">
                        <i class="fa fa-users"></i> <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="http://site/admin/editor">
                        <i class="fa fa-users"></i> <span>Editor</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content">
        <?php echo $this->section('content'); ?>
        </section>
    </div>
</div>
<script src="http://site/assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="http://site/assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="http://site/assets/admin/dist/js/adminlte.min.js"></script>

<?php if (isset($edit)): ?>
    <script src="http://site/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
        $(function () {
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
    </script>
<?php endif; ?>

</body>
</html>
