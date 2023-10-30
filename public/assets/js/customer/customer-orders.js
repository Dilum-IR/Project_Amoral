let popupView = document.getElementById("popup-view");
let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");

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