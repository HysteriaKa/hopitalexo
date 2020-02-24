<?php
include_once 'head.php'
?>

</head>

<body>

    <?php
    include_once 'navbar.php'
    ?>
    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/greynulle.jpg" class="d-block w-80" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/mamour.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/glam.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/docka.JPG" class="d-block w-70" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <?php
    include_once 'bootstrap.php'
    ?>
</body>
<?php
    include_once 'footer.php'
    ?>
</html>