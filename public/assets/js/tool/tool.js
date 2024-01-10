let canvas = new fabric.Canvas('t-shirt-canvas');
var defaultFont = "Arial";
// var defaultFontSize = "16px";
var defaultTextColor = "#000000";
var lastText = null;
var selectedDecorations = [];
// var defaultWeight = "normal";
// var defaultStyle =  "normal";
// var defaultDecoration = "none";
// var defaultStrike = "none";
var rootPath = "http://localhost/project_Amoral/public/assets/images/tool/";


function updateColorCode() {
    var colorPicker = document.getElementById("t-shirt-color-picker");
    var colorDisplay = document.getElementById("selected-color");
    var selectedColorCode = colorPicker.value; //Get the selected color code from the color picker
    colorDisplay.textContent = selectedColorCode; //Update the text content of the color display element

}

var tshirtType = '';
var tshirtImage = document.getElementById("t-shirt-image");
var tshirtSide = document.getElementById("t-shirt-side");

//change the t shirt type to crew neck polo or long sleeve
function updateTshirtType(newType) {
    tshirtImage.src = rootPath + newType;
    tshirtType = newType;
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
        // fontSize:  defaultFontSize,
        textColor: defaultTextColor,
        fontWeight: 'normal',
        textStyle: 'normal',
        textDecoration: 'none',
        textDecorationLine: 'none',

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
            textDecoration: selectedDecorations.join(''),
            textDecorationLine: selectedDecorations.join('')
        });
        console.log("textfomat");
        canvas.renderAll();
    }
}

// function changeFontSize(){
//     var fontSize = parseInt(document.getElementById("text-font-size").value, 10);


//     if (lastText) {
//         lastText.set("fontSize", defaultFontSize);

//     }
//     canvas.renderAll();
// }

var textColorPicker = document.getElementById("text-color");;

function changeTextColor() {

    textColorPicker.addEventListener("input", function () {
        var textColor = document.getElementById("text-color").value;
        defaultTextColor = textColor;
        var textColorDisplay = document.getElementById("selected-text-color");
        var selectedColorCode = textColorPicker.value; //Get the selected color code from the color picker
        textColorDisplay.textContent = selectedColorCode; //Update the text content of the color display element

        if (lastText != null) {
            lastText.set("fill", defaultTextColor);
            canvas.renderAll();
        }
    });
}



function updateTshirtSide() {
    // var selectedType = tshirtType.valueOf;
    var frontSide = document.getElementById("t-shirt-front");
    var backSide = document.getElementById("t-shirt-back");

    if (frontSide.checked) {
        if (tshirtType == "crew_neck_front.png") {
            tshirtImage.src = rootPath + tshirtType;
        } else if (tshirtType == "polo_collar_front.png") {
            tshirtImage.src = rootPath + tshirtType;
        } else if (tshirtType == "long_sleeve_front.png") {
            tshirtImage.src = rootPath + tshirtType;
        }
    } else if (backSide.checked) {
        // console.log("backside checked");
        if ((tshirtType == "crew_neck_front.png") || (tshirtType == "")) {
            // console.log("if backside checked");
            tshirtImage.src = rootPath + "crew_neck_back.png";
        } else if (tshirtType == "polo_collar_front.png") {
            tshirtImage.src = rootPath + "polo_collar_back.png";
        } else if (tshirtType == "long_sleeve_front.png") {
            tshirtImage.src = rootPath + "long_sleeve_back.png";
        }
    }
}

// when you click on another type the radio button should go back to default checked
document.getElementById("crew-neck-image").addEventListener('click', function () {
    if (document.getElementById("t-shirt-back").checked) {
        document.getElementById("t-shirt-front").checked = true;
    }
});

document.getElementById("polo-collar-image").addEventListener('click', function () {
    if (document.getElementById("t-shirt-back").checked) {
        document.getElementById("t-shirt-front").checked = true;
    }
});

document.getElementById("long-sleeve-image").addEventListener('click', function () {
    if (document.getElementById("t-shirt-back").checked) {
        document.getElementById("t-shirt-front").checked = true;
    }
});


function updateTshirtDesign(imageURL) {
    fabric.Image.fromURL(imageURL, function (img) {
        img.scaleToHeight(300);
        img.scaleToWidth(300);
        canvas.centerObject(img);
        canvas.add(img);
        canvas.renderAll();
    });
}

var tshirtColor = document.getElementById("t-shirt-color-picker");
var tshirtBackground = document.getElementById("t-shirt");
var tshirtDesign = document.getElementById("t-shirt-design");
var tshirtCustom = document.getElementById("t-shirt-custom-design");

tshirtColor.addEventListener("input", function () {
    tshirtBackground.style.backgroundColor = this.value;
}, false);

// change tshirt design
tshirtDesign.addEventListener("change", function () {
    updateTshirtDesign.call(this, this.value);
}, false);

function changeTshirtColor(color) {
    tshirtBackground.style.backgroundColor = color;

    if (color == "black") {
        console.log("black");
        document.getElementById("black").style.transform = 'scale(1.3)';
    } else {
        document.getElementById("black").style.transform = 'scale(1)';
    }

    if (color == "blue") {
        console.log("black");
        document.getElementById("blue").style.transform = 'scale(1.3)';
    } else {
        document.getElementById("blue").style.transform = 'scale(1)';
    }

    if (color == "#000435") {
        console.log("black");
        document.getElementById("navy").style.transform = 'scale(1.3)';
    } else {
        document.getElementById("navy").style.transform = 'scale(1)';
    }

    if (color == "white") {
        console.log("black");
        document.getElementById("white").style.transform = 'scale(1.3)';
    } else {
        document.getElementById("white").style.transform = 'scale(1)';
    }

    if (color == "red") {
        console.log("black");
        document.getElementById("red").style.transform = 'scale(1.3)';
    } else {
        document.getElementById("red").style.transform = 'scale(1)';
    }

    if (color == "green") {
        console.log("black");
        document.getElementById("green").style.transform = 'scale(1.3)';
    } else {
        document.getElementById("green").style.transform = 'scale(1)';
    }

}


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

//download the design
function downloadImage() {
    var downloadContent = document.getElementById('t-shirt');
    // console.log("downloaaaaaaaaaaaaaad");
    html2canvas(downloadContent).then(function (canvas) {
        var downloadURL = canvas.toDataURL('image/png');
        var downloadLink = document.createElement('a');
        downloadLink.href = downloadURL;
        downloadLink.download = 'amoral_design.png';
        downloadLink.click();
    });
}
// document.getElementById('download-button').addEventListener('click', function () {

// });

// remove image from canvas with CTRL+Z

// document.addEventListener("keydown", function (e) {
//     if ((e.ctrlKey || e.metaKey) && (e.key === 'z' || e.key === 'Z')) {
//         console.log("pressed ctrl+z")
//         canvas.remove(canvas.getActiveObject());
//     }
// }, false);



// change the color of text decorations icon after clicking


function changeIconColor(textDeco) {
    if (lastText != null) {
       
        console.log("text icon color");
     

        if(textDeco == "bold"){
            document.getElementById("text-format-icons-bold").style.backgroundColor = 'red';
        }
        if(textDeco == "italic"){
            document.getElementById("text-format-icons-italic").style.backgroundColor = 'red';
        }
        if(textDeco == "underline"){
            document.getElementById("text-format-icons-underline").style.backgroundColor = 'red';
        }
        if(textDeco == "line-through"){
            document.getElementById("text-format-icons-line-through").style.backgroundColor = 'red';
        }
    }

}
