<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amoral</title>
    <style>
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 4;
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 5;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.3s ease-in-out;
            height: 50vh;
            width: 500px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.7);


        }

        .popup.show {
            transform: translate(-50%, -50%) scale(1);
        }

        .btn {

            text-decoration: none;
        }

        .btn:hover {
            border-width: 1px;
            border-color: #191919;

        }

        .close-icon {
            /* margin-bottom: 100px; */
            font-size: 25px;
        }

        .btn-1 {
            /* padding: 100px; */
            margin: 20px 0;

        }

        .popup-p {
            color: white;
            display: flex;
            align-self: center;
            justify-self: center;
            flex-direction: column;
            p{
                text-align: center;
            }
        }

        .btn-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
    </style>
</head>

<body>

    <!-- Dark overlay -->
    <div id="overlay"></div>

    <div id="popup1" class="popup">

        <span onclick="hidePopup('popup1')" class="close-icon"><i class="bx bx-x close" style="color: #ffffff"></i></span>
        <div class="popup-p" >

            <p>Choose Your Path and Join the Amoral Family</p>
        </div>

        <div class="btn-content">

            <div class="btn-1">
                <a href="<?= ROOT ?>/guest" class="nav-sign-btn white-btn btn">
                    Sign Up for a Partnership</a>

            </div>
            <a href="<?= ROOT ?>/signup" class="nav-sign-btn white-btn btn">Customer Sign Up</a>
        </div>
        <!-- <div>

            <span>OR</span>
        </div> -->


    </div>
    </div>

    <script>
        function showPopup(popupId) {
            var popup = document.getElementById(popupId);
            var overlay = document.getElementById('overlay');

            if (overlay && popup) {
                popup.style.display = "block";
                overlay.style.display = "block";
                // Trigger reflow to apply the initial scale before adding the show class
                void popup.offsetWidth;
                // Add show class to trigger the animation
                popup.classList.add("show");
            }
        }

        function hidePopup(popupId) {
            var popup = document.getElementById(popupId);
            var overlay = document.getElementById('overlay');

            if (overlay && popup) {
                // Remove show class to trigger the zoom-out animation
                popup.classList.remove("show");

                // Hide the popup after the animation completes
                setTimeout(function() {
                    overlay.style.display = "none";
                    popup.style.display = "none";
                }, 300);
            }
        }
    </script>

</body>

</html>