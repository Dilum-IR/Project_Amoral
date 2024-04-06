<?php

// show($data);

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>collection</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collection/collection.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collection/nav.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include 'navigationbar.php' ?>

    <div class="slides-container">
        <?php

        // "amoral_1.jpg", "amoral_2.jpg", "amoral_3.jpg", "amoral_4.jpg", "amoral_5.jpg",
        // "amoral_6.jpg", "amoral_7.jpg", "amoral_8.jpg", "amoral_9.jpg", "amoral_10.jpg",
        // "amoral_11.jpg", "amoral_12.jpg", "amoral_13.jpg"

        $imageFileNames = array();
        foreach ($data as $item) {
            $imageFileNames[] = $item->image_name;
        }
        show($imageFileNames);

        $slideCount = 0;
        $imageIndex = 0;
        $totalImages = count($imageFileNames);
        $slideId = 1;

        foreach ($imageFileNames as $fileName) :
            while ($slideCount <= ($totalImages) / 4) : ?>
                <div class="full-screen-slide" id="slide-<?php echo $slideCount++; ?>">
                    <div class="slide flex-container">
                        <button class="slide-btn slide-btn-left" onclick="prevSlide()">&#10094;</button>

                        <div class="div-1-1">
                            <div class="image-container">
                                <img class="pre-design" src="<?= ROOT ?>/assets/images/collection/<?php echo $imageFileNames[$imageIndex] ?>" alt="">
                                <div class="place-order-button">
                                    <button class="place-button" id="place-button-1"><span>Place Order</span></button>
                                </div>
                                <br><br>
                                <div class="div-info-1">
                                    <div class="material-info">
                                        <label for="material-type">Material</label>
                                        <input type="text" id="material-type" value="Wetlook" readonly>
                                        <label for="unit-price-info">Price (Rs)</label>
                                        <input type="number" id="unit-price-info" value="1500" readonly>
                                    </div>
                                    <!-- <div class="price-info">
                                        <label for="unit-price-info">Unit Price (Rs) :</label>
                                        <input type="number" id="unit-price-info" value="1500" readonly>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="div-1-2">
                            <div class="image-container">
                                <img class="pre-design" src="<?= ROOT ?>/assets/images/collection/<?php echo $imageFileNames[$imageIndex + 1] ?>" alt="">
                                <div class="place-order-button">
                                    <button class="place-button" id="place-button-2"><span>Place Order</span></button>
                                </div>
                                <br><br>
                                <div class="div-info-1">
                                    <div class="material-info">
                                        <label for="material-type">Material</label>
                                        <input type="text" id="material-type" value="Wetlook" readonly>
                                        <label for="unit-price-info">Price (Rs)</label>
                                        <input type="number" id="unit-price-info" value="1500" readonly>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="div-1-3">
                            <div class="image-container">
                                <img class="pre-design" src="<?= ROOT ?>/assets/images/collection/<?php echo $imageFileNames[$imageIndex + 3] ?>" alt="">
                                <div class="place-order-button">
                                    <button class="place-button" id="place-button-3"><span>Place Order</span></button>
                                </div>
                                <br><br>
                                <div class="div-info-1">
                                    <div class="material-info">
                                        <label for="material-type">Material</label>
                                        <input type="text" id="material-type" value="Wetlook" readonly>
                                        <label for="unit-price-info">Price (Rs)</label>
                                        <input type="number" id="unit-price-info" value="1500" readonly>
                                    </div>

                                    <!-- <div class="price-info">
                                        <label for="unit-price-info">Unit Price (Rs) :</label>
                                        <input type="number" id="unit-price-info" value="1500" readonly>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <button class="slide-btn slide-btn-right" onclick="nextSlide()">&#10095;</button>
                    </div>

                </div>

        <?php
                $imageIndex += 3;
            endwhile;
        endforeach;
        ?>
    </div>

    <script src="<?= ROOT ?>/assets/js/collection/collection.js"></script>
</body>

</html>