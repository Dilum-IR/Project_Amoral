let popupView = document.getElementById("popup-view");
let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");

function openView(button) {
  // Get the data attribute value from the clicked button
  const orderData = button.getAttribute("data-order");

  if (orderData) {
    // Parse the JSON data
    const order = JSON.parse(orderData);
    console.log(order);

    // Populate the "update-form" fields with the order data
    // document.querySelector('.update-form input[name="order_id"]').value =
    //   order.order_id;

    // document.querySelector('.update-form input[name="material"]').value =
    //   order.material_type;

    // document.querySelector(
    //   '.update-form input[name="cut_dispatch_date"]'
    // ).value = order.cut_dispatch_date;

    // document.querySelector(
    //   '.update-form input[name="sew_dispatch_date"]'
    // ).value = order.sew_dispatch_date;

    // document.querySelector(
    //   '.update-form input[name="delivery_expected_on"]'
    // ).value = "2021-09-18";

    // document.querySelector('.update-form input[name="status"]').value =
    //   order.status;
    // document.querySelector('.update-form input[name="garment_id"]').value =
    //   order.garment_id;

    // Show the "update-form" popup
    // document.querySelector(".popup-view").classList.add("open-popup-view");
    popupView.classList.add("open-popup-view");
    overlay.classList.add("overlay-active");

    
    for (let index = 0; index < order.length; index++) {
      
      // const element = array[index];
      
      // addMaterialCardView(order);
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

function addMaterialCardView(material) {
  var newCard = document.createElement("div");
  newCard.className = "user-details new-card";

  newCard.innerHTML = `
    <i class="fas fa-minus remove"></i>
        <div class="input-box">
            <span class="details">Material </span>
            <input name="material[]" value="${material["material_type"]}" readonly value="">
                
                
                <?php foreach($data['materials'] as $material):?>
                    <input type="hidden" name="material_id[]" value="${material["material_id"]}">
                <?php endforeach;?>
                
            </input>
                        
        </div>

        <div class="input-box">
            <span class="details">Sleeves</span>
            <input name="sleeve[]" value="${material["type"]}" readonly value="">
                
                <?php foreach($data['sleeveType'] as $sleeve):?>
                    <input type="hidden" name="sleeve_id[]" value="${material["sleeve_id"]}">
               <?php endforeach;?>
            </input>
        </div>

        <div class="input-box" style="margin-left: 30px;">
            <span class="details">Printing Type</span>
            <input name="printingType[]" value="${material["printing_type"]}" readonly value="">
                
                <?php foreach($data['printingType'] as $printing):?>
                    <input type="hidden" name="ptype_id[]" value="${material["ptype_id"]}">
                <?php endforeach;?>
            </input>
        </div>

        <div class="input-box sizes">
            <span class="details">Sizes & Quantity</span>
            <div class="sizeChart">
                <span class="size">XS</span>
                <input class="st" type="number" id="quantity" name="xs[]" min="0" value="${material["xs"]}">
                <br>
                <span class="size">S</span>
                <input class="st" type="number" id="quantity" name="small[]" min="0" value="${material["small"]}">
                <br>
                <span class="size">M</span>
                <input class="st" type="number" id="quantity" name="medium[]" min="0" value="${material["medium"]}">
                <br>
                <span class="size">L</span>
                <input class="st" type="number" id="quantity" name="large[]" min="0" value="${material["large"]}">
                <br>
                <span class="size">XL</span>
                <input class="st" type="number" id="quantity" name="xl[]" min="0" value="${material["xl"]}">
                <br>
                <span class="size">2XL</span>
                <input class="st" type="number" id="quantity" name="xxl[]" min="0" value="${material["xxl"]}">
                <br>
            </div>
        </div>
    `;

  newCard.style.transition = "all 0.5s ease-in-out";
  document.querySelector(".popup-view .add.card").before(newCard);
  //countv++;
}
