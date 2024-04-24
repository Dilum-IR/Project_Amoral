<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T Shirt Design with Amoral</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tool/tool.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tool/nav.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>

    <?php include 'navigationbar.php' ?>


    <div class="desgin-tool-main">
        <div class="t-shirt-section">

            <div class="t-shirt-icons" id="t-shirt-icons">
                <p>Type</p>
                <div onclick="updateTshirtType('crew_neck_front.png')" class="t-shirt-icon" id="crew-neck-image"><img src="<?= ROOT ?>/assets/images/tool/crew_neck_icon.png" alt=""></div>
                <div onclick="updateTshirtType('polo_collar_front.png')" class="t-shirt-icon" id="polo-collar-image"><img src="<?= ROOT ?>/assets/images/tool/crew_neck_icon.png" alt=""></div>
                <div onclick="updateTshirtType('long_sleeve_front.png')" class="t-shirt-icon" id="long-sleeve-image"><img src="<?= ROOT ?>/assets/images/tool/long_sleeve_icon.png" alt=""></div>
            </div>
            <!-- <select name="" id="t-shirt-type" onchange="updateTshirtType()">
                <option value="crew_neck_front.png">Crew Neck</option>
                <option value="polo_collar_front.png">Polo Collar</option>
                <option value="long_sleeve_front.png">Long Sleeve</option>
            </select> -->

            <br>

            <div class="t-shirt-front-back">
                <p>Side</p>
                <div>
                    <input class="select-side" type="radio" name="t-shirt-side" id="t-shirt-front" value="front-side" checked onclick="updateTshirtSide()">
                    <label class="t-shirt-label" for="t-shirt-front">Front</label>
                </div>
                <div>
                    <input class="select-side" type="radio" name="t-shirt-side" id="t-shirt-back" value="back-side" onclick="updateTshirtSide()">
                    <label class="t-shirt-label" for="t-shirt-back">Back</label>
                </div>
            </div>
            <!-- <label for="t-shirt-side">Select Side</label>
            <select name="" id="t-shirt-side" onchange="updateTshirtSide()">
                <option value="front-side">Front</option>
                <option value="back-side">Back</option>
            </select> -->

            <br>

            <div class="t-shirt-color-select">
                <label for="t-shirt-color-picker">T-Shirt Color</label>
                <div class="t-shirt-color-preset">
                    <div onclick="changeTshirtColor('black')" class="color-circle" id="black"></div>
                    <div onclick="changeTshirtColor('blue')" class="color-circle" id="blue"></div>
                    <div onclick="changeTshirtColor('#000435')" class="color-circle" id="navy"></div>
                    <div onclick="changeTshirtColor('red')" class="color-circle" id="red"></div>
                    <div onclick="changeTshirtColor('green')" class="color-circle" id="green"></div>
                </div>
            </div>
            <br>
            <div class="t-shirt-color-picker-select">
                <input type="color" id="t-shirt-color-picker" class="t-shirt-color-picker" onchange="updateColorCode()">
                <div>Selected Color : <span id="selected-color">#000000</span></div>
            </div>
            <br>

            <label for="t-shirt-design">Select a Design</label>
            <!-- <select name="" id="t-shirt-design">
                <option value=""></option>
                <option value="batman.png">Logo</option>
            </select> -->

            <div class="custom-designs">
                <div class="available-designs" id="available-designs">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                    <img class="available-images" src="<?= ROOT ?>/assets/images/available-designs/uoc_logo.png" alt="">
                </div>
            </div>
            <br>
            <br>

            <input type="file" name="" id="t-shirt-custom-design" accept="image/png, image/jpeg">
            <label class="upload-button-label" for="t-shirt-custom-design"><i id="upload-button-icon" class='bx bx-upload'></i>Upload a Design</label> 
        </div>

        <div class="design-section">
            <div id="t-shirt" class="t-shirt">
                <img id="t-shirt-image" class="t-shirt-image" src="<?= ROOT ?>/assets/images/tool/crew_neck_front.png" alt="t-shirt-image">
                <div class="design-area">
                    <div class="canvas-area">
                        <canvas id="t-shirt-canvas" class="t-shirt-canvas" width="220" height="430" style="position: absolute; width: 220px; height: 430px;  user-select: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <div class="text-editor">
            <div class="text-section">
                <div class="text-add-and-text-box">
                    <input type="text" id="t-shirt-text" placeholder="Add Text...">
                    <button id="add-text-button" onclick="addTshirtText()">Add</button>
                </div>
                <br>
                <div class="font-change">
                    <!-- <label id="font-lable" for="text-font">Font</label> -->
                    <div>Font Style</div>
                    <select name="" class="text-font" id="text-font" onchange="changeFont()">
                        <option value="Arial" style="font-family: Arial; font-weight: bolder; font-size: 16px;">Arial</option>
                        <option value="Verdana" style="font-family: Verdana; font-weight: bolder; font-size: 16px;">Verdana</option>
                        <option value="Georgia" style="font-family: Georgia; font-weight: bolder; font-size: 16px;">Georgia</option>
                        <option value="Times New Roman" style="font-family: 'Times New Roman'; font-weight: normal; font-size: 16px;">
                            Times New Roman</option>
                        <option value="Courier New" style="font-family: 'Courier New'; font-weight: normal; font-size: 16px;">Courier
                            New</option>
                        <option value="Impact" style="font-family: Impact; font-weight: bolder; font-size: 16px;">Impact</option>
                        <option value="Comic Sans MS" style="font-family: 'Comic Sans MS'; font-weight: normal; font-size: 16px;">Comic
                            Sans MS</option>
                        <option value="Tahoma" style="font-family: Tahoma; font-weight: bold; font-size: 16px;">Tahoma</option>
                        <option value="Palatino Linotype" style="font-family: 'Palatino Linotype'; font-weight: normal; font-size: 16px;">Palatino Linotype</option>
                        <option value="Lucida Sans Unicode" style="font-family: 'Lucida Sans Unicode'; font-weight: normal; font-size: 16px;">Lucida Sans Unicode
                        </option>
                        <option value="Garamond" style="font-family: Garamond; font-weight: bold; font-size: 16px;">Garamond</option>
                        <option value="Book Antiqua" style="font-family: 'Book Antiqua'; font-weight: normal; font-size: 16px;">Book
                            Antiqua</option>
                        <option value="Arial Black" style="font-family: 'Arial Black'; font-weight: bolder; font-size: 16px;">Arial
                            Black</option>
                        <option value="Century Gothic" style="font-family: 'Century Gothic'; font-weight: normal; font-size: 16px;">
                            Century Gothic</option>
                        <option value="Franklin Gothic Medium" style="font-family: 'Franklin Gothic Medium'; font-weight: normal; font-size: 16px;">Franklin Gothic Medium
                        </option>
                        <option value="Rockwell" style="font-family: Rockwell; font-weight: bold; font-size: 16px;">Rockwell</option>
                    </select>
                </div>
                <br>
                <div class="text-format">
                    <div class="text-format-icons" id="text-format-icons-bold" onclick="changeIconColor('text-format-icons-bold')">
                        <i type="format" class='bx bx-bold' id="text-bold" value="bold" onclick="changeFormat('bold')"></i>
                    </div>
                    <div class="text-format-icons" id="text-format-icons-italic" onclick="changeIconColor('text-format-icons-italic')">
                        <i type="format" class='bx bx-italic' id="text-italic" value="italic" onclick="changeFormat('italic')"></i>
                    </div>
                    <div class="text-format-icons" id="text-format-icons-underline" onclick="changeIconColor('text-format-icons-underline')">
                        <i type="format" class='bx bx-underline' id="text-underline" value="underline" onclick="changeDecoration('underline')"></i>
                    </div>
                    <div class="text-format-icons" id="text-format-icons-line-through" onclick="changeIconColor('text-format-icons-line-through')">
                        <i type="format" class='bx bx-strikethrough' id="text-strike" value="strike" onclick="changeDecoration('line-through')"></i>
                    </div>
                </div>

                <!-- <div class="t-shirt-text-font">
                    <label for="text-font-size">Font Size</label>
                    <input type="number" id="text-font-size" value="40" onchange="changeFontSize()">
                </div> -->

                <div class="t-shirt-text-color">
                    <label for="text-color">Text Color</label>
                    <input type="color" id="text-color" value="#000000" onchange="changeTextColor()">
                    <div>Color : <span id="selected-text-color">#000000</span></div>
                </div>
            </div>

            <br>
            <button id="download-button" onclick="downloadImage() ; animateDownload()"> Download Design <i id="download-icon" class='bx bx-download'></i> </button>
        </div>

    </div>
    <script src="<?= ROOT ?>/assets/js/tool/fabric.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/tool/tool.js"></script>

</body>

</html>