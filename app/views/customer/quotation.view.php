<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/quotation.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Fo-CyT14-vq_yv62ZukPosT_ZjLglEk&callback=initMap"></script>
</head>

<body>
    <!-- Sidebar -->
    <?php 
    include 'sidebar.php' 
    ?>
    <!-- Navigation bar -->

    <?php 
    include 'navigationbar.php' 
    ?>


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
                            <th>Design</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['quotation'] as $order):?>
                        <?php if($order->is_quotation): ?>
                        
                        <tr>
                            
                            <td><?php echo $order->order_id ?></td>
                            <td class="img">
                                <embed src="<?php echo "/Project_Amoral/public/uploads/designs/" . $order->image ; ?>" type="application/pdf" width="171px" height="221px" scrolling="no" style="zoom:0.55; overflow: hidden;" alt="image">
                            </td>
                            <td><?php echo $order->material ?></td>
                            <td class="desc"><?php echo $order->small + $order->medium + $order->large ?></td>

                        
                            <td><button type="submit" name="selectItem" class="edit" data-order='<?= json_encode($order); ?>' onclick="openView(this)"><i class="fas fa-edit"></i> View</button>
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
                            <th>Design</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['quotation_reply'] as $order):?>
                       
                        
                        <tr>
                            
                            <td><?php echo $order->order_id ?></td>
                            <td class="img">
                                <embed src="<?php echo "/Project_Amoral/public/uploads/designs/" . $order->image ; ?>" type="application/pdf" width="171px" height="221px" scrolling="no" style="zoom:0.55; overflow: hidden;" alt="image">
                            </td>
                            <td><?php echo $order->material ?></td>
                            <td class="desc"><?php echo $order->small + $order->medium + $order->large ?></td>

                        
                            <td><button type="submit" name="selectItem" class="edit" data-order='<?= json_encode($order); ?>' onclick="openViewReply(this)"><i class="fas fa-edit"></i> View</button>
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
        
        <form class="new-form" method="POST">
            
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Material </span>
                        <select name="material">
                            <option value="Crocodile">Crocodile</option>
                            <option value="Wetlook">Wetlook</option>
                            <option value="Baby Crocodile">Baby Crocodile</option>
                        </select>
                        
                    </div>

                    <div class="input-box sizes">
                        <span class="details">Sizes & Quantity</span>
                        <div class="sizeChart">
                            <span class="size">XS</span>
                            <input class="st" type="number" id="quantity" name="xs"  min="0" >
                            <br>
                            <span class="size">S</span>
                            <input class="st" type="number" id="quantity" name="small"  min="0" >
                            <br>
                            <span class="size">M</span>
                            <input class="st" type="number" id="quantity" name="medium"  min="0" >
                            <br>
                            <span class="size">L</span>
                            <input class="st" type="number" id="quantity" name="large"  min="0">
                            <br>
                            <span class="size">XL</span>
                            <input class="st" type="number" id="quantity" name="xl"  min="0">
                            <br>
                            <span class="size">2XL</span>
                            <input class="st" type="number" id="quantity" name="2xl"  min="0">
                            <br>
                        </div>
                    </div>

                    <div class="input-box design">
                        <span class="details">Design</span>
                        <div class="fileType">
                            <h5 class="pdf">PDF</h5>
                            <h5 class="images">Images</h5>
                        </div>
                        <input enctype="multipart/form-data" type="file" name="image" id="fileToUpload"><br>
                        <input enctype="multipart/form-data" type="file" name="image" id="fileToUpload" class="imagesUpload">

                    </div>
                
                </div>

                <script>
                    //toggle upload options
                    let pdf = document.querySelector(".design .pdf");
                    let images = document.querySelector(".design .images");


                    pdf.addEventListener('click', function(){
                        document.querySelector(".design .imagesUpload").classList.remove("is-checked");

                    });
                    images.addEventListener('click', function(){
                        document.querySelector(".design .imagesUpload").classList.add("is-checked");

                    });

                </script>

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
                </div>

                <div class="user-details pickup">
                    <div class="input-box">
                        <span class="details">Pick Up Date</span>
                    
                        <input type="date" name="dispatch_date">
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

                <script>
                        let addMaterial = document.querySelector(".add.card");

                        function addMaterialCard() {
                            var newCard = document.createElement("div");
                            newCard.className = "user-details";

                            
                            newCard.innerHTML = `
                            <i class="fas fa-minus remove"></i>
                                <div class="input-box">
                                    <span class="details">Material </span>
                                    <select name="material">
                                        <option value="Crocodile">Crocodile</option>
                                        <option value="Wetlook">Wetlook</option>
                                        <option value="Baby Crocodile">Baby Crocodile</option>
                                    </select>
                                    
                                </div>

                                <div class="input-box sizes">
                                    <span class="details">Sizes & Quantity</span>
                                    <div class="sizeChart">
                                        <span class="size">XS</span>
                                        <input class="st" type="number" id="quantity" name="xs"  min="0" >
                                        <br>
                                        <span class="size">S</span>
                                        <input class="st" type="number" id="quantity" name="small"  min="0" >
                                        <br>
                                        <span class="size">M</span>
                                        <input class="st" type="number" id="quantity" name="medium"  min="0" >
                                        <br>
                                        <span class="size">L</span>
                                        <input class="st" type="number" id="quantity" name="large"  min="0">
                                        <br>
                                        <span class="size">XL</span>
                                        <input class="st" type="number" id="quantity" name="xl"  min="0">
                                        <br>
                                        <span class="size">2XL</span>
                                        <input class="st" type="number" id="quantity" name="2xl"  min="0">
                                        <br>
                                    </div>
                                </div>
                            `;

                            newCard.style.transition = "all 0.5s ease-in-out";
                            document.querySelector(".add.card").before(newCard);


                            let removeCard = newCard.querySelector("i");
                            removeCard.addEventListener('click', function(){
                                newCard.remove();
                            });

                        }

                        addMaterial.addEventListener('click', addMaterialCard);



                    </script>

                <div class="user-details delivery">
                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                    
                        <input type="date" name="dispatch_date">
                    </div>

                    <div class="input-box location">
                        <span class="details"> Delivery Location</span>
                        <div id="map" style="height: 300px; width: 100%;"></div>
                    </div>

                    <div class="input-box">
                        <span class="details addr">District</span>
                    
                        <select name="district">
                            <option value="Ampara">Ampara</option>
                            <option value="Anuradhapura">Anuradhapura</option>
                            <option value="Badulla">Badulla</option>
                            <option value="Batticaloa">Batticaloa</option>
                            <option value="Colombo">Colombo</option>
                            <option value="Galle">Galle</option>
                            <option value="Gampaha">Gampaha</option>
                            <option value="Hambantota">Hambantota</option>
                            <option value="Jaffna">Jaffna</option>
                            <option value="Kalutara">Kalutara</option>
                            <option value="Kandy">Kandy</option>
                            <option value="Kegalle">Kegalle</option>
                            <option value="Kilinochchi">Kilinochchi</option>
                            <option value="Kurunegala">Kurunegala</option>
                            <option value="Mannar">Mannar</option>
                            <option value="Matale">Matale</option>
                            <option value="Matara">Matara</option>
                            <option value="Monaragala">Monaragala</option>
                            <option value="Mullaitivu">Mullaitivu</option>
                            <option value="Nuwara Eliya">Nuwara Eliya</option>
                            <option value="Polonnaruwa">Polonnaruwa</option>
                            <option value="Puttalam">Puttalam</option>
                            <option value="Ratnapura">Ratnapura</option>
                            <option value="Trincomalee">Trincomalee</option>
                            <option value="Vavuniya">Vavuniya</option>
                        </select>
                    </div>


                </div>

                <input name="latitude" type="hidden" required />
                <input name="longitude" type="hidden" required />

              
                <button type="submit" class="close-btn pb" value="newQuotation" name="newQuotation">Submit</button>
                <button type="button" class="cancel-btn pb" onclick="closeNew()">Cancel</button>
             




            </form>

        <!-- <form method="POST" class="new-req">
            <div class="form">
                <div class="input-box">
                    <span class="details">Material</span><br>
                    <select name="material">
                        <option value="Crocodile">Crocodile</option>
                        <option value="Wetlook">Wetlook</option>
                        <option value="Baby Crocodile">Baby Crocodile</option>
                    </select>
                </div> -->

