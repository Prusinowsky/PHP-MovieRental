<?php 
    use Pecee\SimpleRouter\SimpleRouter as Router;
?>

<html>
    <head>
        <?php view_include('global/head.view.php') ?>
    </head>
    <body>
        <?php view_include('global/navbar.view.php'); ?>
        <div class="mr-header mt-5 d-block container">
            <div class="mr-header">
                <h1>Witaj! </h1>
                <p>Sprawdź nasze filmy, które możesz u nas wypożyczyć. Jest ich trochę, możesz znaleźć je niżej.</p>
            </div>
            <div class="mr-movies d-flex justify-content-center flex-wrap">
                <?php foreach($movies as $key => $movie) : ?>
                <div class="mr-movie card m-2" style="width: 18rem;">
                    <img src="<?php echo $movie['photo'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $movie['title'] ?></h5>
                        <p class="card-text"><?php echo $movie['description'] ?></p>
                        <a href="#" class="btn btn-sm btn-primary">Wypożycz</a>
                        <a href="<?php echo Router::getUrl('movie.edit', ['id' => $movie['id']]); ?>" class="btn btn-sm btn-success">Edytuj</a>
                        <a href="<?php echo Router::getUrl('movie.delete', ['id' => $movie['id']]); ?>" class="btn btn-sm btn-danger">Usuń</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
  