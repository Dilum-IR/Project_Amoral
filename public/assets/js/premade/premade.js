document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.full-screen-slide');
    let currentSlide = 0;

    function showSlide(n) {
        slides.forEach(slide => slide.style.display = 'none');
        slides[n].style.display = 'block';
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    // Automatic sliding
    setInterval(nextSlide, 100000); // Change slide every 15 seconds

    // Button click events
    const nextBtns = document.querySelectorAll('.slide-btn-right');
    const prevBtns = document.querySelectorAll('.slide-btn-left');

    nextBtns.forEach(btn => {
        btn.addEventListener('click', nextSlide);
    });

    prevBtns.forEach(btn => {
        btn.addEventListener('click', prevSlide);
    });
});