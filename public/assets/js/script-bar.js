// Sidebar
window.onload = function(){
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector("#btn");
    const main = document.querySelector(".main");
    const links = document.querySelectorAll(".sidebar li a");

    if (localStorage.getItem('sidebar') === 'open') {
        sidebar.classList.add('open');
        main.classList.add('open');
        menuBtnChange();
    }

    links.forEach(link => {
    link.addEventListener('click', (event) => {
    
        links.forEach(link => {
        link.classList.remove('active');
        });

        link.classList.add('active');


    });
    // console.log(window.location.href);
    // console.log(link.href === window.location.href);

    if (link.href === window.location.href) {
        // console.log(link.href);
        link.classList.add('active');
    }


    

    
    });

    closeBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        main.classList.toggle("open")
        menuBtnChange()

        if (sidebar.classList.contains('open')) {
            localStorage.setItem('sidebar', 'open');
        } else {
            localStorage.setItem('sidebar', 'closed');
        }
    })

    searchBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        menuBtnChange()
    })

    function menuBtnChange(){
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu","bx-menu-alt-right")
        }else{
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu")
        }
    }
}

// Navbar

// const profile = document.querySelector('nav .profile-nav');
// const imgProfile = profile.querySelector('img');
// const dropdownProfile = profile.querySelector('.profile-link');

// imgProfile.addEventListener('click', function () {
// 	dropdownProfile.classList.toggle('show');
// })