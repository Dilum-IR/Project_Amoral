const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

inputs.forEach((input) => {
  // input class name rename when the clicked
  input.addEventListener("focus", () => {
    input.classList.add("active");
  });

  // input class name remove when the clicked outside the page
  input.addEventListener("blur", () => {
    if (input.value != "") {
      return;
    } else {
      input.classList.remove("active");
    }
  });
});


// move sign in & sign up
toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});

// image slider & bullet navigation
let index = 0;

function moveSlider() {

  index = (index % images.length) + 1;

  let currentImage = document.querySelector(`.img-${index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;


  let currentBullet = document.querySelector(`.bull-${index}`);
  bullets.forEach((bull) => bull.classList.remove("active"));
  currentBullet.classList.add("active");

}

setInterval(moveSlider, 2000);
