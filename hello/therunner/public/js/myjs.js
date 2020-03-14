var dateForm = document.getElementById('book_date');
var dateConfirm = document.getElementById('confirm-date-button');
var modal = document.getElementById('modal');
var modalContent = document.getElementById('modal-content');
var bookBtn = document.getElementById('book-button');
var subDiv = document.getElementById('submit-div');
var cancelBtn = document.getElementById('cancelBtn');
var modal2 = document.getElementById('modal2');
var modalContent2 = document.getElementById('modal-content2');

// dateConfirm.addEventListener("click", function(event){
//     event.preventDefault();
//     a = dateForm.value;
//     console.log(a);
// });

//event listener
bookBtn.addEventListener('click', openModal);
window.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', openModal2);
window.addEventListener('click', closeModal2);

//
function openModal(){
    modal.style.display = 'block';
}

function closeModal(e){
    if(e.target==modal){
        modal.style.display = 'none';
    }
}

function openModal2(){
    modal2.style.display = 'block';
}

function closeModal2(e){
    if(e.target==Modal){
        modal2.style.display = 'none';
    }
}


