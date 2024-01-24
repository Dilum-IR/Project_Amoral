<?php

class Quotation extends Controller
{
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
            $data= $order->where($id);
            

            // show($data);
            // show($id);            
            



            if (isset($_POST['updateOrder'])){
                $order_id = $_POST['order_id'];
                show($_POST);
                unset($_POST['updateOrder']);
                

                    // profile picture uploading
                    if (isset($_FILES['image'])) {

                        $img_name = $_FILES['image']['name'];
                        $tmp_name = $_FILES['image']['tmp_name'];
                        $error = $_FILES['image']['error'];


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
                                $new_img_name = $username . "-" . $order_id . "." . $img_ex_lc;

                                // creating upload path on root directory
                                $img_upload_path = $_SERVER['DOCUMENT_ROOT'] . "/Project_Amoral/public/uploads/designs/"  . $new_img_name;

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
                   
                    $update = $order->update($order_id, $_POST, 'order_id');
                    unset($_POST);
                    redirect('customer/quotation');
                }
            
            $errors = [];

            $this->view('customer/quotation', $data);

            if ( isset($_POST['newQuotation']) && $_POST['newQuotation'] === 'newQuotation' && $_SERVER['REQUEST_METHOD'] === 'POST'){
                //need to validate
                // show($_POST['newQuotation']);
 
                    unset($_POST['newQuotation']);
                    // $_SESSION['newQuotation'] = null;
                    $_POST['user_id'] = $id['user_id'];
                    $_POST['order_placed_on'] = date('Y-m-d');
                    $_POST['order_status'] = 'Quotation';
                    $_POST['is_quotation'] = 1;
            
                   
                        $targetdir = ROOT.'/uploads/designs/';
                        $targetfile = $targetdir . basename($_FILES['image']['name']);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

                        $check = getimagesize($_FILES['image']['tmp_name']);
                        if($check == false){
                            $errors['image'] = 'File is not an image.';
                            $uploadOk = 0;
                        }

                        if(file_exists($targetfile)){
                            $errors['image'] = 'File already exists.';
                            $uploadOk = 0;
                        }

                        if($_FILES['image']['size'] > 500000){
                            $errors['image'] = 'File is too large.';
                            $uploadOk = 0;
                        }

                        $allowedTypes = ['jpg', 'jpeg', 'png'];
                        if(!in_array($imageFileType, $allowedTypes)){
                            $errors['image'] = 'File type not allowed.';
                            $uploadOk = 0;
                        }

                        if($uploadOk == 0){
                            $errors['image'] = 'File not uploaded.';
                        }else{
                            if(move_uploaded_file($_FILES['image']['tmp_name'], $targetfile)){
                                $_POST['image'] = basename($_FILES['image']['name']);
                            }else{
                                $errors['image'] = 'File not uploaded.';
                            }
                        }
                    

                    if(isset($_POST['user_id'])){

                        echo "fdgfdddggggggggggggggggffffffffffffffffffffffffgffffggf";

                        $order->insert($_POST);

                        $keys = array_keys($_POST);
                        // show($keys);
                        
                        foreach ($keys as $key) {
                            unset($_POST[$key]);
                        }

                        show($_POST);

                        unset($order);

                        // redirect('customer/quotation');
                        // exit();
                        die();

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
