

function closePopup() {
    var popup = document.querySelector('.popup-report');
    popup.style.display = 'none';
    var container = document.querySelector('.container');
    container.style.display = 'block';
}

function showPopup(button) {
    const rptData = button.getAttribute("data-rpt");
    console.log(rptData);

    if (rptData) {
        const rpt = JSON.parse(rptData);
 
        document.querySelector('.update-form .email').innerText = "Email -   " + rpt.email;
        document.querySelector('.update-form .sent-date').innerText = "Sent Date -   " + rpt.sent_date;
        document.querySelector('.update-form .title').innerText = "Title - " + rpt.title;
        if (rpt.user_id) {
            document.querySelector('.update-form .sender-id').innerText = "Customer ID -   " + rpt.user_id;
        }

        if (rpt.garment_id) {
            document.querySelector('.update-form .sender-id').innerText = "Garment ID -   " + rpt.garment_id;
        }
        document.querySelector('.update-form .popup-input').innerText = rpt.description;
    }

    var popup = document.querySelector('.popup-report');
    popup.style.display = 'block';
    var container = document.querySelector('.container');
    container.style.display = 'none';
}