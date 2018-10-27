<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 27.10.2018
 * Time: 14:06
 */

$this->layout('admin::index', ['title' => 'Editor']);
?>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <?php
                $keys = array_keys($temps[0]);
                foreach ($keys as $key): ?>
                    <th><?= $key ?></th>
                <?php endforeach; ?>
                <th>Controls</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($temps as $temp): ?>
                <tr>
                    <?php foreach ($temp as $val): ?>
                        <td><?= $val ?></td>
                    <?php endforeach; ?>
                    <td>
                        <a href="/admin/editor/edit/<?= $temp['id'] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


