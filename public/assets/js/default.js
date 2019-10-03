$(document).ready(function(){
    $('.hamburger-menu').click(function(){
        $('.header-nav').toggleClass('open-menu');
        $('header').toggleClass('nav-light');
    });
});

$(document).ready(function(){
    $('.dropdown').click(function(){
    $('.has-sub', this).slideToggle();
    });
});

$(document).ready(function(){       
    var scroll = 0;
    $(document).scroll(function() { 
        scroll = $(this).scrollTop();
        if(scroll > 210) {
            $('header').removeClass('nav-none').addClass('nav-scroll');
            $('.hamburger-menu').css('color', '#222');
        } else {
            $('header').removeClass('nav-scroll').addClass('nav-none');
            $('.hamburger-menu').css('color', '#fff');
        }
    });
});

$(document).ready(function(){
    $('.images_overlay').hover(function(){
    $('.images_overlay_text', this).toggleClass('image-text-animate').show(0);
    $('.image_hover', this).toggleClass('image-hover-animate').show(0);
    });
});

$(document).ready(function(){
    $('.box-overlay').hover(function(){
    $('.image-zoom', this).toggleClass('image-zoom-animate').show(0);
    });
});
