<?php


class User
{
	use Model;

	protected $table = 'users';

	protected $allowedCloumns = [
		'first_name',
		'user_email',
	];

	public function validate($data)
	{
		$this->errors = [];

		// is empty name 
		if (empty($data['fullname'])) {
			$this->errors['fullname'] = "Full Name is Required";
		}
		// name validation
		if (!preg_match("/^[a-zA-z]*$/", $data['fullname'])) {
			
			$this->errors['fullname'] = "Full Name is not valid";
			$this->errors['nameError'] = "Use only letters";
		}

		// is empty email 
		if (empty($data['email'])) {
			$this->errors['email'] = "Email is Required";
		}
		// email validation
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['email'] = "Email is not Valid";
		}

		if (empty($this->errors)) {
			true;
		} else {
			false;
		}
	}
}
