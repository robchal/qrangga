<?php

class Gallery_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getFolder() {
        $this->db->query("SELECT * FROM gallery");
        $row = $this->db->resultSet();
        return $row;
    }

    public function addFolder($data) {
        $this->db->query("INSERT INTO gallery (id_folder, folder_name, folder_maker) VALUES (:id_folder, :folder_name, :folder_maker)");
        $this->db->bind(':id_folder', '');
        $this->db->bind(':folder_name', $data['folder_name']);
        $this->db->bind(':folder_maker', $data['folder_maker']);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function getList($data) {
        $this->db->query("SELECT * FROM gallery_detail WHERE id_folder = :id_folder");
        $this->db->bind(':id_folder', $data);
        $row = $this->db->resultSet();
        return $row;
    }

    public function getUserAndIdFolder($data) {
        $this->db->query("SELECT * FROM gallery WHERE id_folder = :id_folder");
        $this->db->bind(':id_folder', $data);
        $row = $this->db->singleSet();
        return $row;
    }

    public function storeImg($post, $gambar) {
        $this->db->query("INSERT INTO gallery_detail (id_folder, id_img, img_name, img_sender) VALUES (:id_folder, :id_img, :img_name, :img_sender)");

        $this->db->bind(':id_folder', $post['id_folder']);
        $this->db->bind(':id_img', '');
        $this->db->bind(':img_name', $gambar);
        $this->db->bind(':img_sender', $post['img_sender']);

        $this->db->execute();
        return $this->db->rowCount() > 0;
    }
}