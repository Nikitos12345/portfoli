<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 26.10.2018
 * Time: 18:07
 */
$this->layout('forms::AuthForm',  ['title' => 'Success']); ?>
<div class="callout callout-danger">
    <h4 style="text-transform: uppercase;">Warning!</h4>

    <p style="text-transform: capitalize;"><?= \App\models\UserModel::$massage ?></p>
    <a href="/" class="btn btn-success">Return to homepage</a>
</div>
