<?php


class User
{
	use Model;

	protected $table = 'users';

	protected $allowedCloumns = [
		'fullname',
		'email',
		'password',
		'user_status'
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
			$this->errors['error'] = "password is Required ";
			$this->errors['error_no'] = 4;
			return;
		} else if ($data['password'] != $data['re-password']) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "passwords does not match ";
			$this->errors['error_no'] = 4;
			return;
		}
		// password validation
		// else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#^%?\$&*~]).{5,}$/", $data['password'])) {
		// 	$this->errors['flag'] = true;
		// 	$this->errors['error'] = "password is not Valid ";
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
            $this->errors['error'] = "password is Required";
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
}
