<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div id="myDiv">Hover over me!</div>
    <i class='bx bx-edit-alt' id="icon"></i>

    <script>
        // Get the div element by its ID
        var myDiv = document.getElementById("myDiv");
        
        // Add event listeners for mouseover and mouseout
        myDiv.addEventListener("mouseover", function() {
            // Change background color when mouse hovers over the div
            myDiv.style.backgroundColor = "lightblue";
        });

        myDiv.addEventListener("mouseout", function() {
            // Revert background color when mouse leaves the div
            myDiv.style.backgroundColor = "black";
        });


        
        var icon = document.getElementById("icon");

        // Add event listeners for mouseover and mouseout
        icon.addEventListener("mouseover", function() {
            // Change background color when mouse hovers over the div
            icon.classList.add("bx-tada");
            
            console.log('hover')
        });
        
        icon.addEventListener("mouseout", function() {
            // Revert background color when mouse leaves the div
            icon.classList.remove("bx-tada");
           
        });
    </script>

    <style>
        #icon{
            font-size: 50px;
        }
    </style>
</body>

</html>