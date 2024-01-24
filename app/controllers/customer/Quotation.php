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
                unset($_POST['newQuotation']);
                $_POST['user_id'] = $_SESSION['USER']->id;
                $_POST['order_status'] = "quotation";
                // show($_POST);
                $order->insert($_POST);
                redirect('customer/quotation');
        }

            $this->view('customer/quotation');
        } else {
            redirect('home');
        }
    }
}
