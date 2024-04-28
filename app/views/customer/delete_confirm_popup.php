<div id="delete-confirm-popup" class="logout-modal">
    <div class="modal-content">
        <span><i class="bx bx-x status-close-icon" style="color: #ff0000"></i></span>
        <div>
            <i class='bx bxs-error-circle bx-tada icon-warn1' style='color:#7d2ae8'></i>

        </div>
        <h3>Are you sure that you want to cancel the order?</h3>
        <div class="logout-btn-component">

            <button class="button" id="okdelete">Yes</button>
            <button class="button" id="nodelete">No</button>
        </div>
    </div>
</div>

<script>
    const delete_confirm_popup = document.getElementById("delete-confirm-popup");
    const closeButton_delete = document.getElementsByClassName("status-close-icon")[0];
    const confirm_delete = document.getElementById("okdelete");
    const cancel_delete = document.getElementById("nodelete");

    cancel_delete.onclick = function() {

        // when popup time get data object for assign empty. beacuse not ok tapped
        each_order = {};
        delete_confirm_popup.style.display = "none";
    };

    confirm_delete.onclick = function() {
        //console.log("Data deleted successfully.");

        // call the garment order js file include this order status update function
        cancel_cus_order("table btn");
        delete_confirm_popup.style.display = "none";
        each_order = {};
    };

    closeButton_delete.onclick = function() {

        // when popup time get data object for assign empty. beacuse not ok tapped
        each_order = {};
        delete_confirm_popup.style.display = "none";
    };

    closeButton_delete.addEventListener("mouseenter", function() {
        closeButton_delete.classList.add("bx-flashing");
    });

    closeButton_delete.addEventListener("mouseleave", function() {
        closeButton_delete.classList.remove("bx-flashing");

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
        width: 30%;
        text-align: center;
    }

    .status-close-icon {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        /* position: absolute !important; */
    }

    .status-close-icon:hover,
    .status-close-icon:focus {
        color: rgb(172, 0, 0);
        text-decoration: none;
        cursor: pointer;
    }

    .icon-warn1 {
        margin-left: 27px;
        font-size: 5rem;
        /* display: flexbox; */
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;

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

    #okdelete {
        margin-right: 10px;
        background-color: #000000;
    }

    #nodelete {
        background-color: #f44336;
    }

    #okdelete:hover {
        transform: scale(1.05);
        /* background-color: rgb(16, 187, 0); */
    }

    #nodelete:hover {
        transform: scale(1.05);
        background-color: rgb(255, 0, 0);
    }

    .logout-btn-component {
        margin-top: 20px;
        margin-bottom: 10px;
    }
</style>