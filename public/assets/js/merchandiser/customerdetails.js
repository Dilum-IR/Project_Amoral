
let sidebar = document.querySelector(".sidebar");
let nav = document.getElementById("navbar");

let nextID = 1;

let popupView = document.querySelector(".popup-view");
let overlay = document.getElementById("overlay");
let popupNew = document.querySelector(".popup-new");


// function openNew(button) {

//   console.log("addnewemployee");

//   // Get the data attribute value from the clicked button
  
//     console.log("data fill");
    
  
//   popupNew.classList.add("is-visible");
//   document.body.style.overflow = "hidden";
//   sidebar.style.pointerEvents = "none";
//   nav.style.pointerEvents = "none";
// }

function closeNew(button1) {

const closeD = button1.getAttribute("data-ct");

if(closeD){
  const closeDN =JSON.parse(closeD);

  document.querySelector(".cancel-modal").classList.add("open-popup-view");



}

  popupNew.classList.remove("is-visible");
  document.body.style.overflow = "auto";
  sidebar.style.pointerEvents = "auto";
  nav.style.pointerEvents = "auto";
  document.getElementById('addCustomerForm').reset();
}

function closeView() {
  popupView.classList.remove("is-visible");
  document.body.style.overflow = "auto";
  sidebar.style.pointerEvents = "auto";
  nav.style.pointerEvents = "auto";
}

//data fetching ftom submit button

function openView(button) {


  // Get the data attribute value from the clicked button
  const cstData = button.getAttribute("data-cst");

  console.log("cstData");

  if (cstData) {
    // Parse the JSON data
    const cst = JSON.parse(cstData);
    console.log("data fill");
    // Populate the "update-form" fields with the order data
    document.querySelector('.update-form input[name="id"]').value = cst.id;
    // document.querySelector('.update-form img[name="cst_image"]').src = cst.cst_image;
    // document.querySelector('.update-form img[name="cst_image"]').src = cst.cst_image;

    document.querySelector('.update-form input[name="fullname"]').value = cst.fullname;

    // document.querySelector('.update-form input[name="user_status"]').value = cst.cst_status;
    document.querySelector('.update-form input[name="email"]').value = cst.email;
    document.querySelector('.update-form input[name="city"]').value = cst.city;
    document.querySelector('.update-form input[name="address"]').value = cst.address;
    // document.querySelector('.update-form input[name="DOB"]').value = cst.DOB;
    document.querySelector('.update-form input[name="phone"]').value = cst.phone;

    // Show the "update-form" popup
    document.querySelector(".popup-view").classList.add("open-popup-view");
  }
  popupView.classList.add("is-visible");
  document.body.style.overflow = "hidden";
  sidebar.style.pointerEvents = "none";
  nav.style.pointerEvents = "none";
}
