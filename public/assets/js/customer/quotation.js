let popupView = document.getElementById("popup-view");
let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");
let popupNew = document.querySelector(".popup-new");

function openView(button) {
  
    // Get the data attribute value from the clicked button
    const orderData = button.getAttribute("data-order");
    
    console.log(orderData);
  
    if (orderData) {
      // Parse the JSON data
      const order = JSON.parse(orderData);
      
      // Populate the "update-form" fields with the order data
      document.querySelector('.update-form input[name="order_id"]').value = order.order_id;
      
      document.querySelector('.update-form input[name="material"]').value = order.material;
      
      document.querySelector('.update-form input[name="small"]').value = order.small;
      document.querySelector('.update-form input[name="medium"]').value = order.medium;

      document.querySelector('.update-form input[name="large"]').value = order.large;

      document.querySelector('.update-form input[name="dispatch_date"]').value = order.dispatch_date;
      document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;

      document.querySelector('.update-form input[name="user_id"]').value =order.user_id;
      document.querySelector('.update-form input[name="district"]').value =order.district;
  
      
      // Show the "update-form" popup
      // document.querySelector(".popup-view").classList.add("open-popup-view");
      popupView.classList.add("open-popup-view");
      overlay.classList.add("overlay-active");
      
  }
}
function closeView(){
    popupView.classList.remove("open-popup-view");
    overlay.classList.remove("overlay-active");
}	

function openReport(){
    popupReport.classList.add("open-popup-report");
    overlay.classList.add("overlay-active");
}
function closeReport(){
    popupReport.classList.remove("open-popup-report");
    overlay.classList.remove("overlay-active");
}

function openNew(){
    popupNew.classList.add("open-popup-new");
    overlay.classList.add("overlay-active");
}
function closeNew(){
    popupNew.classList.remove("open-popup-new");
    overlay.classList.remove("overlay-active");
}
