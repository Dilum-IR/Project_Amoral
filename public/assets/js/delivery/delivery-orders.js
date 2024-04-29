let popupView = document.getElementById("popup-view");
// let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");
let sidebar = document.querySelector('.sidebar');
let nav = document.querySelector('nav');


function openView(data) {
  const orderData = data.getAttribute("data-order");

  console.log(orderData);

  popupView.classList.add("open-popup-view");
  overlay.classList.add("overlay-active");
}

var order_id = -1;
var order={};

function openView(button) {
  const data = button.getAttribute("data-order");
  order = JSON.parse(data);

  order_id = order.order_id;

  // console.log(order);
  document.getElementById("order-id").value = order.order_id;
  document.getElementById("customer-name").value = order.fullname;
  document.getElementById("delivery-city").value = order.city;
  document.getElementById("contact-num").value = order.phone;
  document.getElementById("expected-on").value = order.dispatch_date;

  if (order.pay_type == "full") {
    document.getElementById("remain").innerHTML = "";
    document.querySelector(".recived-checker").innerHTML = "";
  } else if (order.pay_type == "half") {
    document.getElementById("remain").innerHTML =
      '<span class="details">Remaining Payment</span><input id="remaining-on" type="text" required onChange="" readonly value=" " />';
    document.getElementById("remaining-on").value =
      order.remaining_payment + ".00";
    document.querySelector(".recived-checker").innerHTML =
      '<input type="checkbox" id="myCheckbox" name="payed"> <label for="myCheckbox" class="checker-label">Order Payments Received!</label>';
  } else if (order.pay_type == "no") {
    document.getElementById("remain").innerHTML =
      '<span class="details"><b>Remaining Payment (Rs.)</b></span><input id="remaining-on" type="text" required onChange="" readonly value=" " />';
    document.getElementById("remaining-on").value = order.total_price + ".00";
    document.querySelector(".recived-checker").innerHTML =
      '<input type="checkbox" id="myCheckbox" name="payed"> <label for="myCheckbox" class="checker-label">Order Payments Received!</label>';
  }

  initMap(order.order_id, order.latitude, order.longitude); // Initialize the map with the order's location
  // } else {
  //     updateMapLocation(order.latitude, order.longitude); // Update map if already initialized

  popupView.classList.add("is-visible");
  document.body.style.overflow = "hidden";
  sidebar.style.pointerEvents = "none";
  nav.style.pointerEvents = "none";
}

function confirmWithPopup() {
  if (order_id != -1) {
    updateStatus(order_id);
  }
}

function closeView() {
  popupView.classList.remove("is-visible");
  document.body.style.overflow = "auto";
  sidebar.style.pointerEvents = "auto";
  nav.style.pointerEvents = "auto";
}

function openReport() {
  popupReport.classList.add("open-popup-report");
  overlay.classList.add("overlay-active");
}
function closeReport() {
  popupReport.classList.remove("open-popup-report");
  overlay.classList.remove("overlay-active");
}



function filterTable(arg) {
  var table_data = document.querySelectorAll(".table-section tbody tr");
  table_data.forEach((Element) => {
    Element.classList.remove("delivered-row-active");
    Element.classList.remove("delivering-row-active");

    if (arg == 1 && Element.classList.contains("delivering")) {
      console.log(Element);

      Element.classList.remove("delivered-row-active");
      Element.classList.add("delivering-row-active");

      // Element.style.display = 'none';
    } else if (arg == 2 && Element.classList.contains("delivered")) {
      Element.classList.remove("delivering-row-active");
      Element.classList.add("delivered-row-active");
      // Element.style.display = 'none';
    }
  });
}

filterTable(1);
