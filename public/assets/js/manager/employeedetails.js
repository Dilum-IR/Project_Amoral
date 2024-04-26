
// function addEmployee() {
//     var table = document.getElementById("employee-table");
//     var row = table.insertRow(1); // Insert at index 1 to appear on top (after heading)
//     var cell1 = row.insertCell(0);
//     var cell2 = row.insertCell(1);
//     var cell3 = row.insertCell(2);
//     var cell4 = row.insertCell(3);
//     var cell5 = row.insertCell(4);
//     var cell6 = row.insertCell(5);

//     cell1.innerHTML = nextID;
//     nextID++;
//     cell2.innerHTML = "<input class='employee-input' type='text' placeholder='Name' required>";
//     cell3.innerHTML = "<input class='employee-input' type='text' placeholder='Position'required>";
//     cell4.innerHTML = "<input class='employee-input' type='email' placeholder='Address'required>";
//     cell5.innerHTML = "<input class='employee-input' type='text' placeholder='Contact No'required>";
//     cell6.innerHTML = "<input class='employee-input' type='text' placeholder='Contact No'required>";

//     document.getElementById("add-employee-button").style.display = "none";
//     document.getElementById("save-button").style.display = "inline";
//     document.getElementById("cancel-button").style.display = "inline";
//     document.getElementById("remove-employee-button").style.display = "none";
//     document.getElementById("remove-cancel-button").style.display = "none";
//   }

// function cancelAdd() {
//     var table = document.getElementById("employee-table");
//     table.deleteRow(1); // Delete the first row (added when clicking Add Employee)

//     document.getElementById("add-employee-button").style.display = "inline";
//     document.getElementById("save-button").style.display = "none";
//     document.getElementById("cancel-button").style.display = "none";
//     document.getElementById("remove-employee-button").style.display = "none";
//     document.getElementById("remove-cancel-button").style.display = "none";
//     nextID--;
// }

// function saveEmployee(){
//     document.getElementById("add-employee-button").style.display = "inline";
//     document.getElementById("save-button").style.display = "none";
//     document.getElementById("cancel-button").style.display = "none";
//     document.getElementById("remove-employee-button").style.display = "none";
//     document.getElementById("remove-cancel-button").style.display = "none";

// }

// function toggleRemoveButton(data){


//     console.log(data)
//     // var id =  
//     document.getElementById("add-employee-button").style.display = "none";
//     document.getElementById("save-button").style.display = "none";
//     document.getElementById("cancel-button").style.display = "none";
//     document.getElementById("update-employee-button").style.display = "inline";
//     document.getElementById("remove-employee-button").style.display = "inline";
//     document.getElementById("remove-cancel-button").style.display = "inline";
// }



// // ---------------------------------------------------------------------------
// // ---------------------------------------------------------------------------

// const editGen = document.querySelector("#gen-info-edit");//general information edit button
// const popGen = document.querySelector("#gen-info-pop");//general information popup section
// const closeGen = document.querySelector("#gen-pop-close");//genral infomation close button
// const cancelGen = document.querySelector("#gen-edit-cancel");//general information cancel button
// const mainSection = document.querySelector("#middle");//main
// const homeSection =  document.querySelector("#navbar");//home



// editGen.addEventListener("click", () => {
//     popGen.style.display = "block";
//     console.log("aaaaaaaaaaaa");
//     mainSection.style.position = "fixed";
//     mainSection.style.display = "none";

// });

// closeGen.addEventListener("click", () => {
//     popGen.style.display = "none";
//     mainSection.style.position = "absolute";
//     mainSection.style.display = "block";

//     console.log("kugsfiuhshskh");
// });

// cancelGen.addEventListener("click", () => {
//     popGen.style.display = "none";
//     mainSection.style.position = "absolute";
//     mainSection.style.display = "block";
// });






// // ---------------------------------------------------------------------------

// // ---------------------------------------------------------------------------




