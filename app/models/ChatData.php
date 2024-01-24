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
