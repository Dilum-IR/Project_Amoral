<?php
class CustomerOverview extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;
 
        if ($username != 'User') {
            $id = ['user_id' => $_SESSION['USER']->id];
            $data['order'] = $order->where($id);
            $data['material_sizes'] = $order->getFullData($id);


            $this->view('customer/overview', $data);

        }else{
            redirect('home');
        }
    }
}
