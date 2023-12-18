let popupView = document.getElementById("popup-view");
let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");
let popupNew = document.querySelector(".popup-new");
let closeViewBtn = document.querySelector(".popup-view .close-icon a");
let closeReportBtn = document.querySelector(".popup-report .close-icon a");

let progress1 = document.querySelector(".status ul li .one");
let progress2 = document.querySelector(".status ul li .two");
let progress3 = document.querySelector(".status ul li .three");
let progress4 = document.querySelector(".status ul li .four");
let orderCancel = document.querySelector("form .cancel-btn");
let orderUpdate = document.querySelector("form .update-btn");

const viewOrderBtns = document.querySelectorAll('.view-order-btn');

const search = document.querySelector(".form input"),
      table_rows = document.querySelectorAll("tbody tr");

search.addEventListener('input', performSearch);

closeViewBtn.addEventListener('click', closeView);
closeReportBtn.addEventListener('click', closeReport);


function performSearch() {
    table_rows.forEach((row, i) => {
        let search_data = search.value.toLowerCase(),
            row_text = '';

        for(let j=0; j<row.children.length - 1; j++){
            row_text += row.children[j].textContent.toLowerCase();
            
        }
        console.log(row_text);

        row.classList.toggle('hide', row_text.indexOf(search_data) < 0);
    })
}
 

// viewOrderBtns.forEach(btn => {
//     btn.addEventListener('click', () => {
//         const orderId = btn.dataset.id;
//         fetch(`/orders/${orderId}`)
//             .then(response => response.json())
//             .then(data => {
//                 // Populate the popup with the order details
//                 orderDetails.innerHTML = `Material: ${data.material}<br>Quantity: ${data.quantity}`;
//                 orderPopup.style.display = 'block';
//             });
//     });
// });

function removeActiveClass() {
    progress2.classList.remove("active");
    progress3.classList.remove("active");
    progress4.classList.remove("active");
}

function openView(button) {
  
    // Get the data attribute value from the clicked button
    const orderData = button.getAttribute("data-order");
    
    console.log(orderData);

    removeActiveClass();
  
    if (orderData) {
      // Parse the JSON data
      const order = JSON.parse(orderData);

      switch(order.order_status){
        case 'processing':
            progress2.classList.add("active");
            break;

        case 'delivering':
            progress2.classList.add("active");
            progress3.classList.add("active");
            break;

        case 'delivered':
            progress2.classList.add("active");
            progress3.classList.add("active");
            progress4.classList.add("active");
            break;

      }
      
      // Populate the "update-form" fields with the order data
      document.querySelector('.update-form input[name="order_id"]').value = order.order_id;
      
      document.querySelector('.update-form input[name="material"]').value = order.material;
      
      document.querySelector('.update-form input[name="small"]').value = order.small;
      document.querySelector('.update-form input[name="medium"]').value = order.medium;

      document.querySelector('.update-form input[name="large"]').value = order.large;

      
      document.querySelector('.update-form input[name="total_price"]').value = order.total_price;
      document.querySelector('.update-form input[name="remaining_payment"]').value = order.remaining_payment;
      document.querySelector('.update-form input[name="dispatch_date"]').value = order.dispatch_date;
      document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;

      document.querySelector('.update-form input[name="order_status"]').value = order.order_status;
      document.querySelector('.update-form input[name="user_id"]').value =order.user_id;
      document.querySelector('.update-form input[name="district"]').value =order.district;
  
      
      // Show the "update-form" popup
      // document.querySelector(".popup-view").classList.add("open-popup-view");
      popupView.classList.add("open-popup-view");
      overlay.classList.add("overlay-active");

      var currentDate = new Date();
      var orderPlacedOn = new Date(order.order_placed_on);
      if(((currentDate - orderPlacedOn)/(1000 * 60 * 60 * 24)) > 2){
            orderCancel.style.display = "none";
            orderUpdate.style.left = "74%";
      }


      
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