<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$this->e($title)?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="http://site/assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://site/assets/admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="http://site/assets/admin/plugins/iCheck/square/blue.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <p><?=$this->e($title)?></p>
    </div>
    <div class="login-box-body">
        <?php echo $this->section('content'); ?>
    </div>
</div>
<script src="http://site/assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="http://site/assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
