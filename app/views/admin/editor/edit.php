<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 27.10.2018
 * Time: 15:00
 */
$this->layout('admin::index', ['title' => 'Edit', 'edit' => true]); ?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit '<?= $template['name'] ?>' template</h3>
    </div>
    <div class="box-body pad">
        <form method="post" action="/admin/editor/update/<?= $template['id'] ?>">
            <div class="row">
<!--                --><?php //var_dump($template) ?>

                <?php foreach ($template['options'] as $option): ?>
                    <?php if (preg_match('/head[0-9]/', $option)): ?>
                    <div class="col-md-12 edit-marg">
                        <lable class="h3">Изменить Заголовок: </lable>
                        <input class="edit-header" name="<?= $option ?>" value="<?= $template['content'][$option] ?>" >
                    </div>
                    <?php endif; ?>
                    <?php if (preg_match('/text[0-9]/', $option)): ?>
                    <div class="col-md-12 edit-marg">
                        <lable class="h3">Изменить текст: </lable>
                        <textarea name="<?= $option ?>" class="edit-area edit-content"><?= $template['content'][$option] ?></textarea>
                    </div>
                    <?php endif; ?>
                    <?php if (preg_match('/btn[0-9]/', $option)): ?>
                    <div class="col-md-12 edit-marg">
                        <lable class="h3">Изменить текст кнопки: </lable>
                        <input class="edit-btn" type="text" name="<?= $option ?>" value="<?= $template['content'][$option] ?>">
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
            <input type="hidden" name="options" value="<?= implode(',',$template['options']) ?>">
            <input type="submit"  class="btn btn-primary" value="Update template">
        </form>
    </div>
</div>

