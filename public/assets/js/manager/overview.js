let editMaterial = document.querySelector(".edit-material-btn");
let editIcon = document.querySelector(".edit-material-btn i");

let materials = document.querySelectorAll(".material .orders.card");
let addCard = document.querySelector(".add.card");
console.log(materials);

editMaterial.addEventListener("click", function () {

    addCard.classList.toggle("open-add");

});


// Get the modal
var addMaterial = document.getElementById("add-material");
var updateMaterial = document.getElementById("update-material");

// Get the button that opens the modal
var btn = document.querySelector(".add.card");

var updateBtn = document.querySelectorAll(".update-btn");

// Get the <span> element that closes the modal
var span = document.querySelectorAll(".close");
console.log(span);

// When the user clicks on the button, open the modal
btn.onclick = function () {
    addMaterial.style.display = "block";
    //   modal.style.transition = "0.5s ease-in-out";
    document.body.style.overflow = "hidden";
}

// updateBtn.forEach(function (btn) {
//     btn.onclick = function () {
//         console.log('update');
//         const materialData = this.getAttribute("data-material");
//         console.log(materialData);

//         document.querySelector('.update-form input[name="material_type"]').value = materialData.material_type;
//         document.querySelector('.update-form input[name="quantity"]').value = materialData.quantity;
//         document.querySelector('.update-form input[name="unit_price"]').value = materialData.unit_price;

//         updateMaterial.style.display = "block";
//         document.body.style.overflow = "hidden";
//     }
// })

function openUpdate(button) {
    console.log('update');

    document.querySelector('.popup-update input[name="material_type"]').value = button.getAttribute("data-name");
    document.querySelector('.popup-update input[name="quantity"]').value = button.getAttribute("data-quantity");
    document.querySelector('.popup-update input[name="unit_price"]').value = button.getAttribute("data-price");
    document.querySelector('.popup-update input[name="stock_id"]').value = button.getAttribute("data-id");

    updateMaterial.style.display = "block";
    document.body.style.overflow = "hidden";
}

function openDelete(button) {
    console.log('delete');
    console.log(button.getAttribute("data-id"));
    document.querySelector('.popup-delete input[name="stock_id"]').value = button.getAttribute("data-id");


    document.getElementById('deleteConfirmation').style.display = "block";
    document.body.style.overflow = "hidden";
}

function closeDelete() {
    document.getElementById('deleteConfirmation').style.display = "none";
    document.body.style.overflow = "auto";
}


// When the user clicks on <span> (x), close the modal
span.forEach(function (btn) {
    btn.onclick = function () {

        updateMaterial.style.display = "none";

        document.body.style.overflow = "auto";
    }
})



function addMaterialCard(name, quantity, price) {
    var newCard = document.createElement("div");
    newCard.className = "orders card";


    newCard.innerHTML = `
        <button class="delete-material-btn">
            <i class="fa fa-trash"></i>
        </button>
        <div class="middle">
            <div class="left">
                <h3>${name}</h3>
                <h1>${quantity}</h1>
                <p>Rs. ${price} per meter</p>
            </div>
            <button class="update-btn">Update</button>
        </div>
    `;

    console.log(newCard);

    document.querySelector(".add.card").before(newCard);

    let deleteMaterial = newCard.querySelector(".delete-material-btn");
    let updateBtn = newCard.querySelector(".update-btn");

    editMaterial.addEventListener("click", function () {
        deleteMaterial.classList.toggle("open-delete-material-btn");
        updateBtn.classList.toggle("open-update-btn");

        editIcon.classList.toggle("bx-edit");
        editIcon.classList.toggle("bx-check");

    });

    // updateBtn.onclick = function (button) {
    //     console.log('update');
    //     var updateMaterial = document.getElementById("update-material");


    //     updateMaterial.style.display = "block";
    //     document.body.style.overflow = "hidden";
    // }

    deleteMaterial.onclick = function () {
        newCard.remove();
    }


}


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

            submitAction(name, quantity, price);

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
