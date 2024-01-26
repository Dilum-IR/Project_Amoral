<?php


class Employee
{
	use Model;

	protected $table = 'employee';

	protected $allowedCloumns = [

		'emp_id',
		'emp_name',
		'email',
		'contact_number',
		'emp_status',
		'emp_image'
	];

	public function validate($data)
	{
		$this->errors = [];

		// is empty name 
		if (empty($data['fullname'])) {
			// flag mean erros include
			$this->errors['flag'] = true;
			$this->errors['fullname'] = "Full Name is Required";
		}
		// name validation
		if (!preg_match("/^[a-zA-z]*$/", $data['fullname'])) {
			$this->errors['flag'] = true;
			$this->errors['fullname'] = array('nameError' => "Use only letters", "name" => "Full Name is not valid");
			
		}

		// is empty email 
		if (empty($data['email'])) {
			$this->errors['flag'] = true;
			$this->errors['email'] = "Email is Required";
		}
		// email validation
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) 
		{
			$this->errors['flag'] = true;
			$this->errors['email'] = "Email is not Valid";
		
		}

		// is empty password 
		if (empty($data['password'])) {
			$this->errors['flag'] = true;
			$this->errors['password'] = "password is Required";
		}

		// password validation
		// if (!$data['password'] === $data['re-password']) {
		// 	$this->errors['flag'] = true;
		// 	$this->errors['password'] = "password is not same";

		// } else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#\$&*~]).{8,}$/", $data['password'])) {
		// 	$this->errors['flag'] = true;
		// 	$this->errors['password'] = "password is not Valid";
		// 	$this->errors['passwordError'] = "Contain [a-z/A-Z/0-9/!@#\$&*~]";
		// }

		// show($this->errors);

		if (empty($this->errors)) {

			// password hashing 
			$password = $_POST['password'] ;
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$_POST['password']= $hash;

			return true;
		} else {
			return false;
		}
	}
}
