<?php


class Employee
{
	use Model;

	protected $table = 'employee';

	public $allowedCloumns = [

		'emp_id',
		'emp_name',
		'email',
		'contact_number',
		'emp_status',
		'emp_image',
		'is_active',
		'nic',
	];
	public $chatForCloumn = [

		'emp_id',
		'email',
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
		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
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
			$password = $_POST['password'];
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$_POST['password'] = $hash;

			return true;
		} else {
			return false;
		}
	}


	public function passwordResetValidate($data)
	{

		$this->errors = [];
		
		
		// is empty password 
		if (empty($data['password'])) {
			$this->errors['flag'] = true;
			$this->errors['current_password'] = "Password is Required";
		} else if (empty($data['new_password'])) {
			$this->errors['flag'] = true;
			$this->errors['new_password'] = "New password is Required";
		} else if (empty($data['confirm_password'])) {
			$this->errors['flag'] = true;
			$this->errors['confirm_password'] = "Confirm password is Required";
		}
		
		// password validation
		if (!($data['new_password'] === $data['confirm_password'])) {
			$this->errors['flag'] = true;
			$this->errors['password'] = " New & confirm password is not same";
		} else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#\$&*~]).{7,}$/", $data['password'])) {
			$this->errors['flag'] = true;
			$this->errors['password'] = "password is not Valid";
			$this->errors['passwordError'] = "Contain [a-z/A-Z/0-9/!@#\$&*~]";
		}
		// show($data);

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
		if (empty($data['emp_name'])) {
			$this->errors['flag'] = true;
			$this->errors['emp_name'] = "Employee name is required";
			// $this->errors['error_no'] = 1;
			// return;
			// show($data);
		}
		// name validation - this part include more words validation
		else if (!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $data['emp_name'])) {

			$this->errors['flag'] = true;
			$this->errors['emp_name'] = "Name is invalid ";
			// $this->errors['error_no'] = 2;

		}

		// is empty City
		if (empty($data['city'])) {
			$this->errors['flag'] = true;
			$this->errors['city'] = "Employee city is required";
		}
		//city validation
		else if (!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $data['city'])) {
			// show($data);
			$this->errors['flag'] = true;
			$this->errors['city'] = "City is invalid ";
		}

		// is empty Address
		if (empty($data['address'])) {
			$this->errors['flag'] = true;
			$this->errors['address'] = "Employee address is required";
		}
		//Address validation
		else if (!preg_match("/^[a-zA-Z0-9\s\.,:#\/-]+$/", $data['address'])) {
			$this->errors['flag'] = true;
			$this->errors['address'] = "Address is invalid ";
		}

		// is empty DOB
		if (empty($data['DOB'])) {
			$this->errors['flag'] = true;
			$this->errors['DOB'] = "Date of Birth is required";
		} else {
			// Validate the format of the date
			if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $data['DOB'])) {
				$this->errors['flag'] = true;
				$this->errors['DOB'] = "Date of Birth is invalid format";
			} else {
				// Convert the date string to a DateTime object for further validation
				$dateTime = DateTime::createFromFormat('Y-m-d', $data['DOB']);
				$dateTime->setTimezone(new DateTimeZone('Asia/Kolkata'));

				// Check if the date is not in the future
				$currentDate = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
				if ($dateTime > $currentDate) {
					$this->errors['flag'] = true;
					$this->errors['DOB'] = "Date of Birth cannot be in the future";
				} else {
					// Check if the user is at least 18 years old
					$age = $currentDate->diff($dateTime)->y;
					if ($age < 18) {
						$this->errors['flag'] = true;
						$this->errors['DOB'] = "Must be at least 18 years old";
					}
				}
			}
		}


		// is empty Email
		if (empty($data['email'])) {
			$this->errors['flag'] = true;
			$this->errors['email'] = "Employee email is required";
		} else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['flag'] = true;
			$this->errors['email'] = "Email is invalid ";
		}

		// is empty Contact Number
		if (empty($data['contact_number'])) {
			$this->errors['flag'] = true;
			$this->errors['contact_number'] = "Contact Number is required";
		} else if (!preg_match("/^\+?\d{1,4}[-.\s]?\d{1,15}$/", $data['contact_number'])) {
			$this->errors['flag'] = true;
			$this->errors['contact_number'] = "Contact Number is invalid ";
		}
		//show($this->errors);



		if (empty($this->errors)) {

			return true;
		} else {
			return false;
		}
	}

	function findId($email)
	{
		$quary = "SELECT emp_id FROM $this->table
		WHERE email = '$email'";
		return $this->quary($quary);
	}
}
