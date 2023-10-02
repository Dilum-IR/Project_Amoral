<?php


class User
{
	use Model;

	protected $table = 'users';

	protected $allowedCloumns = [
		'fullname',
		'email',
		'password',
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

		// is empty password 
		if (empty($data['password'])) {
			$this->errors['password'] = "password is Required";
		}
		// email validation
		if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#\$&*~]).{8,}$/", $data['password'])) {
			$this->errors['password'] = "password is not Valid";
			$this->errors['passwordError'] = "should contain upper,lower,digit and Special character";
		}

		if (empty($this->errors)) {
			true;
		} else {
			false;
		}
	}
}
