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
            $this->view('manager/overview', $data);
            


            if(isset($_POST['updateMaterial'])){
                // show($_POST);
                unset($_POST['updateMaterial']);
                $materialStock->update($_POST['stock_id'], $_POST, 'stock_id');
                unset($_POST);
                redirect('manager/overview');
            }

            if(isset($_POST['deleteMaterial'])){
                // show($_POST);
                unset($_POST['deleteMaterial']);
                $materialStock->delete($_POST['stock_id'], 'stock_id');
                unset($_POST);
                $data['deleteMaterial'] = 'true';
                redirect('manager/overview', $data);
            }

            if(isset($_POST['addPrintingType'])){
                // show($_POST);
                unset($_POST['addPrintingType']);
                $printingType->insert(['printing_type' => $_POST['printing_type'], 'price' => $_POST['price']]);
                $pType_data = $printingType->where(['printing_type' => $_POST['printing_type']]);
                $checkedMaterials = $_POST['PtypeMaterials'];

                $materialTypes = [];
                $stockIds = [];

                foreach($checkedMaterials as $material){
                    list($materialType, $stockId) = explode(',', $material);
                    $materialTypes[] = $materialType;
                    $stockIds[] = $stockId;
                }

                var_dump($pType_data[0]->ptype_id); // print the ptype_id

                foreach($stockIds as $stockId){
                    $result = $materialPrintingType->insert(['ptype_id' => $pType_data[0]->ptype_id, 'stock_id' => $stockId]);
                    var_dump($result); // print the result of the insert method
                }
                unset($_POST);
                redirect('manager/overview');
            }

            if(isset($_POST['updatePrintingType'])){
                // show($_POST);
                unset($_POST['updatePrintingType']);
                $printingType->update($_POST['ptype_id'], ['printing_type' => $_POST['printing_type'], 'price' => $_POST['price']], 'ptype_id');
                // $pType_data = $printingType->where(['printing_type' => $_POST['printing_type']]);
                $checkedMaterials = $_POST['PtypeMaterials'];

                $materialTypes = [];
                $stockIds = [];

                foreach($checkedMaterials as $material){
                    list($materialType, $stockId) = explode(',', $material);
                    $materialTypes[] = $materialType;
                    $stockIds[] = $stockId;
                }
                // Get all current associations for the printing type
                $currentAssociations = $materialPrintingType->where(['ptype_id' => $_POST['ptype_id']]);

                foreach($stockIds as $stockId){
                    // Check if an association for the checked material already exists
                    $existingAssociation = array_filter($currentAssociations, function($association) use ($stockId) {
                        return $association->stock_id == $stockId;
                    });

                    // If an association already exists, skip to the next iteration
                    if(!empty($existingAssociation)){
                        continue;
                    }

                    // Add the new association
                    $materialPrintingType->insert(['ptype_id' => $_POST['ptype_id'], 'stock_id' => $stockId]);
                }

                // Remove any associations that are no longer checked
                foreach($currentAssociations as $association){
                    if(!in_array($association->stock_id, $stockIds)){
                        // This association was unchecked, so remove it
                        $materialPrintingType->delete($association->mp_id, 'mp_id');
                    }
                }

                unset($_POST);
                redirect('manager/overview');
            }

            if(isset($_POST['deletePType'])){
                unset($_POST['deletePType']);
                $printingType->delete($_POST['ptype_id'], 'ptype_id');
                unset($_POST);
                $data['deletePType'] = 'true';
                redirect('manager/overview', $data);
            }
            
        }else{
            redirect('home');
        }
    }

    public function addMaterial(){
        $materialStock = new MaterialStock;

        $response = []; 
        if(isset($_POST)){
            // show($_POST);
            // unset($_POST['addMaterial']);
            $same_material = $materialStock->where(['material_type' => $_POST['material_type']]);
            if(!empty($same_material)){
                $response = 'Material already exists';
            }else{ 
                $materialStock->insert($_POST);
                unset($_POST);
                // redirect('manager/overview');
            }
            unset($_POST);
            // redirect('manager/overview');
        }
        echo json_encode($response);
    }
}
