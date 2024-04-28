let popupView = document.getElementById("popup-view");
let popupReport = document.querySelector(".popup-report");
let popupNew = document.querySelector(".popup-new");
let closeViewBtn = document.querySelector(".popup-view .close");
let closeNewBtn = document.querySelector(".popup-new .close");
let payBtn = document.querySelector(".pay");

let sidebar = document.querySelector(".sidebar");
let nav = document.getElementById("navbar");

let progress1 = document.querySelector(".status ul li .one");
let progress2 = document.querySelector(".status ul li .two");
let progress3 = document.querySelector(".status ul li .three");
let progress4 = document.querySelector(".status ul li .four");
let progress5 = document.querySelector(".status ul li .five");
let progress6 = document.querySelector(".status ul li .six");
let orderCancel = document.querySelector("form .cancel-btn");
let orderUpdate = document.querySelector("form .update-btn");
let deleteConfirm = document.querySelector(".cd-popup");
let updateConfirm = document.querySelector(".cu-popup");

let updateNo = document.querySelector(".cu-popup .no");
let updateYes = document.querySelector(".cu-popup .yes");

const viewOrderBtns = document.querySelectorAll('.view-order-btn');

const search = document.querySelector(".form input"),
    table_rows = document.querySelectorAll(".table-section tbody tr")
    table_headings = document.querySelectorAll("thead th");

search.addEventListener('input', performSearch);

function performSearch() {
    table_rows.forEach((row, i) => {
        let search_data = search.value.toLowerCase(),
            row_text = '';

        for (let j = 0; j < row.children.length - 1; j++) {
            row_text += row.children[j].textContent.toLowerCase();

        }
        console.log(row_text);

        if(!row.classList.contains('filter')){
            row.classList.toggle('hide', row_text.indexOf(search_data) < 0);
            row.style.setProperty('--delay', i/40 + 's');
        }
    })
}

table_headings.forEach((head, i) => {
    head.onclick = () => {
        let order = 'asc';
        table_headings.forEach(head => head.classList.remove("active"));
        head.classList.add("active");
        let icon = head.querySelector('i');
        table_headings.forEach(h => {
            // console.log(h);
            if(h!=head && h.className !== "null"){
                let ic = h.querySelector('i');
                // console.log(ic);
                if(ic.className.includes('bx-up-arrow-circle')){
                    ic.className = "bx bx-down-arrow-circle";
                }
            }
        });
        if (icon.className.includes('bx-up-arrow-circle')) {
            // Change to down arrow
            icon.className = "bx bx-down-arrow-circle";
            order = 'asc';
        } else {
            // Change to up arrow
            icon.className = "bx bx-up-arrow-circle";
            order = 'desc';
        }



        console.log(i, order);
        sortTable(i, order);

    }
});

function sortTable(i, order){
    [...table_rows].sort((a, b) => {
        console.log(a.querySelectorAll('.table-section td')[i]);
        let x = a.querySelectorAll('.table-section tbody td')[i].textContent.trim(),
            y = b.querySelectorAll('.table-section tbody td')[i].textContent.trim();


        return order === 'asc' ? (x < y ? -1 : 1 ) : (x > y ? -1 : 1);
    }).map(row => document.querySelector('.table-section tbody').appendChild(row));

}

// orderCancel.addEventListener('click', function (event) {
//     console.log('cancel');
//     deleteConfirm.classList.add('is-visible');
// });

// orderUpdate.addEventListener('click', function (event) {
//     event.preventDefault();
//     let noerrors = validateViewOrder();
//     if(noerrors){
//         updateConfirm.classList.add('is-visible');
//     }
// });

// updateNo.addEventListener('click', function(){
//     updateConfirm.classList.remove('is-visible');
// });

/*
updateYes.addEventListener('click', function(){
    document.querySelector(".update-form").submit();
    updateConfirm.classList.remove('is-visible');
});
*/

//**********************Filter table***************************************************** */

//remove active classes of buttons
function removeActiveFilters(){
    let filterBtns = document.querySelectorAll('.filters button');
    filterBtns.forEach(btn => {
        btn.classList.remove('active');
    });
}

