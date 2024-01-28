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
        // document.querySelector('.update-form input[name="xlarge"]').value = order.xl;

        document.querySelector('.update-form input[name="dispatch_date"]').value = order.dispatch_date;
        document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;

        document.querySelector('.update-form input[name="district"]').value =order.district;

        document.querySelector('.update-form embed[name="design"]').src = "/Project_Amoral/public/uploads/designs/" + order.image;


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
        // document.querySelector('.update-form input[name="xlarge"]').value = order.xl;

        document.querySelector('.update-form input[name="dispatch_date"]').value = order.dispatch_date;
        document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;

        document.querySelector('.update-form input[name="district"]').value =order.district;

        document.querySelector('.update-form embed[name="design"]').src = "/Project_Amoral/public/uploads/designs/" + order.image;


        popupViewReply.style.display = "block";
        document.body.style.overflow = "hidden";
        sidebar.style.pointerEvents = "none";
        nav.style.pointerEvents = "none";
      
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