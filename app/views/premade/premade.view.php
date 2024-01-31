<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Made Designs</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/premade/premade.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/premade/nav.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include 'navigationbar.php' ?>

    <div class="slides-container">
        <?php for ($i = 1; $i <= 6; $i++) : ?>
            <div class="full-screen-slide" id="slide-<?php echo $i; ?>">
                <div class="slide flex-container">
                    <button class="slide-btn slide-btn-left" onclick="prevSlide()">&#10094;</button>
                 
                        <div class="div-1-1">
                            <div class="image-container">
                                <img class="pre-design" src="<?= ROOT ?>/assets/images/premade/amoral_3.jpg" alt="">
                                <div class="place-order-button">
                                    <button id="place-button"><span>Place Order</span></button>
                                </div>
                                <br><br><br>
                                <div class="div-info-1">
                                    <div class="material-info">
                                        <label for="material-type">Material :</label>
                                        <input type="text" id="material-type" value="Wetlook" readonly>
                                    </div>
                                    <div class="price-info">
                                        <label for="unit-price-info">Unit Price (Rs) :</label>
                                        <input type="number" id="unit-price-info" value="1500" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="div-1-2">
                            <div class="image-container">
                                <img class="pre-design" src="<?= ROOT ?>/assets/images/premade/amoral_9.jpg" alt="">
                                <div class="place-order-button">
                                    <button id="place-button"><span>Place Order</span></button>
                                </div>
                                <br><br><br>
                                <div class="div-info-1">
                                    <div class="material-info">
                                        <label for="material-type">Material :</label>
                                        <input type="text" id="material-type" value="Wetlook" readonly>
                                    </div>
                                    <div class="price-info">
                                        <label for="unit-price-info">Unit Price (Rs) :</label>
                                        <input type="number" id="unit-price-info" value="1500" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="div-1-3">
                            <div class="image-container">
                                <img class="pre-design" src="<?= ROOT ?>/assets/images/premade/amoral_10.jpg" alt="">
                                <div class="place-order-button">
                                    <button id="place-button"><span>Place Order</span></button>
                                </div>
                                <br><br><br>
                                <div class="div-info-1">
                                    <div class="material-info">
                                        <label for="material-type">Material :</label>
                                        <input type="text" id="material-type" value="Wetlook" readonly>
                                    </div>

                                    <div class="price-info">
                                        <label for="unit-price-info">Unit Price (Rs) :</label>
                                        <input type="number" id="unit-price-info" value="1500" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    <button class="slide-btn slide-btn-right" onclick="nextSlide()">&#10095;</button>
                </div>
            </div>

        <?php endfor; ?>
     
    </div>
    
    <script src="<?= ROOT ?>/assets/js/premade/premade.js"></script>
</body>

</html>