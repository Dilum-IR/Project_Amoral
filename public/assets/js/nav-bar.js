var box = document.querySelector(".notifi-box");
var show = false;

function showNotifi() {
    if (show) {
        box.style.height = "0px";
        box.style.opacity = 0;
        show = false;
    } else {
        box.style.height = "350px";
        box.style.opacity = 1;
        show = true;
    }
}
