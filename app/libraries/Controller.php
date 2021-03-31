<?php

class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $data = [], $data2 = [], $roomDetail = []) {
        if( file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("Views did not exist");
        }
    }
}