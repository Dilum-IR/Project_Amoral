<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta http-equiv="refresh" content="2; url=<?= ROOT ?>/garment/overview"> -->

    <title>Amoral</title>
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
                    <!-- Navigation path -->

                    <!-- Anlysis Containers -->
                    <!-- <ul class="box-info">
                    <li>
                        <i class='bx bxs-calendar-check'></i>
                        <span class="text">
                            <h3>1020</h3>
                            <p>New Order</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-group'></i>
                        <span class="text">
                            <span class="data-precentage">

                                <h3>2834</h3>
                               
                                <i class='bx bxs-down-arrow'></i>
                            </span>
                            <p>Pending</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-dollar-circle'></i>
                        <span class="text">
                            <h3>$2543</h3>
                            <p>Total Sales</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-dollar-circle'></i>
                        <span class="text">
                            <h3>$2543</h3>
                            <p>Total Sales</p>
                        </span>
                    </li>
              </ul> -->



                    <div class="insights">
                        <div class="orders card">
                            <i class='bx bxs-calendar-check'></i>
                            <div class="middle">
                                <div class="left">
                                    <h3>Total Customer Orders</h3>
                                    <?php $totalCustomerOrders = 0; ?>
                                    <?php foreach($data['customerOrder'] as $order): 
                                        if(!$order->is_quotation):
                                            $totalCustomerOrders++;
                                        endif;
                                    endforeach; ?>
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
                                    <?php foreach ($data['customerOrder'] as $order): ?>
                                    <?php if(!$order->is_quotation): ?>
                                        <?php foreach ($data['material_sizes'] as $sizes): ?>
                                          
                                                <?php $totalSales += ($order->unit_price * ($sizes->small + $sizes->large + $sizes->medium)) - ((100 - $order->discount)/100); ?>
                                       
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
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
                                    <?php foreach($data['customerOrder'] as $order): 
                                        if($order->is_quotation):
                                            $totalCustomerQuotations++;
                                        endif;
                                    endforeach; ?>
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
                                    <?php foreach($data['garmentOrder'] as $order): 
                                     
                                            $totalGarmentOrders++;
                                   
                                    endforeach; ?>
                                    <h1><?php echo $totalGarmentOrders ?></h1>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="material">
                        <span>
                            <h2>Material Stock</h2>
                            <button class="edit-material-btn">
                                <i class="bx bx-edit"></i>
                            </button>
                        </span>
                        

                        <div class="add card">
                            <!-- <i class='bx bxs-calendar-check'></i> -->
                            <div class="middle">
                                <div class="left">
                                    <i class='bx bxs-plus-circle'></i>
                                    <h3 style="margin-left: 42%; width: 100%; ">Add a material</h3>
                                </div>
                               
                            </div>

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
                                <input type="submit" class="btn-add" name="addMaterial" value="Add Material">
                            </form>
                        </div>

                    </div>

                    <!-- Delete confirmation popup -->
                    <div id="deleteConfirmation" class="popup-delete">
                        <!-- Modal content -->
                        <div class="popup-content">
                            <h2>Are you sure you want to delete this material?</h2>
                            <form id="deleteMaterialForm" method="POST">
                                <input type="hidden" id="materialId" name="stock_id">
                                <input type="submit" value="Yes, delete it" name="deleteMaterial">
                                <button type="button" id="cancelDelete" onclick="closeDelete()">No, cancel</button>
                            </form>
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
                                <input type="hidden" id="materialId" name="stock_id">
                                <br>
                                <input type="submit" class="btn-add" name="updateMaterial" value="Update Material">
                            </form>
                        </div>
                    </div>

                    <!-- Anlysis Containers -->



                    <div class="table-data">

                        <!-- left side container -->
                        <div class="order">
                            <div class="head">
                                <h3>Recent Customer Orders</h3>
                                <button class="view-all-btn">View All</button>
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
                                    <?php foreach ($data['customerOrder'] as $order): ?>
                                    <?php if(!$order->is_quotation): ?>
                                    <tr>
                                        <td>
                                            <?php echo $order->order_id ?>
                                        </td>
                                        <td><?php echo $order->order_placed_on ?></td>   
                                        <td>
                                        <?php foreach($data['material_sizes'] as $sizes):?>
                                            <?php if($sizes->order_id == $order->order_id) :?>
                                               
                                                <?php echo $sizes->material_type ?><br>
                                            <?php endif;?>
                                        <?php endforeach;?>    
                                        </td>
                                        <td class="status">
                                            <i class='bx bxs-circle <?php echo $order->order_status ?>' style="font-size: 12px;"></i>
                                            <div>
                                                <?php echo $order->order_status ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
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
                                <button class="view-all-btn">View All</button>
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
                                    <?php foreach ($data['garmentOrder'] as $order): ?>
                                   
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
                                    
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- left side container -->

                        <!-- right side container -->



                        <!-- right side container -->
                        </div>

                </main>

                <div class="right">
                    <div class="chat">
                        <div class="chat-title">
                            <h3>Chat With Company</h3>
                        </div>
                        <div class="chat-container">
                            <!-- update -->

                            <div class="chat-box" id="chat-box"></div>
                            <input type="text" id="message-input" placeholder="Type a message...">
                            <button onclick="sendMessage()">Send</button>

                            <!-- <div class="profile-photo">


                            </div>
                            <div class="message-box">
                                message
                                <p><b>Mike John</b>
                                    asbggsdzjgsdgsdsdxgfchvjbkawdsfegd
                                </p>
                                <small class="text-muted">
                                    2 Minutes ago
                                </small> -->

                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </section>
    <script src="<?= ROOT ?>/assets/js/manager/overview.js"></script>
    <script>
        // let editMaterial = document.querySelector(".edit-material-btn");

        function addMaterialCard(name, quantity, price, id) {
            var newCard = document.createElement("div");
            newCard.className = "orders card";

            
            newCard.innerHTML = `
                <button class="delete-material-btn" data-id="${id}" onclick="openDelete(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <div class="middle">
                    <div class="left">
                        <h3>${name}</h3>
                        <h1>${quantity} Kg</h1>
                        <p>Rs. ${price} per Kg</p>
                    </div>
                    <button class="update-btn" data-name="${name}" data-quantity="${quantity}" data-price="${price}" data-id="${id}" onclick="openUpdate(this)">Update</button>
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
            
            var deleteMaterialSuccess = <?php echo $data['deleteMaterial'] ?>;
            console.log(deleteMaterialSuccess);
            if(deleteMaterialSuccess){
                newCard.remove();
            }

        }


        <?php foreach($data['materialStock'] as $material): ?>
            addMaterialCard('<?php echo $material->material_type ?>', '<?php echo $material->quantity ?>', '<?php echo $material->unit_price ?>', '<?php echo $material->stock_id ?>');
        <?php endforeach; ?>

    </script>

    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    
    
</body>

</html>