<?php

class Forum extends Controller{
    private $room_id;

    public function index($data = [], $status = []) {
        if( empty($data) ) {
            $data_chat = $this->model('Forum_model')->getChat(1);
            $this->room_id = $this->model('Forum_model')->getUserAndIdRoom(1);
            if( !$data_chat ) {
                $data_chat = [];
            }
        }else if( !empty($data) ) {
            $data_chat = $this->model('Forum_model')->getChat($data);
            $this->room_id = $this->model('Forum_model')->getUserAndIdRoom($data);
            if( !$data_chat ) {
                $data_chat = [];
            }            
        }

        $room = $this->model('Forum_model')->roomList();
        
        $this->view('templates/header');
        $this->view('templates/navbar');
        $this->view('forum/index', $room, $data_chat, $this->room_id);
        $this->view('templates/footer');
    }

    public function addRoom() {
        $model = $this->model('Forum_model')->insertRoom($_POST);
        if( $model) {
            header('Location:' . URLROOT . '/forum/index/' . 1);
        } else if( !$model) {
            header('Location:' . URLROOT . '/forum/index');
        }
    }

    public function addChat() {
        $gambarUpload = $this->chatGambar($_FILES['gambar']);

        $model = $this->model('Forum_model')->storeChat($_POST, $gambarUpload);
        if ( $model ) {
            header('Location:' . URLROOT . '/forum/index/' . $_POST['id_room']);
        } else if( !$model ) {
            header('Location:' . URLROOT . '/forum/index/' . $_POST['id_room']);
        }

    }

    public function chatGambar($file) {
        $namaFile = $file['name'];
        $error = $file['error'];
        $tmpName = $file['tmp_name'];

        if($error > 0) {
            return false;
        }

        $validExt = ['jpg','jpeg','png',];
        $fileExt = explode('.', $namaFile);
        $fileExt = strtolower(end($fileExt));
        if( !in_array($fileExt, $validExt) ) {
            return false;
        }
        
        $namaFile = uniqid() . '.' . $fileExt;

        move_uploaded_file($tmpName, 'img/' . $namaFile);

        return $namaFile;
    }

    public function hapusRoom($data) {
        $model = $this->model('Forum_model')->deleteRoom($data);
        $modelChat = $this->model('Forum_model')->deleteRoomFromChatDetail($data);
        if ( $model ) {
            header('Location:' . URLROOT . '/forum');
        }
    }
}