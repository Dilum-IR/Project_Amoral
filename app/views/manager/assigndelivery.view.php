<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/assigndelivery.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
</head>
<body>

    <?php include_once 'sidebar.php' ?>
    <?php include_once 'navigationbar.php' ?>

    <section id="main" class="main">
        <div class="success-msg"> </div>

        <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <i class='bx bx-chevron-right'></i>
                <li>
                    <a href="#" class="active">Assign Delivery Orders</a>
                </li>

        </ul>

        <div class="content">
            <div class="map">

            </div>

            <form id="assign-delivery" method="POST">

                <div class="orders">
                    <h3>Selected Orders <i class='bx bx-chevron-right'></i></h3> <span class="error selected"></span>

                    <!-- <div class="order">
                        <p>This is an order </p>
                    </div> -->
                    <h4>Select a deliveryman</h4> <span class="error driver"></span>
                    <select name="deliveryman" id="deliveryman">
                    
                        <option value="" selected hidden style="color: grey;">Select</option>

                        <?php if(!empty($data['deliveryman'])):
                            foreach($data['deliveryman'] as $deliveryman): ?>
                                <option value="<?= $deliveryman->emp_id; ?>"><?= $deliveryman->emp_name; ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" selected hidden style="color: grey;">No Options</option>
                        <?php endif; ?>
                    </select>

                    <div class="emp-details">
                        <div>
                            <h5>Driver's Name:  <span class='name'></span></h5>
                            <h5>Vehicle Type:  <span class="vehicle"></span></h5>
                            <h5>Maximum Capacity:  <span class="capacity"></span></h5>
                            <button class="view-btn" type="button" onclick="openView(this)">View Current Orders</button>
                        </div>
                        <div class="icon">
                            <i></i>
                        </div>
                    </div>
                    
                    <button type="submit">Assign</button>
                </div>
            </form>


        </div>


        
        <div class="popup-view" id="popup-view">
        <!-- <button type="button" class="update-btn pb">Update Order</button> -->
        <!-- <button type="button" class="cancel-btn pb">Cancel Order</button> -->
        <div class="popup-content">
            <span class="close" >&times;</span>
          
            <h2>Current Orders</h2>

        
            <form class="update-form" method="POST">
                <div class="current-orders">
                    <div class="header">
                        <h4>Current No. of Orders: <span class="currentOrders"></span></h4>
                        <h4>Remaining Capacity: <span class="remainCapacity"></span></h4>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 60% 1fr; gap: 15px;">
                        <div class="map">
                            
                        </div>
                        <div class="orders-container">
                        </div>
            
                    </div>

                    <input type="hidden" name="deliver_id" readonly />

                    
                </div>
                <!-- hidden element -->
                <!-- <div class="input-box">
                    <input name="order_id" type="hidden" required />
                </div> -->


                <!-- <form method="POST" class="popup-view" id="popup-view"> -->
                    <input type="submit" class="update-btn pb" name="updateOrdersUpdate" value="Update" />
                    <!-- <button type="button" onclick="" class="cancel-btn pb">Cancel</button> -->
                <!-- </form> -->


            </form>
        </div>
        </div>
    </section>

    <script>
        // ajax for updating assigned orders for deliveryman
        let updateForm = document.querySelector('.popup-view .update-form');
        updateForm.addEventListener('submit', function(e){
            e.preventDefault();
            let formData = new FormData(updateForm);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= ROOT ?>/manager/updateAssignedOrders', true);
            xhr.onload = function(){
                if(this.status == 200){
                    console.log('response'+this.responseText);
                    let response = JSON.parse(this.responseText);
                    if(response == false){
                        var successMsgElement = document.querySelector('.success-msg');
                        successMsgElement.innerHTML = "Orders updated successfully";
                        successMsgElement.style.display = 'block';
                        setTimeout(function() {
                            successMsgElement.style.display = 'none';
                            location.reload();
                        }, 2000);
                    }else{
                        var successMsgElement = document.querySelector('.success-msg');
                        successMsgElement.innerHTML = "There was an error updating the orders";
                        successMsgElement.style.display = 'block';
                        successMsgElement.style.backgroundColor = 'red';
                        setTimeout(function() {
                            successMsgElement.style.display = 'none';
                            location.reload();
                        }, 2000);
                    }
                }
            }
            xhr.send(formData);
        });
    </script>


    <script>
        //ajax for assigning orders
        let form = document.getElementById('assign-delivery');
        form.addEventListener('submit', function(e){
            e.preventDefault();
            var noerror = validateAssign();
            if(noerror){

                let formData = new FormData(form);
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '<?= ROOT ?>/manager/assignDeliverymen', true);
                xhr.onload = function(){
                    if(this.status == 200) {
                        console.log('response'+this.responseText);
                        let response = JSON.parse(this.responseText);
                        if (response == false) {
                            // delay(10000);
                            
                            
                            var successMsgElement = document.querySelector('.success-msg');
                            successMsgElement.innerHTML = "Delivery assigned successfully";
                            successMsgElement.style.display = 'block';
                            // delay(2000);
                            setTimeout(function() {
                                successMsgElement.style.display = 'none';
                                location.reload();
                            }, 2000);
                            
                                
    
                        }else{
                            var successMsgElement = document.querySelector('.success-msg');
                   
                            successMsgElement.innerHTML = "There was an error placing the order";
                            
                            // successMsgElement.style.transition = 'all 1s ease-in-out';
                            
                            successMsgElement.style.display = 'block';
                            successMsgElement.style.backgroundColor = 'red';
                            setTimeout(function() {
                                successMsgElement.style.display = 'none';
                                location.reload();
                            }, 2000);
                        }
                    }
                }
                xhr.send(formData);
            }
        });
    </script>

    <script>
        var orders = <?= json_encode($data['pending_orders']) ?>;
        var assignedOrders = <?= json_encode($data['assigned_orders']) ?>; // this is all orders. these are filtered in js file
        console.log(assignedOrders);
        var sizes = <?= json_encode($data['sizes']); ?>;
        var deliveryman = <?= json_encode($data['deliveryman']); ?>;

    </script>

    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Fo-CyT14-vq_yv62ZukPosT_ZjLglEk&loading=async&callback=initMap"></script>


    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/manager/assigndelivery.js"></script>
    
</body>
</html>