<?php

class Complaints extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status == 'merchandiser') {

            $cstReport = new CustomerReport;
            $gmntReport = new GarmentReport;

            $columnNames = [];
            $columnNames[0] = "report_customer.user_id";
            $columnNames[1] = "report_customer.email";
            $columnNames[2] = "report_customer.title";
            $columnNames[3] = "report_customer.description";
            $columnNames[4] = "report_customer.report_date";
            $columnNames[5] = "report.garment_id";
            $columnNames[6] = "report.email";
            $columnNames[7] = "report.title";
            $columnNames[8] = "report.description";
            $columnNames[9] = "report.report_date";
            $columnNames[10] = "report_customer.is_active";
            $columnNames[11] = "report.is_active";

            $resultCst = $cstReport->findAll('report_id');
            $resultGmnt = $gmntReport->findAll('report_id');
            // show($resultGmnt);

            $result = array_merge($resultCst, $resultGmnt);

            $data = ['data' => $result];
            // mark as read
            if (isset($_POST["markAsRead"])) {
                // show($_POST);
                unset($_POST["markAsRead"]);
                $report_id = $_POST['report_id'];
                $arr = $_POST;
                $arr['is_active'] = 0;
                // show($arr);
                // Check if 'garOrCus' is set to 'customer'
                if ($arr['garOrCus'] === 'customer') {
                    unset($arr['garOrCus']);
                    // Assuming $cstReport is an object of a class that handles database operations
                    $update = $cstReport->update($report_id, $arr, 'report_id');
                    if ($update) {
                        redirect('merchandiser/complaints');
                    } else {

                        echo "Failed to update customer report.";
                    }
                } else {
                    unset($arr['garOrCus']);
                    // Assuming $gmntReport is an object of a similar class for a different type of report
                    $update = $gmntReport->update($report_id, $arr, 'report_id');
                    if ($update) {
                        redirect('merchandiser/complaints');
                    } else {
                        echo "Failed to update garment report.";
                    }
                }
            }

            // Retrieve the value of rptType from the POST data

            // header('Content-Type: application/json');
            // echo json_encode($data);
            $this->view('merchandiser/complaints', $data);
        } else {
            redirect('home');
        }
    }


    public function complaintstatus()
    {

        // echo json_encode($_POST);

        $rptType = $_POST['rptType'];


        // show($rptType);
        $cstReport = new CustomerReport;
        $gmntReport = new GarmentReport;
        // Perform actions based on the selected rptType
        switch ($rptType) {
            case "all":
                // // Action for "All" selected
                $resultCst = $cstReport->findAll('report_id');
                $resultGmnt = $gmntReport->findAll('report_id');

                $result = array_merge_recursive($resultCst, $resultGmnt);
                // show($result);
                $data = ['data' => $result];
                echo json_encode($data);

                // show($data);

                break;
            case "unread":
                // Action for "Unread" selected
                $resultCst = $cstReport->findAllActive('report_id');
                $resultGmnt = $gmntReport->findAllActive('report_id');

                if ($resultCst == false) {
                    $resultCst = [];
                }

                if ($resultGmnt == false) {
                    $resultGmnt = [];
                }

                $result = array_merge_recursive($resultCst, $resultGmnt);
                // show($result);

                // show($result);
                $data = ['data' => $result];
                echo json_encode($data);

                break;

            case "read":
                // Action for "Read" selected

                $resultCst = $cstReport->findAllInActive('report_id');
                $resultGmnt = $gmntReport->findAllInActive('report_id');

                if ($resultCst == false) {
                    $resultCst = [];
                }

                if ($resultGmnt == false) {
                    $resultGmnt = [];
                }

                $result = array_merge_recursive($resultCst, $resultGmnt);

                $data = ['data' => $result];
                echo json_encode($data);

                break;
                

            default:
                // // Action for "All" selected
                $resultCst = $cstReport->findAll('report_id');
                $resultGmnt = $gmntReport->findAll('report_id');

                $result = $resultCst + $resultGmnt;
                // show($result);
                $data = ['data' => $result];
                echo json_encode($data);

                // show($data);
                break;
        }


    }
}
