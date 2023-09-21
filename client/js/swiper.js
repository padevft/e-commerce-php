var options = {
    centeredSlides: true,
    slidesPerView: "auto",
    spaceBetween: 5,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    effect: "coverflow",
    grabCursor: true,
    coverflowEffect: {
        rotate: 45,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
    },
    breakpoints: {
        959: {
            slidesPerView: 1,
            spaceBetween: 5,
        },
        960: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1265: {
            slidesPerView: 3,
            spaceBetween: 50,
        },
        1450: {
            slidesPerView: 4,
            spaceBetween: 80,
        },
    },
}



// var swiper = new Swiper(".swiper-products-home",options );



// options['effect'] = "coverflow";
// options['grabCursor'] = true;
// options['coverflowEffect'] = {};
// options['coverflowEffect']['rotate'] = 50;
// options['coverflowEffect']['stretch'] = 0;
// options['coverflowEffect']['depth'] = 100;
// options['coverflowEffect']['modifier'] = 1;
// options['coverflowEffect']['slideShadows'] = false;


var swiper = new Swiper(".swiper-products",options );
