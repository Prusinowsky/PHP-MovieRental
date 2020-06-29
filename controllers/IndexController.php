<?php

namespace Controllers;

class IndexController {

    public function index(){
        global $db;
        $movies = $db->query("SELECT * FROM `movies`");
        return view('movie/index.view.php', [
            'movies' => $movies
        ]);
    }

}