let popupView = document.getElementById("popup-view");
let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");
let popupNew = document.querySelector(".popup-new");
let closeReportBtn = document.querySelector(".popup-report .close-icon a");
let closeViewBtn = document.querySelector(".popup-view .close-icon a");
let closeNewBtn = document.querySelector(".popup-new .close-icon a");

closeReportBtn.addEventListener("click", closeReport);
closeViewBtn.addEventListener("click", closeView);
closeNewBtn.addEventListener("click", closeNew);

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

var map;
var marker;
var infowindow;
var circle;
function initMap() {


        map.addListener('click', function(event) {
            // navigator.geolocation.getCurrentPosition(function(pos, error) {
                    
            //     if(error){
            //         console.log(error);
            //     }else{
            //         map = new google.maps.Map(document.getElementById('map'), {
            //             center: {lat: pos.coords.latitude, lng: pos.coords.longitude},
            //             zoom: 15
            //         });
    
            //         // marker = new google.maps.Marker({
            //         //     position: {lat: pos.coords.latitude, lng: pos.coords.longitude},
            //         //     map: map,
            //         //     icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png' // URL to the blue marker image
            //         // });
            //     }
            // });

            if(marker){
                marker.setMap(null);
            }

            marker = new google.maps.Marker({
                position: event.latLng,
                map: map
            });

            // if(infowindow){
            //     infowindow.close();
            // }

            // infowindow = new google.maps.InfoWindow({
            //     content: 'Your custom message here'
            // });

            // infowindow.open(map, marker);

            google.maps.event.addEventListener(marker, 'click', function(){
                marker.setMap(null);
            });

    });



    

}