// function removeEmployee(){
//   console.log("removeEmployee");
//     document.getElementById("add-employee-button").style.display = "inline";
//     document.getElementById("save-button").style.display = "none";
//     document.getElementById("cancel-button").style.display = "none";
//     document.getElementById("update-employee-button").style.display = "none";
//     document.getElementById("remove-employee-button").style.display = "none";
//     document.getElementById("remove-cancel-button").style.display = "none";
// }

// function removeCancel(){
//   console.log("removeEmployee");
//     document.getElementById("add-employee-button").style.display = "inline";
//     document.getElementById("save-button").style.display = "none";
//     document.getElementById("cancel-button").style.display = "none";
//     document.getElementById("update-employee-button").style.display = "none";
//     document.getElementById("remove-employee-button").style.display = "none";
//     document.getElementById("remove-cancel-button").style.display = "none";
// }
// document.addEventListener('DOMContentLoaded', function() {
//     const rows = document.querySelectorAll('#employee-table tbody tr');
//     let selectedRow;

//     rows.forEach(row => {
//       row.addEventListener('click', function() {
//         if (selectedRow) {
//           selectedRow.classList.remove('highlight');
//         }
//         selectedRow = row;
//         selectedRow.classList.add('highlight');
//         // console.log('fjhfifh');
//         document.getElementById("update-employee-button").style.display = "block";
//         document.getElementById('remove-cancel-button').style.display = 'block';
//         document.getElementById('remove-employee-button').style.display = 'block';
//       });
//     });

//     document.getElementById('remove-employee-button').addEventListener('click', function() {
//       if (selectedRow) {
//         // console.log('deleteBTN');
//         selectedRow.remove();
//         document.getElementById("update-employee-button").style.display = "none";
//         document.getElementById('remove-employee-button').style.display = 'none';
//         document.getElementById('remove-cancel-button').style.display = 'none';
//       }
//     });

//     document.getElementById('remove-cancel-button').addEventListener('click', function() {
//       if (selectedRow) {
//         // console.log('RMVhgth');
//         selectedRow.classList.remove('highlight');
//         document.getElementById("update-employee-button").style.display = "none";
//         document.getElementById('remove-employee-button').style.display = 'none';
//         document.getElementById('remove-cancel-button').style.display = 'none';
//       }
//     });
//   });

//   function addEmployee() {
//     document.getElementById("add-employee-button").style.display = "none";
//     document.getElementById("save-button").style.display = "inline";
//     document.getElementById("cancel-button").style.display = "inline";
//     document.getElementById("update-employee-button").style.display = "none";
//     document.getElementById("remove-employee-button").style.display = "none";
//     document.getElementById("remove-cancel-button").style.display = "none";

//     var table = document.getElementById('employee-table').getElementsByTagName('tbody')[0];
//     var newRow = table.insertRow(0);

//     var idCell = newRow.insertCell(0);
//     idCell.innerHTML = nextID; // Incrementing ID for the new row
//     nextID++;

//     var nameCell = newRow.insertCell(1);
//     nameCell.innerHTML = '<input type="text" id="newName" required>'; // Input for new name

//     var emailCell = newRow.insertCell(2);
//     emailCell.innerHTML = '<input type="text" id="newPosition" required>'; // Input for new position

//     var emailCell = newRow.insertCell(3);
//     emailCell.innerHTML = '<input type="text" id="newEmail" required>'; // Input for new email

//     var emailCell = newRow.insertCell(4);
//     emailCell.innerHTML = '<input type="text" id="newAddress" required>'; // Input for new address

//     var emailCell = newRow.insertCell(5);
//     emailCell.innerHTML = '<input type="text" id="newContact" required>'; // Input for new contact no

//   }

