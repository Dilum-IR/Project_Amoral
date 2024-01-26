<?php

class Chat extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        // if ($username != 'User') {

        $usersData = $this->getAllUsers();
        $data['chatedUsers'] = $usersData;

        // show($data);

        $this->view('manager/chat', $data);

        // }else{
        //     redirect('home');
        // }
    }

    private function getAllUsers()
    {

        $allUsers = new AllUsers();
        $chatData = new ChatData();

        $user = new User();
        $employee = new Employee();

        // get registered all users using all users table
        $users =  $allUsers->findAll();
        $chatUserDetails = [];

        foreach ($users as $key => $value) {

            // find the already chated users using chat data table
            $data['user_id'] = $value->id;
            $chatedUser = $chatData->first($data,'time','DESC');

            if ($chatedUser) {

                $newData = [];
                $newData['email'] = $value->email;

                // get the already chated users more details using users & employee tables
                $userData = $user->first_selectedColumn($newData);
                $empData = $employee->first_selectedColumn($newData);

                // add that data in to the array
                if ($userData) {

                    $userData->chat_user_id = $value->id;
                    $userData->chat_data = $chatedUser;
                    array_push($chatUserDetails, $userData);
                } else if ($empData) {
                    
                    $empData->chat_data = $chatedUser;
                    $empData->user_status = $empData->emp_status;

                    unset($empData->emp_status);

                    $empData->chat_user_id = $value->id;
                    array_push($chatUserDetails, $empData);
                }
            }
            // show($chatedUser);
        }

        // $columns = ['id', 'email', 'fullname', "user_status","user_image"];

        return $chatUserDetails;
    }
}
