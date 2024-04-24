<?php

class GuestGarment
{
    use Model;

    protected $table = 'guest_garment';

    protected $allowedColumns = [
        'name',
        'email',
        'address',
        'city',
        'manager_name',
        'manager_email',
        'manager_contact',
    ];




    public function validateInfo($data)
    {

        $this->errors = [];

        // Debugging: Output or log initial data
        // error_log(print_r($data, true)); // This will log to your PHP error log
        // // or
        // echo "<pre>" . print_r($data, true) . "</pre>"; // This will output directly to the page (use only in development)
    

        // *******************************Garment Info Validation******************************************************//
        
        // is empty  Name
        if (empty($data['name'])) {
            $this->errors['flag'] = true;
            $this->errors['name'] = "Garment name is required";
            // show($data);
        }
        // name validation - this part include more words validation
        else if (!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $data['name'])) {

            $this->errors['flag'] = true;
            $this->errors['name'] = "Garment Name is invalid ";
            // $this->errors['error_no'] = 2;

        }

        // is empty City
        if (empty($data['city'])) {
            $this->errors['flag'] = true;
            $this->errors['city'] = "Garment city is required";
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
            $this->errors['address'] = "Garment address is required";
        }
        //Address validation
        else if (!preg_match("/^[a-zA-Z0-9\s\.,:#\/-]+$/", $data['address'])) {
			$this->errors['flag'] = true;
			$this->errors['address'] = "Address is invalid ";
		}

        // is empty Email
        if (empty($data['email'])) {
            $this->errors['flag'] = true;
            $this->errors['email'] = "Garment email is required";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['flag'] = true;
            $this->errors['email'] = "Email is invalid ";
        }



        // *******************************Manager Info Validation******************************************************//

        // is empty Manager  Name
        if (empty($data['manager_name'])) {
            $this->errors['flag'] = true;
            $this->errors['manager_name'] = "Manager name is required";
        }
        // name validation - this part include more words validation
        else if (!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+)*$/", $data['manager_name'])) {

            $this->errors['flag'] = true;
            $this->errors['manager_name'] = "Manager Name is invalid ";
            // $this->errors['error_no'] = 2;

        }

        // is empty Email
        if (empty($data['manager_email'])) {
            $this->errors['flag'] = true;
            $this->errors['manager_email'] = "Manager email is required";
        } else if (!filter_var($data['manager_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['flag'] = true;
            $this->errors['manager_email'] = "Email is invalid ";
        }

        // is empty Contact Number
       // is empty Contact Number
		if (empty($data['manager_contact'])) {
			$this->errors['flag'] = true;
			$this->errors['manager_contact'] = "Contact Number is required";
		}
		else if (!preg_match("/^\+?\d{1,4}[-.\s]?\d{1,15}$/",$data['manager_contact'])) {
			$this->errors['flag'] = true;
			$this->errors['manager_contact'] = "Contact Number is invalid ";
		}

        // *******************************Capacity and Cost Metrics Info Validation******************************************************//


        // Validation for numWorkers (Positive integers)
        if (empty($data['no_workers'])) {
            $this->errors['flag'] = true;
            $this->errors['no_workers'] = "No. of Workers is required";
        } elseif (!preg_match("/^[1-9]\d*$/", $data['no_workers']) || (int)$data['no_workers'] < 1) {
            $this->errors['flag'] = true;
            $this->errors['no_workers'] = "Number of Workers at least 1";
        }

        // // Validation for cuttingPrice (Non-negative decimals)
        if (empty($data['cut_price'])) {
            $this->errors['flag'] = true;
            $this->errors['cut_price'] = "Cutting Price is required";
        } elseif (!preg_match("/^\d+(\.\d+)?$/", $data['cut_price'])) {
            $this->errors['flag'] = true;
            $this->errors['cut_price'] = "Cutting Price must be a non-negative number";
        }

        // // Validation for dailyCapacity (Positive integers)
        if (empty($data['day_capacity'])) {
            $this->errors['flag'] = true;
            $this->errors['day_capacity'] = "Daily Capacity is required";
        } elseif (!preg_match("/^[1-9]\d*$/", $data['day_capacity']) || (int)$data['day_capacity'] < 10) {
            $this->errors['flag'] = true;
            $this->errors['day_capacity'] = "Daily Capacity must be at least 10";
        }
        
        // Validation for productCapacity (Positive integers)
        if (empty($data['sewed_price'])) {
            $this->errors['flag'] = true;
            $this->errors['sewed_price'] = "Cutting Price is required";
        } elseif (!preg_match("/^\d+(\.\d+)?$/", $data['sewed_price'])) {
            $this->errors['flag'] = true;
            $this->errors['sewed_price'] = "Sewed Price must be a non-negative number";
        }

        
    
        if (empty($this->errors)) {
            return true;
        } else {
            // Log errors
            // error_log(print_r($this->errors, true)); // Log to PHP error log
            // // or
            // echo "<pre>" . print_r($this->errors, true) . "</pre>"; // Output errors directly to the page
            return false;
        }

        // if (empty($this->errors)) {

		// 	return true;
		// } else {
		// 	return false;
		// }


    }
}


