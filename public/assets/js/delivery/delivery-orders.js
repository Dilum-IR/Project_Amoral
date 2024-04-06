let popupView = document.getElementById("popup-view");
let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");

function openView(data){

    const orderData = data.getAttribute("data-order");

    console.log(orderData)

    popupView.classList.add("open-popup-view");
    overlay.classList.add("overlay-active");
}



function openView(){
    popupView.classList.add("open-popup-view");
    overlay.classList.add("overlay-active");
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

myModal = document.getElementById("myModal");
modal_content = document.getElementById("modal-content");
alert_overlay = document.getElementById("alert-overlay");
function confirmPopup(id){
    
    myModal.classList.remove("disable");
    myModal.classList.add("active");
    
    modal_content.classList.remove("disable");
    modal_content.classList.add("active");
    
    alert_overlay.style.display = "block";
    
    
    order_id = document.getElementById("order_id");

    order_id.value = id;
}

function cancelPopup(){
    
    myModal.classList.remove("active");
    myModal.classList.add("disable");
    
    
    modal_content.classList.remove("active");
    modal_content.classList.add("disable");
    
    alert_overlay.style.display = "none";


    console.log("myModal");
    
}


