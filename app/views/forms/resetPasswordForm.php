<?php $this->layout('forms::AuthForm',  ['title' => 'Update Password']);

/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 20.10.2018
 * Time: 20:23
 */
?>
<?php if(isset(\App\models\authModel::$error)): ?>
<div class="callout callout-danger">
    <h4 style="text-transform: uppercase;">Warning!</h4>

    <p style="text-transform: capitalize;"><?= \App\models\authModel::$error ?></p>
</div>
<?php else: ?>
<form action="/update-password" method="post" class="form-horizontal">
    <div class="box-body">
        <div class="form-group">
            <div class="div col-md-12 text-center">
                <h4>New Password:</h4>
            </div>
            <div class="col-sm-12">
                <input type="password" class="form-control" id="inputpass" placeholder="New Password" name="password">
                <input type="hidden" name="selector" value="<?= $selector ?>">
                <input type="hidden" name="token" value="<?= $token ?>">
            </div>
        </div>
        <div class="box-footer text-center">
            <button type="submit" class="btn btn-info">Update Password</button>
        </div>
    </div>
</form>
<?php endif; ?>