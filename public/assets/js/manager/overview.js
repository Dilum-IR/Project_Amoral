let editMaterial = document.querySelector(".edit-material-btn");
console.log(editMaterial);
let materials = document.querySelectorAll(".card");
console.log(materials);

editMaterial.addEventListener("click", function () {
    materials.forEach(function(material) {
        material.classList.toggle("open-material");
        console.log(material.classList);
    });
});