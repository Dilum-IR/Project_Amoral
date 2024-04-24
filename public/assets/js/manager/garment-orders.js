let popupView = document.getElementById("popup-view");
let popupSetDeadline = document.getElementById("popup-set-deadline");
let popupNew = document.querySelector(".popup-new");
let closeViewBtn = document.querySelector(".popup-view .close");
let closeSetDeadlineBtn = document.querySelector(".popup-set-deadline .close");

let sidebar = document.querySelector(".sidebar");
let nav = document.getElementById("navbar");

let progress1 = document.querySelector(".status ul li .one");
let progress2 = document.querySelector(".status ul li .two");
let progress3 = document.querySelector(".status ul li .three");
let progress4 = document.querySelector(".status ul li .four");
let progress5 = document.querySelector(".status ul li .five");
let orderCancel = document.querySelector("form .cancel-btn");
let orderUpdate = document.querySelector("form .update-btn");

const viewOrderBtns = document.querySelectorAll('.view-order-btn');

const search = document.querySelector(".form input"),
      table_rows = document.querySelectorAll("tbody tr");

search.addEventListener('input', performSearch);

closeViewBtn.addEventListener('click', closeView);
closeSetDeadlineBtn.addEventListener('click', closeSetDeadline);


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

// draggable items
    const draggables = document.querySelectorAll(".draggable");
    const dropzones = document.querySelectorAll(".category");
 

    // dropzones.forEach((dropzone) => {
    //     dropzone.addEventListener("drop", (e) => {
    //         document.querySelector(".save-edit").style.visibility = "visible";

    //     });
    // });

    draggables.forEach((draggable) => {
        draggable.addEventListener("dragstart", (e) => {
            // set deadlines for cutting and sewing
            if(!draggable.classList.contains("set")){
                openSetDeadline(draggable);
            }
        });
    });


    draggables.forEach((draggable) => {
    draggable.addEventListener("dragstart", dragStart);
    draggable.addEventListener("dragend", dragEnd);
    });

    dropzones.forEach((dropzone) => {
    dropzone.addEventListener("dragover", dragOver);
    dropzone.addEventListener("dragenter", dragEnter);
    dropzone.addEventListener("dragleave", dragLeave);
    dropzone.addEventListener("drop", drop);
    });

    let draggedElement = null;

    function dragStart(e) {
    draggedElement = e.target;
    e.target.classList.add("dragging");
    e.dataTransfer.setData("text/plain", e.target.id);
    draggedElement.style.borderColor = "red"; // Change border color when dragging starts
    }

    function dragEnd() {
    draggedElement.classList.remove("dragging");
    draggedElement.style.borderColor = ""; // Reset border color after dragging ends
    }

    function dragOver(e) {
    e.preventDefault();
    }

    function dragEnter(e) {
    e.preventDefault();
    if (e.target.classList.contains("category")) {
        e.target.style.borderColor = "red"; // Change border color when dragging enters a drop zone
    }
    }

    function dragLeave(e) {
    if (e.target.classList.contains("category")) {
        e.target.style.borderColor = ""; // Reset border color when dragging leaves a drop zone
    }
    }

    function drop(e) {
        e.preventDefault();
        const data = e.dataTransfer.getData("text/plain");
        const draggableElement = document.getElementById(data);

        if (draggedElement && draggableElement) {
            const targetCategory = e.target.closest(".category");
            const sourceCategory = draggedElement.closest(".category");

            if (targetCategory !== sourceCategory) {
            targetCategory.appendChild(draggableElement);
            }
        }

        // Reset border color after dropping
        if (e.target.classList.contains("category")) {
            e.target.style.borderColor = "";
        }

        document.querySelector(".save-edit").style.visibility = "visible";

        // console.log(draggableElement);



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
    progress5.classList.remove("active");
}

