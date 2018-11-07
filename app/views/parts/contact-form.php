<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 30.10.2018
 * Time: 17:27
 */ ?>
<section id="contact">
    <div class="contact">
        <div class="container">
            <div class="contact-text">
                <h2 class="contact-text__header color-white"><?= $content['head1'] ?></h2>
                <div class="contact-text__text color-white"><?= $content['text1'] ?></div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <form action="/" class="contact-form">
                        <div class="contact-form-group">
                            <input type="text" class="contact-form__half" placeholder="Your Name">
                            <input type="email" class="contact-form__half" placeholder="Your E-mail">
                            <input type="text" class="contact-form__text" placeholder="Your Massage">
                        </div>
                        <input type="submit" class="contact-form__btn btn-dark" value="<?= $content['btn1'] ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
