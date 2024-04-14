let popupView = document.getElementById("popup-view");
let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");

function openView(button) {
  // Get the data attribute value from the clicked button
  const orderData = button.getAttribute("data-order");

  if (orderData) {
    // Parse the JSON data
    const order = JSON.parse(orderData);
    console.log(order.mult_order);

    // Populate the "update-form" fields with the order data
    document.querySelector('.update-form input[name="order_id"]').value =
      order.order_id;

    document.querySelector(
      '.update-form input[name="cut_dispatch_date"]'
    ).value = order.cut_dispatch_date;

    document.querySelector(
      '.update-form input[name="sew_dispatch_date"]'
    ).value = order.sew_dispatch_date;

    popupView.classList.add("open-popup-view");
    overlay.classList.add("overlay-active");

    // wrapper currently include all card div removing
    var cards_wrapper = document.getElementById("cards-wrapper");
    cards_wrapper.innerHTML="";

    for (let index = 0; index < order.mult_order.length; index++) {

      addMaterialCardView(order.mult_order[index]);

    }
  }
}

function closeView() {
  popupView.classList.remove("open-popup-view");
  overlay.classList.remove("overlay-active");
}

var report_submit = document.getElementById("report-submit");
var popup = document.getElementById("gar-popup-report");
var report_overlay = document.getElementById("report-overlay");

function open_report() {
  if (report_overlay && popup) {
    popup.style.display = "block";
    report_overlay.style.display = "block";

    popup.classList.add("show");
  }
}

function hide_report() {
  if (report_overlay && popup) {
    // Remove show class to trigger the zoom-out animation
    popup.classList.remove("show");

    popup.style.opacity = "0";
    report_overlay.style.opacity = "0";

    setTimeout(function () {
      report_overlay.style.display = "none";
      report_overlay.style.opacity = "1";
      popup.style.display = "none";
      popup.style.opacity = "1";
    }, 1000);
  }
}

// check user report input data is valid or not
report_submit.addEventListener("click", function () {
  event.preventDefault();

  report_submit.disabled = true;

  var title = document.querySelector(".title");
  var description = document.getElementById("problem");
  var email = document.getElementById("email");

  var e_description = document.querySelector(".e-description");
  var e_title = document.querySelector(".e-title");

  var not_valid = false;

  // can't use < element
  const regex = /(?<!\b(?:let|var|const|\(|\w+\.)\s*)</g;

  if (title.value.trim() === "") {
    e_title.innerText = "Title is required.";
    not_valid = true;
  } else if (title.value.match(regex)) {
    e_title.innerText = "Invalid characters used. Try again";
    not_valid = true;
  } else {
    e_title.innerText = "";
    not_valid = false;
  }
  if (description.value.trim() === "") {
    e_description.innerText = "Problem is required.";
    not_valid = true;
  } else if (description.value.match(regex)) {
    e_description.innerText = "Invalid characters used. Try again";
    not_valid = true;
  } else {
    e_description.innerText = "";
    not_valid = false;
  }

  if (not_valid) {
    report_submit.disabled = false;

    return;
  }

  // not_valid is success with pass to the backend
  report_send(email.value, title.value, description.value);
});

function report_send(email, title, description) {
  var id = document.getElementById("id");

  data = {
    email: email,
    title: title,
    description: description,
    garment_id: id.value,
  };

  $.ajax({
    type: "POST",
    url: endpoint,
    data: data,
    cache: false,
    success: function (res) {
      try {
        // convet to the json type
        Jsondata = JSON.parse(res);

        if (Jsondata) {
          toastApply("Send Success", "Your problem reported...", 0);

          if (report_overlay && popup) {
            // Remove show class to trigger the zoom-out animation
            popup.classList.remove("show");

            popup.style.opacity = "0";
            report_overlay.style.opacity = "0";

            setTimeout(function () {
              report_overlay.style.display = "none";
              report_overlay.style.opacity = "1";
              popup.style.display = "none";
              popup.style.opacity = "1";
            }, 1000);
          }

          setTimeout(() => {
            location.reload();
          }, 4000);

          return;
        } else {
          toastApply("Send Failed", "Try again later...", 1);
          report_submit.disabled = false;

          // setTimeout(() => {
          //     location.reload();
          // }, 4000);

          return;
        }
      } catch (error) {}
    },
    error: function (xhr, status, error) {
      // return xhr;
    },
  });
}

function addMaterialCardView(order) {

  // console.log(order);

  var cards_wrapper = document.getElementById("cards-wrapper");

  var newCard = document.createElement("div");
  newCard.className = "all-cards";

  newCard.innerHTML = `
  <div class="user-details material">

  <div class="input-box">

      <span class="details">Material </span>
      <input class="g-type" name="material" type="text" readonly value="${order.material_type}" />

      <span class="details">Sleeves </span>
      <input class="g-type" name="sleeves" type="text" readonly value="${order.type}" />

      <span class="details">Printing Type </span>
      <input class="" name="printing-type" type="text" readonly value="${order.printing_type}" />
  </div>
  <div>

      <div class="s-q">

          <div class="sizes">

              <span class="details">Sizes</span>
              <input class="size" type="text" readonly value="X-Small" />
          </div>
          <div class="sizes">

              <span class="details">Quantity</span>
              <input class="size" type="text" readonly value="${order.xs}" />

          </div>
      </div>
      <div class="s-q">
          <input class="size" type="text" readonly value="Small" />
          <input class="size" type="text" readonly  value="${order.small}"/>
      </div>
      <div class="s-q">
          <input class="size" type="text" readonly value="Medium" />
          <input class="size" type="text" readonly value="${order.medium}"/>
      </div>

      <div class="s-q">
          <input class="size" type="text" readonly value="Large" />
          <input class="size" type="text" readonly value="${order.large}"/>
      </div>
      <div class="s-q">
          <input class="size" type="text" readonly value="X-Large" />
          <input class="size" type="text" readonly value="${order.xl}"/>
      </div>
      <div class="s-q">
          <input class="size" type="text" readonly value="XX-Large" />
          <input class="size" type="text" readonly value="${order.xxl}"/>
      </div>
  </div>
  <div></div>
  
</div>
<hr class="dotted">
    `;

    newCard.style.transition = "all 0.5s ease-in-out";

  cards_wrapper.appendChild(newCard);
  //countv++;
}
