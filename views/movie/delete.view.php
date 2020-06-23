<html>
    <head>
        <?php view_include('global/head.view.php') ?>
    </head>
    <body>
        <?php view_include('global/navbar.view.php'); ?>
        <div class="mr-header mt-5 d-block container">
            <div class="mr-header">
                <h1>Witaj, <?php echo $name; ?>! </h1>
                <p>Sprawdź nasze filmy, które możesz u nas wypożyczyć. Jest ich trochę, możesz znaleźć je niżej.</p>
            </div>
            <div class="mr-movies d-flex justify-content-center flex-wrap">
                <?php foreach([1,2,3,4,5,6,7,8,9, 10] as $key) : ?>
                <div class="mr-movie card m-2" style="width: 18rem;">
                    <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Tytuł filmu</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Wypożycz</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
  