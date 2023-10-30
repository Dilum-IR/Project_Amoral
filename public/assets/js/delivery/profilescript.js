// Sidebar
window.onload = function(){
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector("#btn");
    // const searchBtn = document.querySelector(".bx-search")

    closeBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        menuBtnChange()
    })

    // searchBtn.addEventListener("click",function(){
    //     sidebar.classList.toggle("open")
    //     menuBtnChange()
    // })

    function menuBtnChange(){
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu","bx-menu-alt-right")
        }else{
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu")
        }
    }
}

// popup

const editGen = document.querySelector("#gen-info-edit");//general information edit button
const popGen = document.querySelector("#gen-info-pop");//general information popup section
const closeGen = document.querySelector("#gen-pop-close");//genral infomation close button
const cancelGen = document.querySelector("#gen-edit-cancel");//general information cancel button
const mainSection = document.querySelector("#middle");//main
const homeSection =  document.querySelector("#navbar");//home
const editSec = document.querySelector("#sec-info-edit");//security information edit button
const popSec = document.querySelector("#sec-info-pop");//security information popup section
const closeSec = document.querySelector("#sec-pop-close");//security infomation close button
const cancelSec = document.querySelector("#sec-edit-cancel");//security information cancel button

editSec.addEventListener("click", () => {
    popSec.style.display = "block";
    console.log("bbbbbbbbbbbb");
    mainSection.style.position = "fixed";
    mainSection.style.display = "none";
   
});


editGen.addEventListener("click", () => {
    popGen.style.display = "block";
    console.log("aaaaaaaaaaaa");
    mainSection.style.position = "fixed";
    mainSection.style.display = "none";
    
});

closeGen.addEventListener("click", () => {
    popGen.style.display = "none";
    mainSection.style.position = "absolute";
    mainSection.style.display = "block";

    console.log("kugsfiuhshskh");
});

cancelGen.addEventListener("click", () => {
    popGen.style.display = "none";
    mainSection.style.position = "absolute";
    mainSection.style.display = "block";
});

closeSec.addEventListener("click", () => {
    popSec.style.display = "none";
    mainSection.style.position = "absolute";
    mainSection.style.display = "block";
});

cancelSec.addEventListener("click", () => {
    popSec.style.display = "none";
    mainSection.style.position = "absolute";
    mainSection.style.display = "block";
});
