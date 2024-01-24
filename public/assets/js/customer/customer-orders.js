let popupView = document.getElementById("popup-view");
let popupReport = document.querySelector(".popup-report");
let popupNew = document.querySelector(".popup-new");
let closeViewBtn = document.querySelector(".popup-view .close");
let closeReportBtn = document.querySelector(".popup-report .close");

let sidebar = document.querySelector(".sidebar");
let nav = document.getElementById("navbar");

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

let reportForm = document.querySelector(".popup-report form");
let cancelReportBtn = document.querySelector(".cancelR-btn");


document.addEventListener('DOMContentLoaded', (event) => {

    if (reportForm) {
        cancelReportBtn.addEventListener("click", function(event) {
            clearErrorMsg();
        });
        closeReportBtn.addEventListener('click', function() {
            clearErrorMsg();
            closeReport();
        });

        reportForm.addEventListener("submit", function(event) {
            // event.preventDefault();    
            clearErrorMsg();
            console.log('submit');
            
                let errors = validateReport();
                console.log(Object.values(errors));
                if(Object.keys(errors).length > 0){
                    displayErrorMsg(errors);
                    event.preventDefault();
                } else{
                    
                }
            });
            
        } else {
            console.error('Form not found');
        }
});


closeViewBtn.addEventListener('click', closeView);


function validateReport(){
    let errors = {};
    
    let title = reportForm.querySelector('input[name="title"]').value;
    if(title.trim() === ''){
        errors['title'] = 'Title is required';
    }

    let description = reportForm.querySelector('textarea[name="description"]').value;
    if(description.trim() === ''){
        errors['description'] = 'Description is required';
    }

    let email = reportForm.querySelector('input[name="email"]').value;
    if(email.trim() === ''){
        errors['email'] = 'Email is required';
    } else if(!validateEmail(email)){
        errors['email'] = 'Invalid email';
    }

    return errors;
}

function validateEmail(email){
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function displayErrorMsg(errors){

for (const key in errors) {
    if (Object.hasOwnProperty.call(errors, key)) {
        const error = errors[key];
        reportForm.querySelector(`.error.${key}`).innerText = error;
    }
}
}


function clearErrorMsg(){
    console.log('clear');
    let errorElements = reportForm.querySelectorAll('.error');

    errorElements.forEach(errorElement => {
        errorElement.innerText = '';
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

      var today = new Date();
      var formattedDate = today.getFullYear() + '-' + String(today.getMonth()).padStart(2, '0') + '-' + String(today.getDate()).padStart(2, '0');

      
      // Populate the "update-form" fields with the order data
      document.querySelector('.update-form input[name="order_id"]').value = order.order_id;
      
      document.querySelector('.update-form input[name="material"]').value = order.material;
      
      if(document.querySelector('.update-form input[name="small"]') !== null){
          document.querySelector('.update-form input[name="small"]').value = order.small;
      }

      if(document.querySelector('.update-form input[name="medium"]')){
          document.querySelector('.update-form input[name="medium"]').value = order.medium;

      }
     

    //   document.querySelector('.update-form input[name="large"]').value = order.large;

      
      document.querySelector('.update-form input[name="total_price"]').value = order.unit_price * (order.small + order.large + order.medium);
      document.querySelector('.update-form input[name="remaining_payment"]').value = order.remaining_payment;
      document.querySelector('.update-form input[name="dispatch_date"]').value = order.dispatch_date;
        document.querySelector('.update-form input[name="dispatch_date"]').min = formattedDate;
      document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;
      document.querySelector('.update-form select[name="district"]').value =order.district;
        document.querySelector('.update-form input[name="latitude"]').value =order.latitude;
        document.querySelector('.update-form input[name="longitude"]').value =order.longitude;
  
      
        popupView.style.display = "block";
        document.body.style.overflow = "hidden";
        sidebar.style.pointerEvents = "none";
        nav.style.pointerEvents = "none";

      var currentDate = new Date();
      var orderPlacedOn = new Date(order.order_placed_on);
      if(((currentDate - orderPlacedOn)/(1000 * 60 * 60 * 24)) > 2){
            orderCancel.style.display = "none";
            orderUpdate.style.left = "70%";
      }


      
  }
  
  }
  function closeView(){
    popupView.style.display = "none";
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";
}	

function openReport(){
    popupReport.style.display = "block";
    document.body.style.overflow = "hidden";
    sidebar.style.pointerEvents = "none";
    nav.style.pointerEvents = "none";
}
function closeReport(){
    popupReport.style.display = "none";
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";

    reportForm.reset();
}

function openNew(){
    popupNew.classList.add("open-popup-new");
    overlay.classList.add("overlay-active");
}
function closeNew(){
    popupNew.classList.remove("open-popup-new");
    overlay.classList.remove("overlay-active");
}



        

var map;
var marker;
var infowindow;
var flag = true;
function initMap() {
    map = document.getElementById('map');

    map.addEventListener('mouseover', function(){
        var lat = document.querySelector('input[name="latitude"]').value;
        var lng = document.querySelector('input[name="longitude"]').value;
        

        if(lat && lng && flag){
            var position = {lat: parseFloat(lat), lng: parseFloat(lng)};
            map = new google.maps.Map(document.getElementById('map'), {
                center: position,
                zoom: 8
            });
            marker = new google.maps.Marker({
                position: position,
                map: map
            });
            
        }else{
            
            navigator.geolocation.getCurrentPosition(function(pos, error) {
                
                if(error){
                    console.log(error);
                }else{
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: pos.coords.latitude, lng: pos.coords.longitude},
                        zoom: 8
                    });
                }
            });
        }
        flag = false;
    });

    map.addEventListener('click', function(event) {
        

        if(marker){
            marker.setMap(null);
        }

        marker = new google.maps.Marker({
            position: event.latLng,
            map: map
        });



        // infowindow = new google.maps.InfoWindow({
        //     content: lat+','+ lng
        // });

        // infowindow.open(map, marker);

        google.maps.event.addEventListener(marker, 'rightclick', function(){
            marker.setMap(null);
        });

        lat = event.latLng.lat();
        lng = event.latLng.lng();

        document.querySelector('input[name="latitude"]').value = lat;
        document.querySelector('input[name="longitude"]').value = lng;

    });

    closeViewBtn.addEventListener('click', function(){
        marker.setMap(null);
    });

}