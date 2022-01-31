//import Swiper from 'swiper';

//const $ = jQuery; // You can use JQuery this way in the class

class Swipes {
    constructor() {
        this.initArticlesSlider();
    }

    initArticlesSlider(){
        let settings = {
            slidesPerView: 'auto',
            spaceBetween: 15,
            navigation: {
                nextEl: '#wiki-card-slider-next',
                prevEl: '#wiki-card-slider-prev',
            },
            breakpoints: {
                500: {
                    spaceBetween: 28
                }
            }
        };
        this.initSlider('#wiki-card-slider', settings);
    }

    initSlider(id, settings){
        let slider = document.querySelector(id);

        if (!slider) return;

        new Swiper(id, settings);
    }
}

//export default Swipes;
