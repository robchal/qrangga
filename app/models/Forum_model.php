<?php

class Forum_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function insertRoom($data) {
        $judul = $_POST['judul_room'];
        $maker = $_POST['room_maker'];

        $sql = "INSERT INTO room_chat (room_title, room_maker) VALUES(:room_title, :room_maker)";
        $this->db->query($sql);

        $this->db->bind(':room_title', $judul);
        $this->db->bind(':room_maker', $maker);

        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function roomList() {
        $this->db->query("SELECT * FROM room_chat");
        $row = $this->db->resultSet();
        return $row;
    }

    public function getChat($data) {
        $this->db->query("SELECT * FROM chat_detail WHERE id_room = :id_room ORDER BY id_chat DESC");

        $this->db->bind(':id_room', $data);
        $row = $this->db->resultSet();
        return $row;
    }

    public function storeChat($data, $img) {
        $chatType = '';
        if( strlen($data['chat-content']) < 1 && $img !== false) {
            $chatType = 'image';
        }
        if( strlen($data['chat-content']) > 0 && $img !== false) {
            $chatType = 'mix';
        }
        if(strlen($data['chat-content']) > 1 && $img === false ) {
            $chatType = 'string';
            $img = '';
        }
        if(strlen($data['chat-content']) < 1 && $img === false ) {
            return false;
        }

        $this->db->query("INSERT INTO chat_detail (id_room, id_chat, chat_content, 	gambar_content, type, sender) VALUES (:id_room, :id_chat, :chat_content, :gambar_content, :type, :sender)");

        $this->db->bind(':id_room', $data['id_room']);
        $this->db->bind(':id_chat', '');
        $this->db->bind(':chat_content', $data['chat-content']);
        $this->db->bind(':gambar_content', $img);
        $this->db->bind(':type', $chatType);
        $this->db->bind(':sender', $data['chat_sender']);

        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function getUserAndIdRoom($data) {
        $this->db->query("SELECT id_room, room_maker FROM room_chat WHERE id_room = :id_room");

        $this->db->bind(':id_room',$data);
        $row = $this->db->singleSet();
        return $row;
    }

    public function deleteRoom($data) {
        $this->db->query("DELETE FROM room_chat WHERE id_room = :id_room");
        $this->db->bind('id_room', $data);

        $this->db->execute();
        return $this->db->rowCount() > 0 ;
    }

    public function deleteRoomFromChatDetail($data) {
        $this->db->query("DELETE FROM chat_detail WHERE id_room = :id_room");
        $this->db->bind('id_room', $data);

        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

}