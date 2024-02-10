let editMaterial = document.querySelector(".edit-material-btn");
let editPrintingType = document.querySelector(".edit-printingType-btn");
let editIcon = document.querySelector(".edit-material-btn i");

let materials = document.querySelectorAll(".material .orders.card");
let MaterialaddCard = document.querySelector(".material .add.card");
let PrintingTypeaddCard = document.querySelector(".printingType .add.card");
console.log(materials);

editMaterial.addEventListener("click", function () {

    MaterialaddCard.classList.toggle("open-add");

});

editPrintingType.addEventListener("click", function () {

    PrintingTypeaddCard.classList.toggle("open-add");

});


// material stock js 
var addMaterial = document.getElementById("add-material");
console.log(addMaterial);
var updateMaterial = document.getElementById("update-material");


var btn = document.querySelector(".add.card");

var updateBtn = document.querySelectorAll(".update-btn");


var spanMaterial = document.querySelectorAll(".material .popup-update .close");
console.log(spanMaterial);

// When the user clicks on the button, open the modal
btn.onclick = function () {
    addMaterial.style.display = "block";
    //   modal.style.transition = "0.5s ease-in-out";
    document.body.style.overflow = "hidden";
}

function openUpdateMaterial(button) {
    console.log('update');

    document.querySelector('.popup-update input[name="material_type"]').value = button.getAttribute("data-name");
    document.querySelector('.popup-update input[name="quantity"]').value = button.getAttribute("data-quantity");
    document.querySelector('.popup-update input[name="unit_price"]').value = button.getAttribute("data-price");
    document.querySelector('.popup-update input[name="ppm"]').value = button.getAttribute("data-ppm");	
    document.querySelector('.popup-update input[name="stock_id"]').value = button.getAttribute("data-id");

    updateMaterial.style.display = "block";
    document.body.style.overflow = "hidden";
}

function openDeleteMaterial(button) {
    console.log('delete');
    console.log(button.getAttribute("data-id"));
    document.querySelector('.popup-delete input[name="stock_id"]').value = button.getAttribute("data-id");


    document.getElementById('deleteConfirmation-material').style.display = "block";
    document.body.style.overflow = "hidden";
}

function closeDelete() {
    document.getElementById('deleteConfirmation-materila').style.display = "none";
    document.body.style.overflow = "auto";
}


// When the user clicks on <spanMaterial> (x), close the modal
spanMaterial.forEach(function (btn) {
    btn.onclick = function () {

        updateMaterial.style.display = "none";

        document.body.style.overflow = "auto";
    }
});

// printing type js 
var addPrintingType = document.getElementById("add-printingType");
console.log(addPrintingType);
var updatePrintingType = document.getElementById("update-printingType");


var btnPrintingType = document.querySelector(".printingType .add.card");

var updateBtnPrintingType = document.querySelectorAll(".printingType .update-btn");


var spanPrintingType = document.querySelectorAll("#update-printingType .close");
console.log(spanMaterial);


btnPrintingType.onclick = function () {
    addPrintingType.style.display = "block";
    console.log('add');
    //   modal.style.transition = "0.5s ease-in-out";
    document.body.style.overflow = "hidden";
}

function openUpdatePrintingType(button) {
    console.log('update');
    var materialsJson = button.getAttribute('data-materials');
    var materials = JSON.parse(materialsJson);
    console.log(materialsJson);
    var checkboxes = document.querySelectorAll('.popup-update input[type=checkbox]');
    var materialsString = materials.map(function(material) {
        return material.join(",");
    });
    console.log(materialsString);
    checkboxes.forEach(function(checkbox){
        console.log(checkbox.value);

        if(materialsString.includes(checkbox.value)){
            checkbox.checked = true;
        }else{
            checkbox.checked = false;
        }
    });

    document.querySelector('.popup-update input[name="printing_type"]').value = button.getAttribute("data-printingType");
    document.querySelector('.popup-update input[name="price"]').value = button.getAttribute("data-price");

    document.querySelector('.popup-update input[name="ptype_id"]').value = button.getAttribute("data-id");

    updatePrintingType.style.display = "block";
    document.body.style.overflow = "hidden";
}

function openDeletePrintingType(button) {
    console.log('delete');
    console.log(button.getAttribute("data-id"));
    document.querySelector('.popup-delete input[name="ptype_id"]').value = button.getAttribute("data-id");


    document.getElementById('deleteConfirmation-ptype').style.display = "block";
    document.body.style.overflow = "hidden";
}

var closeAddPrintingType = document.querySelector("#add-printingType .close");

closeAddPrintingType.addEventListener("click", function () {
    addPrintingType.style.display = "none";
    document.body.style.overflow = "auto";
});

function closeDelete() {
    document.getElementById('deleteConfirmation-ptype').style.display = "none";
    document.body.style.overflow = "auto";
}


// When the user clicks on <spanMaterial> (x), close the modal
spanPrintingType.forEach(function (btn) {
    btn.onclick = function () {
        console.log('close');
        updatePrintingType.style.display = "none";

        document.body.style.overflow = "auto";
    }
});


document.addEventListener('DOMContentLoaded', (event) => {
    var addForm = document.querySelector(".popup-add");
    var updateForm = document.querySelector(".popup-update");

    if (addForm) {
        setupForm(addForm, addMaterialCard);
    } else {
        console.error('Add form not found');
    }

    if (updateForm) {
        setupForm(updateForm);
    } else {
        console.error('Update form not found');
    }
});

function setupForm(form, submitAction) {
    var close = form.querySelector(".close");

    close.addEventListener('click', function () {
        clearErrorMsg(form);
        form.style.display = "none";
        document.body.style.overflow = "auto";
    });

    form.addEventListener("submit", function (event) {
        clearErrorMsg(form);
        
        let errors = validateMaterial(form);
        if (Object.keys(errors).length > 0) {
            event.preventDefault();    
            displayErrorMsg(errors, form);
        } else {
            let name = form.querySelector('input[name="material_type"]').value;
            let quantity = form.querySelector('input[name="quantity"]').value;
            let price = form.querySelector('input[name="unit_price"]').value;
            let ppm = form.querySelector('input[name="ppm"]').value;

            submitAction(name, quantity, price, ppm);

            form.style.display = "none";
            document.body.style.overflow = "auto";
        }
    });
}

function validateMaterial(form) {
    let errors = {};

    let title = form.querySelector('input[name="material_type"]').value;
    if (title.trim() === '') {
        errors['name'] = 'Material Name is required';
    }

    let description = form.querySelector('input[name="quantity"]').value;
    if (description.trim() === '') {
        errors['quantity'] = 'Quantity is required';
    }

    let email = form.querySelector('input[name="unit_price"]').value;
    if (email.trim() === '') {
        errors['price'] = 'Price per unit is required';
    }

    return errors;
}

function displayErrorMsg(errors, form) {
    for (const key in errors) {
        if (Object.hasOwnProperty.call(errors, key)) {
            const error = errors[key];
            form.querySelector(`.error.${key}`).innerText = error;
        }
    }
}

function clearErrorMsg(form) {
    let errorElements = form.querySelectorAll('.error');

    errorElements.forEach(errorElement => {
        errorElement.innerText = '';
    });
}
