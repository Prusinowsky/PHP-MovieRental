<?php

namespace Controllers;

use \Pecee\SimpleRouter\SimpleRouter as Router;

class MovieController {

    public function index(){
        global $db;
        $movies = $db->query("SELECT * FROM `movies`");

        return view('movie/index.view.php', [
            'movies' => $movies
        ]);
    }

    public function create(){
        return view('movie/create.view.php');
    }

    public function store(){
        $title = \input()->post('title');
        $description = \input()->post('description');
        $photo = \input()->file('photo');
        
        $title = \filter_var($title, FILTER_SANITIZE_STRING);
        $description = \filter_var($description, FILTER_SANITIZE_STRING);
        
        if($title && $description && in_array($photo->getExtension(),['jpg', 'jpeg',  'png'])){

            $photoPath = '/uploads/'.uniqid().'.'.$photo->getExtension();
            $success = $photo->move(APP_PUBLIC_PATH.$photoPath);

            if(!$success) 
                return 'Nie dodano!';

            global $db;
            $db->insert('movies', [
                'title' => $title,
                'description' => $description,
                'photo' => $photoPath
            ]);

            return \redirect(Router::getUrl('movies'));

        }

        return 'Nie dodano!';
    }


}