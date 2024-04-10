let popupView = document.getElementById("popup-view");
let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");

function openView(button) {
  
  // Get the data attribute value from the clicked button
  const orderData = button.getAttribute("data-order");
  
  if (orderData) {
    // Parse the JSON data
    const order = JSON.parse(orderData);
    
    // Populate the "update-form" fields with the order data
    document.querySelector('.update-form input[name="order_id"]').value =
    order.order_id;
    
    document.querySelector('.update-form input[name="material"]').value = "Wetlook";
    
    document.querySelector('.update-form input[name="cut_dispatch_date"]').value =
    order.cut_dispatch_date;
    
    document.querySelector('.update-form input[name="sew_dispatch_date"]').value =
    order.sew_dispatch_date;
    
    document.querySelector('.update-form input[name="delivery_expected_on"]').value = "2021-09-18";
    
    document.querySelector('.update-form input[name="status"]').value = order.status;
    document.querySelector('.update-form input[name="garment_id"]').value =order.garment_id;

    
    // Show the "update-form" popup
    // document.querySelector(".popup-view").classList.add("open-popup-view");
    popupView.classList.add("open-popup-view");
    overlay.classList.add("overlay-active");
    
}

}


function closeView() {
  popupView.classList.remove("open-popup-view");
  overlay.classList.remove("overlay-active");
}

function openReport() {
  
  popupReport.classList.add("open-popup-report");
  overlay.classList.add("overlay-active");
  
}
function closeReport() {
  popupReport.classList.remove("open-popup-report");
  overlay.classList.remove("overlay-active");
}


