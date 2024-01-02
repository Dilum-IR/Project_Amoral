<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/quotation.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfuuowb7aC4EO89QtfL2NQU0YO5q17b5Y&callback=initMap"></script>
</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include 'navigationbar.php' ?>


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
            <form action="#">
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
                            <th>Request Id</th>
                            <th>Design</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $order):?>
                        <?php if($order->is_quotation): ?>
                        
                        <tr>
                            
                            <td class="ordId"><?php echo $order->order_id ?></td>
                            <td></td>
                            <td><?php echo $order->material ?></td>
                            <td class="desc"> S - <?php echo $order->small ?><br> M - <?php echo $order->medium ?><br> L - <?php echo $order->large ?></td>

                        
                            <td><button type="submit" name="selectItem" class="edit" data-order='<?= json_encode($order); ?>' onclick="openView(this)" title="Edit request"><i class="fas fa-edit"></i> View Request</button>
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
        <div class="close-icon">
          <a href="#">
            <i class="bx bx-x" id="gen-pop-close"></i>
            <!-- <span class="link_name">Close</span> -->
          </a>
        </div>
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
                        <span class="details">Sizes & Quantity</span><br>
                        <div class="sizeChart">
                            <span class="size">S</span>
                        
                            <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                            <input class="st" type="number" id="quantity" name="small" value="0" min="0" max="10">
                            <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                            <br>
                            <span class="size">M</span>
                            <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                            <input class="st" type="number" id="quantity" name="medium" value="0" min="0" max="10">
                            <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                            <br>
                            <span class="size">L</span>
                            <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                                <input class="st" type="number" id="quantity" name="large" value="0" min="0" max="10">
                                <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                                <br>
                        </div>
                    </div>

                    <div class="input-box design">
                        <span class="details">Design</span>
                        <input enctype="multipart/form-data" type="file" name="image" id="fileToUpload">
                    </div>

                    

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

                <div class="btns">
                    <button type="button" class="cancel-btn" onclick="closeNew()">Cancel</button>
                    <button type="submit" class="close-btn" value="newQuotation" name="newQuotation">Submit</button>
                </div>




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
               

    <div class="popup-report">
        <div class="close-icon">
            <a href="#">
                <i class="bx bx-x" id="gen-pop-close"></i>
                <!-- <span class="link_name">Close</span> -->
            </a>
        </div>
        <h2>Report Your Problem</h2>
        <form method="POST">

            <h4>Title : </h4>
            <input name="title" type="text" placeholder="Enter your title">
            <h4>Your email : </h4>
            <input name="email" type="text" placeholder="Enter your email">
            <h4>Problem : </h4>
            <textarea name="description" id="problem" cols="30" rows="5" placeholder="Enter your problem"></textarea>
            <div class="btns">
                <button type="button" class="cancelR-btn" onclick="closeReport()" >Cancel</button>
                <button type="submit" class="close-btn" name="report" value="Submit" >Submit</button>
            </div>

        </form>
    </div>
    

    <div class="popup-view" id="popup-view">
        <!-- <button type="button" class="update-btn pb">Update Order</button> -->
        <!-- <button type="button" class="cancel-btn pb">Cancel Order</button> -->
        <div class="close-icon">
          <a href="#">
            <i class="bx bx-x" id="gen-pop-close"></i>
            <!-- <span class="link_name">Close</span> -->
          </a>
        </div>
        
        <h2>Request Details</h2>

        
            <form class="update-form" method="POST">
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
                            <input class="st" type="number" id="quantity" name="small" value="0" min="0" >
                            <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                            <br>
                            <span class="size">M</span>
                            <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                            <input class="st" type="number" id="quantity" name="medium" value="0" min="0" >
                            <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                            <br>
                            <span class="size">L</span>
                            <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                                <input class="st" type="number" id="quantity" name="large" value="0" min="0">
                                <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                                <br>
                        </div>
                    </div>

                    <div class="input-box">
                        <span class="details">Request Placed On</span>
                        <input name="order_placed_on" type="text" required onChange="" readonly value="2023/10/02" />
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
                    <div class="input-box">
                        <span class="details">Design</span>
                        <div class="image">
                            <div class="flex-half">
                                <div class="add-section">
                                    <div style="text-align: right;">
                                        <a href="#" class="table-section__add-link" onclick="toggleImageForm()">Add Design</a>
                                    </div>
                                    <div id="imageForm" style="display: none;" class="center-items">
                                        <form action="<?php echo ROOT ?>/add/product_image" method="post" enctype="multipart/form-data">
                                            <div id="drop_zone">Drag and drop your image here, or click to select image</div>
                                            <img id="preview" style="display: block; margin: 0 auto; margin-bottom:0.8rem; background-color:white; border-radius:10px;">
                                            <input name="image" type="file" id="file_input" style="display: none;" accept="image/*">
                
                                            <button class="form-btn submit-btn" style="width: 50%;">Upload</button>
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
                                            preview.style.display = 'block';
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
                               
                                <!-- fetch product images -->
                                <?php
                                $url = ROOT . "/assets/uploads/designs" . $order->order_id;
                                $response = file_get_contents($url);
                                $images = json_decode($response, true);
                                // show($images);

                                ?>
                                <div class="carousel">
                                    <button class="carousel-left-btn" id="prevBtn">
                                        <span class="material-symbols-outlined">
                                            <
                                        </span>
                                    </button>
                                    <div id="carouselImages">
                                        <!-- Carousel images will be populated here -->
                                    </div>
                                    <button class="carousel-right-btn" id="nextBtn">
                                        <span class="material-symbols-outlined">
                                            >
                                        </span>
                                    </button>
                                </div>
                                <!-- show number of images and current image like 4/5 -->
                                <div style="text-align: center; height:">
                                    <a onclick="deleteImage()">
                                        <iconify-icon icon="uiw:delete"></iconify-icon>
                                    </a>

                                </div>

                                <div class="image-count"></div>


                            </div>
                            <script>
                                const carouselImages = document.getElementById('carouselImages');
                                const imageCount = document.querySelector('.image-count');

                                let images = <?php echo json_encode($images) ?>;
                                let currentImage = 0;

                                images.forEach(image => {
                                    carouselImages.innerHTML += `
                                    <img src="<?php echo ROOT . '/' ?>${image.image_url}" alt="Product Image-${image.product_image_id}" class="carousel-image">
                                `;
                                });

                                imageCount.innerHTML = ${currentImage + 1}/${images.length};



                                const prevBtn = document.getElementById('prevBtn');
                                const nextBtn = document.getElementById('nextBtn');

                                // Add event listeners to carousel buttons
                                prevBtn.addEventListener('click', () => {
                                    // Decrease currentImage index
                                    currentImage--;
                                    // If currentImage is less than 0, set it to the last image
                                    if (currentImage < 0) {
                                        currentImage = images.length - 1;
                                    }
                                    updateCarousel();
                                });

                                nextBtn.addEventListener('click', () => {
                                    currentImage++;
                                    if (currentImage >= images.length) {
                                        currentImage = 0;
                                    }
                                    updateCarousel();
                                });

                                function updateCarousel() {

                                    carouselImages.innerHTML = '';
                                    carouselImages.innerHTML += `
                            <img src="<?php echo ROOT . '/' ?>${images[currentImage].image_url}" alt="Product Image-${images[currentImage].product_image_id}" class="carousel-image">
                        `;
                                    // Update image count
                                    imageCount.innerHTML = ${currentImage + 1}/${images.length};
                                }

                                // Initial carousel update
                                updateCarousel();

                                // Delete image
                                function deleteImage() {
                                    // Get image id
                                    let imageId = images[currentImage].product_image_id;
                                    console.log(imageId);
                                    // Send delete request
                                    let xhr = new XMLHttpRequest();
                                    xhr.open('DELETE', '<?php echo ROOT . '/delete/product_images/' ?>' + imageId, true);
                                    xhr.onload = function() {
                                        if (this.status == 200) {
                                            // Reload page
                                            location.reload();
                                        }
                                    }
                                    xhr.send();
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <!-- hidden element -->
                <div class="input-box">
                    <!-- <span class="details">Order Id </span> -->
                    <input name="order_status" type="hidden" required onChange="" readonly value="cutting" />
                    <input name="user_id" type="hidden" required onChange="" readonly value="0023456" />
                </div>


                <!-- <form method="POST" class="popup-view" id="popup-view"> -->
                <input type="submit" class="update-btn pb" name="updateOrder" value="Update Order" />
                <button type="button" onclick="" class="cancel-btn pb">Cancel Order</button>
                <!-- </form> -->


            </form>
        
    </div>
    <div id="overlay" class="overlay"></div>



    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/customer/quotation.js"></script>
</body>

</html>