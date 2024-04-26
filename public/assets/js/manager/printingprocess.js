let sidebar = document.querySelector(".sidebar");
let nav = document.getElementById("navbar");

let popupView = document.getElementById("popup-view");
let closeViewBtn = document.querySelector(".popup-view .close");

//remove active classes of buttons
function removeActiveClasses(){
    let filterBtns = document.querySelectorAll('.filters button');
    filterBtns.forEach(btn => {
        btn.classList.remove('active');
    });
}

// filter table data when a filter button is clicked
function filterTable(arg){

    removeActiveClasses();
    let i = 0;
    let table_rows = document.querySelectorAll('.table-section tbody tr');
    if(arg == 'cut'){
        document.querySelector('.filters #pending').classList.add('active');
        if(table_rows.length == 0){
            document.querySelector('.table-section tbody').innerHTML = "<tr><td class='norecords' colspan='8'>No records found</td></tr>";
            return;
        }
        table_rows.forEach(row => {
            if(row.querySelector('.text-status').classList.contains('cut')){
                row.style.display = 'table-row';
                i++;
            }
            else{
                row.style.display = 'none';
            }
        }); 
        
    }else if(arg == 'printing'){
        document.querySelector('.filters #printing').classList.add('active');
        if(table_rows.length == 0){
            document.querySelector('.table-section tbody').innerHTML = "<tr><td colspan='8'>No records found</td></tr>";
            return;
        }
        table_rows.forEach(row => {
            if(row.querySelector('.text-status').classList.contains('printing')){
                row.style.display = 'table-row';
                i++;
            }
            else{
                row.style.display = 'none';
            }

        });
        
    }else if(arg == 'printed'){
        document.querySelector('.filters #printed').classList.add('active');
        if(table_rows.length == 0){
            document.querySelector('.table-section tbody').innerHTML = "<tr><td colspan='8'>No records found</td></tr>";
            return;
        }
        table_rows.forEach(row => {
            if(row.querySelector('.text-status').classList.contains('printed')){
                row.style.display = 'table-row';
                i++;
            }
            else{
                row.style.display = 'none';
            }

        });

    }else{
        document.querySelector('.filters #all').classList.add('active');
        if(table_rows.length == 0){
            document.querySelector('.table-section tbody').innerHTML = "<tr><td colspan='8'>No records found</td></tr>";
            return;
        }
        table_rows.forEach(row => {
            row.style.display = 'table-row';
            i++;
        });
     
    }
    
    if(i == 0){
        document.querySelector('.table-section tbody').innerHTML = "<tr><td colspan='8'>No records found</td></tr>";
    }
}

// *****************************Update status of order*******************************

var each_order = {};
var popup_status_btn = document.getElementById("popup-status-btn");

// popup time get the first update status data order data
function status_update_method(button) {
  status_confirm_popup.style.display = "block";

  const orderData = button.getAttribute("data-order");
  each_order = orderData;

  console.log(each_order);

}

