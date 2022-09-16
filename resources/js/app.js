import './bootstrap';
import Glide from "@glidejs/glide";

const divGlide = document.querySelector('.glide');

if (divGlide !== null) {

    const glide = new Glide('.glide', {
        type: 'carousel',
        autoplay: 5000,
        perView: 3,
        gap: 0,
        breakpoints: {
            900: {
                perView: 2
            },
            576: {
                perView: 1
            }
        },
        animationTimingFunc: "ease-in-out"
    })

    glide.mount()
}


