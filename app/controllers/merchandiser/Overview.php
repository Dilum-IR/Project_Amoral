<?php

class Overview extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $customerOrder = new Order;
        $garmentOrder = new GarmentOrder;
        $materialStock = new MaterialStock;
        $printingType = new PrintingType;
        $materialPrintingType = new MaterialPrintingType;

        // show($_SESSION);

        if ($username != 'User' && $_SESSION['USER']->emp_status === 'merchandiser') {
            $data['deleteMaterial'] = 'false';
            $data['deletePType'] = 'false';
            $data['customerOrder'] = $customerOrder->findAll_withLOJ('garment_order', 'order_id', 'order_id');
            $data['pendingOrders'] = $customerOrder->where(['order_status' => 'pending']);
            $data['material_sizes'] = $customerOrder->getFullData();
            $data['garmentOrder'] = $garmentOrder->where(['emp_id' => $_SESSION['USER']->emp_id]);
            $data['materialStock'] = $materialStock->findAll('stock_id');
            $data['printingType'] = $printingType->findAll('ptype_id');
            // $data['materialPrintingType'] = [];
            // $allMaterial = [];
            foreach($data['printingType'] as $ptype){
                $material = $materialPrintingType->find_withInner(['ptype_id' => $ptype->ptype_id], 'material_stock', 'stock_id', 'stock_id');
                if (is_array($material)) {
                    foreach($material as $mat){
                        $data['materialPrintingType'][$ptype->ptype_id][] = [$mat->material_type, $mat->stock_id];
                    }
                    
                }
            }
            // show($data['materialPrintingType']);
            // show($data['materialPrintingType']);
            // show($data);
            $this->view('merchandiser/overview', $data);
            
        }else{
            redirect('home');
        }
    }


    public function updateMaterial(){
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $materialStock = new MaterialStock;

        $response = [];
        if(isset($_POST) && $username != 'User' && $_SESSION['USER']->emp_status === 'merchandiser'){
            // show($_POST);
            // unset($_POST['updateMaterial']);
            $response = $materialStock->update($_POST['stock_id'], $_POST, 'stock_id');
            unset($_POST);
            // redirect('manager/overview');
        }
        echo json_encode($response);	
    }

    
}
