function closePopup() {
  var popup = document.querySelector(".popup-report");
  popup.style.display = "none";
  var container = document.querySelector(".container");
  container.style.display = "block";
}

function showPopup(button) {
  const rptData = button.getAttribute("data-rpt");
  const reportId = button.getAttribute("data-report-id");
  console.log(rptData);

  if (rptData) {
    const rpt = JSON.parse(rptData);

    document.querySelector(".update-form .email").innerText =
      "Email -   " + rpt.email;
    document.querySelector(".update-form .sent-date").innerText =
      "Sent Date -   " + rpt.sent_date;
    document.querySelector(".update-form .title").innerText =
      "Title - " + rpt.title;
    if (rpt.user_id) {
      document.querySelector(".update-form .sender-id").innerText =
        "Customer ID -   " + rpt.user_id;
    }

    if (rpt.garment_id) {
      document.querySelector(".update-form .sender-id").innerText =
        "Garment ID -   " + rpt.garment_id;
    }
    document.querySelector(".update-form .popup-input").innerText =
      rpt.description;

    var garOrCus = document.querySelector('.update-form input[name="garOrCus');
    // Ensure the hidden input exists before setting its value
    const reportIdInput = document.querySelector(
      '.update-form input[name="report_id"]'
    );
    if (rpt.garment_id) {
      garOrCus.value = "garment";
    }

    if (rpt.user_id) {
      garOrCus.value = "customer";
    }
    console.log(garOrCus);

    if (reportIdInput) {
      reportIdInput.value = rpt.report_id;
    } else {
      console.error("Report ID input not found");
    }
  }

  var popup = document.querySelector(".popup-report");
  popup.style.display = "block";
  var container = document.querySelector(".container");
  container.style.display = "none";
}

var reportEndpoint =
  "http://localhost/project_Amoral/public/merchandiser/complaintstatus";

// $(document).ready(function() {
//     $('input[type="radio"]').change(function() {
//         var rptType = $('input[name="rptType"]:checked').val();
//         // console.log(rptType);
//         $.ajax({
//             type: "POST",
//             url: reportEndpoint,
//             data: { rptType: rptType },
//             success: function(response) {
//                 // Handle success response here
//             // console.log(response);
//                 // alert(response);
//                 // responseData = JSON.parse(response);
//                 // console.log(responseData);

//             },
//             error: function(xhr, status, error) {
//                 // Handle error
//                 console.error(xhr.responseText);
//             }
//         });
//     });
// });

$(document).ready(function () {
    // alert('The document is ready!');
  $('input[type="radio"]').change(function () {
    var rptType = $('input[name="rptType"]:checked').val();
    $.ajax({
      type: "POST",
      url: reportEndpoint,
      data: { rptType: rptType },
      success: function (response) {
        // Parse the JSON response
        var responseData = JSON.parse(response);
        console.log(responseData);
        // Update the report box with new data
        $(".report-input-box").html(""); // Clear existing data
        if (responseData && responseData.data) {
          responseData.data.forEach(function (rpt) {
            var html = `
                            <div class="text-box">
                                <div class="report-info">
                                    <div class="report-info-email">
                                       ${rpt.email}
                                    </div>
                                    <div class="report-info-date">
                                      ${rpt.report_date}
                                    </div>
                                </div>
                                <div class="report-description-title"> </div>
                                <div class="report-description">
                                    ${rpt.description}
                                </div>
                                <div class="report-btns">
                                    <button class="view-btn rpt" type="" name="selectItem" class="edit" data-rpt='${JSON.stringify(
                                      rpt
                                    )}' onclick="showPopup(this)">View Details</button>
                                </div>
                            </div>`;
            $(".report-input-box").append(html);
          });
        } else {
          // Handle empty data case
          $(".report-input-box").html(
            "<div class='text-box'><div class='no-rpts'>No Complaints or Messages</div></div>"
          );
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });
});
