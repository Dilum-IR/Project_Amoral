let popupView = document.getElementById("popup-view");
let popupViewReply = document.getElementById("popup-view-reply");
let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");
let popupNew = document.querySelector(".popup-new");
let closeReportBtn = document.querySelector(".popup-report .close");
let closeViewBtn = document.querySelector(".popup-view .close");
let closeNewBtn = document.querySelector(".popup-new .close");
let closeReplyBtn = document.querySelector(".popup-view-reply .close");

let sidebar = document.querySelector(".sidebar");
let nav = document.getElementById("navbar");

closeReportBtn.addEventListener("click", closeReport);
closeViewBtn.addEventListener("click", closeView);
closeReplyBtn.addEventListener("click", closeViewReply);
closeNewBtn.addEventListener("click", closeNew);

//search tables
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
let newForm = document.querySelector(".popup-new form");

document.addEventListener('DOMContentLoaded', (event) => {

    if (reportForm) {
        cancelReportBtn.addEventListener("click", function(event) {
            clearErrorMsg(reportForm);
        });
        closeReportBtn.addEventListener('click', function() {
            clearErrorMsg(reportForm);
            closeReport();
        });

        reportForm.addEventListener("submit", function(event) {
            // event.preventDefault();    
            clearErrorMsg(reportForm);
            console.log('submit');
            
                let errors = validateReport();
                console.log(Object.values(errors));
                if(Object.keys(errors).length > 0){
                    displayErrorMsg(reportForm, errors);
                    event.preventDefault();
                } else{
                    
                }
            });
            
    } else {
            console.error('Form not found');
    }

    if(newForm){
        closeNewBtn.addEventListener('click', function() {
            clearErrorMsg(newForm);
            closeNew();
        });

        newForm.addEventListener("submit", function(event) {
            // event.preventDefault();    
            clearErrorMsg(newForm);
            console.log('submit');
            
                let errors = validateNewForm();
                console.log(Object.values(errors));
                if(Object.keys(errors).length > 0){
                    displayErrorMsg(newForm, errors);
                    event.preventDefault();
                } else{
                    
                }
            });
    
    }
        
});

var today = new Date().toISOString().split('T')[0];
document.getElementsByName('dispatch_date_delivery')[0].setAttribute('min', today);
document.getElementsByName('dispatch_date_pickup')[0].setAttribute('min', today);


function validateNewForm(){
    let errors = {};

    var xs = document.getElementsByName('xs[]');
    var small = document.getElementsByName('small[]');
    var medium = document.getElementsByName('medium[]');
    var large = document.getElementsByName('large[]');
    var xl = document.getElementsByName('xl[]');
    var xxl = document.getElementsByName('xxl[]');

    var arrays = [xs, small, medium, large, xl, xxl];
   

    for (var i = 0; i < xs.length; i++) {
        // Check if at least one element at this position is not zero
        var flag = arrays.some(function(array) {
            return array[i] && array[i].value !== "0";
        });

        if (!flag) {
            errors['sizes' + i] = 'No values for sizes';
        }
    }

    var pdf = document.getElementById('pdfFileToUpload');
    var image1 = document.getElementById('imageFileToUpload1');
    var image2 = document.getElementById('imageFileToUpload2');

    if (pdf.files.length === 0 && (image1.files.length === 0 || image2.files.length === 0)) {
        errors['files'] = 'No files selected';
    }

    var dispatch_date_pickup = document.getElementsByName('dispatch_date_pickup')[0];
    var dispatch_date_delivery = document.getElementsByName('dispatch_date_delivery')[0];
    var city = document.getElementsByName('city')[0];

    if ((dispatch_date_pickup.value === '') && (dispatch_date_delivery.value === '' || city.value === '')) {
        errors['delivery'] = 'No delivery details';
    }


    return errors;


}


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

function displayErrorMsg(Form, errors){

for (const key in errors) {
    if (Object.hasOwnProperty.call(errors, key)) {
        const error = errors[key];
        Form.querySelector(`.error.${key}`).innerText = "*";
    }
}
}


