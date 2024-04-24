// let editMaterial = document.querySelector(".edit-material-btn");
// let editPrintingType = document.querySelector(".edit-printingType-btn");
// let editIcon = document.querySelector(".edit-material-btn i");

let materials = document.querySelectorAll(".material .orders.card");
// let MaterialaddCard = document.querySelector(".material .add.card");
// let PrintingTypeaddCard = document.querySelector(".printingType .add.card");
// console.log(materials);


// material stock js 
// var addMaterial = document.getElementById("add-material");
// console.log(addMaterial);
var updateMaterial = document.getElementById("update-material");


// var btn = document.querySelector(".add.card");

var updateBtn = document.querySelectorAll(".update-btn");


var spanMaterial = document.querySelectorAll(".close");
// console.log(spanMaterial);

function openUpdateMaterial(button) {
    console.log('update');

    document.querySelector('.popup-update input[name="material_type"]').value = button.getAttribute("data-name");
    document.querySelector('.popup-update input[name="quantity"]').value = button.getAttribute("data-quantity");
    document.querySelector('.popup-update input[name="unit_price"]').value = button.getAttribute("data-price");
    document.querySelector('.popup-update input[name="ppm"]').value = button.getAttribute("data-ppm");	
    document.querySelector('.popup-update input[name="stock_id"]').value = button.getAttribute("data-id");

    updateMaterial.style.display = "block";
    document.body.style.overflow = "hidden";
}



var updatePrintingType = document.getElementById("update-printingType");

// When the user clicks on <spanMaterial> (x), close the modal
spanMaterial.forEach(function (btn) {
    btn.onclick = function () {

        updateMaterial.style.display = "none";
        // updatePrintingType.style.display = "none";
        // addMaterial.style.display = "none";
        // addPrintingType.style.display = "none";

        document.body.style.overflow = "auto";
    }
});




var updateBtnPrintingType = document.querySelectorAll(".printingType .update-btn");








function validateMaterial(form) {
    let errors = {};

    let title = form.querySelector('input[name="material_type"]').value;
    if (title.trim() === '') {
        errors['name'] = 'Material Name is required';
    }

    let description = form.querySelector('input[name="quantity"]').value;
    if (description.trim() === '') {
        errors['quantity'] = 'Quantity is required';
    }

    let email = form.querySelector('input[name="unit_price"]').value;
    if (email.trim() === '') {
        errors['price'] = 'Price per unit is required';
    }

    let ppm = form.querySelector('input[name="ppm"]').value;
    if (ppm.trim() === '') {
        errors['ppm'] = 'Products per unit is required';
    }

   
      clearErrorMsg(form);
      
      // let errors = validateMaterial(form);
      if (Object.keys(errors).length > 0) {
          // event.preventDefault();    
          displayErrorMsg(errors, form);
          return false;
      } else {

          // form.style.display = "none";
          // document.body.style.overflow = "auto";
          return true;
      }
 
}

function validatePrintingType(form) {
    let errors = {};

    let title = form.querySelector('input[name="printing_type"]').value;
    if (title.trim() === '') {
        errors['ptype'] = 'Printing Type is required';
    }

    let checkboxes = form.querySelectorAll('input[type="checkbox"]:checked');
    if (checkboxes.length === 0) {
        errors['materials'] = 'At least one material is required';
    }

    let price = form.querySelector('input[name="price"]').value;
    if (price.trim() === '') {
        errors['price'] = 'Price is required';
    }

    // form.addEventListener("submit", function (event) {
      clearErrorMsg(form);
      
      // let errors = validateMaterial(form);
      if (Object.keys(errors).length > 0) {
          // event.preventDefault();    
          displayErrorMsg(errors, form);
          return false;
      } else {

          // form.style.display = "none";
          // document.body.style.overflow = "auto";
          return true;
      }
  // });

}

function displayErrorMsg(errors, form) {
    for (const key in errors) {
        if (Object.hasOwnProperty.call(errors, key)) {
            const error = errors[key];
            form.querySelector(`.error.${key}`).innerText = error;
        }
    }
}

function clearErrorMsg(form) {
    let errorElements = form.querySelectorAll('.error');

    errorElements.forEach(errorElement => {
        errorElement.innerText = '';
    });
}


//calendar

const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  todayBtn = document.querySelector(".today-btn"),
  gotoBtn = document.querySelector(".goto-btn"),
  dateInput = document.querySelector(".date-input"),
  eventDay = document.querySelector(".event-day"),
  eventDate = document.querySelector(".event-date"),
  eventsContainer = document.querySelector(".events"),
  addEventBtn = document.querySelector(".add-event"),
  addEventWrapper = document.querySelector(".add-event-wrapper "),
  addEventCloseBtn = document.querySelector(".close "),
  addEventTitle = document.querySelector(".event-name "),
  addEventFrom = document.querySelector(".event-time-from "),
  addEventTo = document.querySelector(".event-time-to "),
  addEventSubmit = document.querySelector(".add-event-btn ");

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

