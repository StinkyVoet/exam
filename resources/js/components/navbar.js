// Custom function om makkelijker een minimum en maximumwaarde te krijgen.
const clamp = (num, min, max) => Math.min(Math.max(num, min), max)

let lastKnownScrollPosition = 0;
let ticking = false;

let navbar = document.querySelector('.navbar');

// Wanneer er word gescrolled wordt updateNavbarBg() uitgevoerd
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

updateNavbarBg(window.scrollY);

// Update de navbar achtergrond gradient
function updateNavbarBg(scrollPos) {
    let gradientPos = clamp(-30 + scrollPos / 2, 0, 100);
    let opacity = clamp(scrollPos / 100, 0.4, 1);
    navbar.style.background = "linear-gradient(180deg, rgba(0,0,0,"+opacity+") "+gradientPos+"%, rgba(0,0,0,0) 75%)";
}
