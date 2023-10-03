const toast = document.querySelector(".toast");
const time = document.querySelector(".small");

const msg = document.getElementById("error_message");
const head = document.querySelector(".toast-head");

function toastApply(type, show) {
  let remainingDuration = 4;
  // Show the toast
  toast.classList.remove("hide");
  toast.classList.add("show");

  head.textContent = `${type}`;
  msg.textContent = `${show}`;

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
