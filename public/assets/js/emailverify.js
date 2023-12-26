const inputs = document.querySelectorAll(".otp-card-inputs input");
const button = document.querySelector(".verify");
const otp = document.querySelector(".otp-card");

inputs.forEach((input, index, inputArray) => {
  let lastInputStatus = 0;
  input.onkeyup = (e) => {
    const currentElement = e.target;
    const nextElement = input.nextElementSibling;
    const prevElement = input.previousElementSibling;

    const allFilled = Array.from(inputArray).every(
      (input) => input.value.trim() !== ""
    );

    if (prevElement && e.keyCode === 8) {
      if (lastInputStatus === 1) {
        prevElement.value = "";
        prevElement.focus();
      }
      button.setAttribute("disabled", true);

      lastInputStatus = 1;
    } else {
      const reg = /^[0-9]+$/;
      if (!reg.test(currentElement.value)) {
        currentElement.value = currentElement.value.replace(/\D/g, "");
      } else if (currentElement.value) {
        if (nextElement) {
          nextElement.focus();
        } else {
          button.removeAttribute("disabled");
          lastInputStatus = 0;
        }
      }
    }

    if (allFilled) {
      button.removeAttribute("disabled");
      lastInputStatus = 0;
    } else {
      button.setAttribute("disabled", true);
    }
  };
});

var array = [];

// Get the otp value using each input field
const icon = button.querySelector(".bx-loader-circle");

function getOtp() {
  icon.style.display = "none";
  button.addEventListener("click", () => {
    array = [];
    inputs.forEach((input) => {
      array.push(input.value);
    });

    button.setAttribute("disabled", true);
    icon.style.display = "inline-block";

    setTimeout(() => {
      button.removeAttribute("disabled");
      icon.style.display = "none";
    }, 5000);
  });
}
getOtp();

const time = document.querySelector(".timer");
const resend = document.getElementById("resend");

// time counting method
function startTimer() {
  // Start a countdown
  const countdownInterval = setInterval(() => {
    remainingDuration--;

    // Update the duration element with the remaining time
    if (remainingDuration >= 0) {
      time.textContent = `${remainingDuration}s `;
    }

    // When the duration reaches 0, clear the interval and hide the toast
    if (remainingDuration === 0) {
      clearInterval(countdownInterval);
      time.classList.add("hide");
      resend.removeAttribute("disabled");
      time.textContent = "";
    }
  }, 1000);
}
//  resend top method
resend.addEventListener("click", function (e) {
  e.preventDefault();

  this.setAttribute("disabled", true);
  remainingDuration = 59;
  time.textContent = `${remainingDuration}s `;
  startTimer();

  inputs.forEach((input) => {
    // Clear the otp value of each input field
    input.value = "";
  });
});

// const email = "rdinduwara19158@gmail.com";
// const firstFourChars = email.substring(0, 4); // Get the first 4 characters
// const lastTenChars = email.slice(-10); 