<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/quotation.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Fo-CyT14-vq_yv62ZukPosT_ZjLglEk&callback=initMap"></script>
  <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include_once 'navigationbar.php' ?>
    <!-- content  -->
    <section id="main" class="main">

        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <i class='bx bx-chevron-right'></i>
            <li>
                <a href="#" class="active">Quotation Requests</a>
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
				<input class="new-btn" type="button" onclick="openNew()" value="+New Request">
				<input class="btn" type="button" onclick="openReport()" value="Report Problem">
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
                            <th>Request Id</th>
                            <th>Placed Date</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['quotation'] as $order):?>
                        <?php if($order->is_quotation && $order->order_status == "quotation"): ?>
                            <?php $material = array(); ?>
                        <tr>
                            
                            <td><?php echo $order->order_id ?></td>
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

                        
                            <td><button type="submit" name="selectItem" class="edit" data-order='<?= json_encode($order); ?>' data-material='<?= json_encode($material); ?>' onclick="openView(this)"><i class="fas fa-edit"></i> View</button>
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
                <a href="#" class="active">Quotation Replies</a>
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
	
			</div>

        </form>

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
                            <th>Request Id</th>
                            <th>Placed Date</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['quotation_reply'] as $order):?>
                            <?php if($order->is_quotation && $order->order_status === "reply"): ?>
                                <?php $material_reply = array(); ?>
                        <tr>
                            
                            <td><?php echo $order->order_id ?></td>
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
                                        <?php echo $sizes->xs + $sizes->small + $sizes->medium + $sizes->large + $sizes->xl + $sizes->xxl ?> <br>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>

                        
                            <td><button type="submit" name="selectItem" class="edit" data-reply-order='<?= json_encode($order); ?>' data-reply-material='<?= json_encode($material_reply); ?>' onclick="openViewReply(this)"><i class="fas fa-edit"></i> View</button>
                            <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                        </tr>
                        <?php endif; ?>
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
                        <tr>
                            <td class="materialType"></td>
                            <td class="sleeveType"></td>
                            <td class="printingType"></td>
                            <td class="quantityAll">0</td>
                            <td class="unitPrice">0</td>
                        </tr>
                    </table>
                </div>
                
                    
                    <!-- <p>You will be notified about possible discounts later</p> -->
                    
                

                <script>
                    //add price data dynamically
                    let material = document.querySelector(".user-details select[name='material[]']");
                    let sleeve = document.querySelector(".user-details select[name='sleeve[]']");
                    let printingType = document.querySelector(".user-details select[name='printingType[]']");
                    let quantity = document.querySelector(".sizes");
                    // let addMaterial = document.querySelector(".add.card");
                    let data = document.querySelector(".price-details-container");
                    let materialPrice = 0, sleevePrice = 0, printingTypePrice = 0;

                    let sizesArr = ['xs', 'small', 'medium', 'large', 'xl', 'xxl'];
                    let quantityAll = document.querySelector(".quantityAll");

                    sizesArr.forEach(function(size){
                        let input = document.querySelector(`input[name='${size}[]']`);
                        input.addEventListener('change', function(){
                            let total = 0;
                            sizesArr.forEach(function(size){
                                total += parseInt(document.querySelector(`input[name='${size}[]']`).value);
                            });
                            quantityAll.innerHTML = total;
                        });
                    });
                    
                    let allMaterials = <?php echo json_encode($data['material_prices']) ?>;
                    let allSleeves = <?php echo json_encode($data['sleeveType']) ?>;
                    let allPrintingTypes = <?php echo json_encode($data['material_printingType']) ?>;
                    console.log(allMaterials);

                    function updatePrice(doc, materialPrice, sleevePrice, printingTypePrice){
                        let totalPrice = parseInt(materialPrice) + parseInt(sleevePrice) + parseInt(printingTypePrice);
                        doc.querySelector(".unitPrice").innerHTML = totalPrice;
                    }

                    material.addEventListener('change', function(){
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
                        

                </script>

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
                                        <option value="" selected hidden style="color: grey;">Select</option>
                                        <?php foreach($data['materials'] as $material):?>
                                            <option value="<?php echo $material->stock_id?>"><?php echo $material->material_type ?></option>
                                            <!-- <input type="hidden" name="material_id[]" value="<?php echo $material->stock_id?>"> -->
                                        <?php endforeach;?>
                                        
                                    </select>
                                    
                                </div>



                                <div class="input-box">
                                    <span class="details">Sleeves</span>
                                    <select name="sleeve">
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
                            document.querySelector(".add.card").before(newCard);

                            let newPriceRow = document.createElement("tr");
                           
                            newPriceRow.innerHTML = `
                                <td class="materialType"></td>
                                <td class="sleeveType"></td>
                                <td class="printingType"></td>
                                <td class="quantityAll">0</td>
                                <td class="unitPrice">0</td>
                            `;

                            document.querySelector(".price-details-container").appendChild(newPriceRow);

                            let sizeArr = ['xs', 'small', 'medium', 'large', 'xl', 'xxl'];

                            sizeArr.forEach(function(size){
                                let input = newCard.querySelector(`input[name='${size}[]']`);
                                input.addEventListener('change', function(){
                                    let total = 0;
                                    sizeArr.forEach(function(size){
                                        total += parseInt(newCard.querySelector(`input[name='${size}[]']`).value);
                                    });
                                    newPriceRow.querySelector(".quantityAll").innerHTML = total;
                                });
                            });

                            let material1 = newCard.querySelector("select[name='material[]']");
                            let sleeve1 = newCard.querySelector("select[name='sleeve']");
                            let printingType1 = newCard.querySelector("select[name='printingType[]']");
                            let quantity1 = newCard.querySelector(".sizes");
                            let data1 = newPriceRow;
                            let materialPrice1 = 0, sleevePrice1 = 0, printingTypePrice1 = 0;

                            material1.addEventListener('change', function(){
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

                            


                            let removeCard = newCard.querySelector("i");
                            removeCard.addEventListener('click', function(){
                                newCard.remove();
                                newPriceRow.remove();
                                count--;
                            });

                            let material = newCard.querySelector("select[name='material[]']");
                            let printingType = newCard.querySelector("select[name='printingType[]']");
                            console.log(material);
                            console.log(printingType);

                        
                            
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
                            });

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

              
                <button type="submit" class="close-btn pb" value="newQuotation" name="newQuotation">Submit</button>
                <button type="button" class="cancel-btn pb" onclick="closeNew()">Cancel</button>
             




            </form>
        </div>
    </div> 
               

    <div class="popup-report">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Report Your Problem</h2>
            <form method="POST">

                <h4>Title : <span class="error title"></span>  </h4> 
                <input name="title" type="text" placeholder="Enter your title">
                <h4>Your email : <span class="error email"></span></h4>
                <input name="email" type="text" placeholder="Enter your email">
                <h4>Problem : <span class="error description"></span></h4>
                <textarea name="description" id="problem" cols="30" rows="5" placeholder="Enter your problem"></textarea>
                
                <button type="submit" class="close-btn pb" name="report" value="Submit" >Submit</button>
                <button type="button" class="cancelR-btn pb" onclick="closeReport()" >Cancel</button>
            

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
                            <!-- <div class="image">
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
                                    
                            </div> -->
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


                    <!-- <hr class="first"> -->

                    <!-- <h4 style="font-weight: 100; margin: 10px; color: red;">with different materials</h4> -->

                    <div class="add card">

                        <!-- <div class="left">
                            <i class='bx bxs-plus-circle'></i>
                            <h4>Add a material</h4>
                        </div> -->
                        
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
        
        <h2>Request Details</h2>

        
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
                        //toggle printing type options

                        document.addEventListener('DOMContentLoaded', (event) => {
                           
                            
                                let material = document.querySelector(".user-details select[name='material[]']");
                                let printingType = document.querySelector(".user-details select[name='printingType[]']");
                           

                            
                                
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
                                    
                                });
                         
                            
                        });


                    </script>

                    
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
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/customer/quotation.js"></script>
</body>

</html>