// console.log(sizes);
let sidebar = document.querySelector('.sidebar');
let nav = document.querySelector('nav');


function openView(button){
    const driverId = button.getAttribute('data-id');
    var capacity = button.getAttribute('data-capacity');
    console.log(driverId);
    document.querySelector(".popup-view input[name='deliver_id']").value = driverId;
    let existingCards = document.querySelectorAll('.orders-container .order');
    existingCards.forEach(card => {
        card.remove();
    });

    if(assignedOrders!=false){	

        var orders = assignedOrders.filter(order => order.deliver_id === driverId);
        console.log(orders);
    }else{
        document.querySelector('.popup-view .update-btn').style.cursor = 'not-allowed';
        document.querySelector('.popup-view .update-btn').addEventListener('click', function(event){
            event.preventDefault();
        });
    }

    addCurrentOrders(driverId, capacity);
    var map1;
    
  
    map1 = new google.maps.Map(document.querySelector(".current-orders .map"), {
      // Initial center coordinates
      center: {
        // Sri lanka middle lat lang
        lat: 7.7072567,
        lng: 80.6534611,
      },
      zoom: 9,
    });

   if (Array.isArray(orders) && orders.length !== 0) {
        orders.forEach(order => {
            var marker = new google.maps.Marker({
                position: {
                lat: parseFloat(order.latitude),
                lng: parseFloat(order.longitude),
                },
                map: map1,
                orderId: order.order_id,
            });

            var infoWindow = new google.maps.InfoWindow({
                content: `<h3>Order ID: ${order.order_id}</h3>`
            });

            infoWindow.open(map1, marker);
        });
    }else{
        console.log('No orders');
    }
    document.querySelector('.popup-view').classList.add("is-visible");
    document.body.style.overflow = "hidden";
    sidebar.style.pointerEvents = "none";
    nav.style.pointerEvents = "none";
}

function closeView(){
    document.querySelector('.popup-view').classList.remove("is-visible");
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";
}

document.querySelector('.popup-view .close').addEventListener('click', closeView);

