// ******************** report genaration part ********************

var startDate = document.getElementById("start_date");
var endDate = document.getElementById("end_date");

var gen = document.getElementById("gen");
var warn_message = document.getElementById("message");
var view = document.getElementById("view");
var down = document.getElementById("down");

document.addEventListener("DOMContentLoaded", function () {
  // check genarate button is enabled or disabled
  function checkGenarateBtn() {
    if (startDate.value && endDate.value && startDate.value <= endDate.value) {
      gen.disabled = false;
    } else {
      gen.disabled = true;
    }
  }

  startDate.addEventListener("change", function () {
    // change date for current end date
    if (startDate.value > endDate.value) {
      startDate.value = endDate.value;
    }
    checkGenarateBtn();
  });

  endDate.addEventListener("change", function () {
    // change date for current start date
    if (endDate.value < startDate.value) {
      endDate.value = startDate.value;
    }
    checkGenarateBtn();
  });

  checkGenarateBtn();
});

function closegenarate() {
  warn_message.innerHTML = "";
  gen.style.display = "inline";
  view.style.display = "none";
  down.style.display = "none";
  gen.disabled = true;
  startDate.disabled = false;
  endDate.disabled = false;
  startDate.value = "";
  endDate.value = new Date().toLocaleDateString().toString().replace(",", "/");
}

//Generate pdf
var pdfObject;

function generatePDF() {
  startDate.disabled = true;
  endDate.disabled = true;

  warn_message.innerHTML =
    "<span onclick='closegenarate()' class='text'><i class='bx bx-x' style='color:#ff0000'  ></i></span>  Your report is generated!";
  gen.style.display = "none";
  view.style.display = "inline-block";
  down.style.display = "inline-block";

  down.innerHTML =
    "<i class='bx bx-loader-circle bx-spin bx-flip-horizontal bx-xs'></i>";
  view.innerHTML =
    "<i class='bx bx-loader-circle bx-spin bx-flip-horizontal bx-xs'></i>";

  view.disabled = true;
  down.disabled = true;

  // return;

  data = {
    emp_id: emp_id,
    from_date: startDate.value,
    to_date: endDate.value,
  };

  $.ajax({
    type: "POST",
    url: comp_report_endpoint,
    data: data,
    cache: false,
    success: function (res) {
      try {
        // convet to the json type
        Jsondata = JSON.parse(res);

        console.log(Jsondata);

        if (Jsondata.length == 0) {
          toastApply(
            "No Completed Order",
            "Selected date between has not Completed orders",
            2
          );

          warn_message.innerHTML = "";
          document.getElementById("gen").style.display = "inline";
          view.style.display = "none";
          down.style.display = "none";
          gen.disabled = true;
          startDate.disabled = false;
          endDate.disabled = false;
        } else if (Jsondata) {
          view.disabled = false;
          down.disabled = false;
          view.innerHTML = "View";
          down.innerHTML = "Download";
          generateContent(Jsondata);
        } else {
          toastApply(
            "No Completed Order",
            "Selected Date Between No Completed Orders",
            2
          );
        }
      } catch (error) {
        // toastApply("Update Failed", "Try again later...", 1);
      }
    },
    error: function (xhr, status, error) {
      toastApply(
        "Connection Failed",
        "Report Genaration faild. Try again later...",
        1
      );
    },
  });
}

