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
        <div class="stable-block">
            <img src="http://site/assets/admin/img/header.jpg" alt="">
            <div class="links">
                <a href="/admin/editor/edit/<?= $temp['id'] ?>" class="btn btn-primary btn-lg">Edit</a>
            </div>
        </div>
        <ul id="templates">
            <?php foreach ($temps as $temp): ?>
                <li data-name = "<?= $temp['name'] ?>">
                    <img src="http://site/assets/admin/img/<?= $temp['image']?>" alt="">
                    <div class="links">
                        <a href="/admin/editor/edit/<?= $temp['id'] ?>" class="btn btn-primary btn-lg">Edit</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="stable-block sb-footer">
            <img src="http://site/assets/admin/img/footer.jpg" alt="">
            <div class="links">
                <a href="/admin/editor/edit/<?= $temp['id'] ?>" class="btn btn-primary btn-lg">Edit</a>
            </div>
        </div>
        <form action="/admin/editor/update-parts" method="post">
            <input name="order" type="hidden" id="parts" value="">
            <input value="Сохранить" type="submit" id="updater" class="btn btn-info btn-lg">
        </form>
    </div>
</div>