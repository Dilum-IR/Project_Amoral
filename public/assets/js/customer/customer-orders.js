let popupView = document.getElementById("popup-view");
let popupReport = document.querySelector(".popup-report");
let popupNew = document.querySelector(".popup-new");
let closeViewBtn = document.querySelector(".popup-view .close");
let closeReportBtn = document.querySelector(".popup-report .close");
let closeNewBtn = document.querySelector(".popup-new .close");
// let payBtn = document.querySelector(".pay");

let sidebar = document.querySelector(".sidebar");
let nav = document.getElementById("navbar");

let progress1 = document.querySelector(".status ul li .one");
let progress2 = document.querySelector(".status ul li .two");
let progress3 = document.querySelector(".status ul li .three");
let progress4 = document.querySelector(".status ul li .four");
let orderCancel = document.querySelector("form .cancel-btn");
let orderUpdate = document.querySelector("form .update-btn");
let deleteConfirm = document.querySelector(".cd-popup");
let updateConfirm = document.querySelector(".cu-popup");

let updateNo = document.querySelector(".cu-popup .no");
let updateYes = document.querySelector(".cu-popup .yes");

const viewOrderBtns = document.querySelectorAll(".view-order-btn");

const search = document.querySelector(".form input"),
  table_rows = document.querySelectorAll("tbody tr");

search.addEventListener("input", performSearch);

function performSearch() {
  table_rows.forEach((row, i) => {
    let search_data = search.value.toLowerCase(),
      row_text = "";

    for (let j = 0; j < row.children.length - 1; j++) {
      row_text += row.children[j].textContent.toLowerCase();
    }
    console.log(row_text);

    row.classList.toggle("hide", row_text.indexOf(search_data) < 0);
  });
}



orderCancel.addEventListener('click', function (event) {
    // console.log('cancel');
    deleteConfirm.classList.add('is-visible');
});

orderUpdate.addEventListener("click", function (event) {
  event.preventDefault();
  updateConfirm.classList.add("is-visible");
});

updateNo.addEventListener("click", function () {
  updateConfirm.classList.remove("is-visible");
});

updateYes.addEventListener("click", function () {
  document.querySelector(".update-form").submit();
  updateConfirm.classList.remove("is-visible");
});

//validate the delivery dates
let datesNew = document.querySelectorAll('.popup-new input[type="date"]');
let datesView = document.querySelectorAll('.popup-view input[type="date"]');

let today = new Date();
let todayStr = today.toISOString().split("T")[0];
let fiveDaysLater = new Date(
  today.getFullYear(),
  today.getMonth(),
  today.getDate() + 6
)
  .toISOString()
  .split("T")[0];

datesNew.forEach((date) => {
  date.setAttribute("min", todayStr);
});

datesView.forEach((date) => {
  date.setAttribute("min", fiveDaysLater);
});

let reportForm = document.querySelector(".popup-report form");
let newForm = document.querySelector(".popup-new form");
let cancelReportBtn = document.querySelector(".cancelR-btn");
let cancelNewBtn = document.querySelector(".popup-new .cancel-btn");


document.addEventListener('DOMContentLoaded', () => {

    if (reportForm) {
        cancelReportBtn.addEventListener("click", function () {
            clearErrorMsg(reportForm);
        });
        closeReportBtn.addEventListener('click', function () {
            clearErrorMsg(reportForm);
            closeReport();
        });

        reportForm.addEventListener("submit", function (event) {
            // event.preventDefault();    
            clearErrorMsg(reportForm);
            console.log('submit');

            let errors = validateReport();
            console.log(Object.values(errors));
            if (Object.keys(errors).length > 0) {
                displayErrorMsg(errors, reportForm);
                event.preventDefault();
            }
        });

    }

    if(newForm){
        cancelNewBtn.addEventListener("click", function(){
            clearErrorMsg(newForm);
        });
        closeNewBtn.addEventListener("click", function(){
            clearErrorMsg(newForm);
            closeNew();
        
        });

        newForm.addEventListener("submit", function(event){
            // event.preventDefault();
            clearErrorMsg(newForm);
            
            let errors = validateNewOrder();
            console.log(Object.values(errors));
            if (Object.keys(errors).length > 0) {
                displayErrorMsg(errors, newForm);
                event.preventDefault();
            }
        });
    }
});

