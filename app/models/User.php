<?php


class User
{
	use Model;

	protected $table = 'users';

	public $allowedCloumns = [
		"id",
		'fullname',
		'email',
		'user_status',
		'email_verified',
		'user_image',
	];

	public $customerColumns = [
		"id",
		'fullname',
		'email',
		'user_image',
		'email_verified',
		'address',
		'city',
		'phone',
		'is_active',
	];

	public function validate($data)
	{
		$this->errors = [];

		// flag mean errors include

		// is empty name 
		if (empty($data['fullname'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Name is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
		// name validation - this part include more words validation
		else if (!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $data['fullname'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Name is not valid ";
			$this->errors['error_no'] = 2;
			return;
		}


		// is empty email 
		if (empty($data['email'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Email is Required ";
			$this->errors['error_no'] = 3;
			return;
		}
		// email validation
		else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Email is not Valid ";
			$this->errors['error_no'] = 3;
			return;
		}

		// is empty password 
		if (empty($data['password']) || empty($data['re-password'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Password is Required ";
			$this->errors['error_no'] = 4;
			return;
		} else if ($data['password'] != $data['re-password']) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Passwords does not match ";
			$this->errors['error_no'] = 4;
			return;
		}
		// password validation
		// else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#^%?\$&*~]).{5,}$/", $data['password'])) {
		// 	$this->errors['flag'] = true;
		// 	$this->errors['error'] = "Password is not Valid ";
		// 	$this->errors['error_no'] = 5;
		// 	return;

		// }


		// errors no then hash passwords
		if (empty($this->errors)) {

			// password hashing 
			$password = $_POST['password'];
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$_POST['password'] = $hash;

			return true;
		} else {
			return false;
		}
	}


	public function signInData($data)
	{
		$this->errors = [];

		// is empty email 
		if (empty($data['email'])) {

			$this->errors['flag'] = true;
			$this->errors['error'] = "Email is Required ";
			$this->errors['error_no'] = 3;
			return;
		}
		// email validation
		else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Invalid Email or Password ";
			$this->errors['error_no'] = 7;
			return;
		}

		// is empty password 
		if (empty($data['password'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Password is Required";
			$this->errors['error_no'] = 4;
			return;
		} else if (!preg_match('/^[a-zA-Z0-9!@#\$%^&*_+=\-[\]},.>?\/]+$/', $data['password'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Invalid Email or Password";
			$this->errors['error_no'] = 7;
			return;
		}


		if (empty($this->errors)) {

			return true;
		} else {
			return false;
		}

		// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		//     $email = $_POST['email'];
		//     $password = $_POST['password'];
		// }

	}

	public function passwordResetValidate($data)
	{

		$this->errors = [];

		// is empty password 
		if (empty($data['password'])) {
			$this->errors['flag'] = true;
			$this->errors['current_password'] = "Password is Required";
			return;
			
		}
		else if (empty($data['new_password'])) {
			$this->errors['flag'] = true;
			$this->errors['new_password'] =  "New password is Required";
			return;
			
		}
		else if (empty($data['confirm_password'])) {
			$this->errors['flag'] = true;
			$this->errors['confirm_password'] =  "Confirm password is Required";
			return;
		}

		// password validation
		if (!($data['new_password'] === $data['confirm_password'])) {
			$this->errors['flag'] = true;
			$this->errors['password'] = "Passwords are not the same";
			return;
		} else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#\$&*~]).{8,}$/", $data['password'])) {
			$this->errors['flag'] = true;
			$this->errors['password'] = "New password is not Secure..";
			$this->errors['passwordError'] = "Password must contain [a-z/A-Z/0-9/!@#\$&*~]";
			return;
		}

		//  show($this->errors);

		if (empty($this->errors)) {

			return true;
		} else {
			return false;
		}
	}

	public function changeInfoValidate($data)
	{

		$this->errors = [];

		// is empty Full Name
		if (empty($data['fullname'])) {
			$this->errors['flag'] = true;
			$this->errors['name'] = "Name is required";
			// $this->errors['error_no'] = 1;
			// return;
		}
		// name validation - this part include more words validation
		else if (!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $data['fullname'])) {
			$this->errors['flag'] = true;
			$this->errors['name'] = "Name is invalid ";
			// $this->errors['error_no'] = 2;
		}

		// is empty City
		if (empty($data['city'])) {
			$this->errors['flag'] = true;
			$this->errors['city'] = "City is required";
		}
		//city validation
		else if (!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $data['city'])) {
			$this->errors['flag'] = true;
			$this->errors['city'] = "City is invalid ";
		}

		// is empty Address
		if (empty($data['address'])) {
			$this->errors['flag'] = true;
			$this->errors['address'] = "Address is required";
		}
		//Address validation
		else if (!preg_match("/^[a-zA-Z0-9\s\.,#:-]+$/", $data['address'])) {
			$this->errors['flag'] = true;
			$this->errors['address'] = "Address is invalid ";
		}
		// is empty Email
		if (empty($data['email'])) {
			$this->errors['flag'] = true;
			$this->errors['email'] = "Email is required";
		} else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['flag'] = true;
			$this->errors['email'] = "Email is invalid ";
		}

		// is empty Contact Number
		if (empty($data['phone'])) {
			$this->errors['flag'] = true;
			$this->errors['phone'] = "Contact Number is required";
		} else if (!preg_match("/^\+?\d{1,4}[-.\s]?\d{1,15}$/", $data['phone'])) {
			$this->errors['flag'] = true;
			$this->errors['phone'] = "Contact Number is invalid ";
		}
		// show($this->errors);

		if (empty($this->errors)) {

			return true;
		} else {
			return false;
		}
	}
}