// filter table data when a filter button is clicked
function filterTable(arg){

    removeActiveFilters();
    let i = 0;
    let table_rows = document.querySelectorAll('.table-section tbody tr');
    if(arg == 'pending'){
        document.querySelector('.filters #pending').classList.add('active');
        // if(table_rows.length == 0){
        //     document.querySelector('.table-section tbody').innerHTML = "<tr><td class='norecords' colspan='8'>No records found</td></tr>";
        //     return;
        // }
        table_rows.forEach(row => {
            if(row.querySelector('.text-status').classList.contains('pending')){
                if(row.classList.contains('filter')){
                    row.classList.remove('filter');
                    i++;
                }
            }
            else{
                row.classList.add('filter');
            }
        }); 
        
    }else if(arg == 'cutting'){
        document.querySelector('.filters #cutting').classList.add('active');

        table_rows.forEach(row => {
            if(row.querySelector('.text-status').classList.contains('cutting') || row.querySelector('.text-status').classList.contains('cut')){
                if(row.classList.contains('filter')){
                    row.classList.remove('filter');
                    i++;filter
                }
            }
            else{
                row.classList.add('filter');
            }

        });
        
    }else if(arg == 'printing'){
        document.querySelector('.filters #printing').classList.add('active');

        table_rows.forEach(row => {
            if(row.querySelector('.text-status').classList.contains('printing') || row.querySelector('.text-status').classList.contains('printed') || row.querySelector('.text-status').classList.contains('sent to garment')){
                if(row.classList.contains('filter')){
                    row.classList.remove('filter');
                    i++;
                }
            }
            else{
                row.classList.add('filter');
            }

        });
        
    }else if(arg == 'sewing'){
        document.querySelector('.filters #sewing').classList.add('active');

        table_rows.forEach(row => {
            if(row.querySelector('.text-status').classList.contains('sewing') || row.querySelector('.text-status').classList.contains('sewed')){
                if(row.classList.contains('filter')){
                    row.classList.remove('filter');
                    i++;
                }
            }
            else{
                row.classList.add('filter');
            }

        });

    }else if(arg == 'delivering'){
        document.querySelector('.filters #delivering').classList.add('active');

        table_rows.forEach(row => {
            if(row.querySelector('.text-status').classList.contains('delivering')){
                if(row.classList.contains('filter')){
                    row.classList.remove('filter');
                    i++;
                }
            }
            else{
                row.classList.add('filter');
            }

        });
        
    }else if(arg == 'completed'){
        document.querySelector('.filters #completed').classList.add('active');

        table_rows.forEach(row => {
            if(row.querySelector('.text-status').classList.contains('delivered') || row.querySelector('.text-status').classList.contains('completed')){
                if(row.classList.contains('filter')){
                    row.classList.remove('filter');
                    i++;
                }
            }
            else{
                row.classList.add('filter');
            }

        });
        
    }else if(arg == 'cancelled'){
        document.querySelector('.filters #cancelled').classList.add('active');

        table_rows.forEach(row => {
            if(row.querySelector('.text-status').classList.contains('canceled')){
                if(row.classList.contains('filter')){
                    row.classList.remove('filter');
                    i++;
                }
            }
            else{
                row.classList.add('filter');
            }

        });
        
    }else{
        document.querySelector('.filters #all').classList.add('active');
        if(table_rows.length == 0){
            document.querySelector('.table-section tbody').innerHTML = "<tr><td colspan='8'>No records found</td></tr>";
            return;
        }
        console.log(table_rows);
        table_rows.forEach(row => {
            if(row.classList.contains('filter')){
                row.classList.remove('filter');
                i++;
            }

        });
     
    }
    

}


//validate the delivery dates
let datesNew = document.querySelectorAll('.popup-new input[type="date"]');
let datesView = document.querySelectorAll('.popup-view input[type="date"]');

let today = new Date();
// let todayStr = today.toISOString().split('T')[0];
let threeDaysLater = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 4).toISOString().split('T')[0];
// let fiveDaysLater = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 6).toISOString().split('T')[0];

datesNew.forEach(date => {
    date.setAttribute('min', threeDaysLater);
});

datesView.forEach(date => {
    date.setAttribute('min', threeDaysLater);
});



let reportForm = document.querySelector(".popup-report form");
let newForm = document.querySelector(".popup-new form");
let viewForm = document.querySelector(".popup-view form");
let cancelReportBtn = document.querySelector(".cancelR-btn");
let cancelNewBtn = document.querySelector(".popup-new .cancel-btn");


document.addEventListener('DOMContentLoaded', () => {

    if (reportForm) {
        cancelReportBtn.addEventListener("click", function () {
            clearErrorMsg(reportForm);
        });
        closeReportBtn.addEventListener('click', function () {
            clearErrorMsg(reportForm);
            closeReport();
        });

        reportForm.addEventListener("submit", function (event) {
            // event.preventDefault();    
            clearErrorMsg(reportForm);
            console.log('submit');

            let errors = validateReport();
            console.log(Object.values(errors));
            if (Object.keys(errors).length > 0) {
                displayErrorMsg(errors, reportForm);
                event.preventDefault();
            }
        });

    }
});


// close buttons
closeViewBtn.addEventListener('click', closeView);
closeNewBtn.addEventListener('click', closeNew);