closeViewBtn.addEventListener("click", closeView);
closeNewBtn.addEventListener("click", closeNew);

function validateNewOrder() {
    let errors = {};
    // pdf and images
    var pdf = document.querySelector('#pdfFileToUpload');
    var image1 = document.querySelector('#imageFileToUpload1');
    var image2 = document.querySelector('#imageFileToUpload2');

    if (pdf.files.length === 0 && (image1.files.length === 0 || image2.files.length === 0)) {
        // alert('Please upload a PDF or an image');
        // event.preventDefault();
        errors['files'] = ' *Please upload a PDF or images';
    }

    // sizes
    let sizes = document.querySelectorAll('.popup-new input[type="number"]');
    let total = 0;
    sizes.forEach(size => {
        total += parseInt(size.value);
    });

    if (total === 0) {
        // event.preventDefault();
        errors['sizes0'] = ' *Please select a size';
    }

    // dispatch date
    let dates = document.querySelectorAll('.popup-new input[type="date"]');
    let dateSelected = false;

    dates.forEach(date => {
        if (date.value !== '') {
            dateSelected = true;
        }
    });

    if (!dateSelected) {
        // event.preventDefault();
        errors['dates'] = ' *Please select a date';
    }

    return errors;

}


function validateReport() {
  let errors = {};

  let title = reportForm.querySelector('input[name="title"]').value;
  if (title.trim() === "") {
    errors["title"] = "Title is required";
  }

  let description = reportForm.querySelector(
    'textarea[name="description"]'
  ).value;
  if (description.trim() === "") {
    errors["description"] = "Description is required";
  }

  let email = reportForm.querySelector('input[name="email"]').value;
  if (email.trim() === "") {
    errors["email"] = "Email is required";
  } else if (!validateEmail(email)) {
    errors["email"] = "Invalid email";
  }

  return errors;
}

function validateEmail(email) {
  const re = /\S+@\S+\.\S+/;
  return re.test(email);
}


function displayErrorMsg(errors, form) {

    for (const key in errors) {
        if (Object.hasOwnProperty.call(errors, key)) {
            const error = errors[key];
            form.querySelector(`.error.${key}`).innerText = error;
        }
    }
}



function clearErrorMsg(form) {
    // console.log('clear');
    let errorElements = form.querySelectorAll('.error');

  errorElements.forEach((errorElement) => {
    errorElement.innerText = "";
  });
}

function removeActiveClass() {
  progress2.classList.remove("active");
  progress3.classList.remove("active");
  progress4.classList.remove("active");
}

