<?php

namespace Controllers;

use \Pecee\SimpleRouter\SimpleRouter as Router;

/**
 * Kontroler odpowiadającyza obsługę filmów
 */
class MovieController {

    /**
     * Metoda wyświetlająca wszystkie filmy z bazy danych
     */
    public function index(){
        global $db;
        $movies = $db->query("SELECT * FROM `movies`");

        return view('movie/index.view.php', [
            'movies' => $movies
        ]);
    }

    /**
     * Metoda pokazująca formularz do stworzenia nowego wpisu do bazy danych
     */
    public function create(){
        return view('movie/create.view.php');
    }

    /**
     * Metoda odpowiadająca za zapisanie nowego filmu do bazy danych
     */
    public function store(){
        $title = \input()->post('title');
        $description = \input()->post('description');
        $photo = \input()->file('photo', null);
        $errors = [];

        $title = \filter_var($title, FILTER_SANITIZE_STRING);
        if(!$title) $errors[] = "Brak tytułu";

        $description = \filter_var($description, FILTER_SANITIZE_STRING);
        if(!$description) $errors[] = "Brak opisu";
        
        if($photo->hasError())
            $errors[] = "Nie przesłano zdjęcia";

        if(!in_array($photo->getExtension(),['jpg', 'jpeg',  'png']))
            $errors[] = "Nieprawidłowe rozszerzenie pliku: Powinno być .jpg, .jpeg, .png";
        
        $photoPath = '/uploads/'.uniqid().'.'.$photo->getExtension();
        $result = $photo->move(APP_PUBLIC_PATH.$photoPath);

        global $db;
        if(!count($errors)){
            $db->insert('movies', [
                'title' => $title,
                'description' => $description,
                'photo' => $photoPath
            ]);
            $id = $db->insertId();
            return \redirect(Router::getUrl('movie.edit', ['id' => $id]));
        }

        if(count($errors))
            return view('movie/create.view.php', [
                'errors' => $errors
            ]);

        
    }

    /**
     * Metoda odpowiadająca za wyświetlenie edycji filmu
     */
    public function edit(){
        $id = (int)\request()->getLoadedRoute()->getParameters('id')['id'];

        global $db;
        $movie = $db->queryFirstRow("SELECT * FROM `movies` WHERE `id` = ".$id);

        return view('movie/edit.view.php', [
            'id' => $id,
            'movie' => $movie
        ]);
    }

    /**
     * Metoda odpowiadająca za edycję wpisu w bazie danych
     */
    public function update(){
        $errors = [];
        $success = [];
        $id = (int)\request()->getLoadedRoute()->getParameters('id')['id'];
        if($id <= 0) $errors[] = "Błędny identyfikator posta";

        $title = \input()->post('title');
        $title = \filter_var($title, FILTER_SANITIZE_STRING);
        if(!$title) $errors[] = "Brak tytułu";

        $description = \input()->post('description');
        $description = \filter_var($description, FILTER_SANITIZE_STRING);
        if(!$description) $errors[] = "Brak opisu";

        $photo = \input()->file('photo', null);
        $photoPath = null;
        if(!$photo->hasError()){
            $photoPath = '/uploads/'.uniqid().'.'.$photo->getExtension();
            $result = $photo->move(APP_PUBLIC_PATH.$photoPath);
        }

        global $db;
        if(!count($errors)){
            $db->update('movies', \array_merge([
                'title' => $title,
                'description' => $description
                ], $photoPath !== null ? 
                [
                    'photo' => $photoPath
                    ] : 
                []
            ), "id=%d", $id);
            $success[] = "Zapisano!";
        }

        global $db;
        $movie = $db->queryFirstRow("SELECT * FROM `movies` WHERE `id` = ".$id);

        if(count($errors))
            return view('movie/edit.view.php', [
                'id' => $id,
                'movie' => $movie,
                'errors' => $errors
            ]);
        else
            return view('movie/edit.view.php', [
                'id' => $id,
                'movie' => $movie,
                'sucess' => $success
            ]);    
    }

    /**
     * Metoda odpowaidająca za usuwanie filmu z bazy danych wraz z jego grafiką
     */
    public function destroy(){
        $id = (int)\request()->getLoadedRoute()->getParameters('id')['id'];

        global $db;
        $movie = $db->queryFirstRow("SELECT * FROM `movies` WHERE `id` = ".$id);
        if(strlen($movie['photo'])) \unlink(APP_PUBLIC_PATH.$movie['photo']);

        $result = $db->query("DELETE FROM `movies` WHERE `movies`.`id` = {$id}");

        return \redirect(Router::getUrl('movies'));
    }

}