// const eventsArr = [
//   {
//     day: 13,
//     month: 11,
//     year: 2022,
//     events: [
//       {
//         title: "Event 1 lorem ipsun dolar sit genfa tersd dsad ",
//         time: "10:00 AM",
//       },
//       {
//         title: "Event 2",
//         time: "11:00 AM",
//       },
//     ],
//   },
// ];

var filteredOrders = customerOrders.filter((order) => parseInt(order.emp_id) === empId);
console.log(filteredOrders);
const eventsArr = filteredOrders.map((order) => {
  return {
    day: new Date(order.dispatch_date).getDate(),
    month: new Date(order.dispatch_date).getMonth() + 1,
    year: new Date(order.dispatch_date).getFullYear(),
    details: [
      {
        orderID: order.order_id,
        status: order.order_status,
        placedOn: order.order_placed_on
      },
    ],
  };
}) 
// console.log(eventsArr);
// getEvents();
console.log(eventsArr);

//function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
function initCalendar() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevLastDay = new Date(year, month, 0);
  const prevDays = prevLastDay.getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();
  const nextDays = 7 - lastDay.getDay() - 1;

  date.innerHTML = months[month] + " " + year;

  let days = "";

  for (let x = day; x > 0; x--) {
    days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDate; i++) {
    //check if event is present on that day
    let event = false;
    let eventStatus;
    eventsArr.forEach((eventObj) => {
      if (
        eventObj.day === i &&
        eventObj.month === month + 1 &&
        eventObj.year === year
      ) {
        event = true;
        eventStatus = eventObj.details[0].status;
      }
    });
    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      activeDay = i;
      
      getActiveDay(i);
      
      if (event) {
        days += `<div class="day today active event ${eventStatus}">${i}</div>`;
      } else {
        days += `<div class="day today active">${i}</div>`;
      }
    } else {
      if (event) {
        console.log("jacnsajkcosancksa  ");
        days += `<div class="day event ${eventStatus}">${i}</div>`;
      } else {
        days += `<div class="day ">${i}</div>`;
      }
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next-date">${j}</div>`;
  }
  daysContainer.innerHTML = days;
  addListner();
}

//function to add month and year on prev and next button
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

initCalendar();

//function to add active on day
function addListner() {
  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {


      getActiveDay(e.target.innerHTML);
      updateEvents(Number(e.target.innerHTML));
      activeDay = Number(e.target.innerHTML);
      //remove active
      days.forEach((day) => {
        day.classList.remove("active");
      });

      //if clicked prev-date or next-date switch to that month
      if (e.target.classList.contains("prev-date")) {
        prevMonth();
        //add active to clicked day afte month is change
        setTimeout(() => {
          //add active where no prev-date or next-date
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("prev-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              days.forEach((day) => {
                day.classList.remove("active");
              });
              day.classList.toggle("active");
            }
          });
        }, 100);
      } else if (e.target.classList.contains("next-date")) {
        nextMonth();
        //add active to clicked day afte month is changed
        setTimeout(() => {
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("next-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              days.forEach((day) => {
                day.classList.remove("active");
              });
              day.classList.toggle("active");
            }
          });
        }, 100);
      } else {
        days.forEach((day) => {
          day.classList.remove("active");
        });
        e.target.classList.toggle("active");
      }
    });
  });
}

// todayBtn.addEventListener("click", () => {
//   today = new Date();
//   month = today.getMonth();
//   year = today.getFullYear();
//   initCalendar();
// });

// dateInput.addEventListener("input", (e) => {
//   dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
//   if (dateInput.value.length === 2) {
//     dateInput.value += "/";
//   }
//   if (dateInput.value.length > 7) {
//     dateInput.value = dateInput.value.slice(0, 7);
//   }
//   if (e.inputType === "deleteContentBackward") {
//     if (dateInput.value.length === 3) {
//       dateInput.value = dateInput.value.slice(0, 2);
//     }
//   }
// });

//function get active day day name and date and update eventday eventdate
function getActiveDay(date) {
  const day = new Date(year, month, date);
  const dayName = day.toString().split(" ")[0];
  eventDay.innerHTML = dayName;
  eventDate.innerHTML = date + " " + months[month] + " " + year;
}

//function update events when a day is active
function updateEvents(date) {
  let events = "";
  eventsArr.forEach((event) => {
    if (
      date === event.day &&
      month + 1 === event.month &&
      year === event.year
    ) {
      event.details.forEach((detail) => {
        events += `<div class="event ${detail.status}">
            <div class="Id">
              <h4 class="orderId">Order ID: ${detail.orderID}</h4>
            </div>
            <div class="placedOn">
              <span class="placedOn">Order Placed On: ${detail.placedOn}</span>
            </div>
            <div class="status">
              <span class="status">Status: ${detail.status}</span>
            </div>
        </div>`;
      });
    }
  });
  if (events === "") {
    events = `<div class="no-event">
            <h3>No Orders</h3>
        </div>`;
  }
  eventsContainer.innerHTML = events;
 
}