function openView(button) {
  // Get the data attribute value from the clicked button
  const orderData = button.getAttribute("data-order");
  const materialData = button.getAttribute("data-material");

  console.log(orderData);

  removeActiveClass();

  if (orderData) {
    // Parse the JSON data
    const order = JSON.parse(orderData);
    const material = JSON.parse(materialData);

    switch (order.order_status) {
      case "cutting" || "printing" || "sewing":
        progress2.classList.add("active");
        break;
      // case "delivering":
      //   progress2.classList.add("active");
      //   progress3.classList.add("active");
      //   break;
      case "delivering":
        progress2.classList.add("active");
        progress3.classList.add("active");
        break;

      case "completed":
        progress2.classList.add("active");
        progress3.classList.add("active");
        progress4.classList.add("active");
        break;

      case "cancelled":
        progress1.classList.add("cancel");
        break;
    }

    var today = new Date();
    var formattedDate =
      today.getFullYear() +
      "-" +
      String(today.getMonth()).padStart(2, "0") +
      "-" +
      String(today.getDate()).padStart(2, "0");
    console.log(formattedDate);

    // Populate the "update-form" fields with the order data
    document.querySelector('.update-form input[name="order_id"]').value =
      order.order_id;

    let existingCards = document.querySelectorAll(".user-details.new-card");
    let existingPriceRows = document.querySelectorAll(
      ".price-details-container .units"
    );

    // Remove each existing newCard element
    existingCards.forEach(function (card) {
      card.remove();
    });

    // Remove each existing priceRow element
    existingPriceRows.forEach(function (row) {
      row.remove();
    });

    let quantity = 0;
    let countv = 0;

    for (let i = 0; i < material.length; i++) {
      console.log(material[i]);
      quantity =
        parseInt(material[i].xs) +
        parseInt(material[i].small) +
        parseInt(material[i].medium) +
        parseInt(material[i].large) +
        parseInt(material[i].xl) +
        parseInt(material[i].xxl);
      addMaterialCardView(material[i], quantity, countv);
    }

    // if the order is processing only delivery details can be updated
    let inputs = document.querySelectorAll(".update-form .st");
    if (order.order_status != "pending") {
      inputs.forEach((input) => {
        input.setAttribute("readonly", "true");
      });
    }

    // document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;

    // document.querySelector('.update-form input[name="unit_price"]').value = order.unit_price;

    if (order.is_delivery == 1) {
      document.querySelector(".delivery").classList.add("is-checked");
      document.querySelector(
        '.update-form input[name="dispatch_date_delivery"]'
      ).value = order.dispatch_date;
      document.querySelector('.update-form input[name="city"]').value =
        order.city;
    } else {
      document.querySelector(".pickup").classList.add("is-checked");
      document.querySelector(
        '.update-form input[name="dispatch_date_pickup"]'
      ).value = order.dispatch_date;
    }

    document.querySelector(".update-form .totalPrice").innerHTML =
      order.total_price;
    console.log(order.total_price);
    document.querySelector(".update-form .discountPrice").innerHTML =
      order.discount;
    console.log(order.discount);

    // document.querySelector('.update-form input[name="discount"]').value = order.discount;
    // document.querySelector('.update-form input[name="remaining_payment"]').value = order.remaining_payment;

    document.querySelector('.update-form input[name="order_placed_on"]').value =
      order.order_placed_on;
    document.querySelector('.update-form input[name="city"]').value =
      order.city;
    document.querySelector('.update-form input[name="latitude"]').value =
      order.latitude;
    document.querySelector('.update-form input[name="longitude"]').value =
      order.longitude;

    document.querySelector('.update-form embed[name="design"]').src =
      "/Project_Amoral/public/uploads/designs/" + order.pdf;

    popupView.classList.add("is-visible");
    document.body.style.overflow = "hidden";
    sidebar.style.pointerEvents = "none";
    nav.style.pointerEvents = "none";

    var currentDate = new Date();
    var orderPlacedOn = new Date(order.order_placed_on);
    if (
      (currentDate - orderPlacedOn) / (1000 * 60 * 60 * 24) > 2 ||
      order.order_status != "pending"
    ) {
      orderCancel.style.display = "none";
    } else {
      orderCancel.style.display = "block";
    }

    if (
      order.order_status == "completed" ||
      order.order_status == "cancelled"
    ) {
      orderUpdate.style.display = "none";
      orderCancel.style.display = "none";
    }

    // if(order.remaining_payment == 0){
    //     payBtn.style.display = "none";
    // }
  }

  var today = new Date();
  var formattedDate =
    today.getFullYear() +
    "-" +
    String(today.getMonth()).padStart(2, "0") +
    "-" +
    String(today.getDate()).padStart(2, "0");
  console.log(formattedDate);

  // Populate the "update-form" fields with the order data
  document.querySelector('.update-form input[name="order_id"]').value =
    order.order_id;

  let existingCards = document.querySelectorAll(".user-details.new-card");
  let existingPriceRows = document.querySelectorAll(
    ".price-details-container .units"
  );

  // Remove each existing newCard element
  existingCards.forEach(function (card) {
    card.remove();
  });

  // Remove each existing priceRow element
  existingPriceRows.forEach(function (row) {
    row.remove();
  });

  let quantity = 0;
  let countv = 0;

  for (let i = 0; i < material.length; i++) {
    console.log(material[i]);
    quantity =
      parseInt(material[i].xs) +
      parseInt(material[i].small) +
      parseInt(material[i].medium) +
      parseInt(material[i].large) +
      parseInt(material[i].xl) +
      parseInt(material[i].xxl);
    addMaterialCardView(material[i], quantity, countv);
  }

  // if the order is processing only delivery details can be updated
  let inputs = document.querySelectorAll(".update-form .st");
  if (order.order_status != "pending") {
    inputs.forEach((input) => {
      input.setAttribute("readonly", "true");
    });
  }

  // document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;

  // document.querySelector('.update-form input[name="unit_price"]').value = order.unit_price;

  if (order.is_delivery == 1) {
    document.querySelector(".delivery").classList.add("is-checked");
    document.querySelector(
      '.update-form input[name="dispatch_date_delivery"]'
    ).value = order.dispatch_date;
    document.querySelector('.update-form input[name="city"]').value =
      order.city;
  } else {
    document.querySelector(".pickup").classList.add("is-checked");
    document.querySelector(
      '.update-form input[name="dispatch_date_pickup"]'
    ).value = order.dispatch_date;
  }

  document.querySelector(".update-form .totalPrice").innerHTML =
    order.total_price;
  console.log(order.total_price);
  document.querySelector(".update-form .discountPrice").innerHTML =
    order.discount;
  console.log(order.discount);

  // document.querySelector('.update-form input[name="discount"]').value = order.discount;
  // document.querySelector('.update-form input[name="remaining_payment"]').value = order.remaining_payment;

  document.querySelector('.update-form input[name="order_placed_on"]').value =
    order.order_placed_on;
  document.querySelector('.update-form input[name="city"]').value = order.city;
  document.querySelector('.update-form input[name="latitude"]').value =
    order.latitude;
  document.querySelector('.update-form input[name="longitude"]').value =
    order.longitude;

  document.querySelector('.update-form embed[name="design"]').src =
    "/Project_Amoral/public/uploads/designs/" + order.pdf;

  popupView.classList.add("is-visible");
  document.body.style.overflow = "hidden";
  sidebar.style.pointerEvents = "none";
  nav.style.pointerEvents = "none";

  var currentDate = new Date();
  var orderPlacedOn = new Date(order.order_placed_on);
  if ((currentDate - orderPlacedOn) / (1000 * 60 * 60 * 24) > 2) {
    orderCancel.style.display = "none";
  } else {
    orderCancel.style.display = "block";
  }

  if (order.order_status == "completed" || order.order_status == "cancelled") {
    orderUpdate.style.display = "none";
    orderCancel.style.display = "none";
  }

  // if(order.remaining_payment == 0){
  //     payBtn.style.display = "none";
  // }
}

