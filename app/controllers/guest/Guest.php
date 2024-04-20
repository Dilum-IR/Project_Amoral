<?php

class Guest extends Controller
{
    public function index()
    {
        // Create an instance of the GuestGarment model
        $guestgarment = new GuestGarment;

        // Initialize an array to store any data that will be sent to the view
        $data = [];

        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guest_register'])) {
            
            // Remove the submit button entry from POST data
            unset($_POST['guest_register']);
            
            // Validate the information provided in the form
            if ($guestgarment->validateInfo($_POST)) {
                // If validation is successful, insert the data
                $guestgarment->insert($_POST);

                // Optionally, you might want to redirect or inform the user of success
                $data['success_message'] = 'Registration successful!';
            } else {
                // If validation fails, prepare the error data for the view
                
                $data['errors'] = $guestgarment->errors;
            }
        }

        // Render the view with either success message, errors, or default
        $this->view('home/guest', $data);
    }
}
