<?php

class Reports extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status == 'manager') {

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

            $result = array_merge($resultCst, $resultGmnt);

            // show($result);
            $data = ['data' => $result];

            // mark as read
            if (isset($_POST["markAsRead"])) {
                // show($_POST);
                $report_id = $_POST['report_id'];
                show($report_id);
                unset($_POST["markAsRead"]);
                $arr = $_POST;
                $arr['is_active'] = 0;
                if ($resultCst) {
                    if (isset($arr)) {
                        $update = $cstReport->update($report_id, $arr, 'report_id');
                        redirect('manager/reports');
                    } else if ($resultGmnt) {
                        $update = $gmntReport->update($report_id, $arr, 'report_id');
                        redirect('manager/reports');
                    }
                }
            }


            if (isset($_POST['radio'])) {
            
                $selectedOption = $_POST['radio'];

                show($selectedOption);
                // Perform actions based on the selected option
                switch ($selectedOption) {
                    case 'all':
                       echo "all";
                        break;
                    case 'unread':
                        echo "unread";
                        // Handle the "Read" option
                        break;
                    case 'read':
                        echo "read";
                        // Handle the "Unread" option
                        break;
                    default:
                        // Handle unexpected input
                        show($data);
                        break;
                }
            }



            $this->view('manager/reports', $data);
        } else {
            redirect('home');
        }
    }
}
