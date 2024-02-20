<?php

class Quotation extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;

        $order_material = new OrderMaterial;
        $quotation_reply = new QuotationReply;
        $materials = new MaterialStock;
        $sleeveType = new Sleeves;
        $material_printingType = new MaterialPrintingType;
        
        if ($username != 'User') {
            $id = ['user_id' => $_SESSION['USER']->id];
            $data['quotation']= $order->where($id);
            $data['material_sizes'] = $order->getFullData($id);
            $data['quotation_reply'] = $quotation_reply->getReplyDetails($id);
            $data['materials'] = $materials->getMaterialNames();
            $data['sleeveType'] = $sleeveType->findAll('sleeve_id');
            $data['material_printingType'] = $material_printingType->getFullData();	
            // show($data['material_printingType']);
            // show($data['material_sizes']);
            // show($data);
            // show($id);            
            
            $this->view('customer/quotation', $data);



            if (isset($_POST['updateOrder'])) {
                $order_id = $_POST['order_id'];
                // show($_POST);
                unset($_POST['updateOrder']);

                if(isset($_POST['latitude']) && $_POST['longitude']){
                    $_POST['is_delivery'] = 1;
                }else{
                    $_POST['is_delivery'] = 0;
                }
                
                $dispatch_date = $_POST['dispatch_date_delivery'] ? $_POST['dispatch_date_delivery'] : $_POST['dispatch_date_pickup'];

                if (isset($_FILES['pdf'])) {
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
                }else if(isset($_FILES['image1']) && isset($_FILES['image2'])){

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


                            // convet to image extetion into lowercase and store it in variable
                            $img_ex_lc = strtolower($img_ex);

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


                                // move upload image for that folder

                                move_uploaded_file($tmp_name, $img_upload_path);
                                $_POST['image'] = $new_img_name;
                            } else {
                                $em = "You can't upload files of this type!";
                                header("Location:../../signup.php?error=$em&$data");
                                exit;
                            }

                    

                        }
                }
            

                $arrOrder = ['user_id' => $_SESSION['USER']->id, 'dispatch_date'=>$dispatch_date, 
                    'city' => $_POST['city'], 'pdf' => $pdf, 'image1' => $img1, 'image2' => $img2, 
                    'is_delivery' => $_POST['is_delivery'], 'latitude' => $_POST['latitude'], 'longitude' => $_POST['longitude']];
            
                
                $update1 = $order->update($order_id, $arrOrder, 'order_id');
                // show($update1);
                // show($_POST['material']);

                for ($i = 0; $i < count($_POST['material']); $i++) {
                    $material = $_POST['material'][$i];
                    $xs = $_POST['xs'][$i];
                    $small = $_POST['small'][$i];
                    $medium = $_POST['medium'][$i];
                    $large = $_POST['large'][$i];
                    $xl = $_POST['xl'][$i];
                    $xxl = $_POST['xxl'][$i];

                    $material_data = $materials->where(['material_type' => $material]);
                    // show($material_data);
                    $update2 = $order_material->updateOrderMaterial((object)array(
                        'order_id' => $order_id,
                        'material_id' => $material_data[0]->stock_id),
                        [
                            'xs' => $xs,
                            'small' => $small,
                            'medium' => $medium,
                            'large' => $large,
                            'xl' => $xl,
                            'xxl' => $xxl
                        ]);

                    // show($update2);
                }

                unset($_POST);
                redirect('customer/quotation');
            }
            


            


            if ( isset($_POST['newQuotation']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
                // show($_POST);
                //need to validate
                unset($_POST['newQuotation']);


                date_default_timezone_set('Asia/Kolkata');
                $current_date = date("Y-m-d");

                if(isset($_POST['latitude']) && $_POST['longitude']){
                    $_POST['is_delivery'] = 1;
                }else{
                    $_POST['is_delivery'] = 0;
                }



                $dispatch_date = $_POST['dispatch_date_delivery'] ? $_POST['dispatch_date_delivery'] : $_POST['dispatch_date_pickup'];

                if (isset($_FILES['pdf'])) {
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
                }else if(isset($_FILES['image1']) && isset($_FILES['image2'])){

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
                


                
                $arrOrder = ['user_id' => $_SESSION['USER']->id, 'dispatch_date'=>$dispatch_date, 'order_placed_on' => $current_date, 
                    'order_status' => 'quotation', 'city' => $_POST['city'], 'pdf' => $pdf, 'image1' => $img1, 'image2' => $img2, 
                    'is_delivery' => $_POST['is_delivery'], 'is_quotation' => 1, 'latitude' => $_POST['latitude'], 'longitude' => $_POST['longitude']];
                // show($_POST['material']);
                $insert1 = $order->insert($arrOrder);
                $order_data = $order->findLast();
                $order_id = $order_data[0]->order_id;
    
                

                // Assuming $_POST['material'] and $_POST['size'] are arrays of equal length
                for ($i = 0; $i < count($_POST['material']); $i++) {
                    $material = $_POST['material'][$i];
                    $xs = $_POST['xs'][$i];
                    $small = $_POST['small'][$i];
                    $medium = $_POST['medium'][$i];
                    $large = $_POST['large'][$i];
                    $xl = $_POST['xl'][$i];
                    $xxl = $_POST['xxl'][$i];

                    $material_data = $materials->where(['material_type' => $material]);
                    // show($material_data);
                    $insert2 = $order_material->insert([
                        'order_id' => $order_id,
                        'material_id' => $material_data[0]->stock_id,
                        'xs' => $xs,
                        'small' => $small,
                        'medium' => $medium,
                        'large' => $large,
                        'xl' => $xl,
                        'xxl' => $xxl
                    ]);
                }

                redirect('customer/quotation');
            }

            if(isset($_POST['placeOrder']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
                $order_id = $_POST['order_id'];
                unset($_POST['placeOrder']);
                $arr = ['order_status' => "pending", 'is_quotation' => 0];
                $updateOrder = $order->update($order_id, $arr, 'order_id');
                redirect('customer/quotation');
            }

            if ( isset($_POST['cancelReq']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
                $order_id = $_POST['order_id'];
                $arr = ['order_status' => "cancelled"];   
                $updateCancel = $order->update($order_id, $arr, 'order_id');
            }
        }
            
        else {
            redirect('home');

        }
    }

}
}
}

