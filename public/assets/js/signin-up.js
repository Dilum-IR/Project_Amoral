const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

const signup_button = document.getElementById("sign-up-btn");

signup_button.addEventListener("submit", function (e) {
  e.preventDefault();
  // const data = new FormData(signup_button);
  // console.log(data);
  // signup_button.setAttribute("disabled", true);
});

inputs.forEach((input) => {
  // input class name rename when the clicked
  input.addEventListener("focus", () => {
    input.classList.add("active");
  });

  // input class name rename when the input field for values added
  if (input.value != "") {
    input.classList.add("active");
  }

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

try {
  if (dataValidate.flag === 1) {
    
    switch (dataValidate.error_no) {
      case 1:
        setTimeout(() => {
          toastApply("Name", dataValidate.error);
        }, 50);
        break;
      case 2:
        setTimeout(() => {
          toastApply(dataValidate.error, "Should contains only letters");
        }, 50);
        break;
      case 3:
        setTimeout(() => {
          toastApply("Email", dataValidate.error);
        }, 50);
        break;
      case 4:
        setTimeout(() => {
          toastApply("Password ", dataValidate.error);
        }, 50);
        break;
      case 5:
        setTimeout(() => {
          toastApply(
            dataValidate.error,
            "Should contains [a-z/A-Z/0-9/!@#^%?$&*~]"
          );
        }, 50);
        break;
      case 6:
        setTimeout(() => {
          toastApply("Email", dataValidate.error);
        }, 50);
        break;
      case 7:
        setTimeout(() => {
          toastApply("Sign in credintial", dataValidate.error);
        }, 50);
        break;

      default:
        break;
    }
  } else if (successData.flag === 0) {
    // toast apply for success time
    switch (successData.success_no) {
      case 1:
        setTimeout(() => {
          toastApply("Sign up", successData.success, 0);
        }, 50);

        // popup when verification code sent or not
        if (successData.send===1) {
          
          setTimeout(() => {
            toastApply(
              "Please Verify Your Email",
              "Verification code sent successfully",
              0
            );
          }, 5500);
        }else {
          setTimeout(() => {
            toastApply(
              "Can not Verify Your Email",
              "Unable to send verification code"
            );
          }, 5500);
        }

        break;
      case 2:
        setTimeout(() => {
          toastApply("Sign in", successData.success, 0);
        }, 50);
        break;
      default:
        break;
    }
  }
  // remove header history
  let currentUrl = window.location.origin + window.location.pathname;
  history.pushState({}, "", currentUrl);
  
} catch (error) {
  console.error(error);
}

//password visibility
function togglePasswordVisibility(passwordId, iconId) {
  console.log("dfcvb");

  var passwordField = document.getElementById(passwordId);
  var toggleIcon = document.getElementById(iconId);

  if (passwordField.type === "password") {
    toggleIcon.setAttribute("name", "eye-off-outline");
    passwordField.type = "text";
  } else {
    passwordField.type = "password";
    toggleIcon.setAttribute("name", "eye-outline");
  }
}