function openView(button) {
  
    // Get the data attribute value from the clicked button
    const orderData = button.getAttribute("data-order");
    const materialData = button.getAttribute("data-material");
    // console.log(button.getAttribute('data-customerOrder'));
    const customerOrderData = button.getAttribute("data-customerOrder");

    // console.log(customerOrderData);

    removeActiveClass();
  
    if (orderData) {
      // Parse the JSON data
      const order = JSON.parse(orderData);
      const material = JSON.parse(materialData);
      const customerOrder = JSON.parse(customerOrderData);

      switch(order.status){
        case 'cutting':
            progress2.classList.add("active");
            break;

        case 'cut':
            progress2.classList.add("active");
            progress3.classList.add("active");
            break;

        case 'sent to company':
            progress2.classList.add("active");
            progress3.classList.add("active");
            break;

        case 'company process':
            progress2.classList.add("active");
            progress3.classList.add("active");
            break;

        case 'returned':
            progress2.classList.add("active");
            progress3.classList.add("active");
            break;

        case 'sewing':
            progress2.classList.add("active");
            progress3.classList.add("active");
            progress4.classList.add("active");
            break;

        case 'sewed':
            progress2.classList.add("active");
            progress3.classList.add("active");
            progress4.classList.add("active");
            progress5.classList.add("active");
            break;

        case 'completed':
            progress2.classList.add("active");
            progress3.classList.add("active");
            progress4.classList.add("active");
            progress5.classList.add("active");
            break;

      }

      var today = new Date();
      var formattedDate = today.getFullYear() + '-' + String(today.getMonth()).padStart(2, '0') + '-' + String(today.getDate()).padStart(2, '0');

      
      // Populate the "update-form" fields with the order data
      document.querySelector('.update-form input[name="order_id"]').value = order.order_id;
      document.querySelector('.update-form input[name="cut_dispatch_date"]').value = order.cut_dispatch_date;
      document.querySelector('.update-form input[name="sew_dispatch_date"]').value = order.sew_dispatch_date;	
      
      console.log(order);

    //   document.querySelector('.update-form input[name="dispatch_date"]').value = order.dispatch_date;
    //     document.querySelector('.update-form input[name="dispatch_date"]').min = formattedDate;
      document.querySelector('.update-form input[name="order_placed_on"]').value = customerOrder.order_placed_on;
     console.log(customerOrder);

     document.querySelector('.update-form input[name="dispatch_date"]').value = customerOrder.dispatch_date;
  
      
      // Show the "update-form" popup
      // document.querySelector(".popup-view").classList.add("open-popup-view");
      popupView.classList.add("is-visible");
      document.body.style.overflow = "hidden";
      sidebar.style.pointerEvents = "none";
      nav.style.pointerEvents = "none";

      var currentDate = new Date();
      var orderPlacedOn = new Date(order.order_placed_on);
      if(((currentDate - orderPlacedOn)/(1000 * 60 * 60 * 24)) > 2){
            orderCancel.style.display = "none";
         
      }


      for(let i=0; i<material.length; i++){
        addMaterialCardView(material[i]);
      }
      
  }
  
  }
function closeView(){
    popupView.classList.remove("is-visible");
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";

    document.querySelector('.update-form').reset();
}	


function openSetDeadline(e) {
    const orderData = e.getAttribute("data-order");
    const qty = e.getAttribute("qty");

    const order = JSON.parse(orderData);

    // console.log(order);
    // document.querySelector('.set-deadline-form input[name="order_id"]').value = order.order_id;
    document.querySelector('.set-deadline-form input[name="quantity"]').value = qty;
    document.querySelector('.set-deadline-form input[name="garment_order_id"]').value = order.garment_order_id;

    document.querySelector('.set-deadline-form input[name="order_placed_on"]').value = order.order_placed_on;
    document.querySelector('.set-deadline-form input[name="dispatch_date"]').value = order.dispatch_date;

    //set limits for the date input fields
    var currentDate = new Date();
    var orderPlacedOn = new Date(order.order_placed_on);
    var dispatchDate = new Date(order.dispatch_date);

    let differenceInTime = dispatchDate.getTime() - currentDate.getTime();
    let differenceInDays = differenceInTime / (1000 * 3600 * 24);

    let maxDate = new Date(currentDate.getTime() + (differenceInDays / 2 * 24 * 60 * 60 * 1000));

    document.querySelector('.set-deadline-form input[name="cut_dispatch_date"]').min = currentDate.toISOString().split('T')[0];
    document.querySelector('.set-deadline-form input[name="cut_dispatch_date"]').max = maxDate.toISOString().split('T')[0];

    document.querySelector('.set-deadline-form input[name="sew_dispatch_date"]').min = currentDate.toISOString().split('T')[0];
    document.querySelector('.set-deadline-form input[name="sew_dispatch_date"]').max = dispatchDate.toISOString().split('T')[0];


    popupSetDeadline.classList.add("is-visible");
    document.body.style.overflow = "hidden";
    sidebar.style.pointerEvents = "none";
    nav.style.pointerEvents = "none";
}

