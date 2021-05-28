//styling navbar
const link = document.querySelectorAll('.nav-ul a');
for(let a of link) {
    if(a.href == document.location.href) {
        a.classList.add('active-nav');
    }
}

//styling navbar translate
const navul = document.querySelector('.nav-ul')
if( navul ) {    
    const toggle = document.querySelector('.menu-toggle')
        toggle.addEventListener('click', () => {
            navul.classList.toggle('slide')
        })
}


//addRoom toggle 
const makeRoom = document.querySelector('.make-room');

if( makeRoom) {
    
    const btnAddRoom = document.querySelector('.btn-addRoom');
        btnAddRoom.addEventListener('click', function() {
            makeRoom.classList.toggle('down-slide');
        })
    const closeIcon = document.querySelector('.close-icon');
        closeIcon.addEventListener('click', function() {
            makeRoom.classList.toggle('down-slide');
        })  
}




//delete room
const deleteRoom = document.querySelector('.delete-room');

if ( deleteRoom ) {
    
    const deleteBtn = document.querySelector('.delete-icon');
        deleteBtn.addEventListener('click', function() {
            deleteRoom.classList.toggle('down-dlt');
        })

    const backBtnDlt = document.querySelector('.back-dlt');
        backBtnDlt.addEventListener('click', function() {
            deleteRoom.classList.toggle('down-dlt');
})
}



const chatList = document.querySelector('.chat-list');


if( chatList) {
    const arrowSlide = document.querySelector('.arrow-img'); 
    arrowSlide.addEventListener('click', function() {
        arrowSlide.classList.toggle('press-arrow')
        chatList.classList.toggle('press-arrow')
    })
}

console.log('memek')

