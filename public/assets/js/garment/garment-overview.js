var capacity = 0;
var workers = 0;

g_capacity = document.getElementById("g-capacity");
g_workers = document.getElementById("g-workers");
info_btn = document.getElementById("info-btn");

capacity = parseInt(g_capacity.value);
workers = parseInt(g_workers.value);

// when use the input tag type with changes
g_capacity.addEventListener("input", function (event) {
  capacity = parseInt(event.target.value);
  capacity = check_capacity(capacity);
  g_capacity.value = capacity;
});

g_workers.addEventListener("input", function (event) {
  workers = parseInt(event.target.value);
  workers = check_workers(workers);
  g_workers.value = workers;
});

// capacity up and down arrow
document.getElementById("d-cap-up").addEventListener("click", function () {
  capacity += 1;
  capacity = check_capacity(capacity);
  g_capacity.value = capacity;
});
document.getElementById("d-cap-down").addEventListener("click", function () {
  capacity -= 1;
  capacity = check_capacity(capacity);
  g_capacity.value = capacity;
});

// workers up and down arrow
document.getElementById("n-work-up").addEventListener("click", function () {
  workers += 1;
  workers = check_workers(workers);
  g_workers.value = workers;
});
document.getElementById("n-work-down").addEventListener("click", function () {
  workers -= 1;
  workers = check_workers(workers);
  g_workers.value = workers;
});

function check_capacity(cap) {
  if (cap <= 10 || isNaN(cap)) {
    cap = 10;
  } else if (cap > 100000) {
    cap = 100000;
  }
  return cap;
}

function check_workers(work) {
  if (work <= 1 || isNaN(work)) {
    work = 1;
  } else if (work > 20000) {
    work = 20000;
  }
  return work;
}

info_btn.addEventListener("click", function () {
  if (capacity == 0 || isNaN(capacity)) return;

  if (workers == 0 || isNaN(workers)) return;

  info_btn.disabled = true;

  data = {
    day_capacity: capacity,
    no_workers: workers,
  };

  $.ajax({
    type: "POST",
    url: endpoint,
    data: data,
    cache: false,
    success: function (res) {
      try {
        // convet to the json type
        Jsondata = JSON.parse(res);
        // console.log(Jsondata.u);

        if (Jsondata.u == "no") {
          toastApply(
            "Update Warning",
            "This information already updated...",
            2
          );
        } else if (Jsondata.u == "yes") {
          toastApply("Update Success", "Company information updated...", 0);
        } else {
          toastApply("Update Failed", "Try again later...", 1);
        }
        setTimeout(() => {
          info_btn.disabled = false;
          // location.reload();
        }, 4000);
      } catch (error) {
        toastApply("Update Failed", "Try again later...", 1);
        info_btn.disabled = false;
      }
    },
    error: function (xhr, status, error) {
      toastApply("Update Failed", "Try again later...", 1);
      info_btn.disabled = false;
    },
  });
});


// sales initialize
let salesCircularProgress = document.getElementById("total-sales"),
  salesProgressValue = document.getElementById("total-sales-num"),
  // compleated orders initialize
  completedCircularProgress = document.getElementById("completed-orders"),
  completedProgressValue = document.getElementById("completed-orders-num");

let progressStartValue = 0,
  speed = 15;

// alert(completedProgressEndValue);

if (parseInt(salesProgressEndValue) != 0) {
  // sales for circular animater
  let salesprogress = setInterval(() => {
    progressStartValue++;

    salesProgressValue.textContent = `${progressStartValue}%`;
    salesCircularProgress.style.background = `conic-gradient(#7d2ae8 ${
      progressStartValue * 3.6
    }deg, #ededed 0deg)`;

    if (progressStartValue == parseInt(salesProgressEndValue)) {
      clearInterval(salesprogress);
    }
  }, speed);
}

if (parseInt(completedProgressEndValue) != 0) {
  // sales for circular animater
  let completedProgressStartValue = 0;

  let completedprogress = setInterval(() => {
    completedProgressStartValue++;

    completedProgressValue.textContent = `${completedProgressStartValue}%`;
    completedCircularProgress.style.background = `conic-gradient(#7d2ae8 ${
      completedProgressStartValue * 3.6
    }deg, #ededed 0deg)`;

    if (completedProgressStartValue == parseInt(completedProgressEndValue)) {
      clearInterval(completedprogress);
    }
  }, speed);
}