<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://site/assets/style/bootstrap-grid.css">
    <link rel="stylesheet" href="http://site/assets/style/fontawesome.css">
    <link rel="stylesheet" href="http://site/assets/style/scss.min.css">

    <title>Document</title>
</head>
<body>
<?php echo "<div>$error</div>" ?>
<div class="wrapper">
    <header>
        <div class="scroll-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 col-lg-6 logo"><a href="/"><img src="http://site/assets/img/logo.png" alt=""></a></div>
                    <div class="col-md-12 col-lg-6 text-center">
                        <nav>
                            <ul id="topmenu" class="nav">
                                <li class="active nav-item"><a href="#" class="nav-link" data-scroll>Home</a></li>
                                <li class="nav-item"><a href="#service" class="nav-link" data-scroll>Service</a></li>
                                <li class="nav-item"><a href="#portfolio" class="nav-link" data-scroll>Portfolio</a></li>
                                <li class="nav-item"><a href="#about" class="nav-link" data-scroll>About</a></li>
                                <li class="nav-item"><a href="#contact" class="nav-link" data-scroll>Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php
    if(isset($parts)){
        foreach ($parts as $key => $part){
            $this->insert("parts::".$part, ['content' => $content[$key]]);
        }
    } else $this->section('content');
    ?>
</div>
<footer>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-3 col-sm-6">
                <div class="footer-block">
                    <p class="footer-block__text">Lorem ipsum dolor sit.</p>
                    <p class="footer-block__text">Lorem ipsum dolor sit amet.</p>
                    <p class="footer-block__text">+1333332323</p>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p class="copyright__text">&copy; 2017 - <a href="#" title="Дэзмонд?">Zoom</a></p>
    </div>
</footer>
<script src="http://site/assets/js/jquery-3.3.1.min.js"></script>
<script src="http://site/assets/js/smooth-scroll.polyfills.min.js"></script>
<script src="http://site/assets/js/script.js"></script>
</body>
</html>