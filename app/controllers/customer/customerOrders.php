<?php

class CustomerOrders extends Controller
{
    public function index()
    {


        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;
        $order_material = new OrderMaterial;
        $materials = new MaterialStock;
        $sleeveType = new Sleeves;
        $material_printingType = new MaterialPrintingType;
        $printingType = new PrintingType;


        if ($username != 'User') {

            $id = ['user_id' => $_SESSION['USER']->id];
            // show($id);
            $data['order'] = $order->where($id);
            $data['material_sizes'] = $order->getFullData($id);
            $data['materials'] = $materials->getMaterialNames();
            $data['material_prices'] = $materials->findAll('stock_id');
            $data['sleeveType'] = $sleeveType->findAll('sleeve_id');
            $data['material_printingType'] = $material_printingType->getFullData();
            $data['printingType'] = $printingType->findAll('ptype_id');


            $this->view('customer/orders', $data);
            // show($_POST);

            if (isset($_POST['newOrder']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                // show($_FILES);
                //need to validate
                unset($_POST['newOrder']);


                date_default_timezone_set('Asia/Kolkata');
                $current_date = date("Y-m-d");

                if (isset($_POST['latitude']) && $_POST['longitude']) {
                    $_POST['is_delivery'] = 1;
                } else {
                    $_POST['is_delivery'] = 0;
                }



                $dispatch_date = $_POST['dispatch_date_delivery'] ? $_POST['dispatch_date_delivery'] : $_POST['dispatch_date_pickup'];
                $pdf = '';
                $img1 = '';
                $img2 = '';

                if ($_FILES['pdf']['error'] == 0) {
                    // show($_FILES);
                    $img_name = $_FILES['pdf']['name'];
                    $tmp_name = $_FILES['pdf']['tmp_name'];
                    $error = $_FILES['pdf']['error'];

                    if ($error === 0) {
                        // get image extention store it in variable
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        // convet to image extetion into lowercase and store it in variable
                        $img_ex_lc = strtolower($img_ex);

                        // allowed image extetions
                        $allowed_exs = array("jpg", "jpeg", "png", "pdf");

                        // check the allowed extention is present user upload image
                        if (in_array($img_ex_lc, $allowed_exs)) {

                            // image name username with image name
                            $new_img_name = $username . "-" . uniqid() . "." . $img_ex_lc;

                            // creating upload path on root directory
                            $img_upload_path = $_SERVER['DOCUMENT_ROOT'] . "/Project_Amoral/public/uploads/designs/"  . $new_img_name;

                            // move upload image for that folder

                            move_uploaded_file($tmp_name, $img_upload_path);
                            $pdf = $new_img_name;
                        } else {
                            $em = "You can't upload files of this type!";
                            header("Location:../../signup.php?error=$em&$data");
                            exit;
                        }
                    }
                } else if ($_FILES['image1']['error'] == 0 && $_FILES['image2']['error'] == 0) {
                    // show($_FILES);
                    $img_name1 = $_FILES['image1']['name'];
                    $tmp_name1 = $_FILES['image1']['tmp_name'];
                    $error1 = $_FILES['image1']['error'];

                    $img_name2 = $_FILES['image2']['name'];
                    $tmp_name2 = $_FILES['image2']['tmp_name'];
                    $error2 = $_FILES['image2']['error'];


                    if ($error1 === 0 && $error2 === 0) {
                        // get image extention store it in variable
                        $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
                        $img_ex2 = pathinfo($img_name2, PATHINFO_EXTENSION);

                        // convet to image extetion into lowercase and store it in variable
                        $img_ex_lc1 = strtolower($img_ex1);
                        $img_ex_lc2 = strtolower($img_ex2);

                        // allowed image extetions
                        $allowed_exs = array("jpg", "jpeg", "png", "pdf");

                        // check the allowed extention is present user upload image
                        if (in_array($img_ex_lc1, $allowed_exs) && in_array($img_ex_lc2, $allowed_exs)) {

                            // image name username with image name
                            $new_img_name1 = $username . "-" . uniqid() . "-01." . $img_ex_lc1;
                            $new_img_name2 = $username . "-" . uniqid() . "-02." . $img_ex_lc2;

                            // creating upload path on root directory
                            $img_upload_path1 = $_SERVER['DOCUMENT_ROOT'] . "/Project_Amoral/public/uploads/designs/"  . $new_img_name1;
                            $img_upload_path2 = $_SERVER['DOCUMENT_ROOT'] . "/Project_Amoral/public/uploads/designs/"  . $new_img_name2;


                            // move upload image for that folder

                            move_uploaded_file($tmp_name1, $img_upload_path1);
                            move_uploaded_file($tmp_name2, $img_upload_path2);

                            $img1 = $new_img_name1;
                            $img2 = $new_img_name2;
                        } else {
                            $em = "You can't upload files of this type!";
                            header("Location:../../signup.php?error=$em&$data");
                            exit;
                        }
                    }
                }




                // show($_POST['total_price']);
                $arrOrder = [
                    'user_id' => $_SESSION['USER']->id, 'total_price' => $_POST['total_price'], 'dispatch_date' => $dispatch_date, 'order_placed_on' => $current_date,
                    'order_status' => 'pending', 'city' => $_POST['city'], 'pdf' => $pdf, 'image1' => $img1, 'image2' => $img2,
                    'is_delivery' => $_POST['is_delivery'], 'latitude' => $_POST['latitude'], 'longitude' => $_POST['longitude']
                ];
                // show($arrOrder);
                $insert1 = $order->insert($arrOrder);
                // show($insert1);
                $order_data = $order->findLast();
                $order_id = $order_data[0]->order_id;



                // Assuming $_POST['material'] and $_POST['size'] are arrays of equal length
                $tot = count($_POST['material']);
                // show($tot);
                for ($i = 0; $i < $tot; $i++) {
                    $material = $_POST['material'][$i];
                    $sleeve = $_POST['sleeve'][$i];
                    $pType = $_POST['printingType'][$i];
                    $unit_price = $_POST['unit_price'][$i];
                    $xs = $_POST['xs'][$i];
                    $small = $_POST['small'][$i];
                    $medium = $_POST['medium'][$i];
                    $large = $_POST['large'][$i];
                    $xl = $_POST['xl'][$i];
                    $xxl = $_POST['xxl'][$i];

                    // $material_data = $materials->where(['material_type' => $material]);
                    $sleeve_data = $sleeveType->where(['type' => $sleeve]);
                    $printingType_data = $printingType->where(['printing_type' => $pType]);
                    // show($material);
                    $insert2 = $order_material->insert([
                        'order_id' => $order_id,
                        'material_id' => $material,
                        'sleeve_id' => $sleeve_data[0]->sleeve_id,
                        'ptype_id' => $printingType_data[0]->ptype_id,
                        'unit_price' => $unit_price,
                        'xs' => $xs,
                        'small' => $small,
                        'medium' => $medium,
                        'large' => $large,
                        'xl' => $xl,
                        'xxl' => $xxl
                    ]);
                    // show($insert2);
                }

                redirect('customer/orders');
                exit;
            }

            if (isset($_POST['updateOrder'])) {
                $order_id = $_POST['order_id'];
                // show($_POST);
                unset($_POST['updateOrder']);

                if (isset($_POST['latitude']) && $_POST['longitude']) {
                    $_POST['is_delivery'] = 1;
                } else {
                    $_POST['is_delivery'] = 0;
                }

                $dispatch_date = $_POST['dispatch_date_delivery'] ? $_POST['dispatch_date_delivery'] : $_POST['dispatch_date_pickup'];


                $arrOrder = [
                    'total_price' => $_POST['total_price'], 'dispatch_date' => $dispatch_date,
                    'city' => $_POST['city'],
                    'is_delivery' => $_POST['is_delivery'], 'latitude' => $_POST['latitude'], 'longitude' => $_POST['longitude']
                ];

                $update1 = $order->update($order_id, $arrOrder, 'order_id');
                // show($update1);
                // show($_POST['material']);

                $order_material->delete($order_id, 'order_id');


                $tot = count($_POST['material']);
                // show($tot);
                for ($i = 0; $i < $tot; $i++) {
                    $material = $_POST['material'][$i];
                    $sleeve = $_POST['sleeve'][$i];
                    $pType = $_POST['printingType'][$i];
                    $unit_price = $_POST['unit_price'][$i];
                    $xs = $_POST['xs'][$i];
                    $small = $_POST['small'][$i];
                    $medium = $_POST['medium'][$i];
                    $large = $_POST['large'][$i];
                    $xl = $_POST['xl'][$i];
                    $xxl = $_POST['xxl'][$i];

                    $material_data = $materials->where(['material_type' => $material]);
                    $sleeve_data = $sleeveType->where(['type' => $sleeve]);
                    $printingType_data = $printingType->where(['printing_type' => $pType]);
                    // show($material_data);
                    $insert2 = $order_material->insert([
                        'order_id' => $order_id,
                        'material_id' => $material_data[0]->stock_id,
                        'sleeve_id' => $sleeve_data[0]->sleeve_id,
                        'ptype_id' => $printingType_data[0]->ptype_id,
                        'unit_price' => $unit_price,
                        'xs' => $xs,
                        'small' => $small,
                        'medium' => $medium,
                        'large' => $large,
                        'xl' => $xl,
                        'xxl' => $xxl
                    ]);
                    // show($insert2);
                }

                unset($_POST);
                // redirect('customer/orders');
            }




            if (isset($_POST['report'])) {

                $report = new CustomerReport;

                unset($_POST['report']);

                $_POST['user_id'] = $id['user_id'];

                $_POST['report_date'] = date('Y-m-d');

                if (isset($_POST['user_id'])) {
                    $report->insert($_POST);
                    unset($_POST['user_id']);
                    redirect('customer/orders');
                    show($_POST);
                }
            }

            if (isset($_POST['cancelOrder'])) {
                $order_id = $_POST['order_id'];
                $arrOrder = ['order_status' => 'cancelled'];
                $update1 = $order->update($order_id, $arrOrder, 'order_id');
                redirect('customer/orders');
            }
        } else {
            redirect('home');
        }
    }

    public function payment_process()
    {
        // echo $_POST['id'];4
        if ($_SESSION['USER']->id != $_POST['user'] || $_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || $_SESSION['USER']->user_status != 'customer') {

            $arr['isvalid'] = false;
            echo json_encode($arr);
            return;
        }


        $order = new Order;
        $orderMaterial = new OrderMaterial;
        $printingType = new PrintingType;
        $materialStock = new MaterialStock;
        $user = new User;

        $all_id = "";

        foreach ($_POST['id'] as $key => $id) {
            if ($all_id == "") {
                $all_id = $id;
            } else {

                $all_id .= ", " . $id;
            }
        }

        //foreach ($_POST['id'] as $key => $id) {

        //}

        // get only first order id data for pass to the payhere
        $findOrder = $order->first(['order_id' => $_POST['id'][0]]);


        $orderMaterialData = $orderMaterial->first(['order_id' => $_POST['id'][0]]);

        $userData = $user->first(['id' => $_POST['user']]);

        $orderPrintingType = $printingType->first(['ptype_id' => $orderMaterialData->ptype_id]);
        $orderMaterialStockType = $materialStock->first(['stock_id' => $orderMaterialData->material_id]);


        $ishalf = "";
        // check payment is half or not
        if ($_POST['ishalf'] == "true") {

            $ishalf = "Half ";
            $amount =  $_POST['total'] / 2;
        } else {
            $amount =  $_POST['total'];
        }


        $merchant_id = "1225460";
        $merchant_secret = "MzAzMzgwMzY2MzEyMzU2MzU5Njk4MTU2MTI5NTMzMzYzMTMyMzY2";

        // $merchant_id = "1226367";
        // $merchant_secret = "NDA4NDUyMjEzMjIyNDQ2NTA0OTY0MDA4NTQ4MDI4MzEwNDgyMDQ3NQ==";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $all_id  .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $arr = [];

        $namesArray = explode(' ', $userData->fullname);

        $first_name = $namesArray[0];
        $last_name = $namesArray[1];

        $arr['first_name'] = $first_name;

        // if fullname have more than one name elements then add it for last name
        if (count($namesArray) >= 2) {

            $arr['last_name'] =  $last_name;
        } else {
            $arr['last_name'] = $userData->fullname;
        }

        $arr['merchant_id'] = $merchant_id;
        $arr['hash'] = $hash;
        $arr['currency'] = $currency;

        $arr['email'] = $userData->email;
        $arr['phone'] = $userData->phone;
        $arr['address'] = $userData->address;
        $arr['city'] = $findOrder->city;
        $arr['country'] = "Sri Lanka";

        $arr['items'] = (count($_POST['id']) == 1 ? $ishalf . " Pay For " . $orderMaterialStockType->material_type . " T-Shirt (" . $orderPrintingType->printing_type . " Printing )" : $ishalf . "Pay For Many Orders");
        $arr['amount'] =   $amount;
        $arr['order_id'] =  $all_id;

        $arr['ishalf'] =  $_POST['ishalf'];

        // $arr['data'] = $findOrder;
        // $arr['user'] = $userData;

        $json_obj = json_encode($arr);

        echo $json_obj;
    }


    public function payment_success()
    {
        if ($_SESSION['USER']->id != $_POST['user'] || $_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || $_SESSION['USER']->user_status != 'customer') {

            $arr['isvalid'] = false;
            echo json_encode($arr);
            return;
        }

        $order = new Order;

        foreach ($_POST['id'] as $key => $id) {

            $findOrder = $order->first(['order_id' => $id]);

            if ($_POST['ishalf'] == "true") {
    
                $update_data['remaining_payment'] = ($findOrder->total_price) / 2;
                $update_data['pay_type'] = "half";
                $order->update($id, $update_data, "order_id");

            }else{
                $update_data['pay_type'] = "full";
                $update_data['remaining_payment'] = 0;
                $order->update($id, $update_data, "order_id");

            }
        }

        $data['success'] = 1; 
        echo json_encode($data);
    }
}
