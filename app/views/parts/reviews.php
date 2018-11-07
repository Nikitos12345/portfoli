<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 30.10.2018
 * Time: 17:26
 */ ?>
<section id="reviews">
    <div class="reviews container">
        <div class="reviews-text">
            <h2 class="reviews-text__header"><?= $content['head1'] ?></h2>
            <div class="reviews-text__text"><?= $content['text1'] ?></div>
        </div>
        <div class="reviews-block row">
            <div class="col-sm-4">
                <div class="reviews-block-elem">
                    <h3 class="color-white reviews-block-elem__header"><?= $content['head2'] ?></h3>
                    <div class="reviews-block-elem__text">
                        <?= $content['text2'] ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="reviews-block-elem">
                    <h3 class="color-white reviews-block-elem__header"><?= $content['head3'] ?></h3>
                    <div class="reviews-block-elem__text">
                        <?= $content['text3'] ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="reviews-block-elem">
                    <h3 class="color-white reviews-block-elem__header"><?= $content['head4'] ?></h3>
                    <div class="reviews-block-elem__text">
                        <?= $content['text4'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
