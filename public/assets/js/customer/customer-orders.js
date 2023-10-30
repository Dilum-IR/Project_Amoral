let popupView = document.getElementById("popup-view");
let overlay = document.getElementById("overlay");
let popupReport = document.querySelector(".popup-report");
let popupNew = document.querySelector(".popup-new");

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

function openNew(){
    popupNew.classList.add("open-popup-new");
    overlay.classList.add("overlay-active");
}
function closeNew(){
    popupNew.classList.remove("open-popup-new");
    overlay.classList.remove("overlay-active");
}