function generateContent(genarateData) {
  let net_total = 0;
  let net_cost = 0;
  
  // get total Net-profit for garment
  genarateData.forEach((element) => {
    net_total += element["total_price"];
    net_cost += element["total_cost"];
  });

  var props = {
    outputType: jsPDFInvoiceTemplate.OutputType.Blob,
    returnJsPDFDocObject: true,
    fileName: "Invoice 2024",
    orientationLandscape: false,
    compress: true,
    logo: {
      src: "http://localhost/project_Amoral/public/assets/images/logo.JPG",
      type: "PNG",
      width: 30,
      height: 30,
      margin: {
        top: 0,
        left: 0,
      },
    },
    stamp: {
      inAllPages: true,
      src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
      type: "JPG",
      width: 30,
      height: 30,
      margin: {
        top: -10,
        left: 0,
      },
    },
    business: {
      name: "Amoral",
      address: "Akurassa, Matara, Sri Lanka.",
      phone: "+9477 620 2215",
      email: "amoral639@gmail.com",
      website: "www.amoral.lk",
    },
    contact: {
      label: "",
      name: "Revenue Report",
      address: "Manager : " + emp_name,
      phone: contact_number,
      email: "Genarated Date : " + new Date().toLocaleDateString().toString(),
      otherInfo: "\n\n",
    },
    invoice: {
      label: "",
      num: 19,
      invDate: "From Date : " + startDate.value,
      invGenDate: "To Date : " + endDate.value + "\n\n",
      headerBorder: false,
      tableBodyBorder: false,
      style: {
        margin: {
          top: 100,
        },
      },
      header: [
        {
          title: "Item",
          style: {
            width: 10,
          },
        },

        {
          title: "Order ID",
          style: {
            width: 20,
          },
        },
        {
          title: "Customer ID",
          style: {
            width: 25,
          },
        },
        {
          title: "Description",
          style: {
            width: 35,
          },
        },
        {
          title: "Delivered Date",
          style: {
            width: 30,
          },
        },
        {
          title: "Quantity",
          style: {
            width: 20,
          },
        },
        {
          title: "Cost(Rs.)",
          style: {
            width: 30,
          },
        },
        {
          title: "Total(Rs.)",
          style: {
            width: 20,
          },
        },
      ],
      table: Array.from(Array(genarateData.length), (item, index) => [
        "\n" + (index+1).toString(),
        "\nORD-" + genarateData[index]["order_id"] + "\n",
        "\nUSR-" + genarateData[index]["user_id"],
        "\n" + genarateData[index]["material_array"].join(", "),
        "\n" + genarateData[index]["delivered_date"],
        "\n" + genarateData[index]["total_qty"] + "\n",
        "\n" + formatNumber(genarateData[index]["total_cost"]),
        "\n" + formatNumber(genarateData[index]["total_price"]),
      ]),

      additionalRows: [
        {
          col1: "\tNet Total  :",
          col2: "\t\t\t",
          col3: formatNumber(net_total),
          style: {
            fontSize: 12,
          },
        },
        {
          col1: "\tTotal Cost :",
          col2: "\t\t\t",
          col3: formatNumber(net_cost),
          style: {
            fontSize: 12,
            margin: {
              top: 10,
              bottom: 15,
            },
          },
        },
        {
          col1: "\tNet Profit :",
          col2: "\t\t\t",
          col3: formatNumber(net_total - net_cost),
          style: {
            fontSize: 14,
          },
        },
      ],
    },
    footer: {
      text: "The invoice is created on a computer and is valid without the signature and stamp.",
    },
    pageEnable: true,
    pageLabel: "Page ",
  };
  pdfObject = jsPDFInvoiceTemplate.default(props);
  console.log("Object generated: ", pdfObject);
}

// return value for added two decimal part and
// awlways add , part when 3 digit after
function formatNumber(value) {
  
  // Check if value is negative
  const isNegative = value < 0;
  
  // Convert value to positive for formatting
  const positiveValue = Math.abs(value);
  
  // Format positive value with commas and decimal places
  const formattedValue = positiveValue.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");

  // Enclose negative values within parentheses
  return isNegative ? `(${formattedValue})` : formattedValue;
}

// given date only string type
// new Date().toLocaleDateString().toString()

/* view pdf */
function viewPDF() {
  // console.log(pdfObject);
  if (!pdfObject) {
    return console.log("No PDF Object");
  }

  var fileURL = URL.createObjectURL(pdfObject.blob);
  window.open(fileURL, "_blank");
}

/* download pdf */
function downloadBlob() {
  if (!pdfObject) {
    return console.log("No PDF Object");
  }

  const fileURL = URL.createObjectURL(pdfObject.blob);
  const link = document.createElement("a");
  link.href = fileURL;
  link.download = "Monthly-Report" + new Date() + ".pdf";
  link.click();
}

// end report genaration part
