<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta http-equiv="refresh" content="2; url=<?= ROOT ?>/garment/overview"> -->

    <title>Manager</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/overview.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Sidebar -->

    <?php include 'navigationbar.php' ?>
    <!-- Scripts -->

    <!-- Content -->
    <section id="main" class="main">

        <div class="success-msg"> </div>


        <div class="content">

            <!-- <nav class="sub-nav">
                <a href="" class="nav-link">Garment</a>
                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
            </nav> -->

            <div class="left-right">


                <main>
                    <!-- Navigation path -->
                    <div class="head-title">
                        <div class="left">
                            <ul class="breadcrumb">
                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <i class='bx bx-chevron-right'></i>
                                <li>
                                    <a href="#" class="active">Overview</a>
                                </li>

                            </ul>
                        </div>
                        <!-- <a href="" class="btn-download">
                            <i class='bx bxs-cloud-download'></i>
                            <span class="text">Download PDF</span>
                        </a> -->
                    </div>
    



                    <div class="insights">
                        <div class="orders card">
                            <i class='bx bxs-calendar-check'></i>
                            <div class="middle">
                                <div class="left">
                                    <h3>Total Customer Orders</h3>
                                    <?php $totalCustomerOrders = 0; ?>
                                    <?php if(!empty($data['customerOrder'])): ?>
                                        <?php foreach($data['customerOrder'] as $order): 
                                            
                                                $totalCustomerOrders++;
                                            
                                        endforeach; ?>
                                    <?php endif; ?>
                                    <h1><?php echo $totalCustomerOrders ?></h1>
                                </div>
                            </div>

                        </div>
                        <div class="sales card">
                            <i class='bx bxs-dollar-circle'></i>
                            <div class="middle">
                                <div class="left">
                                    <h3>Total Sales</h3>
                                    <?php $totalSales = 0; ?>
                                    <?php if(!empty($data['customerOrder'])): ?>

                                        <?php foreach ($data['customerOrder'] as $order): ?>
                                            <?php if($order->order_status == 'Delivered' || $order->order_status == 'Completed'): ?>
                                                <?php foreach ($data['material_sizes'] as $sizes): ?>
                                                
                                                        <?php $totalSales += ($order->unit_price * ($sizes->small + $sizes->large + $sizes->medium)) - ((100 - $order->discount)/100); ?>
                                            
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <h1><?php echo "Rs. " , $totalSales ?></h1>

                                </div>

                            </div>
          
                        </div>
                        <div class="sales card">
                            <i class='bx bxs-calendar-check'></i>
                            <div class="middle">
                                <div class="left">
                                    <h3>Total Requests</h3>
                                    <?php $totalCustomerQuotations = 0; ?>
                                    <?php if(!empty($data['customerOrder'])): ?>

                                        <?php foreach($data['customerOrder'] as $order): 
                                            
                                                $totalCustomerQuotations++;
                                            
                                        endforeach; ?>
                                    <?php endif; ?>

                                    <h1><?php echo $totalCustomerQuotations ?></h1>

                                </div>

                            </div>
        
                        </div>
                        <div class="orders card">
                            <i class='bx bxs-calendar-check'></i>
                            <div class="middle">
                                <div class="left">
                                    <h3>Total Garment Orders</h3>
                                    <?php $totalGarmentOrders = 0; ?>
                                    <?php if(!empty($data['garmentOrder'])): ?>

                                        <?php foreach($data['garmentOrder'] as $order): 
                                        
                                                $totalGarmentOrders++;
                                    
                                        endforeach; ?>
                                    <?php endif; ?>

                                    <h1><?php echo $totalGarmentOrders ?></h1>
                                </div>
                            </div>

                        </div>
                    </div>
                                </main>
                    </div>

                    <div class="left-right">
        
                    <main>


                    <div class="material">
                        <span>
                            <h2>Material Stock</h2>
                            <button class="edit-material-btn">
                                <i class="bx bx-edit"></i>
                            </button>
                        </span>
                        

                        <div class="add card">
                            <!-- <i class='bx bxs-calendar-check'></i> -->
                            <!-- <div class="middle"> -->
                                <div class="left">
                                    <i class='bx bxs-plus-circle'></i>
                                    <h3 style="width: 100%; ">Add a material</h3>
                                </div>
                               
                            <!-- </div> -->

                        </div>


                    </div>

                    <div class="printingType">
                        <span>
                            <h2>Printing Types</h2>
                            <button class="edit-printingType-btn">
                                <i class="bx bx-edit"></i>
                            </button>
                        </span>
                        

                        <div class="add card">
                            <!-- <i class='bx bxs-calendar-check'></i> -->
                            <!-- <div class="middle"> -->
                                <div class="left">
                                    <i class='bx bxs-plus-circle'></i>
                                    <h3 style="width: 100%;">Add a printing type</h3>
                                </div>
                               
                            <!-- </div> -->

                        </div>


                    </div>



                    <!--popup to add materials-->

                    <div id="add-material" class="popup-add">

                        <!-- Modal content -->
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <h2>Add a material</h2>
                            <form id="addMaterialForm" method="POST">
                                <label for="materialName">Material Name: <span class="error name"> </span></label><br>
                                <input type="text" id="materialName" name="material_type"><br>
                                <label for="materialQuantity">Quantity: <span class="error quantity"></span></label><br>
                                <input type="text" id="materialQuantity" name="quantity"><br>
                                <label for="materialPrice">Unit Price: <span class="error price"></span></label><br>
                                <input type="text" id="materialPrice" name="unit_price"><br><br>
                                <label for="ppm">Approximate products that can be made per 1Kg: <span class="error ppm"></span></label><br>
                                <input type="text" id="ppm" name="ppm"><br><br>
                                <input type="submit" class="btn-add" name="addMaterial" value="Add Material">
                            </form>
                        </div>

                    </div>

                    <script>
                        // ajax for adding materials
                        document.getElementById("addMaterialForm").addEventListener("submit", function (e) {
                            e.preventDefault();
                            var form = document.getElementById("addMaterialForm");
                            var noerrors = validateMaterial(form);
                            var formData = new FormData(form);
                            console.log(formData);
                            if(noerrors){
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "<?= ROOT ?>/manager/addMaterial", true);
                                xhr.onload = function () {
                                    if (this.status == 200) {
                                        // console.log(this.responseText);
                                        var response = JSON.parse(this.responseText);
                                        console.log('response'+response);
                                        if (response == false) {
                                            var successMsgElement = document.querySelector('.success-msg');
                                            successMsgElement.innerHTML = "Material added successfully";
                                            // successMsgElement.style.transition = 'all 1s ease-in-out';
                                            successMsgElement.style.display = 'block';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                        }else{
                                            var successMsgElement = document.querySelector('.success-msg');
                                            if(response == 'Material already exists'){
                                                successMsgElement.innerHTML = "Material already exists";
                                            }else{
                                                successMsgElement.innerHTML = "There was an error adding the material";
                                            }
                                            
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

                    <!-- Delete confirmation popup -->
                    <div id="deleteConfirmation-material" class="popup-delete">
                        <!-- Modal content -->
                        <div class="popup-content">
                            <h2>Are you sure you want to delete this?</h2>
                            <form id="deleteMaterialForm" method="POST">
                                <input type="hidden" id="materialId" name="stock_id">
                                <input type="submit" value="Yes, delete it" name="deleteMaterial">
                                <button type="button" id="cancelDelete" onclick="closeDelete()">No, cancel</button>
                            </form>
                        </div>
                    </div>

                    <script>
                        // ajax for deleting materials
                        document.getElementById("deleteMaterialForm").addEventListener("submit", function (e) {
                            e.preventDefault();
                            var form = document.getElementById("deleteMaterialForm");
                            var formData = new FormData(form);
                            console.log(formData);
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "<?= ROOT ?>/manager/deleteMaterial", true);
                            xhr.onload = function () {
                                if (this.status == 200) {
                                    console.log(this.responseText);
                                    var response = JSON.parse(this.responseText);
                                    console.log('response'+response);
                                    if (response == false) {
                                        var successMsgElement = document.querySelector('.success-msg');
                                        successMsgElement.innerHTML = "Material deleted successfully";
                                        // successMsgElement.style.transition = 'all 1s ease-in-out';
                                        successMsgElement.style.display = 'block';
                                        setTimeout(function() {
                                            successMsgElement.style.display = 'none';
                                            location.reload();
                                        }, 2000);
                                    }else{
                                        var successMsgElement = document.querySelector('.success-msg');
                                        successMsgElement.innerHTML = "There was an error deleting the material";
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
                        });
                    </script>

                    <!--popup to update materials-->

                    <div id="update-material" class="popup-update">

                        <!-- Modal content -->
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <h2>Update material</h2>
                            <form id="updateMaterialForm" method="POST">
                                <label for="materialName">Material Name: <span class="error name"> </span></label><br>
                                <input type="text" id="materialName" name="material_type"><br>
                                <label for="materialQuantity">Quantity: <span class="error quantity"></span></label><br>
                                <input type="text" id="materialQuantity" name="quantity"><br>
                                <label for="materialPrice">Unit Price: <span class="error price"></span></label><br>
                                <input type="text" id="materialPrice" name="unit_price"><br><br>
                                <label for="ppm">Approximate products that can be made per 1Kg: <span class="error ppm"></span></label><br>
                                <input type="text" id="ppm" name="ppm"><br><br>
                                <input type="hidden" id="materialId" name="stock_id">
                                <br>
                                <input type="submit" class="btn-add" name="updateMaterial" value="Update Material">
                            </form>
                        </div>
                    </div>

                    <script>
                        // ajax for updating materials
                        document.getElementById("updateMaterialForm").addEventListener("submit", function (e) {
                            e.preventDefault();
                            var form = document.getElementById("updateMaterialForm");
                            var noerrors = validateMaterial(form);
                            var formData = new FormData(form);
                            console.log(formData);
                            if(noerrors){
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "<?= ROOT ?>/manager/updateMaterial", true);
                                xhr.onload = function () {
                                    if (this.status == 200) {
                                        console.log(this.responseText);
                                        var response = JSON.parse(this.responseText);
                                        console.log('response'+response);
                                        if (response == false) {
                                            var successMsgElement = document.querySelector('.success-msg');
                                            successMsgElement.innerHTML = "Material updated successfully";
                                            // successMsgElement.style.transition = 'all 1s ease-in-out';
                                            successMsgElement.style.display = 'block';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                        }else{
                                            var successMsgElement = document.querySelector('.success-msg');
                                            successMsgElement.innerHTML = "There was an error updating the material";
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

                
                    
                    <!--popup to add materials-->

                    <div id="add-printingType" class="popup-add">

                        <!-- Modal content -->
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <h2>Add a printing type</h2>
                            <form id="addPrintingTypeForm" method="POST">
                                <label for="pType">Printing Type: <span class="error ptype"></span></label><br>
                                <input type="text" id="pType" name="printing_type"><br>
                                <label for="materialQuantity">Materials: <span class="error materials"></span></label><br>
                                <div class="materialBx">
                                    <?php foreach ($data['materialStock'] as $material): ?>
                                    <div class="checkbx">
                                        <input type="checkbox" id="<?php echo $material->material_type?>" name="PtypeMaterials[]" value="<?php echo $material->material_type . ',' . $material->stock_id?>">
                                        <label for="<?php echo $material->material_type?>"><?php echo $material->material_type?></label>
                                    </div>
                                <?php endforeach; ?>    
                                </div>
                                <br>
                                <label for="ptypePrice">Price Addition: <span class="error price"></span></label><br>
                                <input type="text" id="ptypePrice" name="price"><br><br>
    
                                <input type="submit" class="btn-add" name="addPrintingType" value="Add Printing Type">
                            </form>
                        </div>

                    </div>

                    <script>
                        // ajax for adding printing types
                        document.getElementById("addPrintingTypeForm").addEventListener("submit", function (e) {
                            e.preventDefault();
                            var form = document.getElementById("addPrintingTypeForm");
                            var noerrors = validatePrintingType(form);
                            var formData = new FormData(form);
                            // console.log(formData);
                            if(noerrors){
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "<?= ROOT ?>/manager/addPrintingType", true);
                                xhr.onload = function () {
                                    if (this.status == 200) {
                                        console.log(this.responseText);
                                        var response = JSON.parse(this.responseText);
                                        // console.log('response'+response);
                                        if (response == false) {
                                            // delay(100);
                                            
                                            
                                            var successMsgElement = document.querySelector('.success-msg');
                                            successMsgElement.innerHTML = "Printing type added successfully";
                                            successMsgElement.style.display = 'block';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                            
                                                

                                        }else{
                                            var successMsgElement = document.querySelector('.success-msg');
                                            if(response == 'Printing type already exists'){
                                                successMsgElement.innerHTML = "Printing type already exists";
                                            }else{
                                                successMsgElement.innerHTML = "There was an error adding the printing type";
                                            }
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

                        <!-- Delete confirmation popup -->
                    <div id="deleteConfirmation-ptype" class="popup-delete">
                        <!-- Modal content -->
                        <div class="popup-content">
                            <h2>Are you sure you want to delete this printing type?</h2>
                            <form id="deletePrintingTypeForm" method="POST">
                                <input type="hidden" id="ptypeId" name="ptype_id">
                                <input type="submit" value="Yes, delete it" name="deletePType">
                                <button type="button" id="cancelDelete" onclick="closeDelete()">No, cancel</button>
                            </form>
                        </div>
                    </div>

                    <script>
                            // ajax for deleting printing types
                            document.getElementById("deletePrintingTypeForm").addEventListener("submit", function (e) {
                            e.preventDefault();
                            var form = document.getElementById("deletePrintingTypeForm");
                            var formData = new FormData(form);
                            // console.log(formData);
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "<?= ROOT ?>/manager/deletePrintingType", true);
                            xhr.onload = function () {
                                if (this.status == 200) {
                                    console.log(this.responseText);
                                    var response = JSON.parse(this.responseText);
                                    // console.log('response'+response);
                                    if (response == false) {
                                        var successMsgElement = document.querySelector('.success-msg');
                                        successMsgElement.innerHTML = "Printing type deleted successfully";
                                        // successMsgElement.style.transition = 'all 1s ease-in-out';
                                        successMsgElement.style.display = 'block';
                                        setTimeout(function() {
                                            successMsgElement.style.display = 'none';
                                            location.reload();
                                        }, 2000);
                                    }else{
                                        var successMsgElement = document.querySelector('.success-msg');
                                        successMsgElement.innerHTML = "There was an error deleting the printing type";
                                        
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
                        });
                    </script>

                <!--popup to update printing types-->

                <div id="update-printingType" class="popup-update">

                    <!-- Modal content -->
                    <div class="popup-content">
                        <span class="close">&times;</span>
                        <h2>Update Printing Type</h2>
                        <form id="updatePrintingTypeForm" method="POST">
                            <label for="pType">Printing Type: <span class="error pType"> </span></label><br>
                            <input type="text" id="pType" name="printing_type"><br>
                            <label for="materialQuantity">Materials: <span class="error materials"></span></label><br>
                            <div class="materialBx">
                                <?php foreach ($data['materialStock'] as $material): ?>
                                <div class="checkbx">
                                    <input type="checkbox" id="<?php echo $material->material_type?>" name="PtypeMaterials[]" value="<?php echo $material->material_type . ',' . $material->stock_id?>">
                                    <label for="<?php echo $material->material_type?>"><?php echo $material->material_type?></label>
                                </div>
                            <?php endforeach; ?>    
                            </div>
                            <br>
                            <label for="ptypePrice">Price Addition: <span class="error price"></span></label><br>
                            <input type="text" id="materialPrice" name="price"><br><br>

                            <input type="hidden" id="ptypeId" name="ptype_id">
                            <br>
                            <input type="submit" class="btn-add" name="updatePrintingType" value="Update Printing Type">
                        </form>
                    </div>
                </div>

                <script>
                            // ajax for updating printing types
                        document.getElementById("updatePrintingTypeForm").addEventListener("submit", function (e) {
                            e.preventDefault();
                            var form = document.getElementById("updatePrintingTypeForm");
                            var noerrors = validatePrintingType(form);
                            var formData = new FormData(form);
                            console.log(noerrors);
                            if(noerrors){
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "<?= ROOT ?>/manager/updatePrintingType", true);
                                xhr.onload = function () {
                                    if (this.status == 200) {
                                        console.log(this.responseText);
                                        var response = JSON.parse(this.responseText);
                                        // console.log('response'+response);
                                        if (response == false) {
                                            var successMsgElement = document.querySelector('.success-msg');
                                            successMsgElement.innerHTML = "Printing type updated successfully";
                                            // successMsgElement.style.transition = 'all 1s ease-in-out';
                                            successMsgElement.style.display = 'block';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                        }else{
                                            var successMsgElement = document.querySelector('.success-msg');
                                            
                                            successMsgElement.innerHTML = "There was an error adding the printing type";
                                            
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



                    <div class="table-data">

                        <!-- left side container -->
                        <div class="order">
                            <div class="head">
                                <h3>Recent Customer Orders</h3>
                                <a class="view-all-btn" href="<?= ROOT ?> /manager/customerorders">View All</a>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Placed On</th>
                                        <th>Material</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($data['customerOrder'])): ?>
                                        <?php $i = 0; ?>
                                
                                            <?php foreach ($data['customerOrder'] as $order): ?>
                                                <?php if($i<3): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $order->order_id ?>
                                                        </td>
                                                        <td><?php echo $order->order_placed_on ?></td>   
                                                        <td>
                                                        <?php if(!empty($data['material_sizes'])): ?>

                                                            <?php foreach($data['material_sizes'] as $sizes):?>
                                                                <?php if($sizes->order_id == $order->order_id) :?>
                                                                    
                                                                    <?php echo $sizes->material_type ?><br>
                                                                <?php endif;?>
                                                            <?php endforeach;?> 
                                                        <?php endif; ?>   
                                                        </td>
                                                        <td class="status">
                                                            <i class='bx bxs-circle <?php echo $order->order_status ?>' style="font-size: 12px;"></i>
                                                            <div>
                                                                <?php echo $order->order_status ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>  
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                      
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- left side container -->

                        <!-- right side container -->



                        <!-- right side container -->
                    </div>

                    <div class="table-data">

                        <!-- left side container -->
                        <div class="order">
                            <div class="head">
                                <h3>Recent Garment Orders</h3>
                                <a class="view-all-btn" href="<?= ROOT ?> /manager/garmentorders">View All</a>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>CustomerOrder Id</th>
                                        <th>Placed On</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($data['garmentOrder'])): ?>
                                        <?php $i = 0; ?>
                                
                                            
                                        <?php foreach ($data['garmentOrder'] as $order): ?>
                                            <?php if($i<3): ?>
                                                
                                                <tr>
                                                    <td>
                                                        <?php echo $order->garment_order_id ?>
                                                    </td>
                                                    <td><?php echo $order->order_id ?></td>
                                                    <td><?php echo $order->placed_date ?></td>   
                                                    <td class="status">
                                                        <i class='bx bxs-circle <?php echo $order->status ?>' style="font-size: 12px;"></i>
                                                        <div>
                                                            <?php echo $order->status ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endif; ?>
                                        
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- left side container -->

                        <!-- right side container -->



                        <!-- right side container -->
                        </div>

                </main>

                <div class="right">
                  
                    <div class="calendar">
                        <div class="month">
                            <i class="fas fa-angle-left prev"></i>
                            <div class="date">february 2024</div>
                            <i class="fas fa-angle-right next"></i>
                        </div>
                        <div class="weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="days"></div>

                    </div>

                    <div class="display-orders">
                        <div class="today-date">
                            <div class="event-day"></div>
                            <div class="event-date"></div>
                        </div>
                        <div class="events"></div>

                    </div>

     
                </div>
                <!-- <div class="right">
                    <div class="today-date">
                    <div class="event-day">wed</div>
                    <div class="event-date">12th december 2022</div>
                    </div>
                    <div class="events"></div>
                    <div class="add-event-wrapper">
                    <div class="add-event-header">
                        <div class="title">Add Event</div>
                        <i class="fas fa-times close"></i>
                    </div>
                    <div class="add-event-body">
                        <div class="add-event-input">
                        <input type="text" placeholder="Event Name" class="event-name" />
                        </div>
                        <div class="add-event-input">
                        <input
                            type="text"
                            placeholder="Event Time From"
                            class="event-time-from"
                        />
                        </div>
                        <div class="add-event-input">
                        <input
                            type="text"
                            placeholder="Event Time To"
                            class="event-time-to"
                        />
                        </div>
                    </div>
                    <div class="add-event-footer">
                        <button class="add-event-btn">Add Event</button>
                    </div>
                    </div>
                </div> -->
                <!-- <button class="add-event">
                    <i class="fas fa-plus"></i>
                </button>
                </div> -->
              
            </div>

        </div>
    </section>
    <script>
        var customerOrders = <?php echo json_encode($data['customerOrder']) ?>;
        console.log(customerOrders);
    </script>
    <script src="<?= ROOT ?>/assets/js/manager/overview.js"></script>
    <script>
        // let editMaterial = document.querySelector(".edit-material-btn");

        function addMaterialCard(name, quantity, price, ppm, id) {
            var newCard = document.createElement("div");
            newCard.className = "orders card";

            
            newCard.innerHTML = `
                <button class="delete-material-btn" data-id="${id}" onclick="openDeleteMaterial(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <div class="middle">
                    <div class="left">
                        <h3>${name}</h3>
                        <h1>${quantity} Kg</h1>
                        <p>Rs. ${price} per Kg</p>

                    </div>
                    <button class="update-btn" data-name="${name}" data-quantity="${quantity}" data-price="${price}" data-id="${id}" data-ppm="${ppm}" onclick="openUpdateMaterial(this)">Update</button>
                </div>
            `;

        
            document.querySelector(".add.card").before(newCard);

            let deleteMaterial = newCard.querySelector(".delete-material-btn");
            let updateBtn = newCard.querySelector(".update-btn");

            editMaterial.addEventListener("click", function () {
                deleteMaterial.classList.toggle("open-delete-material-btn");
                updateBtn.classList.toggle("open-update-btn");
            });

            // updateBtn.onclick = function () {
            //     updateMaterial.style.display = "block";
            //     document.body.style.overflow = "hidden";
            // }

            // deleteMaterial.onclick = function () {
            //     document.getElementById("deleteConfirmation").style.display = "block";
            //     document.body.style.overflow = "hidden";

            // }
            
            // var deleteMaterialSuccess = <?php echo $data['deleteMaterial'] ?>;
            // console.log(deleteMaterialSuccess);
            // if(deleteMaterialSuccess){
            //     newCard.remove();
            // }

        }

        function addPrintingTypeCard(printingType, price, materialsJson, id) {
            var newCard = document.createElement("div");
            newCard.className = "orders card";

            newCard.innerHTML = `
                <button class="delete-printingType-btn" data-id="${id}" onclick="openDeletePrintingType(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <div class="middle">
                    <div class="left">
                        <h3>${printingType}</h3>
                        <p>Rs. ${price}</p>
                    </div>
                    <button class="update-btn" data-printingType="${printingType}" data-price="${price}" data-materials='${materialsJson}' data-id="${id}" onclick="openUpdatePrintingType(this)">Update</button>
                </div>
            `;

        
            document.querySelector(".printingType .add.card").before(newCard);

            let deletePrintingType = newCard.querySelector(".delete-printingType-btn");
            let updateBtn = newCard.querySelector(".update-btn");

            editPrintingType.addEventListener("click", function () {
                deletePrintingType.classList.toggle("open-delete-printingType-btn");
                updateBtn.classList.toggle("open-update-btn");
            });

            // updateBtn.onclick = function () {
            //     updateMaterial.style.display = "block";
            //     document.body.style.overflow = "hidden";
            // }

            // deleteMaterial.onclick = function () {
            //     document.getElementById("deleteConfirmation").style.display = "block";
            //     document.body.style.overflow = "hidden";

            // }
            
            var deletePTypeSuccess = <?php echo $data['deletePType'] ?>;
            console.log(deletePTypeSuccess);
            if(deletePTypeSuccess){
                newCard.remove();
            }

        }


        <?php foreach($data['materialStock'] as $material): ?>
            addMaterialCard('<?php echo $material->material_type ?>', '<?php echo $material->quantity ?>', '<?php echo $material->unit_price ?>','<?php echo $material->ppm ?>', '<?php echo $material->stock_id ?>');
        <?php endforeach; ?>

        <?php foreach($data['printingType'] as $printingType): ?>
            <?php $materialsJson = json_encode($data['materialPrintingType'][$printingType->ptype_id]); ?>
            addPrintingTypeCard('<?php echo $printingType->printing_type ?>', '<?php echo $printingType->price ?>', '<?php echo $materialsJson ?>' , '<?php echo $printingType->ptype_id ?>');
        <?php endforeach; ?>

    </script>



    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    
    
</body>

</html>