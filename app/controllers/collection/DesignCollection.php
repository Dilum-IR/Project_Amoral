<?php

class DesignCollection extends Controller{
    public function Index()
    {
        // $data['data']=$this->getCollection();
        $collection = new Collection;

        $result = $collection->findAll('image_id');
        $data = ['data' => $result];
        // show($data);
        $this->view('collection/collection', $data);

    }

    public function newOrder(){
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;
        $order_material = new OrderMaterial;
    
    

        $response = [];

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && $username != 'User' && $_SESSION['USER']->user_status === 'customer') {
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

            $order_data = $order->findLast();
            $prev_order = $order_data[0]->order_id;


            $dispatch_date = $_POST['dispatch_date_delivery'] ? $_POST['dispatch_date_delivery'] : $_POST['dispatch_date_pickup'];
            $pdf = $_POST['img'];
            $img1 = '';
            $img2 = '';

          




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
            // $tot = count($_POST['material']);
            // show($tot);
            
                $material = $_POST['material'];
                $sleeve = $_POST['sleeve'];
                $pType = $_POST['printing_type'];
                $unit_price = $_POST['unit_price'];
                $xs = $_POST['xs'];
                $small = $_POST['small'];
                $medium = $_POST['medium'];
                $large = $_POST['large'];
                $xl = $_POST['xl'];
                $xxl = $_POST['xxl'];

                // $material_data = $materials->where(['material_type' => $material]);
                // $sleeve_data = $sleeveType->where(['type' => $sleeve]);
                // $printingType_data = $printingType->where(['printing_type' => $pType]);
                // show($material);
                $response = $order_material->insert([
                    'order_id' => $order_id,
                    'material_id' => $material,
                    'sleeve_id' => $sleeve,
                    'ptype_id' => $pType,
                    'unit_price' => $unit_price,
                    'xs' => $xs,
                    'small' => $small,
                    'medium' => $medium,
                    'large' => $large,
                    'xl' => $xl,
                    'xxl' => $xxl
                ]);
                // show($insert2);
            

            unset($_POST);
        }

        echo json_encode($response);
    }


}