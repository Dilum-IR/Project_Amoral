// document.addEventListener("DOMContentLoaded", function() {
//     // Get the image element
//     var welcomeImage = document.getElementById("welcome-img");

//     // Set a small delay to allow the image to load
//     setTimeout(function() {
//       // Apply the zoom-out effect
//       welcomeImage.style.transform = "scale(1)";
//     }, 500); // Adjust the delay time as needed
//   });

// let slideIndex = 0;
// showSlides();

// function showSlides() {
//   let i;
//   let slides = document.getElementsByClassName("image-slider");
//   let dots = document.getElementsByClassName("dot-slider");
//   for (i = 0; i < slides.length; i++) {
//     slides[i].style.display = "none";
//   }
//   slideIndex++;
//   if (slideIndex > slides.length) {slideIndex = 1}
//   for (i = 0; i < dots.length; i++) {
//     dots[i].className = dots[i].className.replace(" active", "");
//   }
//   slides[slideIndex-1].style.display = "block";
//   dots[slideIndex-1].className += " active";
//   setTimeout(showSlides, 2000); // Change image every 2 seconds
// }

let slideIndex = 0;
showSlides();

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("image-slider");
    let dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 8000); // Change image every 8 seconds
}

// main image slider
// var counter = 1;
// setInterval(function () {
//     document.getElementById('radio' + counter).checked = true;
//     counter++;
//     if (counter > 4) {
//         counter = 1;
//     }
// }, 5000);

// // loading screen hide
// window.addEventListener("load", ()=> {
//     document.querySelector(".loader").classList.add("loader--hidden");

//     document.querySelector(".loader").addEventListener("trasnsitionend", () => {
//         document.body.removeChild(document.querySelector(".loader"));
//     });
// });

const initSlider = () => {
    const imageList = document.querySelector(".slider-wrapper .image-list");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
    let currentIndex = 0;

    const slideNext = () => {
        currentIndex++;

        if (currentIndex >= imageList.children.length) {
            currentIndex = 0;
        }
        const scrollAmount = imageList.children[currentIndex].offsetLeft;
        imageList.scrollTo({
            left: scrollAmount,
            behavior: "smooth"
        });
    };

    // Auto slide every 3 seconds
    setInterval(slideNext, 3000);
};

window.addEventListener("resize", initSlider);
window.addEventListener("load", initSlider);

//   deal buttons links

document.getElementById("see-collection").addEventListener("click", function () {
    window.location.href = "http://localhost/project_Amoral/public/collection";
});

document.getElementById("place-order").addEventListener("click", function () {
    window.location.href = "http://localhost/project_Amoral/public/signin";
});