//   function updateEmployee(){
//     document.getElementById("add-employee-button").style.display = "none";
//     document.getElementById("save-button").style.display = "inline";
//     document.getElementById("cancel-button").style.display = "inline";
//     document.getElementById("update-employee-button").style.display = "none";
//     document.getElementById("remove-employee-button").style.display = "none";
//     document.getElementById("remove-cancel-button").style.display = "none";

//     var table = document.getElementById('employee-table').getElementsByTagName('tbody')[0];
//     var newRow = table.insertRow(0);

//     var idCell = newRow.insertCell(0);
//     idCell.innerHTML = nextID; // Incrementing ID for the new row
//     nextID++;

//     var nameCell = newRow.insertCell(1);
//     nameCell.innerHTML = '<input type="text" id="newName" required>'; // Input for new name

//     var emailCell = newRow.insertCell(2);
//     emailCell.innerHTML = '<input type="text" id="newPosition" required>'; // Input for new position

//     var emailCell = newRow.insertCell(3);
//     emailCell.innerHTML = '<input type="text" id="newEmail" required>'; // Input for new email

//     var emailCell = newRow.insertCell(4);
//     emailCell.innerHTML = '<input type="text" id="newAddress" required>'; // Input for new address

//     var emailCell = newRow.insertCell(5);
//     emailCell.innerHTML = '<input type="text" id="newContact" required>'; // Input for new contact no
//   }

//   function saveEmployee() {
//     var newName = document.getElementById('newName').value;
//     var newPosition = document.getElementById('newPosition').value;
//     var newEmail = document.getElementById('newEmail').value;
//     var newAddress = document.getElementById('newAddress').value;
//     var newContact = document.getElementById('newContact').value;


//     document.querySelector('.add-save-cancel input[name="emp_name"]').value = newName;
//     document.querySelector('.add-save-cancel input[ name="emp_status"]').value = newPosition;
//     document.querySelector('.add-save-cancel input[name="email"]').value = newEmail;
//     document.querySelector('.add-save-cancel input[name="address"]').value = newAddress;
//     document.querySelector('.add-save-cancel input[name="contact_number"]').value = newContact;

//     var nameCell = document.getElementById('employee-table').rows[document.getElementById('employee-table').rows.length - 1].cells[1];
//     console.log('added');
//     var positionCell = document.getElementById('employee-table').rows[document.getElementById('employee-table').rows.length -1].cells[2];
//     var emailCell = document.getElementById('employee-table').rows[document.getElementById('employee-table').rows.length - 1].cells[3];
//     var addressCell = document.getElementById('employee-table').rows[document.getElementById('employee-table').rows.length - 1].cells[4];
//     var contactCell = document.getElementById('employee-table').rows[document.getElementById('employee-table').rows.length - 1].cells[5];

//     nameCell.innerHTML = newName;
//     positionCell.innerHTML = newPosition;
//     emailCell.innerHTML = newEmail;
//     addressCell.innerHTML = newAddress;
//     contactCell.inneHTML = newContact;

//     document.getElementById("add-employee-button").style.display = "inline";
//     document.getElementById("save-button").style.display = "none";
//     document.getElementById("cancel-button").style.display = "none";
//     document.getElementById("update-employee-button").style.display = "none";
//     document.getElementById("remove-employee-button").style.display = "none";
//     document.getElementById("remove-cancel-button").style.display = "none";
//   }

//   function cancelAdd() {
//     var table = document.getElementById('employee-table').getElementsByTagName('tbody')[0];
//     table.deleteRow(0);

//     document.getElementById("add-employee-button").style.display = "inline";
//     document.getElementById("save-button").style.display = "none";
//     document.getElementById("cancel-button").style.display = "none";
//     document.getElementById("update-employee-button").style.display = "none";
//     document.getElementById("remove-employee-button").style.display = "none";
//     document.getElementById("remove-cancel-button").style.display = "none";
//     nextID--;
//   }



let sidebar = document.querySelector(".sidebar");
let nav = document.getElementById("navbar");

let nextID = 1;

