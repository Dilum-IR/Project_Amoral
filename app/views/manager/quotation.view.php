<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manager</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/quotations.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    

    </head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
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
                <a href="#" class="active">Customer Quotations</a>
            </li>

        </ul>

        <form>
            <div class="form">
                <form>
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

        <div class="table req">
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
                            <th>Placed On</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Status</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['quotation'] as $order): ?>
                        <?php if($order->is_quotation): ?>
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
                                        <?php echo $sizes->xs + $sizes->small + $sizes->medium + $sizes->large + $sizes->xl + $sizes->xxl ?> 
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>

                            <td><button type="submit" name="selectItem" class="edit" data-order='<?= json_encode($order); ?>' data-material='<?= json_encode($material); ?>' onclick="openView(this)"><i class="fas fa-edit"></i> View </button>
                            <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                        </tr>
                        
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <i class='bx bx-chevron-right'></i>
            <li>
                <a href="#" class="active">Quotation Replys</a>
            </li>

        </ul>

        <div class="table replies">
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
                            <th>Placed On</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Status</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['quotation_reply'] as $order): ?>
                    
                        <tr>
                            <td class="ordId"><?php echo $order->order_id ?></td>
                            <td><?php echo $order->user_id ?></td>
                            <td><?php echo $order->order_placed_on ?></td>   
                            <td>
                            <?php foreach($data['material_sizes'] as $sizes):?>
                                    <?php if($sizes->order_id == $order->order_id) :?>
                                        <?php $material_reply[] = $sizes?>
                                    <?php echo $sizes->material_type ?><br>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>
                            <td class="desc">
                                <?php foreach($data['material_sizes'] as $sizes):?>
                                    <?php if($sizes->order_id == $order->order_id) :?>
                                        <?php echo $sizes->xs + $sizes->small + $sizes->medium + $sizes->large + $sizes->xl + $sizes->xxl ?> 
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>
                            <td><button type="submit" name="selectItem" class="edit" data-reply-order='<?= json_encode($order); ?>' data-reply-material='<?= json_encode($material_reply); ?>' onclick="openViewReply(this)"><i class="fas fa-edit"></i> View </button>
                            <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                        </tr>
                        
               
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>


    <!-- POPUP -->

    <div class="popup-new">
        <div class="popup-content">
        <span class="close">&times;</span>
        <h2>New Quotation Request</h2>
        
        <form class="new-form" method="POST" enctype="multipart/form-data">
            
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Material </span>
                        <select name="material[]">
                            <?php foreach($data['materials'] as $material):?>
                                <option value="<?php echo $material->material_type?>"><?php echo $material->material_type?></option>
                            <?php endforeach;?>
                            
                            <?php foreach($data['materials'] as $material):?>
                                <input type="hidden" name="material_id[]" value="<?php echo $material->stock_id?>">
                            <?php endforeach;?>
                            
                        </select>
                        
                    </div>

                    <div class="input-box sizes">
                        <span class="details">Sizes & Quantity <span class="error sizes0"></span></span>
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

                    <div class="input-box design">
                        <span class="details">Design<span class="error files"></span></span>
                        <div class="radio-btns">
                            <input type="radio" id="pdf" name="uploadOption" value="PDF">
                            <label for="pickup">PDF</label>

                            <input type="radio" id="imagesUpload" name="uploadOption" value="Images">
                            <label for="delivery">Images</label>
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
                    <input type="radio" id="pickup" name="deliveryOption" value="Pick Up">
                    <label for="pickup">Pick Up</label>

                    <input type="radio" id="delivery" name="deliveryOption" value="Delivery">
                    <label for="delivery">Delivery</label>
                    <span class="error delivery"></span>
                </div>

                <div class="user-details pickup">
                    <div class="input-box">
                        <span class="details">Pick Up Date</span>
                    
                        <input type="date" name="dispatch_date_pickup">
                    </div>
                </div>

                <div class="user-details delivery">
                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                    
                        <input type="date" name="dispatch_date_delivery">
                    </div>

                    <div class="input-box location">
                        <span class="details"> Delivery Location</span>
                        <div id="map" style="height: 300px; width: 100%;"></div>
                    </div>

                    <div class="input-box">
                        <span class="details addr">District</span>
                    
                        <select name="city">

                        </select>
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
                        document.getElementByName("dispatch_date_delivery").value = "";
                        
                    }

                    function toggleDelivery(){
                        document.querySelector(".user-details.delivery").classList.add("is-checked");
                        document.querySelector(".user-details.pickup").classList.remove("is-checked");
                        document.getElementByName("dispatch_date_pickup").value = "";
                    }
                </script>

                <script>
                        let addMaterial = document.querySelector(".add.card");
                        let count = 0;
                        function addMaterialCard() {
                            var newCard = document.createElement("div");
                            newCard.className = "user-details";

                            
                            newCard.innerHTML = `
                            <i class="fas fa-minus remove"></i>
                                <div class="input-box">
                                    <span class="details">Material </span>
                                    <select name="material[]">
                                        <?php foreach($data['materials'] as $material):?>
                                            <option value="<?php echo $material->material_type?>"><?php echo $material->material_type?></option>
                                        <?php endforeach;?>
                                        
                                        <?php foreach($data['materials'] as $material):?>
                                            <input type="hidden" name="material_id[]" value="<?php echo $material->stock_id?>">
                                        <?php endforeach;?>
                                        
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
                            document.querySelector(".add.card").before(newCard);


                            let removeCard = newCard.querySelector("i");
                            removeCard.addEventListener('click', function(){
                                newCard.remove();
                                count--;
                            });

                        }

                        
                        var materialCount = <?php echo count($data['materials']) ?>;

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

              
                <button type="submit" class="close-btn pb" value="newQuotation" name="newQuotation">Submit</button>
                <button type="button" class="cancel-btn pb" onclick="closeNew()">Cancel</button>
             




            </form>
        </div>
    </div> 

           
    <div class="popup-view" id="popup-view">
        <div class="popup-content">
    
            <span class="close">&times;</span>
            
            <h2>Request Details</h2>
            
                <form class="update-form" method="POST" enctype="multipart/form-data">
                    <div class="user-details">
                        <div class="input-box">
                          
                            <embed name="design" type="application/pdf" style="display: block; width: 250px; height: 249px; margin-bottom:0.8rem; background-color:white; border-radius:10px;">
                            <div class="image">
                                <div class="flex-half">
                                    <div class="add-section">
                                        <div style="text-align: right; position: relative; right: 50px;">
                                            <a href="#" class="table-section__add-link" onclick="toggleImageForm()">Update Design</a>
                                        </div>
                                        <div id="imageForm" style="display: none; transition: display 0.5s ease;">
                                            
                                        <div id="drop_zone">Drag and drop your image here, or click to select image</div>
                                                <input name="image" type="file" id="file_input" style="display: none;" accept="pdf/*">
                                                <embed id="preview" name="preview" type="application/pdf" style="display: block; height:0; margin: 0 auto; margin-bottom:0.8rem; background-color:white; border-radius:10px;">
                                                
                                                
                                        </div>
                                    </div>
                                        
                                        
                                        
                                        
                                </div>
                                    
                            </div>
                        </div>
                        <div class="input-box">
                            <span class="details">Request Id </span>
                            <input name="order_id" type="text" required onChange="" readonly value="" />
                        </div>

                        <div class="input-box" style="height: 0;">

                        </div>

                        <div class="input-box placedDate">
                            <span class="details">Request Placed On</span>
                            <input name="order_placed_on" type="text" required onChange="" readonly value="" />
                        </div>
                        
                    </div>

                    <div class="add card">

                    </div>

                    <hr class="second">
                    <div class="radio-btns">
                        <input type="radio" id="pickupV" name="deliveryOption" value="Pick Up">
                        <label for="pickup">Pick Up</label>

                        <input type="radio" id="deliveryV" name="deliveryOption" value="Delivery">
                        <label for="delivery">Delivery</label>
                        <span class="error delivery"></span>
                    </div>

                    <div class="user-details pickupV">
                        <div class="input-box">
                            <span class="details">Pick Up Date</span>
                        
                            <input type="date" name="dispatch_date_pickup">
                        </div>
                    </div>

                    <div class="user-details deliveryV">
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
                        
                            <select name="city">

                            </select>
                        </div>


                    </div>
                                


                    <!-- <form method="POST" class="popup-view" id="popup-view"> -->
                    <button type="submit" class="update-btn pb" name="updateOrder">Update Order</button>
                    <button type="submit" onclick="" class="cancel-btn pb" name="cancelReq">Cancel Order</button>
                    <!-- </form> -->


                </form>
            </div>
        
    </div>

    <script>
        //toggle delivery options
        
        let deliveryV = document.getElementById("deliveryV");
        let pickUpV = document.getElementById("pickupV");


        pickUpV.addEventListener('click', togglePickUpV);
        deliveryV.addEventListener('click', toggleDeliveryV);

        function togglePickUpV(){
            
            document.querySelector(".user-details.pickupV").classList.add("is-checked");
            document.querySelector(".user-details.deliveryV").classList.remove("is-checked");
            // document.getElementsByName("dispatch_date_delivery")[1].value = "";
            
        }

        function toggleDeliveryV(){
            document.querySelector(".user-details.deliveryV").classList.add("is-checked");
            document.querySelector(".user-details.pickupV").classList.remove("is-checked");
            // document.getElementsByName("dispatch_date_pickup")[1].value = "";
        }

        document.getElementsByName("dispatch_date_delivery")[1].addEventListener('change', function(){
            document.getElementsByName("dispatch_date_pickup")[1].value = "";
            document.getElementsByName("city")[1].value = "";
        });

        document.getElementsByName("dispatch_date_pickup")[1].addEventListener('change', function(){
            document.getElementsByName("dispatch_date_delivery")[1].value = "";
        });

    </script>

    <div class="popup-view-reply" id="popup-view-reply">
        <div class="popup-content">
        <!-- <button type="button" class="update-btn pb">Update Order</button> -->
        <!-- <button type="button" class="cancel-btn pb">Cancel Order</button> -->
        <span class="close">&times;</span>
        
        <h2>Reply Details</h2>

        
            <form class="reply-form" method="POST" enctype="multipart/form-data">
               <div class="user-details">
                        <div class="input-box">
                          
                            <embed name="design" type="application/pdf" style="display: block; width: 250px; height: 249px; margin-bottom:0.8rem; background-color:white; border-radius:10px;">
                        </div>
                        <div class="input-box">
                            <span class="details">Request Id </span>
                            <input name="order_id" type="text" required onChange="" readonly value="" />
                        </div>

                        <div class="input-box" style="height: 0;">

                        </div>

                        <div class="input-box placedDate">
                            <span class="details">Request Placed On</span>
                            <input name="order_placed_on" type="text" required onChange="" readonly value="" />
                        </div>
                        
                    </div>

                    <div class="add card">

                    </div>

                    <hr class="second">

                    <div class="user-details pickupVR">
                        <div class="input-box">
                            <span class="details">Pick Up Date</span>
                        
                            <input type="text" name="dispatch_date_pickup" readonly value="" >
                        </div>
                    </div>

                    <div class="user-details deliveryVR">
                        <div class="input-box">
                            <span class="details">Delivery Expected On</span>
                        
                            <input type="text" name="dispatch_date_delivery" readonly value="">
                        </div>

                        <div class="input-box location">
                            <span class="details"> Delivery Location</span>
                            <div id="map" style="height: 300px; width: 100%;"></div>
                        </div>

                        <div class="input-box city">
                            <span class="details addr">City</span>
                        
                            <input name="city" readonly value="" />

                        </div>


                    </div>

                    <hr class="second">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Unit Price</span>
                            <input name="unit_price" type="text" required onChange="" readonly value="" />
                        </div>

                        <div class="input-box">
                            <span class="details">Total Price</span>
                            <input name="total_price" type="text" required onChange="" readonly value="" />
                        </div>

                        <div class="input-box">
                            <span class="details">Discount</span>
                            <input name="discount" type="text" required onChange="" readonly value="" />
                        </div>

                        <div class="input-box">
                            <span class="details">Special Note </span>
                            <input name="special_note" id="" cols="30" rows="5" readonly value="No special notes" />
                        </div>
                    </div>


                <!-- <form method="POST" class="popup-view" id="popup-view"> -->
                <button type="submit" class="update-btn pb" name="placeOrder">Place Order</button>
                <button type="submit" onclick="" class="cancel-btn pb" name="cancelReq">Cancel Request</button>
                <!-- </form> -->


            </form>
            </div>
        
    </div>

                    
    <script>
        function toggleImageForm() {
            var x = document.getElementById("imageForm");

            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        let dropZone = document.getElementById('drop_zone');
        let fileInput = document.getElementById('file_input');
        let preview = document.getElementById('preview');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function handleFiles(files) {
            ([...files]).forEach(uploadFile);
        }

        function uploadFile(file) {
            let reader = new FileReader();
            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.height = 'auto';
            }
            reader.readAsDataURL(file);
        }

        fileInput.addEventListener('change', function(e) {
            handleFiles(this.files);
        }, false);

        // Event listeners for file drop
        dropZone.addEventListener('drop', function(e) {
            let dt = e.dataTransfer;
            let files = dt.files;

            handleFiles(files);
        }, false);

        // Event listener for drop zone click to trigger file input click
        dropZone.addEventListener('click', function() {
            fileInput.click();
        }, false);
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfuuowb7aC4EO89QtfL2NQU0YO5q17b5Y&callback=initMap"></script>

    <script src="<?= ROOT ?>/assets/js/manager/quotations.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>



</body>

</html>