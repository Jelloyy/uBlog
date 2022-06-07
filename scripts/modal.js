const btn = document.querySelector('.login');
btn.addEventListener("click", function(){
    document.querySelector('.modal-wrap').classList.add('active');
    document.querySelector('.main-wrapper').classList.add('blur');
})
const hider = document.querySelector('span.hide');
hider.addEventListener("click", function(){
    document.querySelector('.modal-wrap').classList.remove('active');
    document.querySelector('.main-wrapper').classList.remove('blur');
})

$('.posts-btn').on('click', function(){
    $('body, html').animate({
        scrollTop: $('.blog-pg').offset().top
    }, 500)
});
$('.about-btn').on('click', function(){
    $('body, html').animate({
        scrollTop: $('.title').offset().top
    }, 500)
})
$('.comments-btn').on('click', function(){
    $('body, html').animate({
        scrollTop: $('.add-comment-label').offset().top
    }, 500)
})