<?php

trait Auth
{

    // check session token and others
    public static function isAuthenticated()
    {
        // validate user for created token and session expiry time 
        if (
            isset($_SESSION['user_token']) &&
            isset($_SESSION['token_expiry']) &&
            $_SESSION['token_expiry'] > time()
        ) {
            // Additional validation can be performed here if needed
    
            return true; // User is authenticated
        } else {
            return false; // User is not authenticated
        }
    }

    // Generate a random token
    public static function generateToken($length = 32)
    {
        return bin2hex(random_bytes($length));
    }

    // all users login time update the users beariar token in database 
    public static function updateUserToken($id, $data, $type, $user)
    {

        $user->update($id, $data, $type);
    }


    // Function to validate the bearer token
    private function ValidateUserToken($token, $userId, $user)
    {
        $arr['token'] = $token;
        $arr['id'] = $userId;

        $validUser = $user->first($arr);

        if ($validUser) {
            
            unset($validUser);
            return true;
        } else {
            return false;
        }

        // return $result->num_rows === 1;
    }

    // Function to validate the bearer token
    static public function ValidateEmpToken($token, $userId, $employee)
    {
        $arr['token'] = $token;
        $arr['emp_id'] = $userId;

        $validUser = $employee->first($arr);
        if ($validUser) {
            return true;
        } else {
            return false;
        }
    }

    protected function authenticateToken($user)
    {
        // Assuming you have established a database connection

        // Get the token from the request header
        $token = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        // Extract the token type and token itself (Bearer token)
        list($tokenType, $token) = explode(' ', $token);

        // Validate the token
        if ($tokenType === 'Bearer' && !empty($token)) {
            // Assuming $dbConnection is your database connection
            $userId = 1; // Set the user ID based on your authentication logic

            if ($this->ValidateUserToken($token, $userId, $user)) {
                // Token is valid, allow access to the protected route
                echo "Authenticated!";
            } else {
                echo "Unauthorized access!";
            }
        } else {
            echo "Invalid token!";
        }
    }
}


// function renewSession() {
//     // Make an AJAX request to the server endpoint responsible for session renewal
//     $.ajax({
//         url: 'path_to_your_endpoint_for_session_renewal.php', // Replace with the actual endpoint URL
//         method: 'POST', // Adjust the method (POST or GET) as needed
//         success: function(response) {
//             console.log('Session renewed successfully');
//             // Schedule the next session renewal after 29 minutes
//             setTimeout(renewSessionAutomatically, 29 * 60 * 1000); // 29 minutes in milliseconds
//         },
//         error: function(xhr, status, error) {
//             console.error('Session renewal failed:', error);
//             // Retry session renewal after a certain interval if needed
//             setTimeout(renewSessionAutomatically,  10 * 1000); // Retry after 10 seconds in case of failure
//         }
//     });
// }