function validateNewOrder() {
    let errors = {};
    // pdf and images
    var pdf = document.querySelector('#pdfFileToUpload');
    var image1 = document.querySelector('#imageFileToUpload1');
    var image2 = document.querySelector('#imageFileToUpload2');

    if (pdf.files.length === 0 && (image1.files.length === 0 || image2.files.length === 0)) {
        // alert('Please upload a PDF or an image');
        // event.preventDefault();
        errors['files'] = ' *Please upload a PDF or images';
    }

    // sizes
    let sizes = document.querySelectorAll('.popup-new input[type="number"]');
    let total = 0;
    sizes.forEach(size => {
        total += parseInt(size.value);
    });

    if (total === 0) {
        // event.preventDefault();
        errors['sizes0'] = ' *Please select a size';
    }

    // dispatch date
    let dates = document.querySelectorAll('.popup-new input[type="date"]');
    let dateSelected = false;

    dates.forEach(date => {
        if (date.value !== '') {
            dateSelected = true;
        }
    });

    if (!dateSelected) {
        // event.preventDefault();
        errors['dates'] = ' *Please select a date';
    }

    clearErrorMsg(newForm);
            
    // let errors = validateNewOrder();
    console.log(Object.values(errors));
    if (Object.keys(errors).length > 0) {
        displayErrorMsg(errors, newForm);
        // event.preventDefault();
    }

    // console.log(errors);

    if(Object.keys(errors).length === 0){
        return true;
    }else{
        return false;
    }

}


function validateViewOrder() {
    let errors = {};
    // pdf and images
   // var pdf = document.querySelector('#pdfFileToUpload');
// var image1 = document.querySelector('#imageFileToUpload1');
// var image2 = document.querySelector('#imageFileToUpload2');

// if (pdf.files.length === 0 && (image1.files.length === 0 || image2.files.length === 0)) {
    // alert('Please upload a PDF or an image');
    // event.preventDefault();
    // errors['files'] = ' *Please upload a PDF or images';
// }

    // sizes
    let sizes = document.querySelectorAll('.popup-view .st');
    let total = 0;
    sizes.forEach(size => {
        total += parseInt(size.value);
    });

    if (total === 0) {
        // event.preventDefault();
        errors['sizes0'] = ' *Please select a size';
    }

    // dispatch date
    let dates = document.querySelectorAll('.popup-view input[type="date"]');
    let dateSelected = false;

    dates.forEach(date => {
        if (date.value !== '') {
            dateSelected = true;
        }
    });

    if (!dateSelected) {
        // event.preventDefault();
        errors['dates'] = ' *Please select a date';
    }

    clearErrorMsg(viewForm);
            
    // let errors = validateNewOrder();
    // console.log(Object.values(errors));
    if (Object.keys(errors).length > 0) {
        displayErrorMsg(errors, viewForm);
        // event.preventDefault();
    }

    if(Object.keys(errors).length === 0){
        return true;
    }else{
        return false;
    }

}

function validateReport() {
    let errors = {};

    let title = reportForm.querySelector('input[name="title"]').value;
    if (title.trim() === '') {
        errors['title'] = 'Title is required';
    }

    let description = reportForm.querySelector('textarea[name="description"]').value;
    if (description.trim() === '') {
        errors['description'] = 'Description is required';
    }

    let email = reportForm.querySelector('input[name="email"]').value;
    if (email.trim() === '') {
        errors['email'] = 'Email is required';
    } else if (!validateEmail(email)) {
        errors['email'] = 'Invalid email';
    }

    return errors;
}

