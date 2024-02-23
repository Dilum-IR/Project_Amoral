// Sidebar
window.onload = function () {
  const sidebar = document.querySelector(".sidebar");
  const closeBtn = document.querySelector("#btn");
  // const searchBtn = document.querySelector(".bx-search")

  closeBtn.addEventListener("click", function () {
    sidebar.classList.toggle("open");
    menuBtnChange();
  });

  // searchBtn.addEventListener("click",function(){
  //     sidebar.classList.toggle("open")
  //     menuBtnChange()
  // })

  function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
      closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else {
      closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
  }
};
function togglePasswordVisibility(inputId, iconId) {
  var passwordInput = document.getElementById(inputId);
  var toggleIcon = document.getElementById(iconId);

  if (passwordInput.type != "password") {
    passwordInput.type = "password";
    toggleIcon.name = "eye-off-outline";
  } else {
    passwordInput.type = "text";
    toggleIcon.name = "eye-outline";
  }
}
