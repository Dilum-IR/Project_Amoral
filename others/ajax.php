<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <input type="text" name="reservation" class="reservation" id="message">
    <button type="submit" id="sendBtn">Submit</button>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        let messageField = document.getElementById("message")

        $(document).ready(function() {

            // message send
            $("#sendBtn").click(function() {
                let message = $("#message").val()

                // after data is send then value is empty
                // messageField.value = ""

                if (message == "") {
                    return
                }


                $.ajax({
                    type: "POST",
                    url: "server.php",
                    data: {
                        name: message
                    },
                    cache: false,
                    success: function(data) {
                        alert(data);

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr)
                    }
                })
            })


        });
    </script>
    <div>

        <? echo $data; ?>
    </div>

</body>

</html>