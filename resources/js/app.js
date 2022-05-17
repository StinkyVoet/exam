require('./bootstrap');

let lastKnownScrollPosition = 0;
let ticking = false;

let navbar = document.querySelector('.navbar');

document.addEventListener('scroll', function(e) {
    lastKnownScrollPosition = window.scrollY;

    if(!ticking) {
        window.requestAnimationFrame(function() {
            updateNavbarBg(lastKnownScrollPosition);
            ticking = false
        });

        ticking = true;
    }
});

function lastKnownScrollPosition(scrollPos) {
    let gradient1;
    let gradient2;
    navbar.style.background = "linear-gradient(180deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0) 75%)";
}