function clearErrorMsg(Form){
    console.log('clear');
    let errorElements = Form.querySelectorAll('.error');

    errorElements.forEach(errorElement => {
        errorElement.innerText = '';
    });
}




function openView(button) {
  
    // Get the data attribute value from the clicked button
    const orderData = button.getAttribute("data-order");
    const materialData = button.getAttribute("data-material");
    
    console.log(materialData);
  
    if (orderData && materialData) {
        // Parse the JSON data
        const order = JSON.parse(orderData);
        const material = JSON.parse(materialData);

        
        // Populate the "update-form" fields with the order data
        document.querySelector('.update-form input[name="order_id"]').value = order.order_id;
        
        // document.querySelector('.update-form input[name="material[]"]').value = material[0].material_type;
        
        // document.querySelector('.update-form input[name="xs[]"]').value = material[0].xs;
        // document.querySelector('.update-form input[name="small[]"]').value = material[0].small;
        // document.querySelector('.update-form input[name="medium[]"]').value = material[0].medium;

        // document.querySelector('.update-form input[name="large[]"]').value = material[0].large;
        // document.querySelector('.update-form input[name="xl[]"]').value = material[0].xl;
        // document.querySelector('.update-form input[name="xxl[]"]').value = material[0].xxl;

                // Select all existing newCard elements
        let existingCards = document.querySelectorAll('.user-details.new-card');

        // Remove each existing newCard element
        existingCards.forEach(function(card) {
            card.remove();
        });

        for(let i=0; i<material.length; i++){
            console.log(material[i]);
            addMaterialCardView(material[i]);
        }
        document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;

        if(order.is_delivery == 1){
            document.querySelector('.update-form input[name="dispatch_date_delivery"]').value = order.dispatch_date;
            document.querySelector('.update-form input[name="district"]').value =order.city;
        }else{
            document.querySelector('.update-form input[name="dispatch_date_pickup"]').value = order.dispatch_date;
        }


        document.querySelector('.update-form embed[name="design"]').src = "/Project_Amoral/public/uploads/designs/" + order.pdf;


        popupView.style.display = "block";
        document.body.style.overflow = "hidden";
        sidebar.style.pointerEvents = "none";
        nav.style.pointerEvents = "none";
      
  }
}
function closeView(){
    popupView.style.display = "none";
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";
}	

function openViewReply(button) {
  
    // Get the data attribute value from the clicked button
    const orderData = button.getAttribute("data-reply-order");
    
    console.log(orderData);
  
    if (orderData) {
    const orderData = button.getAttribute("data-reply-order");
    const materialData = button.getAttribute("data-reply-material");
    
    console.log(materialData);
  
    if (orderData && materialData) {
        // Parse the JSON data
        const order = JSON.parse(orderData);
        const material = JSON.parse(materialData);

        
        // Populate the "update-form" fields with the order data
        document.querySelector('.reply-form input[name="order_id"]').value = order.order_id;
        
                // Select all existing newCard elements
        let existingCards = document.querySelectorAll('.user-details.new-card');

        // Remove each existing newCard element
        existingCards.forEach(function(card) {
            card.remove();
        });

        $qunatity = 0;
        for(let i=0; i<material.length; i++){
            console.log(material[i]);
            addMaterialCardViewReply(material[i]);
            $qunatity += parseInt(material[i].xs) + parseInt(material[i].small) + parseInt(material[i].medium) + parseInt(material[i].large) + parseInt(material[i].xl) + parseInt(material[i].xxl);
        }
        console.log($qunatity);
        document.querySelector('.reply-form input[name="order_placed_on"]').value = order.order_placed_on;

        if(order.is_delivery == 1){
            document.querySelector(".deliveryVR").classList.add("is-checked");
            document.querySelector('.reply-form input[name="dispatch_date_delivery"]').value = order.dispatch_date;
            document.querySelector('.reply-form input[name="district"]').value =order.city;
        }else{
            document.querySelector(".pickupVR").classList.add("is-checked");
            document.querySelector('.reply-form input[name="dispatch_date_pickup"]').value = order.dispatch_date;
        }


        document.querySelector('.reply-form embed[name="design"]').src = "/Project_Amoral/public/uploads/designs/" + order.pdf;

        document.querySelector('.reply-form input[name="unit_price"]').value = order.unit_price;
        document.querySelector('.reply-form input[name="total_price"]').value = order.unit_price * $qunatity;
        document.querySelector('.reply-form input[name="special_note"]').value = order.special_note;
        document.querySelector('.reply-form input[name="discount"]').value = order.discount;

        popupViewReply.style.display = "block";
        document.body.style.overflow = "hidden";
        sidebar.style.pointerEvents = "none";
        nav.style.pointerEvents = "none";
      
  }
}
}
function closeViewReply(){
    popupViewReply.style.display = "none";
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
    popupNew.style.display = "block";
    document.body.style.overflow = "hidden";
    sidebar.style.pointerEvents = "none";
    nav.style.pointerEvents = "none";
}
function closeNew(){
    popupNew.style.display = "none";
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";

    document.querySelector(".new-form").reset();
}