function closeView() {
  popupView.classList.remove("is-visible");
  document.body.style.overflow = "auto";
  sidebar.style.pointerEvents = "auto";
  nav.style.pointerEvents = "auto";
}

function openReport() {
  popupReport.classList.add("is-visible");
  document.body.style.overflow = "hidden";
  sidebar.style.pointerEvents = "none";
  nav.style.pointerEvents = "none";
}
function closeReport() {
  popupReport.classList.remove("is-visible");
  document.body.style.overflow = "auto";
  sidebar.style.pointerEvents = "auto";
  nav.style.pointerEvents = "auto";

  reportForm.reset();
}

function openNew() {
  popupNew.classList.add("is-visible");
  document.body.style.overflow = "hidden";
  sidebar.style.pointerEvents = "none";
  nav.style.pointerEvents = "none";
}
function closeNew() {
  popupNew.classList.remove("is-visible");
  document.body.style.overflow = "auto";
  sidebar.style.pointerEvents = "auto";
  nav.style.pointerEvents = "auto";


    let cards = document.querySelectorAll(".new-card");
    cards.forEach(card => {
        card.remove();
    });
    let priceRows = document.querySelectorAll(".price-details-container .units");
    priceRows.forEach(row => {
        row.remove();
    });
    document.querySelector(".new-form").reset();
}

