<?php

class ChatBox extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {


            $usersData = $this->getAllUsers();
            $data['chatedUsers'] = $usersData;

            $this->view('manager/chat', $data);
        } else {
            redirect('home');
        }
    }

    private function getAllUsers()
    {

        $allUsers = new AllUsers();
        $chatData = new ChatData();
        $chat = new Chat();

        $arr['email'] = $_SESSION['USER']->email;

        // find session user chats
        $userChatId = $allUsers->first($arr);

        $arr = [];
        $arr['from_id'] = $userChatId->id;
        $arr['to_id'] = $userChatId->id;

        // session user chat all conversation 
        $chatConversations = $chat->whereOR($arr);


        // get registered all users using all users table
        $chatUserDetails = [];

        foreach ($chatConversations as $value) {

            // find the already chated users chat data using chat data table
            $data['chat_id'] = $value->chat_id;
            $userChatMsg = $chatData->lastChatmsg($data);
            
            // If chat_data table have chat id or haven't
            if (isset($userChatMsg->chat_id)) {
                $userChatMsg->time = $this->resetTime($userChatMsg->time);

                // When from id is not a session user
                if ($value->from_id != $userChatId->id) {

                    $otherUser['id'] = $value->from_id;
                    $otherUserEmail = $allUsers->first($otherUser);

                    // get the datails of other user
                    $userDetails = $this->getOtherUserData($otherUserEmail->email);
                    $userDetails->last_msg = $userChatMsg;
                    $userDetails->chat_box = $value;
                    $userDetails->log_user = $userChatId->id;

                    array_push($chatUserDetails, $userDetails);
                }
                // When to id is not a session user
                elseif ($value->to_id != $userChatId->id) {

                    $otherUser['id'] = $value->to_id;
                    $otherUserEmail = $allUsers->first($otherUser);

                    // get the datails of other user
                    $userDetails =  $this->getOtherUserData($otherUserEmail->email);
                    $userDetails->last_msg = $userChatMsg;
                    $userDetails->chat_box = $value;
                    $userDetails->log_user = $userChatId->id;

                    array_push($chatUserDetails, $userDetails);
                }
            }
        }

        // Custom sorting function
        function sortByTimeDesc($a, $b)
        {
            $timeA = strtotime($a->last_msg->time);
            $timeB = strtotime($b->last_msg->time);

            return $timeB - $timeA;
        }

        // Sorting the array using usort method
        usort($chatUserDetails, 'sortByTimeDesc');

        // show($chatUserDetails);
        // $columns = ['id', 'email', 'fullname', "user_status","user_image"];

        return $chatUserDetails;
    }

    private function getOtherUserData($email)
    {
        $user = new User();
        $employee = new Employee();

        if ($email) {

            $newData = [];
            $newData['email'] = $email;

            // get the already chated users more details using users & employee tables
            $userData = $user->first_selectedColumn($newData,$user->allowedCloumns);
            $empData = $employee->first_selectedColumn($newData,$employee->allowedCloumns);

            // add that data in to the array
            if ($userData) {

                return $userData;
            } else if ($empData) {

                $empData->user_status = $empData->emp_status;
                unset($empData->emp_status);
                return $empData;
            }
        }
    }

    private function resetTime($time)
    {
        date_default_timezone_set('Asia/Kolkata');
        $date1 = new DateTime($time);
        $date2 = new DateTime();

        // Calculate the difference between the dates
        $interval = $date1->diff($date2);

        $days_difference = $interval->days;
        $hours_difference = $interval->h;
        $minutes_difference = $interval->i;
        $seconds_difference = $interval->s;


        if ($days_difference > 0) {
            $times_ago = $days_difference . " days ago";
        } elseif ($hours_difference > 0) {
            $times_ago = $hours_difference . " h ago";
        } elseif ($minutes_difference > 0) {
            $times_ago = $minutes_difference . " min ago";
        } elseif ($seconds_difference > 0) {
            $times_ago = $seconds_difference . " sec ago";
        } elseif ($seconds_difference == 0) {
            $times_ago = " Just Now";
        }
        return $times_ago;
    }


    public function chatbox()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status == "manager") {

            $chatData = new ChatData();
            $chatMsg = $chatData->where($_POST);
            echo json_encode($chatMsg);
        }
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
