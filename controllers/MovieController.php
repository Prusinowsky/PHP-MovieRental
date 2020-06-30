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
        // Pobranie filmów z bazy danych
        $movies = $db->query("SELECT * FROM `movies`");

        // Zwrócenie pełnego widoku filmów z bazą danych
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

        // Tablica na błędy
        $errors = [];

        // Pobranie wszystkich danych zewnętrznych do zmiennych
        $title = \input()->post('title');
        $description = \input()->post('description');
        $photo = \input()->file('photo', null);

        // Oczyszczanie tytutłu z niedozwolonych znaków
        $title = \filter_var($title, FILTER_SANITIZE_STRING);
        if(!$title) $errors[] = "Brak tytułu";

        // Oczyszczenie opisu z niedozwolonych znaków
        $description = \filter_var($description, FILTER_SANITIZE_STRING);
        if(!$description) $errors[] = "Brak opisu";
        
        // Sprawdzanie przesłanie obrazu powiodło się
        if($photo->hasError())
            $errors[] = "Nie przesłano zdjęcia";

        // Sprawdzenie czy obraz ma poprawne roszerzenie
        if(!in_array($photo->getExtension(),['jpg', 'jpeg',  'png']))
            $errors[] = "Nieprawidłowe rozszerzenie pliku: Powinno być .jpg, .jpeg, .png";
        
        // Przeniesienie obrazu do właściwego folderu 
        $photoPath = '/uploads/'.uniqid().'.'.$photo->getExtension();
        $result = $photo->move(APP_PUBLIC_PATH.$photoPath);

        global $db;
        if(!count($errors)){
            // Zapisanie do bazy danych
            $db->insert('movies', [
                'title' => $title,
                'description' => $description,
                'photo' => $photoPath
            ]);
            $id = $db->insertId();
            return \redirect(Router::getUrl('movie.edit', ['id' => $id]));
        }

        if(count($errors))
            // Wyświelnie formularza z informacją o błędach
            return view('movie/create.view.php', [
                'errors' => $errors
            ]);

        
    }

    /**
     * Metoda odpowiadająca za wyświetlenie edycji filmu
     */
    public function edit(){

        // Pobranie parametru id wpisu z URL
        $id = (int)\request()->getLoadedRoute()->getParameters('id')['id'];

        global $db;
        // Pobranie filmu z bazy danych
        $movie = $db->queryFirstRow("SELECT * FROM `movies` WHERE `id` = ".$id);

        // Zwrócenie widoku edycji 
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

        // Pobranie parametru id z URL
        $id = (int)\request()->getLoadedRoute()->getParameters('id')['id'];
        if($id <= 0) $errors[] = "Błędny identyfikator posta";

        // Pobranie tutułu z formularza i jego oczyszczenie
        $title = \input()->post('title');
        $title = \filter_var($title, FILTER_SANITIZE_STRING);
        if(!$title) $errors[] = "Brak tytułu";

        // Pobranie opisu z formularza i jego oczyszczenie
        $description = \input()->post('description');
        $description = \filter_var($description, FILTER_SANITIZE_STRING);
        if(!$description) $errors[] = "Brak opisu";

        // Pobranie przesłanego zdjęcia i zastąpienie starego
        $photo = \input()->file('photo', null);
        $photoPath = null;
        if(!$photo->hasError()){
            $photoPath = '/uploads/'.uniqid().'.'.$photo->getExtension();
            $result = $photo->move(APP_PUBLIC_PATH.$photoPath);
        }

        global $db;
        if(!count($errors)){
            // Aktualizacja wpisu w bazie danych
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

        // Pobranie wpisu ze zaktualizowanymi danymi
        $movie = $db->queryFirstRow("SELECT * FROM `movies` WHERE `id` = ".$id);

        if(count($errors))
            // Wyświetlenie ponownie formularza z pokazanymi błędami
            return view('movie/edit.view.php', [
                'id' => $id,
                'movie' => $movie,
                'errors' => $errors
            ]);
        else
            // Wyświetlenie widoku z komunikatem sukcesu 
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

        // Pobranie parametru id z URL
        $id = (int)\request()->getLoadedRoute()->getParameters('id')['id'];

        global $db;
        // Pobranie wpisu z bazy danych do usunięcia obrazu z dysku
        $movie = $db->queryFirstRow("SELECT * FROM `movies` WHERE `id` = ".$id);
        if(strlen($movie['photo'])) \unlink(APP_PUBLIC_PATH.$movie['photo']);

        // Usunięcie wpisu z bazy danych
        $result = $db->query("DELETE FROM `movies` WHERE `movies`.`id` = {$id}");

        // Przekierwoanie na stronę filmów
        return \redirect(Router::getUrl('movies'));
    }

}