<?php

class Overview extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $customerOrder = new Order;
        $garmentOrder = new GarmentOrder;
        $materialStock = new MaterialStock;

        if ($username != 'User') {
            $data['deleteMaterial'] = 'false';
            $data['customerOrder'] = $customerOrder->findAll('order_id');
            $data['garmentOrder'] = $garmentOrder->findAll('order_id');
            $data['materialStock'] = $materialStock->findAll('stock_id');
            $this->view('manager/overview', $data);

            if(isset($_POST['addMaterial'])){
                show($_POST);
                unset($_POST['addMaterial']);
                $materialStock->insert($_POST);
                unset($_POST);
                redirect('manager/overview');
            }

            if(isset($_POST['updateMaterial'])){
                show($_POST);
                unset($_POST['updateMaterial']);
                $materialStock->update($_POST['stock_id'], $_POST, 'stock_id');
                unset($_POST);
                redirect('manager/overview');
            }

            if(isset($_POST['deleteMaterial'])){
                show($_POST);
                unset($_POST['deleteMaterial']);
                $materialStock->delete($_POST['stock_id'], 'stock_id');
                unset($_POST);
                $data['deleteMaterial'] = 'true';
                redirect('manager/overview', $data);
            }
              
        }else{
            redirect('home');
        }
    }
}
