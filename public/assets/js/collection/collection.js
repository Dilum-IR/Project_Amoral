// document.addEventListener('DOMContentLoaded', function () {
//     const slides = document.querySelectorAll('.full-screen-slide');
//     let currentSlide = 0;

//     function showSlide(n) {
//         slides.forEach(slide => slide.style.display = 'none');
//         slides[n].style.display = 'block';
//     }

//     function nextSlide() {
//         currentSlide = (currentSlide + 1) % slides.length;
//         showSlide(currentSlide);
//     }

//     function prevSlide() {
//         currentSlide = (currentSlide - 1 + slides.length) % slides.length;
//         showSlide(currentSlide);
//     }

//     // Automatic sliding
//     setInterval(nextSlide, 10000); // Change slide every 10 seconds

//     // Button click events
//     const nextBtns = document.querySelectorAll('.slide-btn-right');
//     const prevBtns = document.querySelectorAll('.slide-btn-left');

//     nextBtns.forEach(btn => {
//         btn.addEventListener('click', nextSlide);
//     });

//     prevBtns.forEach(btn => {
//         btn.addEventListener('click', prevSlide);
//     });
// });

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
setInterval(nextSlide, 30000); // Change slide every 10 seconds


let popupNew = document.querySelector(".popup-new");
let sidebar = document.querySelector(".sidebar");
let nav = document.getElementById("navbar");

function openNew(button) {

    let data = JSON.parse(button.getAttribute("data-design"));

    console.log(data);

    document.querySelector(".popup-new .design");
    document.querySelector(".popup-new .design").src = '/project_Amoral/public/uploads/collection/' + data.image_name;

    popupNew.classList.add("is-visible");
    document.body.style.overflow = "hidden";
    sidebar.style.pointerEvents = "none";
    nav.style.pointerEvents = "none";
}

function closeNew() {
    popupNew.classList.remove("is-visible");
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";
}

// document.getElementById("place-button-1").addEventListener("click", function () {
//     window.location.href = "http://localhost/project_Amoral/public/signin";
// });

// document.getElementById("place-button-2").addEventListener("click", function () {
//     window.location.href = "http://localhost/project_Amoral/public/signin";
// });

// document.getElementById("place-button-3").addEventListener("click", function () {
//     window.location.href = "http://localhost/project_Amoral/public/signin";
// });

function loadSign(){
    window.location.href = "http://localhost/project_Amoral/public/signin"; 
}