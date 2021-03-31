<div class="forum-manager">
    <aside class="chat-list">
    <div class="arrow-slide">
        <div class="chat-logo"><h4>Room Chat</h4></div>
        <img class='arrow-img' src="<?= URLROOT ?>/public/assets/arrow-icon.svg" alt="">
    </div>
        <ul class='room-name'>
            
            <div class="btn-addRoom">
                <h4>Buat room</h4>
                <img src="<?= URLROOT ?>/public/assets/add-icon.svg" alt="">
            </div>
            <?php foreach($data as $d) : ?>
            <li>
                <img class='chat-icon'src="<?= URLROOT ?>/public/assets/chat-icon.svg" alt="">
                <a href="<?= URLROOT ?>/forum/index/<?= $d['id_room'] ?>"><?= $d['room_title'] ?></a>
                
            </li>
            <?php endforeach; ?>
        </ul>
    </aside>


    <div class="chat-room">
            <div class="dltRoomCont">
                <h4>Ketik pesan disini</h4>
                <?php if( $roomDetail['room_maker'] == $_SESSION['username']) : ?>
                        <img class='delete-icon' src="<?= URLROOT ?>/public/assets/trash-icon.svg" alt="">
                        <div class="delete-room">
                            <p>Hapus room ?</p>
                            <div class="delete-roomBtn">
                                <button class='dlt-btn'><a href="<?= URLROOT ?>/forum/hapusRoom/<?= $roomDetail['id_room']?>">Hapus</a></button>
                                <button class='back-dlt'>Kembali</button>
                            </div>
                        </div>
                    <?php endif ; ?>
            </div>
            
        <form action="<?= URLROOT ?>/forum/addChat" method='post' enctype="multipart/form-data">
            <div class="chat-inp">
            <div class="inp-field">
            <input type="hidden" name="id_room" value="<?= $roomDetail['id_room'] ?>">
                <input type="hidden" name="chat_sender" value="<?= $_SESSION['username']?>">
                <textarea name="chat-content" id="chat-content" cols="30" rows="10"></textarea>
                <input class="file-input" type="file" name="gambar" id="">   
            </div>
            <button type='submit' name='send_chat'> Kirim </button>
            </div>
        </form>   

        <div class="chat-body">
        <?php foreach($data2 as $d2) : ?>
            <?php if( $d2['sender'] == $_SESSION['username']) :?>
            <?php if( $d2['type'] == 'string') : ?>
                    <div class="chat-send user">
                        <h5><?= $d2['sender'] ?></h5>
                        <p><?= $d2['chat_content'] ?></p>
                    </div>
            <?php elseif( $d2['type'] == 'image') : ?>
                    <div class="chat-send user img-send">
                        <h5><?= $d2['sender'] ?></h5>
                        <img src="<?= URLROOT ?>/img/<?= $d2['gambar_content']?>" alt="">
                    </div>  
            <?php elseif( $d2['type'] == 'mix') : ?>
                    <div class="chat-send user img-send">
                        <h5><?= $d2['sender'] ?></h5>
                        <p><?= $d2['chat_content'] ?></p>
                        <img src="<?= URLROOT ?>/img/<?= $d2['gambar_content']?>" alt="">
                    </div>  
            <?php endif; ?> 
            <?php elseif( $d2['sender'] !== $_SESSION['username'] )  :?>
                <?php if( $d2['type'] == 'string') : ?>
                    <div class="chat-send">
                        <h5><?= $d2['sender'] ?></h5>
                        <p><?= $d2['chat_content'] ?></p>
                    </div>
            <?php elseif( $d2['type'] == 'image') : ?>
                    <div class="chat-send img-send">
                        <h5><?= $d2['sender'] ?></h5>
                        <img src="<?= URLROOT ?>/img/<?= $d2['gambar_content']?>" alt="">
                    </div>  
            <?php elseif( $d2['type'] == 'mix') : ?>
                    <div class="chat-send img-send">
                        <h5><?= $d2['sender'] ?></h5>
                        <p><?= $d2['chat_content'] ?></p>
                        <img src="<?= URLROOT ?>/img/<?= $d2['gambar_content']?>" alt="">
                    </div>  
            <?php endif; ?> 
            <?php endif ; ?>
            
        <?php endforeach ; ?>
        </div>       
    </div>
    
    <div class="make-room">
    <div class="buat-close">
    <p class='close-icon'>X</p>
    <p class='room-desc'>You can make your own chat room here</p>
        <div class="form-addRoom">
            <form action="<?= URLROOT ?>/forum/addRoom" method='post'>
                <input type="hidden" name="id_room">
                <input type="text" name="judul_room" id="judul_room" placeholder='masukan nama room'>
                <input type="hidden" name="room_maker" value="<?= $_SESSION['username']?>">
                <button type='submit' name='buat-room'>Buat Room</button>
            </form>
        </div>
    </div>
    </div>

</div>

