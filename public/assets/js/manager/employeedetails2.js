
// Get references to the popup elements
const overlay = document.getElementById("overlay");
const popupView = document.getElementById("popup-view");
const popupNew = document.querySelector(".popup-new");

// Function to open the "Add New Employee" popup
function openNew() {
  popupNew.classList.add("open-popup-new");
  overlay.classList.add("overlay-active");
}

// Function to close the "Add New Employee" popup
function closeNew() {
  popupNew.classList.remove("open-popup-new");
  overlay.classList.remove("overlay-active");
}

// Function to close the "View Employee Details" popup
function closeView() {
  popupView.classList.remove("open-popup-view");
  overlay.classList.remove("overlay-active");
}

// Function to open the "View Employee Details" popup
function openView(button) {
  // Get the data attribute value from the clicked button
  const empData = button.getAttribute("data-order");

  if (empData) {
    // Parse the JSON data
    const emp = JSON.parse(empData);

    // Populate the "update-form" fields with the order data
    document.querySelector('.update-form input[name="emp_id"]').value = emp.emp_id;
    document.querySelector('.update-form input[name="emp_name"]').value = emp.emp_name;
    document.querySelector('.update-form input[name="email"]').value = emp.email;
    document.querySelector('.update-form input[name="address"]').value = emp.address;
    document.querySelector('.update-form input[name="contact_number"]').value = emp.contact_number;

    // Show the "View Employee Details" popup
    popupView.classList.add("open-popup-view");
    overlay.classList.add("overlay-active");
  }
}

