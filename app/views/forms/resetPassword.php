<?php $this->layout('forms::AuthForm',  ['title' => 'Reset Password']); ?>
<?php if(isset(\App\models\authModel::$error)): ?>
    <div class="callout callout-danger">
        <h4 style="text-transform: uppercase;">Warning!</h4>

        <p style="text-transform: capitalize;"><?= \App\models\authModel::$error ?></p>
    </div>
<?php endif; ?>
<form method="post" action="/reset-password" class="form-horizontal">
    <div class="box-body">
        <div class="form-group">
            <div class="col-sm-12 text-center"><h4>Email:</h4></div>

            <div class="col-sm-12">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
            </div>
        </div>
        <div class="box-footer text-center">
            <button type="submit" class="btn btn-info" name="resetPassword">Reset Password</button>
        </div>
    </div>
</form>