function closeSetDeadline() {
    popupSetDeadline.classList.remove("is-visible");
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";
}


function addMaterialCardView(material) {
    var newCard = document.createElement("div");
    newCard.className = "user-details new-card";

    console.log(material['xs']);
    newCard.innerHTML = `
        <div class="input-box">
            <span class="details">Material </span>
            <input name="material[]" value="${material['material_type']}" readonly value="">
                
                
                <?php foreach($data['materials'] as $material):?>
                    <input type="hidden" name="material_id[]" value="${material['material_id']}">
                <?php endforeach;?>
                
            </input>
                        
        </div>

        <div class="input-box">
            <span class="details">Sleeves</span>
            <input name="sleeve[]" value="${material['type']}" readonly value="">
                
                <?php foreach($data['sleeveType'] as $sleeve):?>
                    <input type="hidden" name="sleeve_id[]" value="${material['sleeve_id']}">
            <?php endforeach;?>
            </input>
        </div>

        <div class="input-box">
            <span class="details">Printing Type</span>
            <input name="printingType[]" value="${material['printing_type']}" readonly value="">
                
                <?php foreach($data['printingType'] as $printing):?>
                    <input type="hidden" name="ptype_id[]" value="${material['ptype_id']}">
                <?php endforeach;?>
            </input>
        </div>

        <div class="input-box sizes">
        <span class="details">Sizes & Quantity <span class="error sizes0"></span></span>
        <div class="sizeChart">
            <div>
                <span class="size">XS</span>
                <input class="st" type="number" id="quantity" name="xs[]" readonly value="${material['xs']}">
            </div>
            <div>
                <span class="size">S</span>
                <input class="st" type="number" id="quantity" name="small[]" readonly value="${material['small']}">
            </div>
            <div>
                <span class="size">M</span>
                <input class="st" type="number" id="quantity" name="medium[]" readonly value="${material['medium']}">
            </div>
            <div>
                <span class="size">L</span>
                <input class="st" type="number" id="quantity" name="large[]" readonly value="${material['large']}">
            </div>
            <div>
                <span class="size">XL</span>
                <input class="st" type="number" id="quantity" name="xl[]" readonly value="${material['xl']}">
            </div>
            <div>
                <span class="size">2XL</span>
                <input class="st" type="number" id="quantity" name="xxl[]" readonly value="${material['xxl']}">
            </div>
        </div>
    </div>
    `;

    newCard.style.transition = "all 0.5s ease-in-out";
    document.querySelector(".popup-view .add.card").before(newCard);



}

var map;
var marker;
var infowindow;
var flag = true;
function initMap() {

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 7.8731, lng: 80.7718},
        zoom: 8
    });

    map.addListener('mouseover', function(){
        var lat = document.querySelector('input[name="latitude"]').value;
        var lng = document.querySelector('input[name="longitude"]').value;
        

        if(lat && lng && flag){
            marker = new google.maps.Marker({
                position: {lat: parseFloat(lat), lng: parseFloat(lng)},
                map: map
            });
        }
        flag = false;
    });

    map.addListener('click', function(event) {
        

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

        google.maps.event.addListener(marker, 'rightclick', function(){
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