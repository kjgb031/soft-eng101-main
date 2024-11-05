let currentSlide = 0;
const slides = [
    'hero.jpg',  // Update these with your actual image URLs
    'hero2.jpg',
    'hero3.jpg'
];

document.getElementById("next").addEventListener("click", function() {
    currentSlide = (currentSlide + 1) % slides.length;
    document.querySelector(".hero").style.backgroundImage = `url(${slides[currentSlide]})`;
});

document.getElementById("prev").addEventListener("click", function() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    document.querySelector(".hero").style.backgroundImage = `url(${slides[currentSlide]})`;
});