// when a location is clicked on the map, display order details
function addOrderCards(orderId){
    var order = orders.find(order => order.order_id === orderId);
    console.log(sizes);
    var sizeArr = sizes.filter(size => size.order_id === orderId);
    var orderCard = document.createElement("div");
    var details = document.createElement("div");
    orderCard.classList.add("order");
    details.classList.add('order-' + orderId);
    orderCard.classList.add('order-' + orderId);
    details.style.padding = '10px';
    var tot = 0;
    // console.log(sizeArr[0]);
    // sizeArr = JSON.parse(sizeArr);
    for (var i in sizeArr) {
        // console.log(size);
        tot += parseInt(sizeArr[i].xs) + parseInt(sizeArr[i].small) + parseInt(sizeArr[i].medium) + parseInt(sizeArr[i].large) + parseInt(sizeArr[i].xl) + parseInt(sizeArr[i].xxl);  
    }
    details.innerHTML = `
        <h5>Order ID: <input name="order_id[]" readonly value="${order.order_id}"></h5>
        <p>Delivery Date: ${order.dispatch_date}</p>
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


// display orders of the selected driver in the popup
function addCurrentOrders(deliverId, cap){
    if(assignedOrders==false){
        document.querySelector('.orders-container').innerText = 'No orders assigned';
    }else{
        assignedOrders = assignedOrders.filter(order => order.deliver_id === deliverId);
        let sizes = ['xs', 'small', 'medium', 'large', 'xl', 'xxl'];
        var sumsizes = 0;
        sizes.forEach(size => {
            sumsizes += assignedOrders.reduce((acc, order) => acc + parseInt(order[size]), 0);
        });
        console.log(cap);
        document.querySelector('.remainCapacity').innerHTML = parseInt(cap) - 0.4 * sumsizes + ' Kg';
        document.querySelector('.currentOrders').innerHTML = assignedOrders.length;
        console.log(assignedOrders);
        assignedOrders.forEach(order => {
            if(order.deliver_id === deliverId){
                var sizeArr = sizes.filter(size => size.order_id === order.order_id);
                
                let currentOrder = document.createElement('div');
                currentOrder.classList.add('order');
                currentOrder.classList.add(`order-${deliverId}`);
                console.log(order);
                var tot =  0;
                for (var i in sizeArr) {
                    // console.log(size);
                    tot += parseInt(sizeArr[i].xs) + parseInt(sizeArr[i].small) + parseInt(sizeArr[i].medium) + parseInt(sizeArr[i].large) + parseInt(sizeArr[i].xl) + parseInt(sizeArr[i].xxl);  
                }
                
                currentOrder.innerHTML = `
                    <div>        
                        <h5>Order ID: <input name="order_id[]" readonly value="${order.order_id}"></h5>

                        <p>City: ${order.city}</p>
                        <p>Quantity: ${tot}</p>

                    </div>

                    <i class="fas fa-minus close"></i>
    
                `;
                document.querySelector('.orders-container').appendChild(currentOrder);

                let removeCard = currentOrder.querySelector("i");
                removeCard.addEventListener("click", function () {
                    currentOrder.remove();
                });

            }
        });
    }
 
}

function validateAssign(){
    var errors = {};

    var driver = document.querySelector('select[name="deliveryman"]').value;
    var orders = document.querySelectorAll('input[name="order_id[]"]');
    console.log(orders);
    if(driver === ''){
        errors['driver'] = '*Please select a driver';
    }

    if(orders.length === 0){
        errors['selected'] = '*Please select orders';
    }

    clearErrorMsg();
            
    // let errors = validateNewOrder();
    // console.log(Object.values(errors));
    if (Object.keys(errors).length > 0) {
        displayErrorMsg(errors);
        // event.preventDefault();
    }

    if(Object.keys(errors).length === 0){
        return true;
    }else{
        return false;
    }

}

let assignform = document.querySelector('form');

function displayErrorMsg(errors) {

    for (const key in errors) {
        if (Object.hasOwnProperty.call(errors, key)) {
            const error = errors[key];
            assignform.querySelector(`.error.${key}`).innerText = error;
        }
    }
}


function clearErrorMsg() {
    // console.log('clear');
    let errorElements = assignform.querySelectorAll('.error');

    errorElements.forEach(errorElement => {
        errorElement.innerText = '';
    });
}

// when a driver is selected, display driver details
var drivers = document.querySelectorAll('select[name="deliveryman"]');

drivers.forEach(driver => {
    driver.addEventListener('change', function() {
        var empId = driver.value;
        // addCurrentOrders(empId);
        document.querySelector('.emp-details .view-btn').setAttribute('data-id', empId);
        console.log(empId);
        var driverDetails = deliveryman.find(d => d.emp_id === empId);
        console.log(driverDetails);
        document.querySelector('.emp-details .name').innerHTML = driverDetails.emp_name;
        document.querySelector('.emp-details .vehicle').innerHTML = driverDetails.vehicle_type;
        document.querySelector('.emp-details .capacity').innerHTML = `${driverDetails.max_capacity} Kg`;
        document.querySelector('.emp-details .view-btn').setAttribute('data-capacity', driverDetails.max_capacity);

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
  
  
    var map1;
    
  
    map1 = new google.maps.Map(document.querySelector(".map"), {
      // Initial center coordinates
      center: {
        // Sri lanka middle lat lang
        lat: 7.7072567,
        lng: 80.6534611,
      },
      zoom: 9,
    });

   if (Array.isArray(orders) && orders.length !== 0) {
        orders.forEach(order => {
            var marker = new google.maps.Marker({
                position: {
                lat: parseFloat(order.latitude),
                lng: parseFloat(order.longitude),
                },
                map: map1,
                orderId: order.order_id,
            });

            var infoWindow = new google.maps.InfoWindow({
                content: `<h3>Order ID: ${order.order_id}</h3>`
            });

            infoWindow.open(map1, marker);

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
    }else{
        console.log('No orders');
    }






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