<?php


class ChatData
{
    use Model;

    protected $table = 'chat_data';

    protected $allowedCloumns = [

        'chat_id',
        'user_id',
        'msg',
        'time'
    ];

    public function lastChatmsg($data)
    {

        $keys = array_keys($data);
        $quary = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . " && ";
        }
        
        $quary = trim($quary, " && ");
       $quary .= " ORDER BY time DESC limit $this->limit offset $this->offset";

        $data = array_merge($data);
        // run the quary stage
        $result = $this->quary($quary, $data);
        if ($result) {

            return $result[0];
        }
        return false;
    }

    public function msgValidate($data)
    {
        $this->errors = [];

        if (empty($data["msg"])) {
            $this->errors['flag'] = true;
            $this->errors['error'] =  "Message is required";
        }
        // Sanitize and validate the input data
        else if (!preg_match("/^[a-zA-Z0-9*+\-\/?!@&%.,='$]+$/", $data["msg"])) {
            $this->errors['flag'] = true;
            $this->errors['error'] =  "Some characters not allowed";
        }
    }
}
