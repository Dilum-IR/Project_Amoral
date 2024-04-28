setTimeout(() => {
  let search = document.getElementById("search");
  var users_list = document.querySelectorAll(".all-chat .user-content");

  // get current search value
  search.addEventListener("input", function () {
    let match_found = false;

    // get chat box with users names
    users_list.forEach((user, index) => {
      let user_name = user.querySelector("h4").textContent.toLowerCase(),
        search_value = search.value.toLowerCase();

      if (user_name.includes(search_value)) {
        console.log(user_name);
        user.classList.remove("hide");
        match_found = true;

      } else {
        user.classList.add("hide");
      }

      //given each row for delay seconds 0s , 0.04s,0.008s , ...  (0/12 , 1/12, 2/12)
      user.style.setProperty("--delay", index / 12 + "s");
    });


    let no_data_row = document.getElementById("no-data-search");
    if (match_found) {
      no_data_row.classList.add("hide");
    } else {
      no_data_row.classList.remove("hide");
    }
    
  });
}, 500);
