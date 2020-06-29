<?php

namespace Controllers;

/**
 * Główny kontroler odpowiadający za główną funkcjonalność aplikacji
 */
class IndexController {

    /**
     * Główna metoda, wyświetlająca w naszyp przypadku wszystki filmy z bazy danych
     */
    public function index(){
        global $db;
        $movies = $db->query("SELECT * FROM `movies`");
        return view('movie/index.view.php', [
            'movies' => $movies
        ]);
    }

}