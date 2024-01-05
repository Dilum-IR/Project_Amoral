let editMaterial = document.querySelector(".edit-material-btn");
let editIcon = document.querySelector(".edit-material-btn i");
console.log(editMaterial);
let materials = document.querySelectorAll(".material .orders.card");
let addCard = document.querySelector(".add.card");
console.log(materials);

editMaterial.addEventListener("click", function () {
    materials.forEach(function(material) {
        material.classList.toggle("open-material");
        addCard.classList.toggle("open-add");
        editIcon.classList.toggle("bx-edit");
        editIcon.classList.toggle("bx-check");
    });
});