let countv = 0;
function addMaterialCardView(material) {
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

        <div class="input-box sizes">
            <span class="details">Sizes & Quantity</span>
            <div class="sizeChart">
                <span class="size">XS</span>
                <input class="st" type="number" id="quantity" name="xs[]" min="0" value="${material['xs']}">
                <br>
                <span class="size">S</span>
                <input class="st" type="number" id="quantity" name="small[]" min="0" value="${material['small']}">
                <br>
                <span class="size">M</span>
                <input class="st" type="number" id="quantity" name="medium[]" min="0" value="${material['medium']}">
                <br>
                <span class="size">L</span>
                <input class="st" type="number" id="quantity" name="large[]" min="0" value="${material['large']}">
                <br>
                <span class="size">XL</span>
                <input class="st" type="number" id="quantity" name="xl[]" min="0" value="${material['xl']}">
                <br>
                <span class="size">2XL</span>
                <input class="st" type="number" id="quantity" name="xxl[]" min="0" value="${material['xxl']}">
                <br>
            </div>
        </div>
    `;

    newCard.style.transition = "all 0.5s ease-in-out";
    document.querySelector(".popup-view .add.card").before(newCard);
    countv++;

    let removeCard = newCard.querySelector("i");

    removeCard.addEventListener('click', function(){
        countv--;
        if(countv == 0){
            removeCard.style.display = "none";
        } else {
            newCard.remove();
        }
    });
    

}


function addMaterialCardViewReply(material){
    var newCard = document.createElement("div");
    newCard.className = "user-details new-card";

    
    newCard.innerHTML = `
 
        <div class="input-box">
            <span class="details">Material </span>
            <input name="material[]" value="${material['material_type']}" readonly value="">
                
                
                <?php foreach($data['materials'] as $material):?>
                    <input type="hidden" name="material_id[]" value="${material['material_id']}">
                <?php endforeach;?>
                
            </input>
                        
        </div>

        <div class="input-box sizes">
            <span class="details">Sizes & Quantity</span>
            <div class="sizeChart">
                <span class="size">XS</span>
                <input class="st" type="number" id="quantity" name="xs[]" min="0" value="${material['xs']}">
                <br>
                <span class="size">S</span>
                <input class="st" type="number" id="quantity" name="small[]" min="0" value="${material['small']}">
                <br>
                <span class="size">M</span>
                <input class="st" type="number" id="quantity" name="medium[]" min="0" value="${material['medium']}">
                <br>
                <span class="size">L</span>
                <input class="st" type="number" id="quantity" name="large[]" min="0" value="${material['large']}">
                <br>
                <span class="size">XL</span>
                <input class="st" type="number" id="quantity" name="xl[]" min="0" value="${material['xl']}">
                <br>
                <span class="size">2XL</span>
                <input class="st" type="number" id="quantity" name="xxl[]" min="0" value="${material['xxl']}">
                <br>
            </div>
        </div>
    `;

    newCard.style.transition = "all 0.5s ease-in-out";
    document.querySelector(".popup-view-reply .add.card").before(newCard);
}

var map;
var marker;
var infowindow;
var circle;
async function initMap() {


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

initMap();