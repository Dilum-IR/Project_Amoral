let canvas = new fabric.Canvas('t-shirt-canvas');
var defaultFont = "Arial";
var lastText = null;
var selectedDecorations = [];
// var defaultWeight = "normal";
// var defaultStyle =  "normal";
// var defaultDecoration = "none";
// var defaultStrike = "none";

function updateColorCode() {
    var colorPicker = document.getElementById("t-shirt-color-picker");
    var colorDisplay = document.getElementById("selected-color");
    var selectedColorCode = colorPicker.value; //Get the selected color code from the color picker
    colorDisplay.textContent = selectedColorCode; //Update the text content of the color display element
}

var tshirtType = document.getElementById("t-shirt-type");
var tshirtImage = document.getElementById("t-shirt-image");
var tshirtSide = document.getElementById("t-shirt-side");

function updateTshirtType() {
    var selectedType = tshirtType.options[tshirtType.selectedIndex].value;
    tshirtImage.src = selectedType;
}

function addTshirtText() {
    var tshirtText = document.getElementById("t-shirt-text").value;
    var centerX = canvas.width / 2;
    var centerY = canvas.height / 2;
    // place the text in the center of the canvas
    var text = new fabric.Text(tshirtText, {
        left: centerX,
        top: centerY,
        fontFamily: defaultFont,
        fontWeight: 'normal',
        textStyle: 'normal',
        textDecoration: 'none',
        // textDecorationLine : 'none',
        lockScalingY: false

    });

    canvas.add(text);
    lastText = text;
    document.getElementById("t-shirt-text").value = "";
}

function changeFont() {
    // console.log("ddddddddddddddddddddddd");
    var selectedFont = document.getElementById("text-font");
    defaultFont = selectedFont.value;

    if (lastText != null) {
        lastText.set("fontFamily", defaultFont);
        canvas.renderAll();
    }
}

function changeFormat(style) {
    if (lastText != null) {
        if (selectedDecorations.includes(style)) {
            selectedDecorations = selectedDecorations.filter(item => item !== style);
        } else {
            selectedDecorations.push(style);
        }
        textFormat();
    }
}

function changeDecoration(decoration) {
    if (lastText != null) {
        if (selectedDecorations.includes(decoration)) {
            selectedDecorations = selectedDecorations.filter(item => item !== decoration);
        } else {
            selectedDecorations.push(decoration);
        }
        textFormat();
    }
}

function textFormat() {
    if (lastText != null) {
        lastText.set({
            fontWeight: selectedDecorations.includes('bold') ? 'bold' : 'normal',
            fontStyle: selectedDecorations.includes('italic') ? 'italic' : 'normal',
            textDecoration : selectedDecorations.join(''),
            textDecorationLine : selectedDecorations.join('')
        });
        console.log("textfomat");
        canvas.renderAll();
    }
}

var rootPath = "<?= ROOT ?>/assets/images/tool/";

function updateTshirtSide() {
    var selectedSide = tshirtSide.options[tshirtSide.selectedIndex].value;
    var selectedType = tshirtType.options[tshirtType.selectedIndex].value;
    console.log("update t shirt side");
    if ((selectedSide == "front-side") && (selectedType == "crew_neck_front.png")) {
        tshirtImage.src = selectedType;
    } else if ((selectedSide == "back-side") && (selectedType == "crew_neck_front.png")) {
        tshirtImage.src = ROOT + "assets/images/tool/crew_neck_back.png";

    } else if ((selectedSide == "front-side") && (selectedType == "polo_collar_front.png")) {
        tshirtImage.src = selectedType;
    } else if ((selectedSide == "back-side") && (selectedType == "polo_collar_front.png")) {
        tshirtImage.src = "polo_collar_back.png";

    } if ((selectedSide == "front-side") && (selectedType == "long_sleeve_front.png")) {
        tshirtImage.src = selectedType;
    } else if ((selectedSide == "back-side") && (selectedType == "long_sleeve_front.png")) {
        tshirtImage.src = "long_sleeve_back.png";
    }
}

function updateTshirtDesign(imageURL) {
    fabric.Image.fromURL(imageURL, function (img) {
        img.scaleToHeight(300);
        img.scaleToWidth(300);
        canvas.centerObject(img);
        canvas.add(img);
        canvas.renderAll();
    });
}

var tshirtColor1 = document.getElementById("t-shirt-color");
var tshirtColor2 = document.getElementById("t-shirt-color-picker");
var tshirtBackground = document.getElementById("t-shirt");
var tshirtDesign = document.getElementById("t-shirt-design");
var tshirtCustom = document.getElementById("t-shirt-custom-design");

// change tshirt color
tshirtColor1.addEventListener("change", function () {
    tshirtBackground.style.backgroundColor = this.value;
}, false);

tshirtColor2.addEventListener("input", function () {
    tshirtBackground.style.backgroundColor = this.value;
}, false);

// change tshirt design
tshirtDesign.addEventListener("change", function () {
    updateTshirtDesign.call(this, this.value);
}, false);

// upload a custom design
tshirtCustom.addEventListener("change", function (e) {
    var readImage = new FileReader();

    readImage.onload = function (event) {
        var imageObject = new Image();
        imageObject.src = event.target.result;
        // console.log("before image object");
        // create a new image in fabric.js when filereader loads an image
        imageObject.onload = function () {
            var newImage = new fabric.Image(imageObject);
            // console.log("image object");
            newImage.scaleToHeight(300);
            newImage.scaleToWidth(300);
            canvas.centerObject(newImage);
            canvas.add(newImage);
            canvas.renderAll();
        };
    }
    if (e.target.files[0]) {
        // console.log(" after image object");
        readImage.readAsDataURL(e.target.files[0]);
    }
}, false);

// remove image from canvas with CTRL+Z

document.addEventListener("keydown", function (e) {
    if ((e.ctrlKey || e.metaKey) && (e.key === 'z' || e.key === 'Z')) {
        console.log("pressed ctrl+z")
        canvas.remove(canvas.getActiveObject());
    }
}, false);



