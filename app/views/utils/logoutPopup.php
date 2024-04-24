<div id="logout-popup" class="logout-modal">
    <div class="modal-content">
        <span><i class="bx bx-x log-close-icon" style="color: #ff0000"></i></span>
        <div>
            <i class='bx bxs-error-circle bx-tada icon-warn' style='color:#7d2ae8'></i>
        </div>
        <h3>Do you want to logout ?</h3>
        <div class="logout-btn-component">

            <a href="<?= ROOT ?>/logout" class="button" id="confirmDelete">Yes</a>
            <button class="button" id="cancelDelete">No</button>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById("logout-popup");
    const btn = document.getElementById("logout-btn");
    const closeButton = document.getElementsByClassName("log-close-icon")[0];
    const confirmBtn = document.getElementById("confirmDelete");
    const cancelBtn = document.getElementById("cancelDelete");

    btn.addEventListener("click", function() {
        modal.style.display = "block";
    });

    closeButton.onclick = function() {
        modal.style.display = "none";
        // btn.classList.remove("active");
    };
    
    cancelBtn.onclick = function() {
        // btn.classList.remove("active");
        modal.style.display = "none";
    };
    
    confirmBtn.onclick = function() {
        modal.style.display = "none";
    };
    
    closeButton.addEventListener("mouseenter", function() {
        closeButton.classList.add("bx-flashing");
    });
    
    closeButton.addEventListener("mouseleave", function() {
        closeButton.classList.remove("bx-flashing");
    });
</script>


<style>
    .logout-modal {
        display: none;
        position: fixed;
        z-index: 100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        border-radius: 10px;
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 25%;
        text-align: center;
    }

    .log-close-icon {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        /* position: absolute !important; */
    }

    .log-close-icon:hover,
    .log-close-icon:focus {
        color: rgb(172, 0, 0);
        text-decoration: none;
        cursor: pointer;
    }

    .icon-warn {
        margin-left: 27px;
        font-size: 7rem;
        /* display: flexbox; */
        justify-content: center;
        align-items: center;
    }

    .button {
        text-decoration: none;
        width: 110px;
        font-size: 16px;
        display: inline-block;
        padding: 8px;
        border-radius: 10px;
        cursor: pointer;
        border: none;
        outline: none;
        color: #fff;
        transition: 0.3s ease-in;
        text-align: center;
        transform: scale(1);
        
    }
    
    #confirmDelete {
        margin-right: 10px;
        background-color: #000000;
    }
    
    #cancelDelete {
        background-color: #f44336;
    }
    
    #confirmDelete:hover {
        transform: scale(1.05);
        /* background-color: rgb(16, 187, 0); */
    }
    
    #cancelDelete:hover {
        transform: scale(1.05);
        background-color: rgb(255, 0, 0);
    }

    .logout-btn-component{
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>