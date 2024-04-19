function showPopup(element) {
    var popup = document.querySelector('.popup-report');
    popup.style.display = 'block';
    var container = document.querySelector('.container');
    container.style.display = 'none';

}

function closePopup() {
    var popup = document.querySelector('.popup-report');
    popup.style.display = 'none';
    var container = document.querySelector('.container');
    container.style.display = 'block';
}