<?php $this->layout('forms::AuthForm',  ['title' => 'Log in'])?>
<?php if(isset(\App\models\UserModel::$error)): ?>
    <div class="callout callout-danger">
        <h4 style="text-transform: uppercase;">Warning!</h4>

        <p style="text-transform: capitalize;"><?= \App\models\UserModel::$error ?></p>
    </div>
<?php endif; ?>
<form action="/admin" method="post">
    <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="remember" checked> Remember Me
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" class="btn btn btn-info btn-block btn-flat" name="login">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
</form>

<a href="/reset-password">I forgot my password</a><br>