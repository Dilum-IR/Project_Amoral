<?php

class Overview extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status == "garment") {


            $info = $this->getInfo();
            $overview = $this->overview();
            $recent_orders = $this->recent_orders();

            $data['info'] = $info;
            $data['overview'] = $overview;
            $data['recent_orders'] = $recent_orders;

            // show($data);

            $this->view('garment/overview', $data);
        } else {
            redirect('home');
        }
    }

    private function getInfo()
    {

        $garment = new Garment();

        $id['garment_id'] = $_SESSION['USER']->emp_id;
        return $garment->first($id);
    }

    public function updateInfo()
    {

        $garment = new Garment();

        $data = $this->getInfo();

        if ($data->no_workers == $_POST['no_workers'] && $data->day_capacity == $_POST['day_capacity']) {
            echo json_encode(['u' => "no"]);
            return;
        }

        $garment->update($_SESSION['USER']->emp_id, $_POST, 'garment_id');

        echo json_encode(['u' => "yes"]);
    }

    private function recent_orders()
    {
        $garment = new GarmentOrder;

        $rec_orders =  $garment->where(['garment_id' => $_SESSION['USER']->emp_id]);

        // sort orders in descending order 
        rsort($rec_orders);

        // Extract the first 10 elements
        $first_10_elements = array_slice($rec_orders, 0, 10);

        return $first_10_elements;
    }
    private function overview()
    {

        $garment = new GarmentOrder;

        $data['status'] = "completed";
        $data['garment_id'] = $_SESSION['USER']->emp_id;

        $completed = array();
        $completed = $garment->where($data);

        if ($completed != false)

            $overview['completed'] = count($completed);
        else
            $overview['completed'] = 0;


        unset($data['garment_id']);
        $current = $garment->where(['garment_id' => $_SESSION['USER']->emp_id], $data);

        if ($current != false)

            $overview['current'] = count($current);
        else
            $overview['current'] = 0;

        return $overview;
    }
}
