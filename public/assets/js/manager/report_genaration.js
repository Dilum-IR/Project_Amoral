// ******************** report genaration part ********************

var startDate = document.getElementById("start_date");
var endDate = document.getElementById("end_date");
document.addEventListener("DOMContentLoaded", function () {
  // check genarate button is enabled or disabled
  function checkGenarateBtn() {
    if (startDate.value && endDate.value && startDate.value <= endDate.value) {
      document.getElementById("gen").disabled = false;
    } else {
      document.getElementById("gen").disabled = true;
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
  document.getElementById("message").innerHTML = "";
  document.getElementById("gen").style.display = "inline";
  document.getElementById("view").style.display = "none";
  document.getElementById("down").style.display = "none";
  document.getElementById("gen").disabled = true;
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

  document.getElementById("message").innerHTML =
    "<span onclick='closegenarate()' class='text'><i class='bx bx-x' style='color:#ff0000'  ></i></span>  Your report is generated!";
  document.getElementById("gen").style.display = "none";
  document.getElementById("view").style.display = "inline-block";
  document.getElementById("down").style.display = "inline-block";

  document.getElementById("down").innerHTML =
    "<i class='bx bx-loader-circle bx-spin bx-flip-horizontal bx-xs'></i>";
  document.getElementById("view").innerHTML =
    "<i class='bx bx-loader-circle bx-spin bx-flip-horizontal bx-xs'></i>";

  document.getElementById("view").disabled = true;
  document.getElementById("down").disabled = true;

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
            "Selected date has not Completed orders",
            2
          );

          closegenarate();
        } else if (Jsondata) {
          document.getElementById("view").disabled = false;
          document.getElementById("down").disabled = false;
          document.getElementById("view").innerHTML = "View";
          document.getElementById("down").innerHTML = "Download";
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
      address: "Employee ID : 5432",
      phone: "071258634 ",
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
          title: "#",
          style: {
            width: 10,
          },
        },

        {
          title: "Order ID",
          style: {
            width: 25,
          },
        },
        {
          title: "Customer ID",
          style: {
            width: 25,
          },
        },
        // {
        //   title: "Placed Date",
        //   style: {
        //     width: 30,
        //   },
        // },
        {
          title: "Delivered Date",
          style: {
            width: 30,
          },
        },
        {
          title: "Quantity",
          style: {
            width: 25,
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
        "\n" + index + 1,
        "\nORD-" + genarateData[index]["order_id"] + "\n",
        "\nUSR-" + genarateData[index]["user_id"],
        // "\n" + genarateData[index]["placed_date"].split(" ")[0],
        "\n"+genarateData[index]["delivered_date"],
        "\n" + genarateData[index]["total_qty"] + "\n",
        "\n" + formatNumber(genarateData[index]["total_cost"]),
        "\n" + formatNumber(genarateData[index]["total_price"])
      ]),

      additionalRows: [
        // {
        //   col1: "\tNet Total  :",
        //   col2: "\t\t\t",
        //   col3: "542.00",
        //   style: {
        //     fontSize: 12,
        //   },
        // },
        // {
        //   col1: "\tTotal Cost :",
        //   col2: "\t\t\t",
        //   col3: "542.00",
        //   style: {
        //     fontSize: 12,
        //     margin: {
        //       top: 10,
        //       bottom: 15,
        //     },
        //   },
        // },
        {
          col1: "\tNet Profit :",
          col2: "\t\t\t",
          col3: "52535.00",
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
  return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
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
