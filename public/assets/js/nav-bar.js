var box = document.querySelector(".notifi-box");
var notifiBtn = document.querySelector(".nav-link.notifi");
var show = false;


notifiBtn.addEventListener("click", function (event) {
    event.stopPropagation(); // Prevent this click from triggering the document click event
    showNotifi();
});

document.addEventListener("click", function () {
    if (show) {
        hideNotifi();
    }
});

function showNotifi() {
    if (!show) {
        box.style.height = "350px";
        box.style.opacity = 1;
        show = true;
    }
}

function hideNotifi() {
    if (show) {
        box.style.height = "0px";
        box.style.opacity = 0;
        show = false;
    }
}
