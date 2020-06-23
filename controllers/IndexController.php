<?php

namespace Controllers;

class IndexController {

    public function index(){
        return view('index.view.php', [
            'name' => "Patryk"
        ]);
    }

    public function show(){
        return view('index.view.php', [
            'name' => "Patryk"
        ]);
    }
    
}