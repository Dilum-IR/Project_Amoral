<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tool/nav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tool/tool.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>


    <div class="design-tool">
        <label for="t-shirt-type">Select T-Shirt Type</label>
        <select name="" id="t-shirt-type" onchange="updateTshirtType()">
            <option value="<?= ROOT ?>/assets/images/tool/crew_neck_front.png">Crew Neck</option>
            <option value="<?= ROOT ?>/assets/images/tool/polo_collar_front.png">Polo Collar</option>
            <option value="<?= ROOT ?>/assets/images/tool/long_sleeve_front.png">Long Sleeve</option>
        </select>

        <label for="t-shirt-side">Select Side</label>
        <select name="" id="t-shirt-side" onchange="updateTshirtSide()">
            <option value="front-side">Front</option>
            <option value="back-side">Back</option>
        </select>
        <div id="t-shirt" class="t-shirt">

            <img id="t-shirt-image" src="<?= ROOT ?>/assets/images/tool/crew_neck_front.png" alt="t-shirt-image">

            <div class="design-area">
                <div class="canvas-area">
                    <canvas id="t-shirt-canvas" class="t-shirt-canvas" width="220" height="430" style="position: absolute; width: 220px; height: 430px; left: 29px; top: 32px; user-select: none;"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- <label for="t-shirt-type">Select T-Shirt Type</label>
    <select name="" id="t-shirt-type" onchange="updateTshirtType()">
        <option value="crew_neck_front.png">Crew Neck</option>
        <option value="polo_collar_front.png">Polo Collar</option>
        <option value="long_sleeve_front.png">Long Sleeve</option>
    </select> -->

    <label for="t-shirt-design">Select a Design</label>
    <select name="" id="t-shirt-design">
        <option value=""></option>
        <option value="batman.png">Logo</option>
        <!-- <option value=""></option>
        <option value=""></option>
        <option value=""></option>
        <option value=""></option>
        <option value=""></option>
        <option value=""></option> -->
    </select>

    <label for="t-shirt-custom-design">Upload an Image</label>
    <input type="file" name="" id="t-shirt-custom-design" accept="image/*">
    <br>
    <br>

    <label for="t-shirt-text">Add a Text</label>
    <input type="text" id="t-shirt-text" placeholder="Type Here...">
    <button onclick="addTshirtText()">Add Text</button>
    <label for="text-font">Change Font Style</label>
    <select name="" id="text-font" onchange="changeFont()">
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

    <div class="text-format">
        <i type="format" class='bx bx-bold' id="text-bold" value="bold" onclick="changeFormat('bold')"></i>
        <i type="format" class='bx bx-italic' id="text-italic" value="italic" onclick="changeFormat('italic')"></i>
        <i type="format" class='bx bx-underline' id="text-underline" value="underline" onclick="changeDecoration('underline')"></i>
        <i type="format" class='bx bx-strikethrough' id="text-strike" value="strike" onclick="changeDecoration('line-through')"></i>
    </div>
    <br>
    <br>

    <label for="t-shirt-color">Select T-Shirt Color</label>
    <select name="" id="t-shirt-color">
        <option value="#fff">White</option>
        <option value="#000">Black</option>
        <option value="#f00">Red</option>
        <option value="#008000">Green</option>
        <option value="#ff0">Yellow</option>
        <option value="#000080">Navy Blue</option>
        <option value="#808080">Grey</option>
    </select>

    <br>
    <br>

    <div id="display-color-code">Selected Color : <span id="selected-color">#000000</span></div>
    <input type="color" id="t-shirt-color-picker" class="t-shirt-color-picker" onchange="updateColorCode()">


    <script src="<?= ROOT ?>/assets/js/tool/fabric.js"></script>
    <script src="<?= ROOT ?>/assets/js/tool/tool.js"></script>
</body>

</html>