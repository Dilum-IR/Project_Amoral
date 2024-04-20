const toast = document.querySelector(".toast");
const time = document.querySelector(".small");

const msg = document.getElementById("error_message");
const head = document.querySelector(".toast-head");

const icon = document.querySelector(".icon");

function toastApply(type, show, flag = 1) {
  // change the icon type with the success time
  if (flag === 0) {
    icon.classList.remove("bx-error-circle");
    icon.classList.remove("bx-error");
    icon.classList.add("bx-check-circle");
    toast.style.backgroundColor = "#24b304";
  } else if (flag === 2) {
    icon.classList.remove("bx-error-circle");
    icon.classList.remove("bx-check-circle");
    icon.classList.add("bx-error");
    toast.style.backgroundColor = "#fac500";
  } else {
    icon.classList.remove("bx-check-circle");
    icon.classList.remove("bx-error");
    icon.classList.add("bx-error-circle");
    toast.style.backgroundColor = "#a30404";
  }

  let remainingDuration = 5;
  // Show the toast
  toast.style.zIndex = 1000;
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
      // popup when verification code not sent
      case 8:
        setTimeout(() => {
          toastApply("Network Error", "Use the resend verification code");
        }, 50);
        break;

      case 9:
        setTimeout(() => {
          toastApply(
            "Email is not Verifyed ",
            "Please Verify Your Email Address"
          );
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
        break;
      case 2:
        setTimeout(() => {
          toastApply("Sign in", successData.success, 0);
        }, 50);
        break;

      case 3:
        // popup when verification code sent
        setTimeout(() => {
          toastApply(
            "Please Verify Your Email ",
            "Verification code sent successfully",
            0
          );
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

// success icon
// <ion-icon name="checkmark-circle-outline"></ion-icon>
// toggleIcon.setAttribute("name", "eye-off-outline");
