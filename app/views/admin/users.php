<?php $this->layout('admin::index', ['title' => 'All Users']);
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 22.10.2018
 * Time: 12:11
 */
?>
<?php if(isset($massage)): ?>
<div class="callout callout-info">
    <h4 style="text-transform: uppercase;">Success</h4>

    <p style="text-transform: capitalize;"><?= $massage ?></p>
</div>
<?php endif; ?>
<?php if(isset($error)): ?>
    <div class="callout callout-danger">
        <h4 style="text-transform: uppercase;">Warning!</h4>

        <p style="text-transform: capitalize;"><?= $error ?></p>
    </div>
<?php endif; ?>
<h1>All Users</h1>
<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <?php
                    $keys = array_keys($users[0]);
                    foreach ($keys as $key): ?>
                        <th><?= $key ?></th>
                    <?php endforeach; ?>
                <th>Controls</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $userdata): ?>
                    <tr>
                        <?php foreach ($userdata as $user): ?>
                            <td><?= $user ?></td>
                        <?php endforeach; ?>
                        <td>
                            <a href="/admin/users/show/<?= $userdata['id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a style="color: red" href="/admin/users/delete/<?= $userdata['id'] ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-6 ">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Add new user</h3>
            </div>
            <form method="post" action="/admin/users" class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input name="addUser" type="submit" class="btn btn-info" value="Add user">
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
