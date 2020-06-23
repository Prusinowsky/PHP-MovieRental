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

    public function show($id){
        return view('movie/show.view.php', [
            'id' => intval($id)
        ]);
    }
    

    public function edit($id){
        return view('movie/edit.view.php');
    }

    public function delete($id){
        return view('movie/delete.view.php');
    }

}