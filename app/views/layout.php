<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/style/bootstrap-grid.css">
    <link rel="stylesheet" href="/assets/style/fontawesome.css">
    <link rel="stylesheet" href="/assets/style/scss.min.css">

    <title>Document</title>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-6 logo"><a href="/"><img src="img/logo.png" alt=""></a></div>
                <div class="col-md-12 col-lg-6 text-center">
                    <nav>
                        <ul id="topmenu" class="nav">
                            <li class="active nav-item"><a href="#" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="#service" class="nav-link">Service</a></li>
                            <li class="nav-item"><a href="#portfolio" class="nav-link">Portfolio</a></li>
                            <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                            <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <?php
    if(isset($parts)){
        foreach ($parts as $part){
            $this->insert("parts::".$part);
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
<sript src="js/bootstrap.min.js"></sript>
<sript src="js/isotope.min.js"></sript>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<sript src="js/script.js"></sript>
</body>
</html>