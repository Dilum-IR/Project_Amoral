console.log(sizes);

// when a location is clicked on the map, display order details
function addOrderCards(orderId){
    var order = orders.find(order => order.order_id === orderId);
    var sizeArr = sizes.filter(size => size.order_id === orderId);
    var orderCard = document.createElement("div");
    var details = document.createElement("div");
    orderCard.classList.add("order");
    details.classList.add('order-' + orderId);
    details.style.padding = '10px';
    var tot = 0;
    console.log(sizeArr[0]);
    // sizeArr = JSON.parse(sizeArr);
    for (var i in sizeArr) {
        // console.log(size);
        tot += parseInt(sizeArr[i].xs) + parseInt(sizeArr[i].small) + parseInt(sizeArr[i].medium) + parseInt(sizeArr[i].large) + parseInt(sizeArr[i].xl) + parseInt(sizeArr[i].xxl);  
    }
    details.innerHTML = `
        <h5>Order ID: <input name="order_id[]" readonly value="${order.order_id}"></h5>
        <p>City: ${order.city}</p>
        <p>Quantity: ${tot}</p>
    `;

    // Create a close icon
    var closeIcon = document.createElement("div");
    closeIcon.classList.add("close");
    closeIcon.innerHTML = "&times;";
    closeIcon.style.cursor = "pointer";
    closeIcon.addEventListener("click", function() {
        orderCard.remove();
    });

    // Append the close icon to the order card
    orderCard.appendChild(details);
    orderCard.appendChild(closeIcon);

    document.querySelector(".orders h4").before(orderCard);
}

// when a driver is selected, display driver details
var drivers = document.querySelectorAll('select[name="deliveryman"]');

drivers.forEach(driver => {
    driver.addEventListener('change', function() {
        var empId = driver.value;
        console.log(empId);
        var driverDetails = deliveryman.find(d => d.emp_id === empId);
        console.log(driverDetails);
        document.querySelector('.emp-details .name').innerHTML = driverDetails.emp_name;
        document.querySelector('.emp-details .vehicle').innerHTML = driverDetails.vehicle_type;
        document.querySelector('.emp-details .capacity').innerHTML = `${driverDetails.max_capacity} Kg`;

        var iconClass;
        switch (driverDetails.vehicle_type) {
            case 'bike':
                iconClass = 'fa-motorcycle';
                break;
            case 'three-wheel':
                iconClass = 'fa-motorcycle';
                break;
            case 'van':
                iconClass = 'fa-shuttle-van';
                break;
            case 'lorry':
                iconClass = 'fa-truck';
                break;
        }

        document.querySelector('.emp-details .icon i').className = `fas ${iconClass}`;
        document.querySelector('.emp-details').style.opacity = 1;
        document.querySelector('.emp-details').style.visibility = 'visible';
        document.querySelector('.emp-details').style.height = 'auto';
    });
});


function initMap(){
  
    var marker1;
    var marker2;
    var map1;
    var map2;
  
    map1 = new google.maps.Map(document.querySelector(".map"), {
      // Initial center coordinates
      center: {
        // Sri lanka middle lat lang
        lat: 7.7072567,
        lng: 80.6534611,
      },
      zoom: 9,
    });

    orders.forEach(order => {
        var marker = new google.maps.Marker({
            position: {
              lat: parseFloat(order.latitude),
              lng: parseFloat(order.longitude),
            },
            map: map1,
            orderId: order.order_id,
        });

        marker.addListener("click", function () {
            var existingCard = document.querySelector(`.order-${this.orderId}`);
            console.log(existingCard);
            if (existingCard) {
                // If a card for this order ID already exists, remove it
                existingCard.remove();
            } else {
                // Otherwise, add a new card
                addOrderCards(this.orderId);
            }
        });
    });





    // console.log(lat);

    // map2 = new google.maps.Map(document.getElementById("view-order-map"), {
    // // Initial center coordinates
    // center: {
        
    //     lat: lat,
    //     lng: lng,
    // },
    // zoom: 7,
    // });
  


}

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