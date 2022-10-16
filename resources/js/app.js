import './bootstrap';
import Glide from "@glidejs/glide";

const divGlide = document.querySelector('.glide');
const mediaMenu = document.querySelector('#media-menu')
const menuBtn = document.querySelector('#menu-bars')
const closeBtn = document.querySelector('.close-button')

const showMediaMenu = () => {
    mediaMenu.style.left = 0;
}

const hideMediaMenu = () => {
    mediaMenu.style.left = '-100%'
}

menuBtn.addEventListener('click', showMediaMenu)
closeBtn.addEventListener('click', hideMediaMenu)


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

// Show submenu if user authenticated
const authProfile = document.querySelector('#auth .picture')
const chevron = document.querySelector('.profile-chevron')
const submenu = document.querySelector('.submenu')
const showSubmenu = () => {
    submenu.classList.toggle('active')

    if (chevron.classList.contains('fa-chevron-down')) {
        chevron.classList.replace('fa-chevron-down', 'fa-chevron-up')
    } else {
        chevron.classList.replace('fa-chevron-up', 'fa-chevron-down')
    }
}

if (authProfile) {
    authProfile.addEventListener('click', showSubmenu)
    chevron.addEventListener('click', showSubmenu)
}




