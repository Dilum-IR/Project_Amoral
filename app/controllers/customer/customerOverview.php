<?php
class CustomerOverview extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;

        if ($username != 'User') {
            $id = ['user_id' => $_SESSION['USER']->id];
            $data = $order->where($id);

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

                // when chat id is not included then insert the new user data.
                if ((empty($chatId))) {

                    $emp = new Employee();

                    $arr = [];
                    $arr['emp_status'] = 'manager';

                    $empData = $emp->first_selectedColumn($arr, $emp->chatForCloumn);

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

                echo json_encode($chatMsgs);
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

        if ($username != 'User' && $_SESSION['USER']->emp_status == "manager") {

            $chatData = new ChatData();
            $chatData->insert($_POST);
        }
    }
}