<!-- 
                <div class="input-box">
                    <span class="details">Delivery Address</span>
                    <input type="text" name="address" placeholder="Enter delivery address">
                </div>

                <div class="input-box">
                    <span class="details">Delivery Expected On</span>
                    <input type="date" name="dispatch_date">
                </div>
                
                
                    <span class="details">T-shirt Design</span>
                    <input enctype="multipart/form-data" type="file" name="design" id="fileToUpload">
                
            </div>
            <div class="btns">
                <button type="button" class="cancel-btn" onclick="closeNew()">Cancel</button>
                <button type="submit" class="close-btn" value="newQuotation" name="newQuotation">Submit</button>
            </div>
        </form> -->
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
        <!-- <button type="button" class="update-btn pb">Update Order</button> -->
        <!-- <button type="button" class="cancel-btn pb">Cancel Order</button> -->
        <span class="close">&times;</span>
        
        <h2>Request Details</h2>

        
            <form class="update-form" method="POST" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Request Id </span>
                        <input name="order_id" type="text" required onChange="" readonly value="0023456" />
                    </div>

                    <div class="input-box">
                        <span class="details">Material </span>
                        <input name="material" type="text" required onChange="" readonly value="Wetlook" />
                        
                    </div>

                    <div class="input-box sizes">
                        <span class="details">Sizes & Quantity</span><br>
                        <div class="sizeChart">
                      
                            <span class="size">S</span>
                        
                            <input class="st" type="number" id="quantity" name="small"  min="0" >
                            <br>
                            <span class="size">M</span>
                            <input class="st" type="number" id="quantity" name="medium"  min="0" >
                            <br>
                            <span class="size">L</span>
                            <input class="st" type="number" id="quantity" name="large"  min="0">
                            <br>
                            <span class="size">XL</span>
                            <input class="st" type="number" id="quantity" name="xl"  min="0">
                            <br>

                        </div>
                    </div>

                    <div class="input-box">
                        <span class="details">Request Placed On</span>
                        <input name="order_placed_on" type="text" required onChange="" readonly value="2023/10/02" />
                    </div>
                    <div class="input-box">
                        <span class="details">Design</span>
                        <embed name="design" type="application/pdf" style="display: block; width: 250px; margin: 0 auto; margin-bottom:0.8rem; background-color:white; border-radius:10px;">
                        <div class="image">
                            <div class="flex-half">
                                <div class="add-section">
                                    <div style="text-align: right; position: relative; right: 36px;">
                                        <a href="#" class="table-section__add-link" onclick="toggleImageForm()">Add Design</a>
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
                        <span class="details">Delivery Expected On</span>
                    
                        <input type="date" name="dispatch_date">
                    </div>
                    <div class="input-box">
                        <span class="details addr">Address</span>
                    
                        <input type="text" name="district">
                    </div>
                    <div class="input-box">
                        <span class="details">Delivery Location</span>
                        <div id="map" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
                               


                <!-- <form method="POST" class="popup-view" id="popup-view"> -->
                <button type="submit" class="update-btn pb" name="updateOrder">Update Order</button>
                <button type="button" onclick="" class="cancel-btn pb">Cancel Order</button>
                <!-- </form> -->


            </form>
            </div>
        
    </div>

    <div class="popup-view-reply" id="popup-view-reply">
        <div class="popup-content">
        <!-- <button type="button" class="update-btn pb">Update Order</button> -->
        <!-- <button type="button" class="cancel-btn pb">Cancel Order</button> -->
        <span class="close">&times;</span>
        
        <h2>Request Details</h2>

        
            <form class="update-form" method="POST" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Request Id </span>
                        <input name="order_id" type="text" required onChange="" readonly value="0023456" />
                    </div>

                    <div class="input-box">
                        <span class="details">Material </span>
                        <input name="material" type="text" required onChange="" readonly value="Wetlook" />
                        
                    </div>

                    <div class="input-box sizes">
                        <span class="details">Sizes & Quantity</span><br>
                        <div class="sizeChart">
                      
                            <span class="size">S</span>
                        
                            <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                            <input class="st" type="number" id="quantity" name="small"  min="0" >
                            <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                            <br>
                            <span class="size">M</span>
                            <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                            <input class="st" type="number" id="quantity" name="medium"  min="0" >
                            <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                            <br>
                            <span class="size">L</span>
                            <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                            <input class="st" type="number" id="quantity" name="large"  min="0">
                            <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                            <br>


                        </div>
                    </div>

                    <div class="input-box">
                        <span class="details">Request Placed On</span>
                        <input name="order_placed_on" type="text" required onChange="" readonly value="2023/10/02" />
                    </div>
                    <div class="input-box">
                        <span class="details">Design</span>
                        <embed name="design" type="application/pdf" style="display: block; width: 250px; margin: 0 auto; margin-bottom:0.8rem; background-color:white; border-radius:10px;">
                        <div class="image">
                            <div class="flex-half">
                                <div class="add-section">
                                    <div style="text-align: right; position: relative; right: 36px;">
                                        <a href="#" class="table-section__add-link" onclick="toggleImageForm()">Add Design</a>
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
                        <span class="details">Delivery Expected On</span>
                    
                        <input type="date" name="dispatch_date">
                    </div>
                    <div class="input-box">
                        <span class="details addr">Address</span>
                    
                        <input type="text" name="district">
                    </div>
                    <div class="input-box">
                        <span class="details">Delivery Location</span>
                        <div id="map" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
                               


                <!-- <form method="POST" class="popup-view" id="popup-view"> -->
                <button type="submit" class="update-btn pb" name="updateOrder">Place Order</button>
                <button type="button" onclick="" class="cancel-btn pb">Cancel Request</button>
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
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/customer/quotation.js"></script>
</body>

</html>