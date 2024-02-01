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

const timer = document.querySelector(".timer");
const resend = document.getElementById("resend");

// time counting method
function startTimer() {
  // Start a countdown
  const countdownInterval = setInterval(() => {
    remainingDuration--;

    // Update the duration element with the remaining time
    if (remainingDuration >= 0) {
      timer.textContent = `${remainingDuration}s `;
    }

    // When the duration reaches 0, clear the interval and hide the toast
    if (remainingDuration === 0) {
      clearInterval(countdownInterval);
      timer.classList.add("hide");
      resend.removeAttribute("disabled");
      timer.textContent = "";
    }
  }, 1000);
}
//  resend OTP method
resend.addEventListener("click", function (e) {
  e.preventDefault();

  this.setAttribute("disabled", true);
  remainingDuration = 59;
  timer.textContent = `${remainingDuration}s `;
  startTimer();

  inputs.forEach((input) => {
    // Clear the otp value of each input field
    input.value = "";
  });
});

var array = [];

// Get the otp value using each input field
const l_icon = button.querySelector(".bx-loader-circle");

l_icon.style.display = "none";

function getOtp() {
  array = [];
  inputs.forEach((input) => {
    array.push(input.value);
  });

  button.setAttribute("disabled", true);
  l_icon.style.display = "inline-block";

  setTimeout(() => {
    button.removeAttribute("disabled");
    l_icon.style.display = "none";
  }, 5000);

  // OTP bind & convert to the integer
  var result = parseInt(array.join(""));

  return result;
}

