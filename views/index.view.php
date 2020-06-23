<html>
    <head>
        <title>Movie Rental</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php view_include("navbar.view.php"); ?>
        <div class="mr-header mt-5 d-block container">
            <div class="mr-header">
                <h1>Witaj, <?php echo $name; ?>! </h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium cumque, consequuntur culpa quisquam delectus perspiciatis molestiae nam nesciunt. Fugit assumenda suscipit saepe odit sunt, culpa molestias! Tempora molestiae quas harum?</p>
            </div>
            <div class="mr-movies d-flex justify-content-center flex-wrap">
                <?php foreach([1,2,3,4,5,6,7,8,9] as $key) : ?>
                <div class="mr-movie card m-2" style="width: 18rem;">
                    <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
  