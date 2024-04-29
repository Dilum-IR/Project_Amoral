
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

    <section id="main-col" class="main-col">

        <div class="slides-container">


            <?php

            // $imageFileNames = array();
            // $imageFileNames = ["amoral_1.jpg", "amoral_2.jpg", "amoral_3.jpg", "amoral_4.jpg", "amoral_5.jpg",
            // "amoral_6.jpg", "amoral_7.jpg", "amoral_8.jpg", "amoral_9.jpg", "amoral_10.jpg",
            // "amoral_11.jpg", "amoral_12.jpg", "amoral_13.jpg"];

            if (!empty($data)) {

                // show($data);
                foreach ($data as $item) {
                    $imageFileNames[] = $item->image_name;
                    $imagePrice[] = $item->price;
                    $imageMaterial[] = $item->material;
                }

                // show($imageMaterial);

                // show($imageFileNames);

                $slideCount = 0;
                $imageIndex = 0;
                $totalImages = count($imageFileNames);
                // show($totalImages);
                $slideId = 1;
                // $slideCount  = ceil(($totalImages) / 3);
                // show($slideCount);

                foreach ($imageFileNames as $fileName) :
                    while ($slideCount <= $totalImages/3) : ?>

                        <div class="full-screen-slide" id="slide-<?php echo $slideCount++; ?>">
                            <div class="slide flex-container">
                                <button class="slide-btn slide-btn-left" onclick="prevSlide()"><i class="bx bxs-chevrons-left" ></i></button>

                                <div class="div-1-1">
                                    <div class="image-container">
                                        <img class="pre-design" src="<?= ROOT ?>/uploads/collection/<?php echo $imageFileNames[$imageIndex] ?>" alt="">
                                        <div class="place-order-button">
                                            <button class="place-button" id="place-button-1" data-design='<?= json_encode($data[$imageIndex]); ?>' onclick='openNew(this)'><span>Place Order</span></button>
                                        </div>
                                        <br><br>
                                        <div class="div-info-1">
                                            <div class="material-info">
                                                <label for="material-type">Material</label>
                                                <input type="text" id="material-type" value="<?php echo $imageMaterial[$imageIndex] ?>" readonly>
                                                <label for="unit-price-info">Price (Rs)</label>
                                                <input type="number" id="unit-price-info" value="<?php echo $imagePrice[$imageIndex] ?>" readonly>
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
                                        <img class="pre-design" src="<?= ROOT ?>/uploads/collection/<?php echo $imageFileNames[$imageIndex + 1] ?>" alt="">
                                        <div class="place-order-button">
                                            <button class="place-button" id="place-button-2" data-design='<?= json_encode($data[$imageIndex + 1]); ?>' onclick='openNew(this)'><span>Place Order</span></button>
                                        </div>
                                        <br><br>
                                        <div class="div-info-1">
                                            <div class="material-info">
                                                <label for="material-type">Material</label>
                                                <input type="text" id="material-type" value="<?php echo $imageMaterial[$imageIndex + 1] ?>" readonly>
                                                <label for="unit-price-info">Price (Rs)</label>
                                                <input type="number" id="unit-price-info" value="<?php echo $imagePrice[$imageIndex + 1] ?>" readonly>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="div-1-3">
                                    <div class="image-container">
                                        <img class="pre-design" src="<?= ROOT ?>/uploads/collection/<?php echo $imageFileNames[$imageIndex + 2] ?>" alt="">
                                        <div class="place-order-button">
                                            <button class="place-button" id="place-button-3" data-design='<?= json_encode($data[$imageIndex + 2]); ?>' onclick='openNew(this)'><span>Place Order</span></button>
                                        </div>
                                        <br><br>
                                        <div class="div-info-1">
                                            <div class="material-info">
                                                <label for="material-type">Material</label>
                                                <input type="text" id="material-type" value="<?php echo $imageMaterial[$imageIndex + 2] ?>" readonly>
                                                <label for="unit-price-info">Price (Rs)</label>
                                                <input type="number" id="unit-price-info" value='<?php echo $imagePrice[$imageIndex + 2] ?>' readonly>
                                            </div>

                                            <!-- <div class="price-info">
                                        <label for="unit-price-info">Unit Price (Rs) :</label>
                                        <input type="number" id="unit-price-info" value="1500" readonly>
                                    </div> -->
                                        </div>
                                    </div>
                                </div>

                                <button class="slide-btn slide-btn-right" onclick="nextSlide()"><i class="bx bxs-chevrons-right" ></i></button>
                            </div>

                        </div>

            <?php
                        $imageIndex +=1;
                    endwhile;
                endforeach;
            }
            ?>
        </div>

         <!-- Pop up new -->
    <div class="popup-new">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>New Order</h2>

            <form class="new-form" method="POST" enctype="multipart/form-data">

                
                <div class="user-details">
                    
                    <div class="input-box" class="    align-self: center;
                                                    align-content: center;
                                                    left: 9%;
                                                    top: -35px;
                                                    position: relative;">
                        <img src="" alt="" class="design" style="width: 55%; height: 75%; object-fit: cover; left: 9%; position: relative;">
                    </div>
                    <div class="input-box">
                        <span class="details">Material </span>
                        <input type="text" required name="material" readOnly />

                    </div>

                    <div class="input-box" style="height: 0;"></div>

                    <div class="input-box" style="    position: relative;
                                                        top: -140px;">
                        <span class="details">Sleeve Type</span>
                        <select required name="sleeve[]">
                            <option value="" selected hidden style="color: grey;">Select</option>
                            <?php foreach ($data['sleeveType'] as $sleeve) : ?>
                                <option value="<?php echo $sleeve->type ?>"><?php echo $sleeve->type ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-box" style="   top: -86px;
                                                    position: relative;">
                        <span class="details">Printing Type</span>
                        <input type="text" required name="printingType" readOnly />
                    </div>

                    <div class="input-box sizes" style="position: relative;
                                                        top: -83px;">
                        <span class="details">Sizes & Quantity <span class="error sizes0"></span></span>
                        <div class="sizeChart">
                            <span class="size">XS</span>
                            <input class="st" type="number" id="quantity" name="xs[]" min="0" value="0">
                            <br>
                            <span class="size">S</span>
                            <input class="st" type="number" id="quantity" name="small[]" min="0" value="0">
                            <br>
                            <span class="size">M</span>
                            <input class="st" type="number" id="quantity" name="medium[]" min="0" value="0">
                            <br>
                            <span class="size">L</span>
                            <input class="st" type="number" id="quantity" name="large[]" min="0" value="0">
                            <br>
                            <span class="size">XL</span>
                            <input class="st" type="number" id="quantity" name="xl[]" min="0" value="0">
                            <br>
                            <span class="size">2XL</span>
                            <input class="st" type="number" id="quantity" name="xxl[]" min="0" value="0">
                            <br>
                        </div>
                    </div>

                </div>
                <img src="<?php echo ROOT ?>/assets/images/customer/sizeChart.jpg" width="80%" style="margin: 7%;">

                <hr>
                <div class="radio-btns">
                    <input type="radio" id="pickupN" name="deliveryOption" value="Pick Up">
                    <label for="pickup">Pick Up</label>

                    <input type="radio" id="deliveryN" name="deliveryOption" value="Delivery">
                    <label for="delivery">Delivery</label>
                    <span class="error dates"></span>
                </div>

                <div class="user-details pickupN is-checked">
                    <div class="input-box">
                        <span class="details">Pick Up Date</span>

                        <input type="date" name="dispatch_date_pickup">
                    </div>
                </div>

                <div class="user-details deliveryN">
                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>

                        <input type="date" name="dispatch_date_delivery">
                    </div>

                    <div class="input-box location">
                        <span class="details"> Delivery Location</span>  <span class="error delmap"></span>
                        <div class="googlemap" id="new-order-map" style="height: 300px; width: 100%;"></div>
                    </div>

                    <div class="input-box city">
                        <span class="details addr">City</span>

                        <input type="text" name="city">

                    </div>


                </div>

                <hr class="second">

                <div class="prices">

                    <p style="text-align: right; margin: 10px 30px;"></p><br>

                    <table class="price-details-container">
                        <tr>
                            <th>Material</th>
                            <th>Sleeve Type</th>
                            <th>Printing Type</th>
                            <th>Quantity</th>
                            <th>Unit Price(Rs.)</th>
                        </tr>

                        <tr class="units">
                            <td class="materialType"></td>
                            <td class="sleeveType"></td>
                            <td class="printingType"></td>
                            <td class="quantityAll">0</td>
                            <td class="unitPrice"></td>

                            <input type="hidden" name="unit_price"> 
                        </tr>

                        <tr class="total">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td class="totalPrice">0</td>
                    </table>
                </div>

                <input type="hidden" name="total_price" />


                <!-- <p>You will be notified about possible discounts later</p> -->



                <input name="latitude" type="hidden" required />
                <input name="longitude" type="hidden" required />


                <button type="submit" class="close-btn pb" name="newOrder">Submit</button>
                <button type="button" class="cancel-btn pb" onclick="closeNew()">Cancel</button>





            </form>
        </div>
    </section>

    <script src="<?= ROOT ?>/assets/js/collection/collection.js"></script>
