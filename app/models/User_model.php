<?php
class User_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findUserByUsername($username) {
        $this->db->query("SELECT * FROM users WHERE username = :username");

        $this->db->bind(':username', $username);
        $this->db->singleSet();
        return $this->db->rowCount() > 0;
    }

    public function register($data) {
        $this->db->query("INSERT INTO users (username, email, password) VALUES(:username, :email, :password)");

        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        $this->db->execute();
        return $this->db->rowCount() > 0;
    }  
    
    public function login($username, $password) {
        $this->db->query("SELECT * FROM users WHERE username = :username");

        $this->db->bind(':username', $username);

        $row = $this->db->singleSet();
        $hashedPass = $row['password'];

        if( $row ) {
            if( password_verify ($password, $hashedPass) == true ) {
                return $row;
            } else {
                return false;
            }
        }else {
            return false;
        }
    }

}

