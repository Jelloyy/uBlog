const open_btn = document.querySelector('.open_panel');
const adminPanel = document.querySelector('.admin_panel');


open_btn.addEventListener('click', function(){
    adminPanel.classList.toggle('open');
});