function change_order_status(tap = "popup") {
  
  // always this part for come when user is popup click with the ok button 
  if (tap == "table btn") {
    order_status = "";
    
    // Get the data attribute value from the clicked button
    // const orderData = button.getAttribute("data-order");
    
    if (each_order) {
      // Parse the JSON data
      order = JSON.parse(each_order);
      
      switch (order.order_status) {
        case "cut":
          order_status = "printing";
          break;
        case "printing":
          order_status = "printed";
          break;
        case "printed":
            order_status = "sent to garment";
            break;
        default:
          break;
      }
    } else {
      return;
    }
  }

  if(order_status == "printed"){
    document.querySelector('.popup-view .update-form .update-btn').value = "Mark As Sent";
    document.querySelector('.popup-view .update-form .update-btn').title = "Mark order as sent to garment";
  }
//   popup_status_btn.innerHTML =
//     "<i class='bx bx-loader-circle bx-spin bx-flip-horizontal bx-sm'></i>";

//   document.getElementById(`table-status-btn${order.order_id}`).innerHTML =
//     "<i class='bx bx-loader-circle bx-spin bx-flip-horizontal bx-xs'></i>";
//   document.getElementById(`table-status-btn${order.order_id}`).disabled = true;

//   popup_status_btn.disabled = true;
//   document.getElementById("popup-status-cancel-btn").disabled = true;

  data = {
    garment_order_id: order.garment_order_id,
    status: order_status,
    order_id: order.order_id,
  };

  console.log(data);

  $.ajax({
    type: "POST",
    url: change_status_endpoint,
    data: data,
    cache: false,
    success: function (res) {
      try {
        // convet to the json type
        console.log(res);
        Jsondata = JSON.parse(res);

        if (Jsondata.user) {
            var successMsgElement = document.querySelector('.success-msg');
            successMsgElement.innerHTML = "Order updated successfully";
            successMsgElement.style.display = 'block';
            setTimeout(function() {
                successMsgElement.style.display = 'none';
                location.reload();
            }, 2000);
        }else{
            var successMsgElement = document.querySelector('.success-msg');
                
            successMsgElement.innerHTML = "There was an error updating the order";
            
            // successMsgElement.style.transition = 'all 1s ease-in-out';
            
            successMsgElement.style.display = 'block';
            successMsgElement.style.backgroundColor = 'red';
            setTimeout(function() {
                successMsgElement.style.display = 'none';
                location.reload();
            }, 2000);
        }
      } catch (error) {
        // popup_status_btn.innerHTML = "Update Status";
        // document.getElementById(`table-status-btn${order.order_id}`).innerHTML =
        //   "Update Status";
        var successMsgElement = document.querySelector('.success-msg');
                
        successMsgElement.innerHTML = "There was an error updating the order";
        
        // successMsgElement.style.transition = 'all 1s ease-in-out';
        
        successMsgElement.style.display = 'block';
        successMsgElement.style.backgroundColor = 'red';
        setTimeout(function() {
            successMsgElement.style.display = 'none';
            location.reload();
        }, 2000);

      }
    },
    error: function (xhr, status, error) {
        var successMsgElement = document.querySelector('.success-msg');
                
        successMsgElement.innerHTML = "There was an error updating the order";
        
        // successMsgElement.style.transition = 'all 1s ease-in-out';
        
        successMsgElement.style.display = 'block';
        successMsgElement.style.backgroundColor = 'red';
        setTimeout(function() {
            successMsgElement.style.display = 'none';
            location.reload();
        }, 2000);
    },
  });
}



//close button
closeViewBtn.addEventListener('click', closeView);

//confirmation popup 
// document.querySelector(".update-btn").addEventListener('click', function (event) {
//     event.preventDefault();

//     document.querySelector('.cu-popup').classList.add('is-visible');
// });

// document.querySelector('.cu-popup .no').addEventListener('click', function(){
//     updateConfirm.classList.remove('is-visible');
// });


