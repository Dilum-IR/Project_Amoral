function paymentGateway() {
  $(document).ready(function () {
    data = {
      type: "hi server sdgsfxg",
    };

    $.ajax({
      type: "POST",
      url: "http://localhost/project_Amoral/others/payment.php",
      data: data,
      cache: false,
      success: function (res) {
        try {
          var obj = JSON.parse(res);
          //   alert(obj);

          // Payment completed. It can be a successful failure.
          payhere.onCompleted = function onCompleted(orderId) {
            console.log("Payment completed. OrderID:" + orderId);
            // Note: validate the payment and show success or failure page to the customer
          };

          // Payment window closed
          payhere.onDismissed = function onDismissed() {
            // Note: Prompt user to pay again or show an error page
            console.log("Payment dismissed");
          };

          // Error occurred
          payhere.onError = function onError(error) {
            // Note: show an error page
            console.log("Error:" + error);
          };

          // Put the payment variables here
          var payment = {
            sandbox: true,
            merchant_id: obj["merchant_id"], // Replace your Merchant ID
            return_url: "http://localhost/project_Amoral/others/checkout.php", // Important
            cancel_url: "http://localhost/project_Amoral/others/checkout.php", // Important
            notify_url: "http://localhost/project_Amoral/others/successPay.php",
            order_id: obj["order_id"],
            items: obj["items"],
            amount: obj["amount"],
            currency: obj["currency"],
            hash: obj["hash"], // *Replace with generated hash retrieved from backend
            first_name: obj["first_name"],
            last_name: obj["last_name"],
            email: obj["email"],
            phone: obj["phone"],
            address: obj["address"],
            city: obj["city"],
            country: obj["country"],
            delivery_address: "No. 46, Galle road, Kalutara South",
            delivery_city: "Kalutara",
            delivery_country: "Sri Lanka",
            custom_1: "",
            custom_2: "",
          };

          payhere.startPayment(payment);
        } catch (error) {}
      },
      error: function (xhr, status, error) {},
    });

    //      http://localhost/project_Amoral/public/verify?success_no=3&flag=0&hash=$2y$10$4TIw8dwyFPijeLLrl6/w3.qjeLOiKfObgfVzUUV/w5xw/u59Xh0XC&code=19258387&email=rdinduwara19158%40gmail.com&u=1
  });
}
