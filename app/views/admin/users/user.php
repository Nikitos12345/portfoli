<?php $this->layout('admin::index', ['title' => 'User Admin']);
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 22.10.2018
 * Time: 19:11
 */

?>
<h1>Hello admin</h1>
<div class="row">
    <div>
        <div class="col-md-4">
            <div class="box box-info" >
                <form method="post" action="<?php if($isAdmin) echo '/admin/users/update/'.$user['User id']; else echo '';?>" class="form-horizontal">
                    <div class="box-body">
                        <?php foreach ($user as $key => $item): ?>
                        <div class="form-group row">
                            <?php if($key == 'Roles'): ?>
                                <label class="col-sm-4 ">Roles: </label>
                                <div class="col-sm-8">
                                    <select name="rotes" class="form-control">
                                        <option <?= ($user['Roles'] != 'ADMIN') ?: 'selected'  ?>>Admin</option>
                                        <option <?= ($user["Roles"] != 'REVIEWER') ?: 'selected' ?>>Reviewer</option>
                                    </select>
                                </div>
                            <?php else: ?>
                                <label class="col-sm-4 "> <?= ($userColumn[$key]) ?: $key.': '?></label>
                                <?php if($key == 'enable'): ?>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="enable" value="<?= $item ?>">
                                    </div>
                                <?php else: ?>
                                    <div class="col-sm-8">
                                        <?= $item?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-4">Password: </label>

                            <div class="col-sm-8">
                                <input type="password" name="newPassword" class="form-control" id="inputPassword3" placeholder="New Password">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info">Update user</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
