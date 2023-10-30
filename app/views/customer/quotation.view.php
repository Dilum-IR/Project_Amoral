<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/customer/quotation.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php'?>
    
    <!-- Navigation Bar -->
    <?php include 'navigationbar.php'?>

    <!-- Content -->
    <section id="main" class="main">

        <h2>Your Quotations</h2>

        <form>
            <div class="form">
				<input class="form-group" type="text" placeholder="Search...">
				<i class='bx bx-search icon'></i>
				<input class="new-btn" type="button" onclick="openNew()" value="+New Quotation Request">
				<input class="reportBtn" type="button" onclick="openReport()" value="Report Problem">
			</div>

        </form>

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th class="ordId">OrderId</th>
                    <th class="desc">Description</th>
                    <th class="stth">Status</th>
                    <th class="cost">Cost</th>
                    <th></th>
                </tr>
            </thead>

    

            <!-- <tr>
                <td>1</td>
                <td class="ordId">002345</td>
                <td class="desc">Material : Wetlook <br>
                    Sizes & Quantity : S - 2
                </td>
                <td class="st">
                    <div class="text-status">Processing</div>
                </td>
                <td class="cost">Rs. 2400</td>
                <td><button type="submit" class="view-order-btn" onclick="openView()">View Order</button></td>
            </tr> -->
        </table>

    </section>

    <!-- POPUP -->
    <div class="popup-new">
        <h2>New Quotation Request</h2>
        <form action="">
            <div class="form">
                <div class="input-box">
                    <span class="details">Material</span><br>
                    <select name="material">
                        <option value="material1">Crocodile</option>
                        <option value="material2">Wetlook</option>
                        <option value="material3">Baby Crocodile</option>
                    </select>
                </div>
                <div class="input-box">
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

                <div class="input-box">
                    <span class="details">Delivery Address</span>
                    <input type="text" name="address" placeholder="Enter delivery address">
                </div>

                <div class="input-box">
                    <span class="details">Delivery Expected On</span>
                    <input type="date" name="dispatch_date">
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <span class="details">T-shirt Design</span>
                    <input type="file" name="design" id="fileToUpload">
                </form>
            </div>
            <div class="btns">
                <button type="button" class="cancel-btn" onclick="closeNew()">Cancel</button>
                <button type="submit" class="close-btn" name="newQuotation">Submit</button>
            </div>
        </form>
    </div> 

    <div class="popup-report">
        <h2>Report Your Problem</h2>
        <h4>Your name : </h4>
        <input type="text" placeholder="Enter your name">
        <h4>Your email : </h4>
        <input type="text" placeholder="Enter your email">
        <h4>Problem : </h4>
        <textarea name="problem" id="problem" cols="30" rows="10" placeholder="Enter your problem"></textarea>
		<div class="btns">
			<button type="button" class="cancelR-btn" onclick="closeReport()">Cancel</button>
			<button type="button" class="close-btn" onclick="closeReport()">Submit</button>
		</div>
    </div>

    <!-- <div class="popup-new" id="popup-new">
        <h2>Order Details</h2>

        <div class="container1">
            <form>
                <div class="user-details">

                    <div class="input-box">
                        <span class="details">Material </span>
                        <input type="text" required onChange="" />
                    </div>

                    <div class="input-box sizes">
                        <span class="details">Sizes & Quantity</span>
                        <input class="size" type="text" required onChange=""  />
                        <p>_</p>
                        <input class="size" type="text" required onChange="" />
                    </div>

                    <div class="input-box">
                        <span class="details">Delivery Address</span>
                        <input type="text" required onChange="" />
                    </div>

                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                        <input type="text" required onChange="" />
                    </div>
 

                </div>
            </form>
        </div>
        <button type="button" class="cancelN-btn" onclick="closeNew()">Cancel</button>
        <button type="submit" class="submit-btn" onclick="closeNew()">Submit</button>
    </div> -->


    <script src="<?=ROOT ?>/assets/js/script-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/customer/quotation.js"></script>

</body>
</html>