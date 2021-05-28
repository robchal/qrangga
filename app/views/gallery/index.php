<div class="gallery-manager">
    <aside class="chat-list">
    <div class="arrow-slide">
        <div class="chat-logo"><h4>Gallery</h4></div>
        <img class='arrow-img' src="<?= URLROOT ?>/public/assets/arrow-icon.svg" alt="">
    </div> 

        <ul class='room-name'>
            <div class="btn-addRoom">
                <h4>Buat Folder</h4>
                <img src="<?= URLROOT ?>/public/assets/add-icon.svg" alt="">
            </div>
            <?php foreach($data as $d) : ?>
            <li>
                <img class='chat-icon'src="<?= URLROOT ?>/public/assets/folder-icon.svg" alt="">
                <a href="<?= URLROOT ?>/gallery/index/<?= $d['id_folder'] ?>"> <?= $d['folder_name'] ?> </a>
                
            </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <div class="gallery-body">
            <div class="inp-gambar">
                <form action="<?= URLROOT ?>/gallery/tambahGambar" method='post' enctype="multipart/form-data">
                    <input type="hidden" name="id_folder" value="<?= $roomDetail['id_folder'] ?>">
                    <input type="hidden" name="img_sender" value="<?= $_SESSION['username'] ?>">
                    <label for="inp-img">Upload gambar</label>
                    <input type="file" name="fotoGallery" id="inp-img">
                    <button type='submit' name='submit'>Tambah foto</button>
                </form>
            </div>

            <div class="list-gambar">
                <?php foreach($data2 as $d2) : ?>
                    <img src="<?= URLROOT ?>/Gallery/<?= $d2['img_name'] ?>" alt="">
                <?php endforeach ; ?> 
            </div>
    </div>

        <!-- make folder -->
    <div class="make-room">
        <div class="buat-close">
        <p class='close-icon'>X</p>
        <p class='room-desc'>You can make your own folder here</p>
            <div class="form-addRoom">
                <form action="<?= URLROOT ?>/gallery/addFolder" method='post'>
                    <input type="hidden" name="id_folder">
                    <input type="text" name="folder_name" id="judul_room" placeholder='masukan judul folder...'>
                    <input type="hidden" name="folder_maker" value="<?= $_SESSION['username']?>">
                    <button type='submit' name='buat-folder'>Buat folder</button>
                </form>
            </div>
        </div>
    </div>

</div>