function openView(button) {

    // Get the data attribute value from the clicked button
    const orderData = button.getAttribute("data-order");
    const materialData = button.getAttribute("data-material");
    const customersData = button.getAttribute("data-customers");

    const order = JSON.parse(orderData);
    const material = JSON.parse(materialData);
    const customers = JSON.parse(customersData);

    console.log('orderdata'+orderData);

       
        // Populate the "update-form" fields with the order data
        document.querySelector('.update-form input[name="order_id"]').value = order.order_id;
        document.querySelector('.update-form input[name="order_status"]').value = order.order_status;

        let existingCards = document.querySelectorAll('.user-details.new-card');
        let existingPriceRows = document.querySelectorAll('.price-details-container .units');

        // Remove each existing newCard element
        existingCards.forEach(function(card) {
            card.remove();
        });

        // Remove each existing priceRow element
        existingPriceRows.forEach(function(row) {
            row.remove();
        }
        );


        let quantity = 0;
        let countv = 0;
        for(let i=0; i<material.length; i++){
            console.log(material[i]);
            quantity = parseInt(material[i].xs) + parseInt(material[i].small) + parseInt(material[i].medium) + parseInt(material[i].large) + parseInt(material[i].xl) + parseInt(material[i].xxl);
            addMaterialCardView(material[i], quantity, countv);
        }
        

      
        document.querySelector('.update-form input[name="dispatch_date_pickup"]').value = order.dispatch_date;


        document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;

        // document.querySelector('.update-form input[name="unit_price"]').value = order.unit_price;

        // document.querySelector('.update-form embed[name="design"]').src = "/Project_Amoral/public/uploads/designs/" + order.pdf;


        // populate the customer details
        document.querySelector('.update-form input[name="id"]').value = order.user_id;
        customers.forEach(customer => {
            if(customer.id == order.user_id){
                document.querySelector('.update-form input[name="fullname"]').value = customer.fullname;
                document.querySelector('.update-form input[name="email"]').value = customer.email;
                document.querySelector('.update-form input[name="phone"]').value = customer.phone;
            }
        });


        //image slider

    const carouselImages = document.getElementById('carouselImages');
    const imageCount = document.querySelector('.image-count');

    let images = [order.image1, order.image2];
    let currentImage = 0;

    console.log(baseUrl+images[0]);



    images.forEach(image => {
        var path = baseUrl + image;
        var imgHTML = `<img src="${path}" alt="Product Image" class="carousel-image">`;
        console.log(imgHTML);
        carouselImages.innerHTML += imgHTML;
    });

    // imageCount.innerHTML = currentImage + 1/images.length;



    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    // Add event listeners to carousel buttons
    prevBtn.addEventListener('click', () => {
        // Decrease currentImage index
        currentImage--;
        // If currentImage is less than 0, set it to the last image
        if (currentImage < 0) {
            currentImage = images.length - 1;
        }
        updateCarousel();
    });

    nextBtn.addEventListener('click', () => {
        currentImage++;
        if (currentImage >= images.length) {
            currentImage = 0;
        }
        updateCarousel();
    });

    function updateCarousel() {

        carouselImages.innerHTML = '';
        carouselImages.innerHTML += `
        <img src="<?php echo ROOT . '/' ?>${images[currentImage].image_url}" alt="Product Image-${images[currentImage].product_image_id}" class="carousel-image">
    `;
        // Update image count
        // imageCount.innerHTML = currentImage + 1/images.length;
    }

    // Initial carousel update
    updateCarousel();

        popupView.classList.add("is-visible");
        document.body.style.overflow = "hidden";
        sidebar.style.pointerEvents = "none";
        nav.style.pointerEvents = "none";

}

function closeView() {
    popupView.classList.remove("is-visible");
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";

    document.querySelector('.update-form').reset();
}

function addMaterialCardView(material, quantity, countv ) {
    var newCard = document.createElement("div");
    newCard.className = "user-details new-card";

    
    newCard.innerHTML = `
        <i class="fas fa-minus remove"></i>
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

        <div class="input-box" style="margin-left: 30px;">
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
                <input class="st" type="number" id="quantity" name="xs[]" min="0" readonly value="${material['xs']}">
            </div>
            <div>
                <span class="size">S</span>
                <input class="st" type="number" id="quantity" name="small[]" min="0" readonly value="${material['small']}">
            </div>
            <div>
                <span class="size">M</span>
                <input class="st" type="number" id="quantity" name="medium[]" min="0" readonly value="${material['medium']}">
            </div>
            <div>
                <span class="size">L</span>
                <input class="st" type="number" id="quantity" name="large[]" min="0" readonly value="${material['large']}">
            </div>
            <div>
                <span class="size">XL</span>
                <input class="st" type="number" id="quantity" name="xl[]" min="0" readonly value="${material['xl']}">
            </div>
            <div>
                <span class="size">2XL</span>
                <input class="st" type="number" id="quantity" name="xxl[]" min="0" readonly value="${material['xxl']}">
            </div>
        </div>
    </div>
    `;

    newCard.style.transition = "all 0.5s ease-in-out";
    document.querySelector(".popup-view .add.card").before(newCard);
    countv++;

    let removeCard = newCard.querySelector("i");

    // hide the remove button for the first card
    console.log(countv);
    if(!newCard.previousElementSibling.classList.contains("new-card") && countv == 1){
        removeCard.style.display = "none";
        newCard.querySelector(".input-box").style.marginLeft = "30px";
    }

    removeCard.addEventListener('click', function(){
        countv--;
        newCard.remove();
            
    });

}


// image slider
