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
            foreach ($data['printingType'] as $ptype) {
                $material = $materialPrintingType->find_withInner(['ptype_id' => $ptype->ptype_id], 'material_stock', 'stock_id', 'stock_id');
                if (is_array($material)) {
                    foreach ($material as $mat) {
                        $data['materialPrintingType'][$ptype->ptype_id][] = [$mat->material_type, $mat->stock_id];
                    }
                }
            }
            // show($data['materialPrintingType']);
            // show($data['materialPrintingType']);
            // show($data);
            $this->view('merchandiser/overview', $data);


            // add new image to the collection
            if (isset($_POST["newCollection"])) {
                unset($_POST["newCollection"]);
                // show($_POST);
                $this->collectionAdd($_POST);
            }
        } else {
            redirect('home');
        }
    }


    public function updateMaterial()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $materialStock = new MaterialStock;

        $response = [];
        if (isset($_POST) && $username != 'User' && $_SESSION['USER']->emp_status === 'merchandiser') {
            // show($_POST);
            // unset($_POST['updateMaterial']);
            $response = $materialStock->update($_POST['stock_id'], $_POST, 'stock_id');
            unset($_POST);
            // redirect('manager/overview');
        }
        echo json_encode($response);
    }

    public function collectionAdd($data)
    {
        $collectionImage = new Collection;
        // show($data);

        $newImageName = $this->changeImage($data);

        $removeImage = ['image_name'];
        foreach ($removeImage as $key) {
            // $columnImage[$key] = $data[$key];
            unset($data[$key]);
        }
        // show($data);
        $data['image_name'] = $newImageName;
        $collectionImage->insert($data);
    }

    public function changeImage($data){

        $img_name = $_FILES['image_name']['name'];
        $tmp_name = $_FILES['image_name']['tmp_name'];

        if ($_FILES['image_name']['error'] == 0) {
            // show($_FILES);



            // get image extention store it in variable
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);


            // convet to image extetion into lowercase and store it in variable
            $img_ex_lc = strtolower($img_ex);

            // allowed image extetions
            $allowed_exs = array("jpg", "jpeg");

            // check the allowed extention is present user upload image
            if (in_array($img_ex_lc, $allowed_exs)) {

                // $collection = new Collection;

                // $lastImage = $collection->findLast();

                // show($lastImage);

                // $lastImageId = $lastImage[0]->image_id;

                // image name username with image name
                $new_img_name = "amoral-design - " .  uniqid() . "." . $img_ex_lc;


                // creating upload path on root directory
                // $img_upload_path = $_SERVER['DOCUMENT_ROOT'] . "/Project_Amoral/public/uploads/collection/"  . $new_img_name;
                $img_upload_path = "../../project_Amoral/public/uploads/collection/" . $new_img_name;


                // move upload image for that folder

                move_uploaded_file($tmp_name, $img_upload_path);


                // $img = $new_img_name;
                // show($img);
                // $_POST['image_name'] = $img;
                return $new_img_name;

            }
        }
    }
}
