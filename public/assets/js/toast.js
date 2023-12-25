const toast = document.querySelector(".toast");
const time = document.querySelector(".small");

const msg = document.getElementById("error_message");
const head = document.querySelector(".toast-head");

const icon = document.querySelector(".icon");

function toastApply(type, show, flag = 1) {

  // change the icon type with the success time
  if (flag === 0) {

    icon.classList.remove("bx-error-circle");
    icon.classList.add("bx-check-circle");
    toast.style.backgroundColor ="#24b304"

  } else {
    icon.classList.remove("bx-check-circle");
    icon.classList.add("bx-error-circle");
  }

  let remainingDuration = 5;
  // Show the toast
  toast.classList.remove("hide");
  toast.classList.add("show");

  head.textContent = `${type}`;
  msg.textContent = `${show}`;
  // toast.style.backgroundcolor = "Red";

  // Automatically hide the toast after given seconds
  setTimeout(function () {
    toast.classList.remove("show");
    toast.classList.add("hide");
  }, remainingDuration * 1000);

  // Start a countdown
  const countdownInterval = setInterval(function () {
    remainingDuration--;

    // Update the duration element with the remaining time
    time.textContent = `${remainingDuration} sec`;

    // When the duration reaches 0, clear the interval and hide the toast
    if (remainingDuration <= 1) {
      clearInterval(countdownInterval);
      toast.classList.remove("show");
    }
  }, 1000);
}

// success icon
// <ion-icon name="checkmark-circle-outline"></ion-icon>
// toggleIcon.setAttribute("name", "eye-off-outline");
