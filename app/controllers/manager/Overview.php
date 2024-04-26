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

        if ($username != 'User' && $_SESSION['USER']->emp_status === 'manager') {
            $data['deleteMaterial'] = 'false';
            $data['deletePType'] = 'false';
            $data['customerOrder'] = $customerOrder->findAll('order_id');
            $data['material_sizes'] = $customerOrder->getFullData();
            $data['garmentOrder'] = $garmentOrder->findAll('order_id');
            $data['materialStock'] = $materialStock->findAll('stock_id');
            $data['printingType'] = $printingType->findAll('ptype_id');
            // $data['materialPrintingType'] = [];
            // $allMaterial = [];
            foreach ($data['printingType'] as $ptype) {
                $material = $materialPrintingType->find_withInner(['ptype_id' => $ptype->ptype_id], 'material_stock', 'stock_id', 'stock_id');
                if (is_array($material)) {
                    foreach ($material as $mat) {
                        $data['materialPrintingType'][$ptype->ptype_id][] = [$mat->material_type, $mat->stock_id];
                    }
                }
            }

            // for chart and analysis
            $overview = $this->overview();
            
            $data['overview'] = $overview;

            // for chart and analysis
            

            show($data);

            // $this->genarate_report();

            // show($data['materialPrintingType']);
            // show($data['materialPrintingType']);
            $this->view('manager/overview', $data);
        } else {
            redirect('home');
        }
    }

    public function addMaterial()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $materialStock = new MaterialStock;

        $response = [];
        if (isset($_POST) && $username != 'User' && $_SESSION['USER']->emp_status === 'manager') {
            // show($_POST);
            // unset($_POST['addMaterial']);
            $same_material = $materialStock->where(['material_type' => $_POST['material_type']]);
            if (!empty($same_material)) {
                $response = 'Material already exists';
            } else {
                $response = $materialStock->insert($_POST);

                // unset($_POST);
                // redirect('manager/overview');
            }
            unset($_POST);
            // redirect('manager/overview');
        }
        echo json_encode($response);
    }

    public function deleteMaterial()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $materialStock = new MaterialStock;

        $response = [];
        if (isset($_POST) && $username != 'User' && $_SESSION['USER']->emp_status === 'manager') {
            // show($_POST);
            // unset($_POST['deleteMaterial']);
            $response = $materialStock->delete($_POST['stock_id'], 'stock_id');
            unset($_POST);
            // redirect('manager/overview');
        }
        echo json_encode($response);
    }

    public function updateMaterial()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $materialStock = new MaterialStock;

        $response = [];
        if (isset($_POST) && $username != 'User' && $_SESSION['USER']->emp_status === 'manager') {
            // show($_POST);
            // unset($_POST['updateMaterial']);
            $response = $materialStock->update($_POST['stock_id'], $_POST, 'stock_id');
            unset($_POST);
            // redirect('manager/overview');
        }
        echo json_encode($response);
    }

    public function addPrintingType()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $printingType = new PrintingType;
        $materialPrintingType = new MaterialPrintingType;

        $response = [];

        if (isset($_POST) && $username != 'User' && $_SESSION['USER']->emp_status === 'manager') {
            // show($_POST);
            // unset($_POST['addPrintingType']);
            $same_pType = $printingType->where(['printing_type' => $_POST['printing_type']]);
            if (!empty($same_pType)) {
                $response = 'Printing type already exists';
            } else {

                $result = $printingType->insert(['printing_type' => $_POST['printing_type'], 'price' => $_POST['price']]);
                $pType_data = $printingType->where(['printing_type' => $_POST['printing_type']]);
                $checkedMaterials = $_POST['PtypeMaterials'];

                $materialTypes = [];
                $stockIds = [];

                foreach ($checkedMaterials as $material) {
                    list($materialType, $stockId) = explode(',', $material);
                    $materialTypes[] = $materialType;
                    $stockIds[] = $stockId;
                }

                // var_dump($pType_data[0]->ptype_id); // print the ptype_id

                if ($result == false) {
                    foreach ($stockIds as $stockId) {
                        $response = $materialPrintingType->insert(['ptype_id' => $pType_data[0]->ptype_id, 'stock_id' => $stockId]);
                        // var_dump($result); // print the result of the insert method
                    }
                }
            }
            unset($_POST);

            echo json_encode($response);

            // redirect('manager/overview');
        }
    }

    public function deletePrintingType()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $printingType = new PrintingType;

        $response = [];
        if (isset($_POST) && $username != 'User' && $_SESSION['USER']->emp_status === 'manager') {
            // unset($_POST['deletePType']);
            $response = $printingType->delete($_POST['ptype_id'], 'ptype_id');
            unset($_POST);
        }

        echo json_encode($response);
    }

    public function updatePrintingType()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $printingType = new PrintingType;
        $materialPrintingType = new MaterialPrintingType;

        $response = [];

        if (isset($_POST) && $username != 'User' && $_SESSION['USER']->emp_status === 'manager') {
            // show($_POST);
            // unset($_POST['updatePrintingType']);
            $result = $printingType->update($_POST['ptype_id'], ['printing_type' => $_POST['printing_type'], 'price' => $_POST['price']], 'ptype_id');
            // $pType_data = $printingType->where(['printing_type' => $_POST['printing_type']]);
            $checkedMaterials = $_POST['PtypeMaterials'];

            $materialTypes = [];
            $stockIds = [];

            foreach ($checkedMaterials as $material) {
                list($materialType, $stockId) = explode(',', $material);
                $materialTypes[] = $materialType;
                $stockIds[] = $stockId;
            }
            // Get all current associations for the printing type
            $currentAssociations = $materialPrintingType->where(['ptype_id' => $_POST['ptype_id']]);

            foreach ($stockIds as $stockId) {
                // Check if an association for the checked material already exists
                $existingAssociation = array_filter($currentAssociations, function ($association) use ($stockId) {
                    return $association->stock_id == $stockId;
                });

                // If an association already exists, skip to the next iteration
                if (!empty($existingAssociation)) {
                    continue;
                }

                // Add the new association
                $response = $materialPrintingType->insert(['ptype_id' => $_POST['ptype_id'], 'stock_id' => $stockId]);
            }

            // Remove any associations that are no longer checked
            foreach ($currentAssociations as $association) {
                if (!in_array($association->stock_id, $stockIds)) {
                    // This association was unchecked, so remove it
                    $materialPrintingType->delete($association->mp_id, 'mp_id');
                }
            }

            unset($_POST);
            // redirect('manager/overview');
        }

        echo json_encode($response);
    }


    private function overview()
    {

        $order = new Order;
        // get data from database
        $alldata = $order->getAllOrderData(['order_status'=>'completed']);
        // that data re-structred
        $new_result = $order->get_order_data($alldata);
    
        // show($data);

        //find not compleated orders where login garments
        // not compleated mean that orders are given but processing that is relevent garments
        $data['status1'] = "completed";
        $data['status2'] = "canceled";
        $data['status3'] = "delivered";


        $current = $order->whereAndOR([], $data);

        if ($current != false)

            $overview['current'] = $current[0]->current_orders;
        else
            $overview['current'] = 0;



        // find the count of the cancel orders
        $arr['order_status'] =  "canceled";

        $cancel_orders = $order->where($arr);

        if ($cancel_orders != false)

            $overview['cancel_orders'] = count($cancel_orders);
        else
            $overview['cancel_orders'] = 0;

        // $overview['sales']  = $this->calculateSales($new_result);

        return $overview;
    }


    public function genarate_report()
    {
        try {

            $arr = [];
            if (!isset($_POST['emp_id']) || $_SESSION['USER']->emp_status != "manager" || $_SESSION['USER']->emp_id != $_POST['emp_id']) {
                $arr['user'] = false;

                echo json_encode($arr);
                exit;
            }

            $fromDate = $_POST['from_date'];
            $toDate = $_POST['to_date'];

            $fromDateTS = strtotime($fromDate);
            $toDateTS = strtotime($toDate);
            
            $order = new Order;
            // get data from database
            $alldata = $order->getAllOrderData(['order_status'=>'completed']);
            // that data re-structred
            $new_result = $order->get_order_data($alldata);
    
            $final_result = [];
            foreach ($new_result as $key => $value) {
                // need to change with compleated date
                $valueTSnew = strtotime($value->delivered_date);

                // get the each garment orders only then validate with compleated and date duration
                if (($fromDateTS <= $valueTSnew) && ($toDateTS >= $valueTSnew)) {
                    array_push($final_result, $value);
                }
            }

            // show($new_result);

            echo json_encode($final_result);

        } catch (\Throwable $th) {
            $arr['user'] = false;

            echo json_encode($arr);
            exit;
        }
    }
}
