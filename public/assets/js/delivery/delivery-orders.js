let popupView = document.getElementById("popup-view");
// let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");

function openView(data) {
  const orderData = data.getAttribute("data-order");

  console.log(orderData);

  popupView.classList.add("open-popup-view");
  overlay.classList.add("overlay-active");
}

var order_id = -1;

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

// myModal = document.getElementById("myModal");
// modal_content = document.getElementById("modal-content");
// alert_overlay = document.getElementById("alert-overlay");
// function confirmPopup(id){

//     myModal.classList.remove("disable");
//     myModal.classList.add("active");

//     modal_content.classList.remove("disable");
//     modal_content.classList.add("active");

//     alert_overlay.style.display = "block";

//     order_id = document.getElementById("order_id");

//     order_id.value = id;
// }

// function cancelPopup(){

//     myModal.classList.remove("active");
//     myModal.classList.add("disable");

//     modal_content.classList.remove("active");
//     modal_content.classList.add("disable");

//     alert_overlay.style.display = "none";

//     console.log("myModal");

// }

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