<?php
class CustomerOverview extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        
        if ($username != 'User'  && $_SESSION['USER']->user_status === 'customer') {
            $order = new Order;
            
            $id = ['user_id' => $_SESSION['USER']->id];
            $data['order'] = $order->where($id);
            $data['material_sizes'] = $order->getFullData($id);


            $this->view('customer/overview', $data);
        } else {
            redirect('home');
        }
    }

    public function chat_data()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->user_status == "customer" && $username == $_POST['email']) {

            try {

                $allUsers = new AllUsers();
                $chat = new Chat();
                $chatData = new ChatData();

                $userChatId = $allUsers->first($_POST);

                // chat id find in then chat table
                $userarr['from_id'] = $userChatId->id;
                $userarr['to_id'] = $userChatId->id;

                // session user chat conversation 
                $chatId = $chat->whereOR($userarr);

                $emp = new Employee();

                $arr = [];
                $arr['emp_status'] = 'manager';

                $empData = $emp->first_selectedColumn($arr, $emp->chatForCloumn);

                // when chat id is not included then insert the new user data.
                if ((empty($chatId))) {

                    // find the emp email in all user table
                    $arr = [];
                    $arr['email'] = $empData->email;
                    $empChatId = $allUsers->first($arr);

                    // insert the chat conversation
                    $arr = [];
                    $arr['from_id'] = $empChatId->id;
                    $arr['to_id'] = $userChatId->id;

                    $chat->insert($arr);

                    // Again check session user chat conversation & get the ID
                    $chatId = $chat->where($arr);
                }

                // get the chat Id for included all chat messages
                $chatMsgs = $this->chatbox($chatId[0]->chat_id);

                $chatAllData['chat'] = $chatId;
                $chatAllData['chatMsgs'] = $chatMsgs;
                $chatAllData['log_user'] = $userChatId->id;
                $chatAllData['empImage'] = $empData->emp_image;

                echo json_encode($chatAllData);
            } catch (\Throwable $th) {
                //throw $th;
            }
        } else {
            redirect("404");
        }
    }

    private function chatbox($chat_id)
    {
        $arr['chat_id'] = $chat_id;

        $chatData = new ChatData();
        $chatMsg = $chatData->where($arr);

        return $chatMsg;
    }

    public function saveMsg()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->user_status == "customer") {

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $chatData = new ChatData();
                $chatData->insert($_POST);
            } else {

                redirect("404");
            }
        }else{
            redirect("404");

        }
    }
}
