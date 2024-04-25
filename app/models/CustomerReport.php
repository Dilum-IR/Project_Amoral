<?php

class CustomerReport{
    use Model;

    protected $table = 'report_customer';

    protected $allowedcolumns = [
        'report_id',
        'user_id',
        'email',
        'title',
        'description',
        'report_date',
        'is_active'
    ];

    public function validate($data){

        $this->errors = [];

        if(empty($data['title'])){
            $errors['title'] = 'Title is required.';
        }

        if(empty($data['description'])){
            $errors['desc'] = 'Description is required.';
        }

        if(empty($data['email'])){
            $errors['email'] = 'Email is required.';
        }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email is not valid.';
        }

        return $errors;
    }
}