<?php

class Quotation extends Controller{
    public function index()
    {
  
        // $order = new Order;

        // // show($_POST);
        // if (isset($_POST['newQuotation'])){
        //     //need to validate
        //         unset($_POST['newQuotation']);
        //         $order->insert($_POST);
        //         redirect('customer/quotation');
        // }

        // $this->view('customer/quotation');

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        
        $order = new Order;
        
        if ($username != 'User') {
            $id = ['user_id' => $_SESSION['USER']->id];
            $data = $order->where($id);


            
            $this->view('customer/quotation', $data);

            $errors = [];

            if (isset($_POST['newQuotation']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
                //need to validate
 
                    unset($_POST['newQuotation']);
                    $_POST['user_id'] = $id['user_id'];
                    $_POST['order_placed_on'] = date('Y-m-d');
                    $_POST['order_status'] = 'Quotation';
                    $_POST['is_quotation'] = 1;

                    // $folder = ROOT . 'uploads/images';
                    

                    // $allowed = ['image/jpeg', 'image/jpg'];
                    // show($_FILES['image']);die;

                    // if(!empty($_FILES['image']['name'])){
                    //     if($_FILES['image']['error'] == 0){
                    //         if(in_array($_FILES['image']['type'], $allowed)){
                    //             $destination = $folder. '/' . time(). '_' . basename($_FILES['image']['name']);
                    //             console_log($destination);
                    //             move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                    //             $_POST['image'] = $destination;
                    //         }else{
                    //             $errors[] = 'File type not allowed';
                    //         }
                    //     }else{
                    //         $errors[] = 'File not uploaded';
                    //     }
                    // }

                    if(isset($_POST['user_id'])){
                        show($_POST);
                        $order->insert($_POST);
                        unset($_POST['user_id']);
                        redirect('customer/quotation');
                    }
            }            

            if (isset($_POST['report'])) {
                

                $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
                if (empty($description)) {
                    $errors[] = 'Description is required.';
                }
            
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                if (empty($email)) {
                    $errors[] = 'Email is required.';
                } 
                elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = 'Email is not valid.';
                }
        
                if (empty($errors)) {
                    $report = new CustomerReport;
    
                    unset($_POST['report']);
                    
                    $_POST['user_id'] = $id['user_id'];
    
                    $_POST['report_date'] = date('Y-m-d');
                    
                    if (isset($_POST['user_id'])) {
        
                        $report->insert($_POST);
                        unset($_POST['user_id']);
                        // redirect('customer/orders');
        
                    }                
                } else {
             
                    foreach ($errors as $error) {
                        echo $error . '<br>';
                    }
                }
            }else{
      
            }
        } else {
            redirect('home');
        }
    }
}