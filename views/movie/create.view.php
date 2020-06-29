<html>
    <head>
        <?php view_include('global/head.view.php') ?>
    </head>
    <body>
        <?php view_include('global/navbar.view.php'); ?>
        <div class="mr-header mt-5 d-block container">
            <div class="mr-header">
            <h1>Dodaj</h1>
                <p>Wypełnij formularz aby dodać film.</p>
            </div>
            <form action="/movie" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Tytuł</label>
                    <input class="form-control" id="title" name="title" type="text" placeholder="Tytuł">
                </div>
                <div class="form-group">
                    <label for="description">Opis filmu</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="photo">Wybierz zdjęcie</label>
                    <input type="file" class="form-control-file" name="photo" id="photo">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Wyślij</button>
            </form>
        </div>
    </body>
</html>
  