<?php

class Overview extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status == "garment") {


            $info = $this->getInfo();
            $data['info'] = $info;

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
}
