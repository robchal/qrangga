<?php

class Gallery extends Controller {
    private $idFolder;

    public function index($data = []) {
        if( empty($data) ) {
            $dataFolder = $this->model('Gallery_model')->getList(1);
            $this->idFolder = $this->model('Gallery_model')->getUserAndIdFolder(1);
            if( !$dataFolder) {
                $dataFolder = [];
            }
        } else if( !empty($data) ) {
            $dataFolder = $this->model('Gallery_model')->getList($data);
            $this->idFolder = $this->model('Gallery_model')->getUserAndIdFolder($data);
            if( !$dataFolder) {
                $dataFolder = [];
            }
        }
        
        $galleryList = $this->model('Gallery_model')->getFolder();
        $this->view('templates/header');
        $this->view('templates/navbar');
        $this->view('gallery/index', $galleryList, $dataFolder, $this->idFolder);
        $this->view('templates/footer');
    }

    public function addFolder() {
        $model = $this->model('Gallery_model')->addFolder($_POST);
        if( $model ) {
            header('Location:' . URLROOT . '/gallery/index');
        }else {
            header('Location:' . URLROOT . '/gallery/index');
        }
    }

    public function tambahGambar() {
        $gambarUpload = $this->imgFilter($_FILES['fotoGallery']);
        if( !$gambarUpload ) {
            header('Location:' . URLROOT . '/Gallery/index/' . $_POST['id_folder']);
        }
        if( $gambarUpload ) {
            $model = $this->model('Gallery_model')->storeImg($_POST, $gambarUpload);
            if ( $model ) {
                header('Location:' . URLROOT . '/Gallery/index/' . $_POST['id_folder']);
            } else if( !$model ) {
                header('Location:' . URLROOT . '/Gallery/index/' . $_POST['id_folder']);
            }
        }

    }

    public function imgFilter($file) {
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

        move_uploaded_file($tmpName, 'Gallery/' . $namaFile);

        return $namaFile;
    }
}