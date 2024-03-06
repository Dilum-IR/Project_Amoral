<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manager</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/customer-orders.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    </head>

<body>
    <!-- Sidebar -->
    <?php include_once 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include_once 'navigationbar.php' ?>
    <!-- Scripts -->
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>

    <!-- content  -->
    <section id="main" class="main">

        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <i class='bx bx-chevron-right'></i>
            <li>
                <a href="#" class="active">Customer Orders</a>
            </li>

        </ul>

        <form>
            <div class="form">
                <form >
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
				<input class="new-btn" type="button" onclick="openNew()" value="+New Order">
			</div>

        </form>

        <div class="table">
            <!-- <div class="table-header">
                <p>Order Details</p>
                <div>
                    <input placeholder="order"/>
                    <button class="add_new">+ Add New</button>
                </div>
            </div> -->
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>User Id</th>
                            <th>Placed Date</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Dispatch Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['orders'] as $order): ?>
                        
                            <?php $material = array(); ?>
                        <tr>
                            <td class="ordId"><?php echo $order->order_id ?></td>
                            <td><?php echo $order->user_id ?></td>
                            <td><?php echo $order->order_placed_on ?></td>
                            <td>
                            <?php foreach($data['material_sizes'] as $sizes):?>
                                    <?php if($sizes->order_id == $order->order_id) :?>
                                        <?php $material[] = $sizes?>
                                    <?php echo $sizes->material_type ?><br>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>
                            <td class="desc">
                                <?php foreach($data['material_sizes'] as $sizes):?>
                                    <?php if($sizes->order_id == $order->order_id) :?>
                                        <?php echo $sizes->xs + $sizes->small + $sizes->medium + $sizes->large + $sizes->xl + $sizes->xxl ?> <br>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>
                            <td><?php echo $order->dispatch_date ?></td>
                            <td class="st">
                                <div class="text-status <?php echo $order->order_status?>"><?php echo $order->order_status ?></div>
                                <div class="progress-bar"></div>
                            </td>
                        
                            <td><button type="submit" name="selectItem" class="edit" data-order='<?= json_encode($order); ?>' data-material='<?= json_encode($material); ?>' data-customers='<?= json_encode($data['customers']) ?>' onclick="openView(this)" ><i class="fas fa-edit"></i> View</button></td>
                            <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                        </tr>

                        
                     
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>


    <!-- POPUP -->
               
    <div class="popup-view" id="popup-view">
        <!-- <button type="button" class="update-btn pb">Update Order</button> -->
        <!-- <button type="button" class="cancel-btn pb">Cancel Order</button> -->
        <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Order Details</h2>
        <div class="status">

            <ul>
                <li>
                    <iconify-icon
                        icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
                    <div class="progress one">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Pending</p>
                </li>

                <li>
                    <iconify-icon icon="tabler:cut"></iconify-icon>
                    <div class="progress two">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Cutting</p>
                </li>
                <li>
                    <iconify-icon icon="tabler:shirt-filled"></iconify-icon>
                    <div class="progress three">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Printing</p>
                </li>
                <li>
                    <iconify-icon icon="game-icons:sewing-string"></iconify-icon>
                    <div class="progress four">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Sewing</p>
                </li>

                <li>
                    <iconify-icon icon="tabler:truck-delivery"></iconify-icon>
                    <div class="progress five">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Delivery In Progress</p>
                </li>
                <li>
                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                    <div class="progress six">

                        <!-- <i class="uil uil-check"></i> -->
                    </div>
                    <p class="text">Delivered</p>
                </li>

            </ul>

        </div>

        
        <form class="update-form" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <embed name="design" type="application/pdf" style="display: block; width: 250px; height: 249px; margin-bottom:0.8rem; background-color:white; border-radius:10px;">

                    </div>
                    <div class="input-box">
                        <span class="details">Order ID </span>
                        <input name="order_id" type="text" required onChange="" readonly value="" />
                    </div>
                    <div class="input-box" style="height: 0;">

                    </div>
                    <div class="input-box placedDate">
                        <span class="details">Order Placed On</span>
                        <input name="order_placed_on" type="text" required onChange="" readonly value="" />
                    </div>

                    <input name="order_status" type="hidden" required onChange="" readonly value="" />

                </div>

                <div class="add card"></div>


                <hr class="second">
                
                <div class="radio-btns">
                    <input type="radio" id="pickup" name="deliveryOption" value="Pick Up">
                    <label for="pickup">Pick Up</label>

                    <input type="radio" id="delivery" name="deliveryOption" value="Delivery">
                    <label for="delivery">Delivery</label>
                </div>

                <div class="user-details pickup">
                    <div class="input-box">
                        <span class="details">Pick Up Date</span>
                    
                        <input type="date" name="dispatch_date_pickup" >
                    </div>
                </div>

                <script>
                    //toggle delivery options
                    let delivery = document.getElementById("delivery");
                    let pickUp = document.getElementById("pickup");


                    pickUp.addEventListener('click', togglePickUp);
                    delivery.addEventListener('click', toggleDelivery);



                    function togglePickUp(){
                        
                        document.querySelector(".user-details.pickup").classList.add("is-checked");
                        document.querySelector(".user-details.delivery").classList.remove("is-checked");
                        
                    }

                    function toggleDelivery(){
                        document.querySelector(".user-details.delivery").classList.add("is-checked");
                        document.querySelector(".user-details.pickup").classList.remove("is-checked");
                    }
                </script>                

                <div class="user-details delivery">

                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                    
                        <input type="date" name="dispatch_date_delivery" >
                    </div>
                    <div class="input-box">
                        <span class="details addr">City</span>
                    
                        <input name="city" type="text">

                        
                    </div>


                    <div class="input-box location">
                        <span class="details">Location</span>
                        <div id="map" style="height: 400px; width: 100%;"></div>
                    </div>

                    <!-- hidden element -->
                    <div class="input-box">
                        <input name="latitude" type="hidden"  />
                        <input name="longitude" type="hidden"  />
                    </div>
                
                    
                </div>

                <hr class="second">

                <div style="display: flex;text-align: center;flex-direction: column;padding: 5px;">
                    <h3>Customer Details</h3>
                </div>

                <div class="user-details customer">
                    <div class="input-box">
                        <span class="details">Customer ID</span>
                        <input name="id" type="text"  />
                    </div>
                    <div class="input-box">
                        <span class="details">Customer Name</span>
                        <input name="fullname" type="text"  />
                    </div>
                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input name="phone" type="text"  />
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input name="email" type="email"  />
                    </div>
                </div>

                <hr class="second">

                <div style="display: flex;text-align: center;flex-direction: column;padding: 5px;">
                    <h3>Payment Details</h3>
                </div>

                <div class="prices">
                    
                    <p style="text-align: right; margin: 10px 30px;"></p><br>
                    
                    <table class="price-details-container">
                        <tr>
                            <th>Material</th>
                            <th>Sleeve Type</th>
                            <th>Printing Type</th>
                            <th>Quantity</th>
                            <th>Unit Price(Rs.)</th>
                        </tr>

                        <tr class="discount">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Discount(%)</td>
                            <td><input type="number" name="discount" style="border: none;" class="discountPercentage" value=0 min="0" max="50"></td>
                        </tr>
    
                        <tr class="total">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td><input type="text" name="total_price" style="border: none;" class="totalPrice" value=""></td>

                        </tr>
                    </table>
                </div>

                

                <input type="button" class="update-btn pb"  value="Update Order" />
                <button type="button" class="cancel-btn pb">Cancel Order</button>

                <div class="cu-popup" role="alert">
                    <div class="cu-popup-container">
                        <p>Are you sure you want to update this order?</p>
                        <div class="cu-buttons">
                            <input type="submit" class="yes"  value="Yes" name="updateOrder"/>
                            <input type="button" class="no" value="No"/>
                        </div>
                        
                    </div> 
                </div> 
                
            </div>
        </form>
    </div>

        <!-- Pop up new -->
        <div class="popup-new">
        <div class="popup-content">
        <span class="close">&times;</span>
        <h2>New Order</h2>
        
        <form class="new-form" method="POST" enctype="multipart/form-data">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Customer ID </span>
                    <select name="id">
                        <option value="" selected hidden style="color: grey;">Select</option>
                        <?php foreach($data['customers'] as $customer): ?>
                            <option value="<?php echo $customer->id ?>"><?php echo $customer->id . '-' . $customer->fullname; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                </div>
            
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Material </span>
                        <select name="material[]">
                            <option value="" selected hidden style="color: grey;">Select</option>
                            <?php foreach($data['materials'] as $material):?>
                                <option value="<?php echo $material->stock_id?>"><?php echo $material->material_type ?></option>
                                <!-- <input type="hidden" name="material_id[]" value="<?php echo $material->stock_id?>"> -->
                            <?php endforeach;?>
                            
                        </select>
                        
                    </div>



                    <div class="input-box">
                        <span class="details">Sleeves</span>
                        <select name="sleeve[]">
                            <option value="" selected hidden style="color: grey;">Select</option>
                            <?php foreach($data['sleeveType'] as $sleeve):?>
                                <option value="<?php echo $sleeve->type?>"><?php echo $sleeve->type?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">Printing Type</span>
                        <select name="printingType[]">
                            
                        </select>
                    </div>

                    <div class="input-box sizes">
                        <span class="details">Sizes & Quantity <span class="error sizes0"></span></span>
                        <div class="sizeChart">
                            <div>
                                <span class="size">XS</span>
                                <input class="st" type="number" id="quantity" name="xs[]" min="0" value="0">
                            </div>
                            <div>
                                <span class="size">S</span>
                                <input class="st" type="number" id="quantity" name="small[]" min="0" value="0">
                            </div>
                            <div>
                                <span class="size">M</span>
                                <input class="st" type="number" id="quantity" name="medium[]" min="0" value="0">
                            </div>
                            <div>
                                <span class="size">L</span>
                                <input class="st" type="number" id="quantity" name="large[]" min="0" value="0">
                            </div>
                            <div>
                                <span class="size">XL</span>
                                <input class="st" type="number" id="quantity" name="xl[]" min="0" value="0">
                            </div>
                            <div>
                                <span class="size">2XL</span>
                                <input class="st" type="number" id="quantity" name="xxl[]" min="0" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="input-box design">
                        <span class="details">Design<span class="error files"></span></span>
                        <div class="radio-btns">
                            <input type="radio" id="pdf" name="fileType" value="PDF">
                            <label for="pdf">PDF</label>

                            <input type="radio" id="imagesUpload" name="fileType" value="Images">
                            <label for="imagesUpload">Images</label>
                        </div>
                        <input type="file" name="pdf" id="pdfFileToUpload" accept=".pdf" style="display: none;">
                        <button class="removeButton pdf" data-input-id="pdfFileToUpload">Remove</button><br>

                        <input type="file" name="image1" id="imageFileToUpload1" accept="image/*" style="display: none;">
                        <button class="removeButton img1" data-input-id="imageFileToUpload1">Remove</button><br>

                        <input type="file" name="image2" id="imageFileToUpload2" accept="image/*" style="display: none;">
                        <button class="removeButton img2" data-input-id="imageFileToUpload2">Remove</button><br>
                    </div>

                    <script>
                        //toggle upload options
                        let pdf = document.querySelector(".design #pdf");
                        let images = document.querySelector(".design #imagesUpload");
                        let pdfUpload = document.querySelector("#pdfFileToUpload");
                        let imagesUpload1 = document.querySelector("#imageFileToUpload1");
                        let imagesUpload2 = document.querySelector("#imageFileToUpload2");
                        let removePdfButton = document.querySelector(".removeButton.pdf");
                        let removeImg1Button = document.querySelector(".removeButton.img1");
                        let removeImg2Button = document.querySelector(".removeButton.img2");



                        pdf.addEventListener('click', function(){
                            pdfUpload.style.display = "block";
                            imagesUpload1.style.display = "none";
                            imagesUpload2.style.display = "none";
                            removeImg1Button.style.display = "none";
                            removeImg2Button.style.display = "none";
                            if(pdfUpload.files.length > 0) {
                                removePdfButton.style.display = "block";
                            } 

                        });

                        images.addEventListener('click', function(){
                            imagesUpload1.style.display = "block";
                            imagesUpload2.style.display = "block";
                            pdfUpload.style.display = "none";
                            removePdfButton.style.display = "none";
                            if(imagesUpload1.files.length > 0) {
                                removeImg1Button.style.display = "block";
                            } 
                            if(imagesUpload2.files.length > 0) {
                                removeImg2Button.style.display = "block";
                            } 
                        });

                        pdfUpload.addEventListener('change', function(){
                            if(pdfUpload.files.length > 0) {
                                removePdfButton.style.display = "block";
                                imagesUpload1.value = '';
                                imagesUpload2.value = '';
                            } 
                        });

                        imagesUpload1.addEventListener('change', function(){
                            if(imagesUpload1.files.length > 0) {
                                removeImg1Button.style.display = "block";
                                pdfUpload.value = '';
                            } 
                        });

                        imagesUpload2.addEventListener('change', function(){
                            if(imagesUpload2.files.length > 0) {
                                removeImg2Button.style.display = "block";
                                pdfUpload.value = '';
                            } 
                        });

                        removePdfButton.addEventListener('click', function(event){
                            event.preventDefault();
                            clearInputAndHideButton(pdfUpload, removePdfButton);
                        });

                        removeImg1Button.addEventListener('click', function(event){
                            event.preventDefault();
                            clearInputAndHideButton(imagesUpload1, removeImg1Button);
                        });

                        removeImg2Button.addEventListener('click', function(event){
                            event.preventDefault();
                            clearInputAndHideButton(imagesUpload2, removeImg2Button);
                        });

                        function clearInputAndHideButton(input, button) {
                            input.value = '';
                            button.style.display = "none";
                        }
                    </script>

                </div>
                <hr class="first">

                <h4 style="font-weight: 100; margin: 10px; color: red;">with different materials</h4>

                <div class="add card">
     
                    <div class="left">
                        <i class='bx bxs-plus-circle'></i>
                        <h4>Add a material</h4>
                    </div>
                    
                </div>

                <img src="<?php echo ROOT ?>/assets/images/customer/sizeChart.jpg" width="80%" style="margin: 7%;">

                <hr>
                <div class="radio-btns">
                    <input type="radio" id="pickupN" name="deliveryOption" value="Pick Up">
                    <label for="pickup">Pick Up</label>

                    <input type="radio" id="deliveryN" name="deliveryOption" value="Delivery">
                    <label for="delivery">Delivery</label>
                    <span class="error delivery"></span>
                </div>

                <div class="user-details pickupN">
                    <div class="input-box">
                        <span class="details">Pick Up Date</span>
                    
                        <input type="date" name="dispatch_date_pickup">
                    </div>
                </div>

                <div class="user-details deliveryN">
                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                    
                        <input type="date" name="dispatch_date_delivery">
                    </div>

                    <div class="input-box location">
                        <span class="details"> Delivery Location</span>
                        <div id="map" style="height: 300px; width: 100%;"></div>
                    </div>

                    <div class="input-box city">
                        <span class="details addr">City</span>
                    
                        <input type="text" name="city">

                    </div>


                </div>

                <hr class="second">

                <div class="prices">
                    
                    <p style="text-align: right; margin: 10px 30px;"></p><br>
                    
                    <table class="price-details-container">
                        <tr>
                            <th>Material</th>
                            <th>Sleeve Type</th>
                            <th>Printing Type</th>
                            <th>Quantity</th>
                            <th>Unit Price(Rs.)</th>
                        </tr>
                        <tr class="units">
                            <td class="materialType"></td>
                            <td class="sleeveType"></td>
                            <td class="printingType"></td>
                            <td class="quantityAll">0</td>
                            <td class="unitPrice">0</td>

                            <input type="hidden" name="unit_price[]">   
                            
                        </tr>
                        <tr class="total">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td class="totalPrice">0</td>
                    </table>
                </div>

                <input type="hidden" name="total_price" />
                
                    
                    <!-- <p>You will be notified about possible discounts later</p> -->
                    
                

                <script>
                    //add price data dynamically in new order popup
                    let material = document.querySelector(".popup-new .user-details select[name='material[]']");
                    let sleeve = document.querySelector(".popup-new .user-details select[name='sleeve[]']");
                    let printingType = document.querySelector(".popup-new .user-details select[name='printingType[]']");
                    let quantity = document.querySelector(".popup-new .sizes");
                    // let addMaterial = document.querySelector(".add.card");
                    let data = document.querySelector(".popup-new .price-details-container");
                    let materialPrice = 0, sleevePrice = 0, printingTypePrice = 0;

                    let sizesArr = ['xs', 'small', 'medium', 'large', 'xl', 'xxl'];
                    let quantityAll = document.querySelector(".quantityAll");

                    let total = 0;
                    sizesArr.forEach(function(size){
                        let input = document.querySelector(`input[name='${size}[]']`);
                        input.addEventListener('change', function(){
                            total = 0;
                            sizesArr.forEach(function(size){
                                total += parseInt(document.querySelector(`input[name='${size}[]']`).value);
                            });
                            quantityAll.innerHTML = total;
                            generateTotalPrice();
                        });
                    });


                    console.log(total);
                    
                    let allMaterials = <?php echo json_encode($data['material_prices']) ?>;
                    let allSleeves = <?php echo json_encode($data['sleeveType']) ?>;
                    let allPrintingTypes = <?php echo json_encode($data['material_printingType']) ?>;
                    console.log(allMaterials);

                    function updatePrice(doc, materialPrice, sleevePrice, printingTypePrice){
                        let unitPrice = parseInt(materialPrice) + parseInt(sleevePrice) + parseInt(printingTypePrice);
                        doc.querySelector(".unitPrice").innerHTML = unitPrice;                    

                        doc.querySelector("input[name='unit_price[]']").value = unitPrice;
                        console.log("efdsf"+doc.querySelector("input[name='unit_price[]']").value);
                        generateTotalPrice();
                        // document.querySelector(".totalPrice").innerHTML = currentTotal + (unitPrice * total);
                    }

                    function generateTotalPrice(){
                        let total = 0;
                        document.querySelectorAll(".units").forEach(function(unit){
                            total += parseInt(unit.querySelector(".unitPrice").innerHTML) * parseInt(unit.querySelector(".quantityAll").innerHTML);
                        });
                        document.querySelector(".popup-new .totalPrice").innerHTML = total;

                        document.querySelector(".popup-new input[name='total_price']").value = total;
                        console.log("tot"+document.querySelector(".popup-new input[name='total_price']").value);
                    }

                    material.addEventListener('change', function(){
                        
                        let materialId = material.value;
                        let materialType = material.options[material.selectedIndex].text;
                        let noOptions = true;
                        let printingTypeOptions = '<option value="" selected hidden style="color: grey;">Select</option>';
                        let materialPrintingType = <?php echo json_encode($data['material_printingType']) ?>;
                        materialPrintingType.forEach(function(item){
                            if(item.stock_id == materialId) {
                                printingTypeOptions += `<option value="${item.printing_type}">${item.printing_type}</option>`;
                                noOptions = false;
                            }
                        });
                        if(noOptions) {
                            printingTypeOptions = '<option value="" selected hidden style="color: grey;">No options available</option>';
                        }
                        
                        printingType.innerHTML = printingTypeOptions;
                        console.log(printingType);

                        console.log(material.value);
                        allMaterials.forEach(function(item){
                            if(item.stock_id == material.value) {
                                data.querySelector(".materialType").innerHTML = item.material_type;
                                materialPrice = item.unit_price;
                            }
                        });

                        updatePrice(document, materialPrice, sleevePrice, printingTypePrice);
                    });

                    sleeve.addEventListener('change', function(){
                        console.log(sleeve.value);
                        allSleeves.forEach(function(item){
                            if(item.type == sleeve.value) {
                                data.querySelector(".sleeveType").innerHTML = item.type;
                                sleevePrice = item.price;
                            }
                        });

                        updatePrice(document, materialPrice, sleevePrice, printingTypePrice);
                    });

                    printingType.addEventListener('change', function(){
                        console.log(printingType.value);
                        allPrintingTypes.forEach(function(item){
                            if(item.printing_type == printingType.value) {
                                data.querySelector(".printingType").innerHTML = item.printing_type;
                                printingTypePrice = item.price;
                            }
                        });

                        updatePrice(document, materialPrice, sleevePrice, printingTypePrice);
                    });



                    //add price data dynamically in new order popup
                    let qunatityView = document.querySelector(".popup-view .sizes");

                    


                        

                </script>

                <script>
 
                    //toggle delivery options of new order
                    let deliveryN = document.getElementById("deliveryN");
                    let pickUpN = document.getElementById("pickupN");


                    pickUpN.addEventListener('click', togglePickUpN);
                    deliveryN.addEventListener('click', toggleDeliveryN);

                    function togglePickUpN(){
                        
                        document.querySelector(".user-details.pickupN").classList.add("is-checked");
                        document.querySelector(".user-details.deliveryN").classList.remove("is-checked");
                        
                    }

                    function toggleDeliveryN(){
                        document.querySelector(".user-details.deliveryN").classList.add("is-checked");
                        document.querySelector(".user-details.pickupN").classList.remove("is-checked");
                    }
                </script>

                <script>

                    //add new order for different parameters(material, sleeve, printing type, quantity) in the same order
                        let addMaterial = document.querySelector(".popup-new .add.card");
                        let count = 0;
                        function addMaterialCard() {
                            var newCard = document.createElement("div");
                            newCard.className = "user-details";

                            
                            newCard.innerHTML = `
                            <i class="fas fa-minus remove"></i>
                            
                                <div class="input-box">
                                    <span class="details">Material </span>
                                    <select name="material[]">
                                        <option value="" selected hidden style="color: grey;">Select</option>
                                        <?php foreach($data['materials'] as $material):?>
                                            <option value="<?php echo $material->stock_id?>"><?php echo $material->material_type ?></option>
                                            <!-- <input type="hidden" name="material_id[]" value="<?php echo $material->stock_id?>"> -->
                                        <?php endforeach;?>
                                        
                                    </select>
                                    
                                </div>



                                <div class="input-box">
                                    <span class="details">Sleeves</span>
                                    <select name="sleeve[]">
                                        <option value="" selected hidden style="color: grey;">Select</option>
                                        <?php foreach($data['sleeveType'] as $sleeve):?>
                                            <option value="<?php echo $sleeve->type?>"><?php echo $sleeve->type?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="input-box" style="margin-left: 30px;">
                                    <span class="details">Printing Type</span>
                                    <select name="printingType[]">
                                        
                                    </select>
                                </div>

                                <div class="input-box sizes">
                                    <span class="details">Sizes & Quantity</span>
                                    <div class="sizeChart">
                                        <span class="size">XS</span>
                                        <input class="st" type="number" id="quantity" name="xs[]" min="0" value="0">
                                        <br>
                                        <span class="size">S</span>
                                        <input class="st" type="number" id="quantity" name="small[]" min="0" value="0">
                                        <br>
                                        <span class="size">M</span>
                                        <input class="st" type="number" id="quantity" name="medium[]" min="0" value="0">
                                        <br>
                                        <span class="size">L</span>
                                        <input class="st" type="number" id="quantity" name="large[]" min="0" value="0">
                                        <br>
                                        <span class="size">XL</span>
                                        <input class="st" type="number" id="quantity" name="xl[]" min="0" value="0">
                                        <br>
                                        <span class="size">2XL</span>
                                        <input class="st" type="number" id="quantity" name="xxl[]" min="0" value="0">
                                        <br>
                                    </div>
                                </div>
                            `;

                            newCard.style.transition = "all 0.5s ease-in-out";
                            addMaterial.before(newCard);
                            
                            //add new price row for the new material
                            let newPriceRow = document.createElement("tr");
                            newPriceRow.className = "units";
                           
                            newPriceRow.innerHTML = `
                                <td class="materialType"></td>
                                <td class="sleeveType"></td>
                                <td class="printingType"></td>
                                <td class="quantityAll">0</td>
                                <td class="unitPrice">0</td>

                                <input type="hidden" name="unit_price[]">   

                            `;

                            document.querySelector(".popup-new .price-details-container .total").before(newPriceRow);

                            let sizeArr = ['xs', 'small', 'medium', 'large', 'xl', 'xxl'];

                            sizeArr.forEach(function(size){
                                let input = newCard.querySelector(`input[name='${size}[]']`);
                                input.addEventListener('change', function(){
                                    let total = 0;
                                    sizeArr.forEach(function(size){
                                        total += parseInt(newCard.querySelector(`input[name='${size}[]']`).value);
                                    });
                                    newPriceRow.querySelector(".quantityAll").innerHTML = total;
                                    generateTotalPrice();
                                });
                            });

                            let material1 = newCard.querySelector("select[name='material[]']");
                            let sleeve1 = newCard.querySelector("select[name='sleeve[]']");
                            let printingType1 = newCard.querySelector("select[name='printingType[]']");
                            let quantity1 = newCard.querySelector(".sizes");
                            let data1 = newPriceRow;
                            let materialPrice1 = 0, sleevePrice1 = 0, printingTypePrice1 = 0;

                            material1.addEventListener('change', function(){
                                let materialId = material1.value;
                                let materialType = material1.options[material1.selectedIndex].text;
                                let noOptions = true;
                                let printingTypeOptions = '<option value="" selected hidden style="color: grey;">Select</option>';
                                let materialPrintingType = <?php echo json_encode($data['material_printingType']) ?>;
                                materialPrintingType.forEach(function(item){
                                    if(item.stock_id == materialId) {
                                        printingTypeOptions += `<option value="${item.printing_type}">${item.printing_type}</option>`;
                                        noOptions = false;
                                    }
                                });
                                if(noOptions) {
                                    printingTypeOptions = '<option value="" selected hidden style="color: grey;">No options available</option>';
                                }
                                
                                printingType1.innerHTML = printingTypeOptions;
                                console.log(printingType1);


                                allMaterials.forEach(function(item){
                                    if(item.stock_id == material1.value) {
                                        data1.querySelector(".materialType").innerHTML = item.material_type;
                                        materialPrice1 = item.unit_price;
                                    }
                                });

                                updatePrice(data1, materialPrice1, sleevePrice1, printingTypePrice1);
                            });

                            sleeve1.addEventListener('change', function(){
                                allSleeves.forEach(function(item){
                                    if(item.type == sleeve1.value) {
                                        data1.querySelector(".sleeveType").innerHTML = item.type;
                                        sleevePrice1 = item.price;
                                    }
                                });

                                updatePrice(data1, materialPrice1, sleevePrice1, printingTypePrice1);
                            });

                            printingType1.addEventListener('change', function(){
                                allPrintingTypes.forEach(function(item){
                                    if(item.printing_type == printingType1.value) {
                                        data1.querySelector(".printingType").innerHTML = item.printing_type;
                                        printingTypePrice1 = item.price;
                                    }
                                });

                                updatePrice(data1, materialPrice1, sleevePrice1, printingTypePrice1);
                            });

                            

                            //remove the card and the price row
                            let removeCard = newCard.querySelector("i");
                            removeCard.addEventListener('click', function(){
                                newCard.remove();
                                newPriceRow.remove();
                                count--;
                            });

                            // let material = newCard.querySelector("select[name='material[]']");
                            // let printingType = newCard.querySelector("select[name='printingType[]']");
                            // console.log(material);
                            // console.log(printingType);

                        
                            
                            // material1.addEventListener('change', function(){
                            //     let materialId = material.value;
                            //     let materialType = material.options[material.selectedIndex].text;
                            //     let noOptions = true;
                            //     let printingTypeOptions = '<option value="" selected hidden style="color: grey;">Select</option>';
                            //     let materialPrintingType = <?php echo json_encode($data['material_printingType']) ?>;
                            //     materialPrintingType.forEach(function(item){
                            //         if(item.stock_id == materialId) {
                            //             printingTypeOptions += `<option value="${item.printing_type}">${item.printing_type}</option>`;
                            //             noOptions = false;
                            //         }
                            //     });
                            //     if(noOptions) {
                            //         printingTypeOptions = '<option value="" selected hidden style="color: grey;">No options available</option>';
                            //     }
                                
                            //     printingType.innerHTML = printingTypeOptions;
                            //     console.log(printingType);
                            // });

                        }

                        //restrict the no of additional orders that can be made inside the same order
                        var materialCount = <?php echo count($data['materials'])*count($data['printingType'])*count($data['sleeveType'])-1 ?>;
                        console.log(materialCount);
                        addMaterial.addEventListener('click', function(){
                            if(count < materialCount-1) {
                                addMaterialCard();
                                count++;
                            }
                            else{
                                alert("You can only add " + materialCount + " materials");
                            }
                        });


                      



                    </script>



                <input name="latitude" type="hidden" required />
                <input name="longitude" type="hidden" required />

              
                <button type="submit" class="close-btn pb" name="newOrder">Submit</button>
                <button type="button" class="cancel-btn pb" onclick="closeNew()">Cancel</button>
             




            </form>
        </div>
    </div> 


    <script>
            // clear the other option when one is selected in the delivery options
            document.querySelectorAll("input[name='dispatch_date_pickup']").forEach(pickupDate => {
                pickupDate.addEventListener('change', function(){
                    document.querySelectorAll("input[name='dispatch_date_delivery']").forEach(deliveryDate =>{
                        deliveryDate.value = "";
                    });

                });
            });

            document.querySelectorAll("input[name='dispatch_date_delivery']").forEach(deliveryDate => {
                deliveryDate.addEventListener('change', function(){
                    document.querySelectorAll("input[name='dispatch_date_pickup']").forEach(pickupDate =>{
                        pickupDate.value = "";
                    });

                });
            });
    </script>



    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfuuowb7aC4EO89QtfL2NQU0YO5q17b5Y&callback=initMap"></script>

    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/manager/customer-orders.js"></script>
</body>

</html>