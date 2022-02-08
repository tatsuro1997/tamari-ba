// import Swiper JS
import Swiper from 'swiper';
// import Swiper styles
import 'swiper/swiper-bundle.css';

// core version + navigation, pagination modules:
import SwiperCore, { Navigation, Pagination, Autoplay } from 'swiper/core';

// configure Swiper to use modules
SwiperCore.use([Navigation, Pagination, Autoplay]);

// init Swiper:
const swiper = new Swiper(".swiper-container", {
  loop: true,
  spaceBetween: 30,
  centeredSlides: true,
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
});