function addMaterialCardView(material, quantity, countv) {
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
  countv++;

  var newPriceRow = document.createElement("tr");
  newPriceRow.className = "units";

  newPriceRow.innerHTML = `
    <td class="materialType">${material["material_type"]}</td>
    <td class="sleeveType">${material["type"]}</td>
    <td class="printingType">${material["printing_type"]}</td>
    <td class="quantityAll">${quantity}</td>
    <td class="unitPrice">${material["unit_price"]}</td>
    
    <input type="hidden" name="unit_price[]" value="${material["unit_price"]}"> `;

  document
    .querySelector(".price-details-container .discount")
    .before(newPriceRow);

  let removeCard = newCard.querySelector("i");

  // hide the remove button for the first card
  console.log(newCard.nextElementSibling);
  if (
    !newCard.previousElementSibling.classList.contains("new-card") &&
    countv == 1
  ) {
    removeCard.style.display = "none";
    newCard.querySelector(".input-box").style.marginLeft = "30px";
  }

  removeCard.addEventListener("click", function () {
    countv--;

    //remove cards and reduce the prices from the total
    let removedPrice =
      parseInt(newPriceRow.querySelector(".unitPrice").innerText) *
      parseInt(newPriceRow.querySelector(".quantityAll").innerText);
    let tot = parseInt(
      document.querySelector(".popup-view .totalPrice").innerText
    );
    // console.log(removedPrice);
    newCard.remove();
    newPriceRow.remove();
    document.querySelector(".popup-view .totalPrice").innerHTML =
      tot - removedPrice;
  });

  //update price when quantity is changed
  let quantityInputs = newCard.querySelectorAll(".st");
  quantityInputs.forEach((input) => {
    input.addEventListener("change", function () {
      let quantity = 0;
      quantityInputs.forEach((input) => {
        quantity += parseInt(input.value);
      });
      newPriceRow.querySelector(".quantityAll").innerText = quantity;
      updateTotalPrice();
    });
  });
}

function updateTotalPrice() {
  let total = 0;
  document.querySelectorAll(".units").forEach(function (unit) {
    total +=
      parseInt(unit.querySelector(".unitPrice").innerHTML) *
      parseInt(unit.querySelector(".quantityAll").innerHTML);
  });
  document.querySelector(".popup-view .totalPrice").innerHTML = total;

  document.querySelector(".popup-view input[name='total_price']").value = total;
  console.log(
    "tot" +
      document.querySelector(".popup-view input[name='total_price']").value
  );
}

// var map;
// var marker;
// var infowindow;
// var flag = true;
// async function initMap() {
//   closeViewBtn.addEventListener("click", function () {
//     if (marker) {
//       marker.setMap(null);
//     }
//   });
// }

  var marker;
  var map;

  map = new google.maps.Map(document.getElementById("order-map"), {
    // Initial center coordinates
    center: {
      // Sri lanka middle lat lang
      lat: 7.7072567,
      lng: 80.6534611,
    },
    zoom: 7,
  });

  // set the marker initial time user current location
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };

        // Set the map's center to the user's current location
        map.setCenter(pos);

        map.setZoom(15);

        // Add a marker at the user's current location
        marker = new google.maps.Marker({
          position: pos,
          map: map,
          title: "Your Location",
        });
      },
      function () {
        handleLocationError(true, map.getCenter());
      }
    );
  } else {
    handleLocationError(false, map.getCenter());
  }

  // add the location lat lang for this object
  var selectedLocation;

  // Add a click event listener to the map
  map.addListener("click", function (event) {
    if (marker) {
      marker.setMap(null);
    }

    // Get the clicked location's latitude and longitude
    var latitude = event.latLng.lat();
    var longitude = event.latLng.lng();

    console.log(latitude);

    marker = new google.maps.Marker({
      position: {
        lat: latitude,
        lng: longitude,
      },
      map: map,
    });

    document.querySelector('input[name="latitude"]').value = latitude;
    document.querySelector('input[name="longitude"]').value = longitude;
  });


marker.addListener("click", function () {
  infoWindow.open(map, marker);
});

function handleLocationError(browserHasGeolocation, pos) {
  var infoWindow = new google.maps.InfoWindow({
    content: browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation.",
  });

  var marker = new google.maps.Marker({
    position: pos,
    map: map,
  });

  marker.addListener("click", function () {
    infoWindow.open(map, marker);
  });
}

