<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta http-equiv="refresh" content="2; url=<?= ROOT ?>/garment/overview"> -->

    <title>Merchandiser</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/merchandiser/overview.css">
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
                            <!-- <button class="edit-material-btn">
                                <i class="bx bx-edit"></i>
                            </button> -->
                        </span>
                        

                        <div class="add card">
                            <!-- <i class='bx bxs-calendar-check'></i> -->
                            <!-- <div class="middle"> -->
                                <!-- <div class="left">
                                    <i class='bx bxs-plus-circle'></i>
                                    <h3 style="width: 100%; ">Add a material</h3>
                                </div> -->
                               
                            <!-- </div> -->

                        </div>


                    </div>

                    <div class="printingType">
                        <span>
                            <h2>Printing Types</h2>
                            <!-- <button class="edit-printingType-btn">
                                <i class="bx bx-edit"></i>
                            </button> -->
                        </span>
                        

                        <div class="add card">
                            <!-- <i class='bx bxs-calendar-check'></i> -->
                            <!-- <div class="middle"> -->
                                <!-- <div class="left">
                                    <i class='bx bxs-plus-circle'></i>
                                    <h3 style="width: 100%;">Add a printing type</h3>
                                </div> -->
                               
                            <!-- </div> -->

                        </div>


                    </div>



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
                                xhr.open("POST", "<?= ROOT ?>/merchandiser/updateMaterial", true);
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

                
                    
                   
                    <div class="table-data">

                        <!-- left side container -->
                        <div class="order">
                            <div class="head">
                                <h3>Recent Customer Orders</h3>
                                <a class="view-all-btn" href="<?= ROOT ?> /merchandiser/customerorders">View All</a>
                            </div>
                            <table>
                                <?php if(!empty($data['customerOrder']) || !empty($data[' pendingOrders'])): ?>
                                    
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Placed On</th>
                                        <th>Material</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $i = 0; ?>
                                        <?php if(!empty($data['customerOrder'])): ?>
                                            <?php foreach ($data['customerOrder'] as $order): ?>
                                                <?php if($order->order_id !== null): ?>
                                                <?php if($i<3): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $order->order_id ?>
                                                        </td>
                                                        <td><?php echo $order->order_placed_on ?></td>   
                                                        <td>
                                                            <?php $material_types = array(); ?>
                                                            <?php foreach($data['material_sizes'] as $sizes):?>
                                                                <?php if($sizes->order_id == $order->order_id) :?>
                                                                    <?php $material[] = $sizes;?>
                                                                    <?php $material_types[] = $sizes->material_type; ?>
                                                                <?php endif;?>
                                                            <?php endforeach;?>
                                                            <?php $distinct_types = array_unique($material_types); ?>
                                                            <?php foreach($distinct_types as $type): ?>
                                                                <?php echo $type; ?><br>
                                                            <?php endforeach; ?> 
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
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <?php if(!empty($data['pendingOrders'])): ?>
                                            <?php foreach ($data['pendingOrders'] as $order): ?>

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
                                    <?php else: ?>
                                        <h3 style="text-align: center; color: grey;">No Customer Orders</h3>
                                    <?php endif; ?>
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
                                <a class="view-all-btn" href="<?= ROOT ?> /merchandiser/garmentorders">View All</a>
                            </div>
                            <table>
                                <?php if(!empty($data['garmentOrder'])): ?>
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>CustomerOrder Id</th>
                                        <th>Placed On</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                    </tbody>
                                <?php else: ?>
                                    <h3 style="text-align: center; color: grey;">No Garment Orders</h3>
                                <?php endif; ?>
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

                    <div class="collection-image">
                        <div class="collection-image-content">
                            <span class="add-to-collection">Add to Collection</span>
                            <img src="<?= ROOT ?>/assets/images/merchandiser/collection.jpg" class="collection-front-image">
                        </div>
                        <div class="image-uploader">
                            <form action="" method="POST">
                                <span class="new-item-collection">Upload a new Item to the collection</span>
                                <div class="upload-buttons">
                                    <input class="col-image" name="image_name" type="file" accept=".jpg">
                                    <div class="all-input-box" >
                                        <div class="input-box">
                                            <span class="details"> Material </span>
                                            <input type="text" name="material" id="" placeholder="Material">
                                        </div>
                                        <div class="input-box">
                                            <span class="details">Unit Price</span>
                                            <input type="text" name="price" id="" placeholder="Unit Price" >
                                        </div>

                                    </div>
                                    <button type="submit" name="newCollection" class="upload-button" >Submit</button>
                                </div>
                            </form>
                        </div>
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
        var empId = <?php echo $_SESSION['USER']->emp_id ?>;
        console.log(customerOrders);
        console.log(typeof empId);
    </script>
    <script src="<?= ROOT ?>/assets/js/merchandiser/overview.js"></script>
    <script>
        // let editMaterial = document.querySelector(".edit-material-btn");

        function addMaterialCard(name, quantity, price, ppm, id) {
            var newCard = document.createElement("div");
            newCard.className = "orders card";

            
            newCard.innerHTML = `
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
            console.log(materialsJson);
            var materials = JSON.parse(materialsJson);
            var materialList = "";
            materials.forEach(material => {
                materialList += material[0] + "<br>";
            });


            newCard.innerHTML = `

                <div class="middle">
                    <div class="left">
                        <h3>${printingType}</h3>
                        <p>Rs. ${price}</p>
                        <h5>Materials: ${materialList}</h5>

                    </div>
                </div>
            `;

        
            document.querySelector(".printingType .add.card").before(newCard);



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