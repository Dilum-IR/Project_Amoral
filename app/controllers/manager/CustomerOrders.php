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

        if ($username != 'User') {

            $data['orders'] = $order->findAll('order_id');
            $data['customers'] = $customer->findAll();
            $data['material_sizes'] = $order->getFullData();
            $data['materials'] = $materials->getMaterialNames();
            $data['material_prices'] = $materials->findAll('stock_id');
            $data['sleeveType'] = $sleeveType->findAll('sleeve_id');
            $data['material_printingType'] = $material_printingType->getFullData();	
            $data['printingType'] = $printingType->findAll('ptype_id');
            
            $this->view('manager/customerorders', $data);

            if (isset($_POST['updateOrder'])){
                $order_id = $_POST['order_id'];
                // show($_POST);
                unset($_POST['updateOrder']);

                if(isset($_POST['latitude']) && $_POST['longitude']){
                    $_POST['is_delivery'] = 1;
                }else{
                    $_POST['is_delivery'] = 0;
                }
                
                $dispatch_date = $_POST['dispatch_date_delivery'] ? $_POST['dispatch_date_delivery'] : $_POST['dispatch_date_pickup'];
            

                $arrOrder = ['order_status' => $_POST['order_status'], 'total_price' => $_POST['total_price'], 'dispatch_date'=>$dispatch_date,
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

                unset($_POST);
                // redirect('customer/orders');
            }
              
        }else{
            redirect('home');
        }
    }
}