<?php

class CustomerOrders extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;
        $materials = new MaterialStock;
        $order_material = new OrderMaterial;
        $customer = new User;
        $sleeveType = new Sleeves;
        $material_printingType = new MaterialPrintingType;
        $printingType = new PrintingType;
        $garment_order = new GarmentOrder;
        $employee = new Employee;

        if ($username != 'User' && $_SESSION['USER']->emp_status === 'manager') {

            // show($_SESSION['USER']->emp_id);


            $data['orders'] = $order->findAll('order_id');
            $data['customers'] = $customer->findAll();
            $data['customer_and_garment_orders'] = $order->findAll_withLOJ('garment_order', 'order_id', 'order_id');
            $data['material_sizes'] = $order->getFullData();
            $data['materials'] = $materials->getMaterialNames();
            $data['material_prices'] = $materials->findAll('stock_id');
            $data['sleeveType'] = $sleeveType->findAll('sleeve_id');
            $data['material_printingType'] = $material_printingType->getFullData();	
            $data['printingType'] = $printingType->findAll('ptype_id');
            $data['employee'] = $employee->findAll('emp_id');
            // show($data);
            $this->view('manager/customerorders', $data);

            
              
        }else{
            redirect('home');
        }
    }

    public function newOrder(){
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;
        $materials = new MaterialStock;
        $order_material = new OrderMaterial;
        $customer = new User;
        $sleeveType = new Sleeves;
        $material_printingType = new MaterialPrintingType;
        $printingType = new PrintingType;
        $garment_order = new GarmentOrder;

        $response = [];

        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");

        if ( isset($_POST) && $username != 'User' && $_SESSION['USER']->emp_status === 'manager'){
            // show($_POST);
            //need to validate
            // unset($_POST['newOrder']);



            if(isset($_POST['latitude']) && $_POST['longitude']){
                $_POST['is_delivery'] = 1;
            }else{
                $_POST['is_delivery'] = 0;
            }

            $dispatch_date = $_POST['dispatch_date_delivery'] ? $_POST['dispatch_date_delivery'] : $_POST['dispatch_date_pickup'];
            $pdf = '';
            $img1 = '';
            $img2 = '';

            $order_data = $order->findLast();
            $prev_order = $order_data[0]->order_id;

            // var_dump($_FILES);

            if ($_FILES['pdf']['error'] === 0) {
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
                        $new_img_name = "ORD-" . $prev_order + 1 . "-" . uniqid() . "." . $img_ex_lc;

                        // creating upload path on root directory
                        $img_upload_path = $_SERVER['DOCUMENT_ROOT'] . "/Project_Amoral/public/uploads/designs/"  . $new_img_name;

                        // move upload image for that folder
                        
                            move_uploaded_file($tmp_name, $img_upload_path);
                            $pdf = $new_img_name;
                        


                    } 
                }
            }else if($_FILES['image1']['error'] === 0 && $_FILES['image2']['error'] === 0){

                    $img_name1 = $_FILES['image1']['name'];
                    $tmp_name1 = $_FILES['image1']['tmp_name'];
                    $error1 = $_FILES['image1']['error'];

                    $img_name2 = $_FILES['image2']['name'];
                    $tmp_name2 = $_FILES['image2']['tmp_name'];
                    $error2 = $_FILES['image2']['error'];

                    // var_dump($error1);

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
                        // if (in_array($img_ex_lc1, $allowed_exs) && in_array($img_ex_lc2, $allowed_exs)) {

                            // image name username with image name
                            $new_img_name1 = "ORD-" . $prev_order + 1 . "-" . uniqid() . "-01." . $img_ex_lc1;
                            $new_img_name2 = "ORD-" . $prev_order + 1 . "-" . uniqid() . "-02." . $img_ex_lc2;

                            // creating upload path on root directory
                            $img_upload_path1 = $_SERVER['DOCUMENT_ROOT'] . "/Project_Amoral/public/uploads/designs/"  . $new_img_name1;
                            $img_upload_path2 = $_SERVER['DOCUMENT_ROOT'] . "/Project_Amoral/public/uploads/designs/"  . $new_img_name2;


                            // move upload image for that folder
                            // var_dump($img_upload_path1);
                            move_uploaded_file($tmp_name1, $img_upload_path1);
                            move_uploaded_file($tmp_name2, $img_upload_path2);

                            $img1 = $new_img_name1;
                            $img2 = $new_img_name2;


                        // }
                    }
                

            }
            


            
            // show($_POST['total_price']);
            $arrOrder = ['user_id' => $_POST['id'], 'discount' => $_POST['discount'], 'total_price' => $_POST['total_price'], 'dispatch_date'=>$dispatch_date, 'order_placed_on' => $current_date, 
                'order_status' => 'pending', 'city' => $_POST['city'], 'pdf' => $pdf, 'image1' => $img1, 'image2' => $img2, 
                'is_delivery' => $_POST['is_delivery'], 'latitude' => $_POST['latitude'], 'longitude' => $_POST['longitude']];
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
                $response = $order_material->insert([
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
            unset($_POST);

            // redirect('customer/orders');
        }
        echo json_encode($response);
    }

    public function updateOrder(){

   
        $order = new Order;
        $materials = new MaterialStock;
        $order_material = new OrderMaterial;
        $customer = new User;
        $sleeveType = new Sleeves;
        $material_printingType = new MaterialPrintingType;
        $printingType = new PrintingType;
        $garment_order = new GarmentOrder;

        
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d");

        $arr = [];

        if (isset($_POST) && $_SESSION['USER']->emp_status === 'manager'){
            $arr['user'] = false;
            $order_id = $_POST['order_id'];
            // show($_POST);
            // unset($_POST['updateOrder']);
            
            if(isset($_POST['latitude']) && $_POST['longitude']){
                $_POST['is_delivery'] = 1;
            }else{
                $_POST['is_delivery'] = 0;
            }
            
            if((($_POST['order_status'] == 'pending') && $_POST['pay_type'] == 'no') ){
            
                $dispatch_date = $_POST['dispatch_date_delivery'] ? $_POST['dispatch_date_delivery'] : $_POST['dispatch_date_pickup'];
                
                $arrOrder = ['order_status' => $_POST['order_status'], 'discount' => $_POST['discount'], 'total_price' => $_POST['total_price'], 'dispatch_date'=>$dispatch_date,
                    'city' => $_POST['city'],
                    'is_delivery' => $_POST['is_delivery'], 'latitude' => $_POST['latitude'], 'longitude' => $_POST['longitude']];
                    
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

                // insert a garment order if the order status is cutting
                // show($_SESSION['USER']->id);
                $current_orders = $garment_order->where(['order_id' => $order_id]);
                // show($current_orders);

                if($_POST['order_status'] == 'cutting' && empty($current_orders)){
                    // $garment_order = new GarmentOrder;
                    $garment_order->insert(['order_id' => $order_id, 'emp_id' => $_SESSION['USER']->emp_id, 'status' => 'pending' ]);
                }
                $order->update($order_id, $arrOrder, 'order_id');
                $arr['user'] = true;
            }else if($_POST['order_status'] == 'completed' || $_POST['order_status'] == 'refunded'){

                $current_date = date("Y-m-d");
                $arrOrder = ['order_status' => $_POST['order_status'], 'delivered_date' => $current_date, 'refundable' => 0];
                
                $order->update($order_id, $arrOrder, 'order_id');
                $arr['user'] = true;
            }else{
                $dispatch_date = $_POST['dispatch_date_delivery'] ? $_POST['dispatch_date_delivery'] : $_POST['dispatch_date_pickup'];
                $arrOrder = ['order_status' => $_POST['order_status'], 'dispatch_date'=>$dispatch_date,
                'city' => $_POST['city'],
                'is_delivery' => $_POST['is_delivery'], 'latitude' => $_POST['latitude'], 'longitude' => $_POST['longitude'], 'refundable' => 0];
                
                // insert a garment order if the order status is cutting
                // show($_SESSION['USER']->id);
                $current_orders = $garment_order->where(['order_id' => $order_id]);
                // show($current_orders);

                if($_POST['order_status'] == 'cutting' && empty($current_orders)){
                    // $garment_order = new GarmentOrder;
                    $garment_order->insert(['order_id' => $order_id, 'emp_id' => $_SESSION['USER']->emp_id, 'status' => 'pending' ]);
                }
                $order->update($order_id, $arrOrder, 'order_id');
                $arr['user'] = true;
            }

            unset($_POST);
            // redirect('customer/orders');

        }

        echo json_encode($arr);
    }

    public function cancelOrder(){
        $order = new Order;
        $garment_order = new GarmentOrder;

        $arr = [];

        if (isset($_POST) && $_SESSION['USER']->emp_status === 'manager'){
            $arr['user'] = false;
            $order_id = $_POST['order_id'];
            // show($_POST);
            // unset($_POST['updateOrder']);
            
            $arrOrder = ['order_status' => 'canceled'];
            
            $order->update($order_id, $arrOrder, 'order_id');
            $relevant_garment_order = $garment_order->where(['order_id' => $order_id]);
            // show($relevant_garment_order);
            if(!empty($relevant_garment_order)){
                $garment_order->update($relevant_garment_order[0]->garment_order_id, ['status' => 'canceled'], 'garment_order_id');
            }
            $arr['user'] = true;
            unset($_POST);

        }

        echo json_encode($arr);
    }

    public function cancelReason(){
        $order = new Order;
        $garment_order = new GarmentOrder;

        $arr = [];

        if (isset($_POST) && $_SESSION['USER']->emp_status === 'manager'){
            $arr['user'] = false;
            $order_id = $_POST['order_id'];
            // show($_POST);
            // unset($_POST['updateOrder']);
            
            $arrOrder = ['order_status' => 'canceled', 'canceled_reason' => $_POST['canceled_reason']];
            
            $order->update($order_id, $arrOrder, 'order_id');
            $relevant_garment_order = $garment_order->where(['order_id' => $order_id]);
            // show($relevant_garment_order);
            if(!empty($relevant_garment_order)){
                $garment_order->update($relevant_garment_order[0]->garment_order_id, ['status' => 'canceled'], 'garment_order_id');
            }
            $arr['user'] = true;
            unset($_POST);

        }

        echo json_encode($arr);
        
    }

}