let popupView = document.querySelector(".popup-view");
let overlay = document.getElementById("overlay");
let popupNew = document.querySelector(".popup-new");


function openNew(button) {

  console.log("addnewemployee");

  // Get the data attribute value from the clicked button
  // const empData = button.getAttribute("data-emp");

 

 
    // Parse the JSON data
    // const emp = JSON.parse(empData);
    console.log("data fill");
    // Populate the "update-form" fields with the order data
    // document.querySelector('.update-form input[name="emp_id"]').value = emp.emp_id;
    // document.querySelector('.update-form img[name="emp_image"]').src = emp.emp_image;
    // document.querySelector('.update-form img[name="emp_image"]').src = emp.emp_image;

    // document.querySelector('.update-form input[name="emp_name"]').value = emp.emp_name;

    // document.querySelector('.update-form input[name="emp_status"]').value = emp.emp_status;
    // document.querySelector('.update-form input[name="email"]').value = emp.email;
    // document.querySelector('.update-form input[name="city"]').value = emp.city;
    // document.querySelector('.update-form input[name="address"]').value = emp.address;
    // document.querySelector('.update-form input[name="DOB"]').value = emp.DOB;
    // document.querySelector('.update-form input[name="contact_number"]').value = emp.contact_number;

    // Show the "update-form" popup
    // document.querySelector(".popup-view").classList.add("open-popup-view");
  
  popupNew.classList.add("is-visible");
  document.body.style.overflow = "hidden";
  sidebar.style.pointerEvents = "none";
  nav.style.pointerEvents = "none";
}

function closeNew() {
  popupNew.classList.remove("is-visible");
  document.body.style.overflow = "auto";
  sidebar.style.pointerEvents = "auto";
  nav.style.pointerEvents = "auto";
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
  const empData = button.getAttribute("data-emp");

  console.log("empData");

  if (empData) {
    // Parse the JSON data
    const emp = JSON.parse(empData);
    console.log(emp.is_active);
    // Populate the "update-form" fields with the order data
    document.querySelector('.update-form input[name="emp_id"]').value = emp.emp_id;
    // document.querySelector('.update-form img[name="emp_image"]').src = emp.emp_image;
    // document.querySelector('.update-form img[name="emp_image"]').src = emp.emp_image;

    document.querySelector('.update-form input[name="emp_name"]').value = emp.emp_name;

    document.querySelector('.update-form input[name="emp_status"]').value = emp.emp_status;
    document.querySelector('.update-form input[name="email"]').value = emp.email;
    document.querySelector('.update-form input[name="city"]').value = emp.city;
    document.querySelector('.update-form input[name="address"]').value = emp.address;
    document.querySelector('.update-form input[name="DOB"]').value = emp.DOB;
    document.querySelector('.update-form input[name="contact_number"]').value = emp.contact_number;

    // Show the "update-form" popup
    document.querySelector(".popup-view").classList.add("open-popup-view");
  }
  popupView.classList.add("is-visible");
  document.body.style.overflow = "hidden";
  sidebar.style.pointerEvents = "none";
  nav.style.pointerEvents = "none";
}

function showAdditionalFields(selectElement) {
  var selectedValue = selectElement.value;
  var cutting = document.getElementById('cutting');
  var sewing = document.getElementById('sewing');
  var workers = document.getElementById('workers');
  var capacity = document.getElementById('capacity');

  var joinedDateLabel = document.getElementById('date');

  if (selectedValue === 'garment') {
      cutting.style.display = 'block';
      sewing.style.display = 'block';
      workers.style.display = 'block';
      capacity.style.display = 'block';
      joinedDateLabel.textContent = 'Joined Date';
  } else {
      cutting.style.display = 'none';
      sewing.style.display = 'none';
      workers.style.display = 'none';
      capacity.style.display = 'none';
      joinedDateLabel.textContent = 'Date of Birth';
  }
}