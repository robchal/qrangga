<?php

class Pages extends Controller {
    
    public function index() {
        $this->view('templates/header');
        $this->view('templates/navbar');
        $this->view('Pages/index');
        $this->view('templates/footer');
    }
    public function __construct() {
        if( !isset($_SESSION['password'])) {
            header('Location:' . URLROOT . '/user/index');
        }
    }
    public function about() {
        echo "About/page";
    }

    
}