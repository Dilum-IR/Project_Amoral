const toast = document.querySelector(".toast");
const time = document.querySelector(".small");

document.getElementById("help").addEventListener("click", () => {
  
  let remainingDuration = 5;
  // Show the toast
  toast.classList.remove("hide");
  toast.classList.add("show");

  // Automatically hide the toast after given seconds
   setTimeout(function () {
    toast.classList.remove("show");
    toast.classList.add("hide");
  }, remainingDuration*1000);


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
});
