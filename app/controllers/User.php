<?php

class User extends Controller{
    public function index() {
        if( isset($_SESSION['password']) ) {
            header('Location:' . URLROOT . '/pages/index');
        } else {
            header('Location:' . URLROOT . '/user/login');
        }
    }

    public function login() {
        $model = $this->model('User_model');
        $data = [
            'username' => '',
            'password' => '',
            'errorUsernameLogin' => '',
            'errorPasswordLogin' => ''
        ];

        //check and validate post
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'errorUsernameLogin' => '',
                'errorPasswordLogin' => ''
            ];

            //validate username
            if( empty($data['username'])) {
                $data['errorUsernameLogin'] = "*  Mohon masukan username!";
            }

            //validate password
            if( empty($data['password'])) {
                $data['errorPasswordLogin'] = "*  Mohon masukan password!";
            }

            //check if all error empty
            if( empty($data['errorPasswordLogin']) && empty($data['errorUsernameLogin'])) {
                $loggedinUser = $model->login($data['username'], $data['password']);
                if( $loggedinUser ) {
                    $this->createUserSession($loggedinUser);
                    header('location:' . URLROOT . '/pages/index' );
                } else if( !$loggedinUser ){
                    $data['errorPasswordLogin'] = "Password atau username yang anda masukan salah." ;

                    $this->view('user/login', $data);
                }
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'errorUsernameLogin' => '',
                'errorPasswordLogin' => ''
            ];
        }

        $this->view('templates/header');
        $this->view('user/login', $data);
        $this->view('templates/footer');
    }

    //logut
    public function logout() {
        session_unset();
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        header('Location:' . URLROOT . '/user/login');
    }

    //cretae user session
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];
    }

    //register method
    public function register() {
        $model = $this->model('User_model');
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmpassword' => '',
            'errorUsername' => '',
            'errorEmail' => '',
            'errorPassword' => '',
            'errorConfirmpassword' => ''
        ];

        //catching value from post and validate
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
           //sanitixe post data
        $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

        $data = [
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'confirmpassword' => trim($_POST['confirmpassword']),
            'errorUsername' => '',
            'errorEmail' => '',
            'errorPassword' => '',
            'errorConfirmpassword' => ''
        ];

        $nameValidation = "/^[a-zA-Z0-9]*$/";

        //validate username
        if( empty($data['username']) ) {
            $data['errorUsername'] = "Mohon mengisi username!";
        } else if( !preg_match($nameValidation, $data['username']) ) {
            $data['errorUsername'] = "*  Username hanya bisa diisi dengan karakter huruf dan angka";
        } else {
            if( $model->findUserByUsername($data['username']) ) {
                $data['errorUsername'] ='*  Username telah digunakan, silakan memilih username yang lain.';
            }
        }

        //validate  email
        if( empty($data['email']) ) {
            $data['errorEmail'] = "*  Mohon mengisi e-mail!";
        } else if( !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ) {
            $data['errorEmail'] = "*  Mohon masukan format e-mail dengan benar!";
        }

        //validate password
        if( empty($data['password']) ) {
            $data['errorPassword'] = "*  Mohon mengisi password!";
        } else if (strlen($data['password']) < 6) {
            $data['errorPassword'] = "*  Password harus diisi dengan minimal 7 karakter";
        }

        //validate confirm password
        if( empty($data['confirmpassword']) ) {
            $data['errorConfirmpassword'] = "*  Mohon mengisi konfirmasi password!";
        } else {
            if( $data['password'] != $data['confirmpassword'] ) {
            $data['errorConfirmpassword'] = "*  Konfirmasi password tidak sesuai";
        }
    }

    //check if error empty
    if ( empty($data['errorUsername']) && empty($data['errorEmail']) && empty($data['errorPassword']) && empty($data['errorConfirmpassword']) ){
        //hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        //register user
        if( $model->register($data) ) {
            header('Location:' . URLROOT . '/user/login');
        } else {
            die('something went wrong');
        }
    }
}

        $this->view('templates/header');
        $this->view('user/register', $data);
        $this->view('templates/footer');
    }

    
}