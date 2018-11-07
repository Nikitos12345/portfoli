<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 30.10.2018
 * Time: 16:20
 */ ?>
<section id="service">
    <div  class="service">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="service-item"><i class="far fa-lightbulb"></i></div>
                    <?= $content['text1'] ?>
                </div>
                <div class="col-6 col-md-3">
                    <div class="service-item"><i class="fas fa-pencil-alt"></i></div>
                    <?= $content['text2'] ?>
                </div>
                <div class="col-6 col-md-3">
                    <div class="service-item"><i class="fas fa-cog"></i></div>
                    <?= $content['text3'] ?>
                </div>
                <div class="col-6 col-md-3">
                    <div class="service-item"><i class="fas fa-camera"></i></div>
                    <?= $content['text4'] ?>
                </div>
            </div>
            <button class="btn-red"><?= $content['btn1'] ?></button>
        </div>
    </div>
</section>
