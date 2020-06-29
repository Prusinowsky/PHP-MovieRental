<?php 
    use Pecee\SimpleRouter\SimpleRouter as Router;
?>

<!-- Plik zawierający formularz edycji nowego wpisu do bazy danych filmu -->

<html>
    <head>
        <?php view_include('global/head.view.php') ?>
    </head>
    <body>
        <?php view_include('global/navbar.view.php'); ?>
        <div class="mr-header mt-5 d-block container">
            <div class="mr-header">
            <h1>Edytuj</h1>
                <p>Wypełnij formularz aby edytować film.</p>
            </div>
            <?php // Success ?>
            <?php $successes = isset($successes) ? $successes : []; ?>
            <?php foreach($successes as $success): ?>
                <div class="alert alert-succes" role="alert"><?php echo $success ?></div>
            <?php endforeach; ?>
            <?php // Errors ?>
            <?php $errors = isset($errors) ? $errors : []; ?>
            <?php foreach($errors as $error): ?>
                <div class="alert alert-warning" role="alert"><?php echo $error ?></div>
            <?php endforeach; ?>
            <form action="<?php echo Router::getUrl('movie.update', ['id' => $id]); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Tytuł</label>
                    <input class="form-control" id="title" name="title" type="text" placeholder="Tytuł" value="<?php echo $movie['title'] ?>">
                </div>
                <div class="form-group">
                    <label for="description">Opis filmu</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $movie['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <img class="img-thumbnail" src="<?php echo $movie['photo'] ?>"/><p>&nbsp;</p>
                    <label for="photo">Wybierz zdjęcie</label>
                    <input type="file" class="form-control-file" name="photo" id="photo">
                </div>
                <button type="submit" class="btn btn-success btn-block">Zapisz</button>
            </form>
        </div>
    </body>
</html>