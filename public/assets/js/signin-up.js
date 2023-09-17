const inputs = document.querySelectorAll(".input-field");

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