function validateEmail(email) {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function displayErrorMsg(errors, form) {

    for (const key in errors) {
        if (Object.hasOwnProperty.call(errors, key)) {
            const error = errors[key];
            form.querySelector(`.error.${key}`).innerText = error;
        }
    }
}


function clearErrorMsg(form) {
    // console.log('clear');
    let errorElements = form.querySelectorAll('.error');

    errorElements.forEach(errorElement => {
        errorElement.innerText = '';
    });
}


function removeActiveClass() {
    document.querySelectorAll(".popup-view .status ul li .progress").forEach(li => {
        progress1.classList.remove("cancel");

        li.classList.remove("active");
    });
}

var lat;
var lng;
function openView(button) {

    // Get the data attribute value from the clicked button
    const orderData = button.getAttribute("data-order");
    const materialData = button.getAttribute("data-material");
    const customersData = button.getAttribute("data-customers");
    const garmentOrderData = button.getAttribute("data-g-orders");
    const employeeData = button.getAttribute("data-emp");

    console.log(materialData);
    
    removeActiveClass();
    
    if (orderData) {
        // Parse the JSON data
        const order = JSON.parse(orderData);
        console.log(order);
        const material = JSON.parse(materialData);
        const customers = JSON.parse(customersData);
        let employee = '';
        if(order.order_status != 'pending' && garmentOrderData){
            const garmentOrders = JSON.parse(garmentOrderData);
            const gOrder = garmentOrders.find(ord => ord.order_id == order.order_id);
            console.log(gOrder);
            if(employeeData){
                const employees = JSON.parse(employeeData);
                employee = employees.find(emp => emp.emp_id == gOrder.emp_id);  
                console.log(employee);   
            }
        }

        switch (order.order_status) {
            case 'cutting' :
                progress2.classList.add("active");
                progress2.classList.add("set");
                progress2.nextElementSibling.innerText = 'Cutting';
                progress3.nextElementSibling.innerText = 'Printing';
                progress4.nextElementSibling.innerText = 'Sewing';
                progress5.nextElementSibling.innerText = 'Delivery In Progress';
                break;

            case 'cut':
                progress2.classList.add("active");
                progress2.classList.add("set");
                progress2.nextElementSibling.innerText = 'Cut';
                progress3.nextElementSibling.innerText = 'Printing';
                progress4.nextElementSibling.innerText = 'Sewing';
                progress5.nextElementSibling.innerText = 'Delivery In Progress';
                break;

            case 'printing':
                progress2.classList.add("active");
                progress3.classList.add("active");
                progress3.classList.add("set");
                progress2.nextElementSibling.innerText = 'Cut';
                progress3.nextElementSibling.innerText = 'Printing';
                progress4.nextElementSibling.innerText = 'Sewing';
                progress5.nextElementSibling.innerText = 'Delivery In Progress';
                break;

            case 'printed':
                progress2.classList.add("active");
                progress3.classList.add("active");
                progress3.classList.add("set");
                progress3.nextElementSibling.innerText = 'Printed';
                progress4.nextElementSibling.innerText = 'Sewing';
                progress5.nextElementSibling.innerText = 'Delivery In Progress';
                break;

            case 'sent to garment':
                progress2.classList.add("active");
                progress3.classList.add("active");
                progress3.classList.add("set");
                progress3.nextElementSibling.innerText = 'Printed & Sent to Stitch';
                progress4.nextElementSibling.innerText = 'Sewing';
                progress5.nextElementSibling.innerText = 'Delivery In Progress';
                break;

            case 'sewing':
                progress2.classList.add("active");
                progress3.classList.add("active");
                progress4.classList.add("active");
                progress4.classList.add("set");
                progress4.nextElementSibling.innerText = 'Sewing';
                progress5.nextElementSibling.innerText = 'Delivery In Progress';
                break;

            case 'sewed':
                progress2.classList.add("active");
                progress3.classList.add("active");
                progress4.classList.add("active");
                progress4.classList.add("set");
                progress4.nextElementSibling.innerText = 'Sewed';
                progress5.nextElementSibling.innerText = 'Delivery In Progress';

                break;

            case 'delivering':
                progress2.classList.add("active");
                progress3.classList.add("active");
                progress4.classList.add("active");
                progress5.classList.add("active");
                progress5.classList.add("set");
                progress5.nextElementSibling.innerText = 'Delivery In Progress';
                break;

            case 'delivered':
                progress2.classList.add("active");
                progress3.classList.add("active");
                progress4.classList.add("active");
                progress5.classList.add("active");
                progress5.classList.add("set");
                progress5.nextElementSibling.innerText = 'Delivered';
                break;

            case 'completed':
                progress2.classList.add("active");
                progress3.classList.add("active");
                progress4.classList.add("active");
                progress5.classList.add("active");
                progress6.classList.add("active");
                progress6.classList.add("set");
                progress6.nextElementSibling.innerText = 'Completed';
                break;

            case 'canceled':
                progress1.classList.add("cancel");
                progress1.nextElementSibling.innerText = 'Cancelled';
                break;

        }

        //get the payment type - no, half or full
        let paymentType = order.pay_type;
        if(paymentType == 'no'){
            document.querySelector('.popup-view .payment span').innerText = 'Not Paid';
            document.querySelector('.popup-view .payment').style.backgroundColor = '#ff0000';
        }else if(paymentType == 'half'){
            document.querySelector('.popup-view .payment span').innerText = 'Half Paid';
            document.querySelector('.popup-view .payment').style.backgroundColor = '#ffcc00';

        }else if(paymentType == 'full'){
            document.querySelector('.popup-view .payment span').innerText = 'Fully Paid';
            document.querySelector('.popup-view .payment').style.backgroundColor = 'rgb(33 159 33)';
            document.querySelector('.popup-view input[name="total_price"]').setAttribute("disabled", "disabled");
            document.querySelector('.popup-view input[name="discount"]').setAttribute("disabled", "disabled");

        }

        // if not paid cannot update status
        // if(paymentType == 'no'){
        //     document.querySelectorAll(".popup-view .status ul li .progress").forEach(li => {
        //         li.style.pointerEvents = 'none';
        //         li.style.cursor = 'not-allowed';
        //     });
        // }else{
        //     document.querySelectorAll(".popup-view .status ul li .progress").forEach(li => {
        //         li.style.pointerEvents = 'auto';
        //         li.style.cursor = 'pointer';
        //     });
        // }




        // update the status bar when clicked the next status
        let statuses = ['pending', 'cutting', 'printing', 'sewing', 'delivering', 'completed']
        let changedStatus = order.order_status;
        let i = -1;
        let prevStatus = null;

        if(paymentType != 'no'){
            console.log(' jiosjci');
            document.querySelectorAll(".popup-view .status ul li .progress").forEach((li, index) => {
                if(index != 0){
                    let prevElement = li.parentElement.previousElementSibling.querySelector('.progress');
                    console.log(prevElement.classList);
                    if((li.classList.contains("cutting") || li.classList.contains("completed")) && (prevElement.classList.contains("set") || prevElement.classList.contains('one')) && !(li.classList.contains('active')) ){
                        console.log('nvsdknfks');
                        li.style.pointerEvents = 'auto';
                        li.style.cursor = 'pointer';
                        li.addEventListener('click', function () {
                            this.classList.toggle("active");
                            console.log(this);
                                
                            
                            if(this.classList.contains("active")){
                                i++;
                                updateStatus(this.classList);
                            }else{
                                changedStatus = prevStatus;                 
                                i--;
                            }
                            prevStatus = statuses[i];
                            // console.log('prevstatus      '+prevStatus);
                            // console.log('status    '+changedStatus);
                            document.querySelector('.update-form input[name="order_status"]').value = changedStatus;
                            // console.log(document.querySelector('.update-form input[name="order_status"]').value);
                        });
    
                    }

                }
            });
        }else{
            document.querySelectorAll(".popup-view .status ul li .progress").forEach(li => {
                li.style.pointerEvents = 'none';
                li.style.cursor = 'not-allowed';
            });
        }

        function updateStatus(classes){
            console.log(classes);
            if (classes.contains("two") && classes.contains("active")) {
                changedStatus = 'cutting';
            } else if (classes.contains("six") && classes.contains("active")) {
                changedStatus = 'completed';
            }
        }


        var today = new Date();
        var formattedDate = today.getFullYear() + '-' + String(today.getMonth()).padStart(2, '0') + '-' + String(today.getDate()).padStart(2, '0');
       
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

        if(paymentType == 'full'){
            let unitPriceInputs = document.querySelector('.popup-view input[name="unit_price[]"]');
            console.log(unitPriceInputs);
            if(!Array.isArray(unitPriceInputs)){
                unitPriceInputs = [unitPriceInputs];
            }
            unitPriceInputs.forEach(input => {
                input.setAttribute("disabled", "disabled");
            });
        }

        // after updating to cutting, disable updating quantity
        if (order.order_status != 'pending') {
            document.querySelectorAll(".popup-view .st").forEach(input => {
                input.setAttribute("disabled", "disabled");
            });

            // update employee input field
            document.querySelector('.update-form input[name="emp_id"]').value = 'EMP-' + employee.emp_id + ' - ' + employee.emp_name;
        }else{
            document.querySelectorAll(".popup-view .st").forEach(input => {
                input.removeAttribute("disabled");
            });
        }
        

        // update the total price when discount is updated
        let discountInput = document.querySelector('.popup-view input[name="discount"]');
        discountInput.addEventListener('change', function(){
            updateTotalPrice();
        });

        document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;

        // document.querySelector('.update-form input[name="unit_price"]').value = order.unit_price;

        if(order.is_delivery == 1){
            document.querySelector(".pickup").classList.remove("is-checked");
            document.querySelector(".delivery").classList.add("is-checked");
            document.querySelector('.update-form input[name="dispatch_date_delivery"]').value = order.dispatch_date;
            document.querySelector('.update-form input[name="city"]').value =order.city;
            document.querySelector('.update-form input[name="latitude"]').value = order.latitude;
            document.querySelector('.update-form input[name="longitude"]').value = order.longitude;
            lat = parseFloat(order.latitude);
            lng = parseFloat(order.longitude);
            // console.log(typeof(lat));

            
        }else{
            document.querySelector(".delivery").classList.remove("is-checked");
            document.querySelector(".pickup").classList.add("is-checked");
            document.querySelector('.update-form input[name="dispatch_date_pickup"]').value = order.dispatch_date;
        }

        if(order.is_delivery == 1){

            var map = new google.maps.Map(document.getElementById("view-order-map"), {
                // Initial center coordinates
                center: {
                    
                    lat: lat,
                    lng: lng,
                },
                zoom: 15,
            });
        }else{
            var map = new google.maps.Map(document.getElementById("view-order-map"), {
                // Initial center coordinates
                center: {
                    // Sri lanka middle lat lang
                    lat: 7.7072567,
                    lng: 80.6534611,
                },
                zoom: 7,
            });
        }

        // map.setZoom(15);
        marker = new google.maps.Marker({
            position: {
                lat: lat,
                lng: lng,
            },
            map: map,
            title: "Your Location",
        });

        map.addListener("click", function (event) {
            if (marker) {
            marker.setMap(null);
            }
    
            // Get the clicked location's latitude and longitude
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();
    
            console.log(latitude);
    
            marker = new google.maps.Marker({
            position: {
                lat: latitude,
                lng: longitude,
            },
            map: map,
            });
    
            document.querySelector('.popup-view input[name="latitude"]').value = latitude;
            document.querySelector('.popup-view input[name="longitude"]').value = longitude;
            document.querySelector('.popup-view input[name="pay_type"]').value = paymentType;
        });
        

        marker.addListener("click", function () {
            infoWindow.open(map, marker);
        });


        document.querySelector('.update-form input[name="total_price"]').value = order.total_price;
        document.querySelector('.update-form input[name="discount"]').value = order.discount;
        // document.querySelector('.update-form input[name="remaining_payment"]').value = order.remaining_payment;
        
        // document.querySelector('.update-form .totalPrice').value = order.total_price;


        document.querySelector('.update-form input[name="order_placed_on"]').value = order.order_placed_on;
        // document.querySelector('.update-form input[name="city"]').value = order.city;

        console.log(order.pdf);
        if(order.pdf === ''){
            document.querySelector('.update-form embed[name="design"]').style.display = 'none';
            document.querySelector('.update-form .carousel').style.display = 'flex';
        
            //download images when the button is clicked
            document.querySelector('.download').addEventListener('click', function() {
                var link = document.createElement('a');
                [order.image1, order.image2].forEach(image => {
        
                    link.href = "/Project_Amoral/public/uploads/designs/" + image;
                    link.download = image;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                });
            });
        }else{
            document.querySelector('.update-form embed[name="design"]').style.display = 'block';
            document.querySelector('.update-form embed[name="design"]').src = "/Project_Amoral/public/uploads/designs/" + order.pdf;
            
            //download the pdf when the button is clicked
            document.querySelector('.download').addEventListener('click', function() {
                var link = document.createElement('a');
                link.href = "/Project_Amoral/public/uploads/designs/" + order.pdf;
                link.download = order.pdf;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
            document.querySelector('.update-form .carousel').style.display = 'none';
        }

//image slider

const carouselImages = document.getElementById('carouselImages');
// const imageCount = document.querySelector('.image-count');

let images = [order.image1, order.image2];
let currentImage = 0;

// console.log(baseUrl+images[0]);



images.forEach((image, index) => {
    var path =  '../uploads/designs/' + image;
    console.log(path);
    var imgHTML1 = document.querySelector('.img1');
    var imgHTML2 = document.querySelector('.img2');
    // imgHTML.src = path;
    if(index==1){
        imgHTML2.src = path;
        imgHTML2.style.transition = 'all 0.5s ease-in-out';
        // imgHTML.classList.add('img2')
        imgHTML2.style.display = 'none';
        // currentImage = 1;
    }else{
        imgHTML1.src = path;
        imgHTML1.style.transition = 'all 0.5s ease-in-out';

        // imgHTML.classList.add('img1')
        imgHTML1.style.display = 'block';
        // currentImage = 0;
    }
    // var imgHTML = `<img src="${path}" alt="Product Image" class="carousel-image">`;
    // console.log(imgHTML);
    // carouselImages.innerHTML = imgHTML;
    // carouselImages.appendChild(imgHTML);
});

// imageCount.innerHTML = currentImage + 1/images.length;



const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

// Add event listeners to carousel buttons
prevBtn.addEventListener('click', (event) => {
    // Decrease currentImage index
    event.preventDefault();
    if(currentImage == 1){
        document.querySelector('.img2').style.display = 'none';
        document.querySelector('.img1').style.display = 'block';
        currentImage = 0;
    }
});

nextBtn.addEventListener('click', (event) => {
    // Increase currentImage index
    event.preventDefault();
    if(currentImage == 0){
        document.querySelector('.img1').style.display = 'none';
        document.querySelector('.img2').style.display = 'block';
        currentImage = 1;
    }
});




        // populate the customer details
        document.querySelector('.update-form input[name="id"]').value = order.user_id;
        customers.forEach(customer => {
            if(customer.id == order.user_id){
                document.querySelector('.update-form input[name="fullname"]').value = customer.fullname;
                document.querySelector('.update-form input[name="email"]').value = customer.email;
                document.querySelector('.update-form input[name="phone"]').value = customer.phone;
            }
        });

        popupView.classList.add("is-visible");
        document.body.style.overflow = "hidden";
        sidebar.style.pointerEvents = "none";
        nav.style.pointerEvents = "none";


        //disable the fields according to the status
        if(order.order_status == 'canceled'){
            document.querySelectorAll('.popup-view input').forEach(input => {
                input.setAttribute("disabled", "disabled");
            });
            document.querySelectorAll('.popup-view .new-card .remove').forEach(remove => {
                remove.style.display = "none";
            });
            orderCancel.style.display = "none";
            orderUpdate.style.display = "none";
        }else if (order.order_status == 'delivering' || order.order_status == 'delivered' || order.order_status == 'completed' ) {
            document.querySelectorAll(".popup-view input[type='date']").forEach(date => {	
                date.setAttribute("disabled", "disabled");
            });
            document.querySelectorAll('.popup-view .new-card .remove').forEach(remove => {
                remove.style.display = "none";
            });
            orderCancel.style.display = "none";
            orderUpdate.style.display = "none";
            if(order.order_status == 'delivered'){
                orderUpdate.style.display = 'block'
                orderUpdate.value = 'Mark As Completed';
            }
        } else {
            if(order.order_status != 'pending' ){
                document.querySelectorAll('.popup-view .new-card .remove').forEach(remove => {
                    remove.style.display = "none";
                });
            }
            document.querySelectorAll(".popup-view input[type='date']").forEach(date => {	
                date.removeAttribute("disabled");
            });
            orderCancel.style.display = "block";
            orderUpdate.style.display = "block";
        }


    }

}


function closeView() {
    popupView.classList.remove("is-visible");
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";

    document.querySelector('.update-form').reset();
}

function openNew(){
    popupNew.classList.add("is-visible");
    document.body.style.overflow = "hidden";
    sidebar.style.pointerEvents = "none";
    nav.style.pointerEvents = "none";
}
function closeNew(){
    popupNew.classList.remove("is-visible");
    document.body.style.overflow = "auto";
    sidebar.style.pointerEvents = "auto";
    nav.style.pointerEvents = "auto";

    let cards = document.querySelectorAll(".new-card");
    cards.forEach(card => {
        card.remove();
    });
    let priceRows = document.querySelectorAll(".price-details-container .units");
    priceRows.forEach((row, index) => {
        if (index !== 0) {
            row.remove();
        }
    });
    document.querySelector(".new-form").reset();
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
                <input class="st" type="number" id="quantity" name="xs[]" min="0" value="${material['xs']}">
            </div>
            <div>
                <span class="size">S</span>
                <input class="st" type="number" id="quantity" name="small[]" min="0" value="${material['small']}">
            </div>
            <div>
                <span class="size">M</span>
                <input class="st" type="number" id="quantity" name="medium[]" min="0" value="${material['medium']}">
            </div>
            <div>
                <span class="size">L</span>
                <input class="st" type="number" id="quantity" name="large[]" min="0" value="${material['large']}">
            </div>
            <div>
                <span class="size">XL</span>
                <input class="st" type="number" id="quantity" name="xl[]" min="0" value="${material['xl']}">
            </div>
            <div>
                <span class="size">2XL</span>
                <input class="st" type="number" id="quantity" name="xxl[]" min="0" value="${material['xxl']}">
            </div>
        </div>
    </div>
    `;

    newCard.style.transition = "all 0.5s ease-in-out";
    document.querySelector(".popup-view .add.card").before(newCard);
    countv++;

    var newPriceRow = document.createElement("tr");
    newPriceRow.className = "units";
    
    newPriceRow.innerHTML = `
    <td class="materialType">${material['material_type']}</td>
    <td class="sleeveType">${material['type']}</td>
    <td class="printingType">${material['printing_type']}</td>
    <td class="quantityAll">${quantity}</td>
    <td><input type="text" name="unit_price[]" class="unitPrice" style="border: none;" value="${material['unit_price']}"></td>
`;
    
    document.querySelector(".price-details-container .discount").before(newPriceRow);
    
    let removeCard = newCard.querySelector("i");

    // hide the remove button for the first card
    console.log(countv);
    if(!newCard.previousElementSibling.classList.contains("new-card") && countv == 1){
        removeCard.style.display = "none";
        newCard.querySelector(".input-box").style.marginLeft = "30px";
    }

    removeCard.addEventListener('click', function(){
        countv--;

            //remove cards and reduce the prices from the total
            let removedPrice = parseInt(newPriceRow.querySelector(".unitPrice").innerText) * parseInt(newPriceRow.querySelector(".quantityAll").innerText);
            let tot = parseInt(document.querySelector(".popup-view .totalPrice").innerText);
            // console.log(removedPrice);
            newCard.remove();
            newPriceRow.remove();
            document.querySelector(".popup-view .totalPrice").innerHTML = tot - removedPrice;
        
    });

    //update price when quantity is changed
    let quantityInputs = newCard.querySelectorAll(".st");
    quantityInputs.forEach(input =>{
        input.addEventListener('change', function(){
            let quantity = 0;
            quantityInputs.forEach(input =>{
                quantity += parseInt(input.value);
            });
            newPriceRow.querySelector(".quantityAll").innerText = quantity;
            updateTotalPrice();
        });
    });


}

function updateTotalPrice(){
    let total = 0;
    document.querySelectorAll(".units").forEach(function(unit){
        total += parseInt(unit.querySelector(".popup-view input[name='unit_price[]']").value) * parseInt(unit.querySelector(".quantityAll").innerHTML);
        // console.log(unit.querySelector(".quantityAll").innerHTML);
    });
    let discount = parseInt(document.querySelector(".popup-view input[name='discount']").value);
    console.log(discount);
    total *= (100 - discount) / 100;
    console.log(total);
    // document.querySelector(".popup-view .totalPrice").innerHTML = total;

    document.querySelector(".popup-view input[name='total_price']").value = total;
    console.log("tot"+document.querySelector(".popup-view input[name='total_price']").value);
}


///******************************************update order****************************************************** */

var each_order = {};

function update_method(button){
    status_confirm_popup.style.display = "block";

    const orderData = button.getAttribute("data-order");
    each_order = orderData;
  
    console.log(each_order);
  
}

function change_order_status(tap = "popup"){
    if(tap == "table btn"){
        if(each_order){
            order = JSON.parse(each_order);

            console.log(order);
        }
    }

    $.ajax({
        type: "POST",
        url: update_order_endpoint,
        data: order,
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
                    //   location.reload();
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

var orderId;

function cancel_method(ordId){
    delete_confirm_popup.style.display = "block";
    orderId = ordId;
    console.log(orderId);
}

function cancel_order(tap = "popup"){
    if(tap == "table btn"){

        $.ajax({
            type: "POST",
            url: cancel_order_endpoint,
            data: {order_id: orderId},
            cache: false,
            success: function (res) {
                try {
                // convet to the json type
                console.log(res);
                Jsondata = JSON.parse(res);
        
                if (Jsondata.user) {
                    var successMsgElement = document.querySelector('.success-msg');
                    successMsgElement.innerHTML = "Order cancelled successfully";
                    successMsgElement.style.display = 'block';
                    setTimeout(function() {
                        successMsgElement.style.display = 'none';
                        location.reload();
                    }, 2000);
                }else{
                    var successMsgElement = document.querySelector('.success-msg');
                        
                    successMsgElement.innerHTML = "There was an error cancelling the order";
                    
                    // successMsgElement.style.transition = 'all 1s ease-in-out';
                    
                    successMsgElement.style.display = 'block';
                    successMsgElement.style.backgroundColor = 'red';
                    setTimeout(function() {
                        successMsgElement.style.display = 'none';
                        //   location.reload();
                    }, 2000);
                }
                } catch (error) {
                // popup_status_btn.innerHTML = "Update Status";
                // document.getElementById(`table-status-btn${order.order_id}`).innerHTML =
                //   "Update Status";
                var successMsgElement = document.querySelector('.success-msg');
                        
                successMsgElement.innerHTML = "There was an error cancelling the order";
                
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
                        
                successMsgElement.innerHTML = "There was an error cancelling the order";
                
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
}


function initMap(){
  
    var marker1;
    var marker2;
    var map1;
    var map2;
  
    map1 = new google.maps.Map(document.getElementById("new-order-map"), {
      // Initial center coordinates
      center: {
        // Sri lanka middle lat lang
        lat: 7.7072567,
        lng: 80.6534611,
      },
      zoom: 7,
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
  
    // set the marker initial time user current location
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        function (position) {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

        //   var pos_view = {
        //     lat: lat,
        //     lng: lng,
        //     };
  
          // Set the map's center to the user's current location
          map1.setCenter(pos);
        //   map2.setCenter(pos);
          
          map1.setZoom(15);
        //   map2.setZoom(15);
  
          // Add a marker at the user's current location
          marker1 = new google.maps.Marker({
            position: pos,
            map: map1,
            title: "Your Location",
          });

        //   marker2 = new google.maps.Marker({
        //     position: pos_view,
        //     map: map2,
        //     title: "Your Location",
        //   });
        },
        function () {
          handleLocationError(true, map1.getCenter());
          handleLocationError(true, map2.getCenter());
        }
      );
    } else {
      handleLocationError(false, map1.getCenter());
      handleLocationError(false, map2.getCenter());
    }
  
    // add the location lat lang for this object
    var selectedLocation;
  
    // Add a click event listener to the map
    
    map1.addListener("click", function (event) {
      if (marker1) {
        marker1.setMap(null);
      }
  
      // Get the clicked location's latitude and longitude
      var latitude = event.latLng.lat();
      var longitude = event.latLng.lng();
  
      console.log(latitude);
  
      marker1 = new google.maps.Marker({
        position: {
          lat: latitude,
          lng: longitude,
        },
        map: map1,
      });
  
      document.querySelector('.popup-new input[name="latitude"]').value = latitude;
      document.querySelector('.popup-new input[name="longitude"]').value = longitude;
    });

    // map2.addListener("click", function (event) {
    //   if (marker2) {
    //     marker2.setMap(null);
    //   }
  
    //   // Get the clicked location's latitude and longitude
    //   var latitude = event.latLng.lat();
    //   var longitude = event.latLng.lng();
  
    //   console.log(latitude);
  
    //   marker2 = new google.maps.Marker({
    //     position: {
    //       lat: latitude,
    //       lng: longitude,
    //     },
    //     map: map2,
    //   });
  
    //   document.querySelector('.popup-view input[name="latitude"]').value = latitude;
    //   document.querySelector('.popup-view input[name="longitude"]').value = longitude;
    // });
    
    // marker1.addListener("click", function () {
    //   infoWindow.open(map1, marker1);
    // });

    // marker2.addListener("click", function () {
    //   infoWindow.open(map2, marker2);
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