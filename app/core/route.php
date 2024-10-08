<?php

$username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

route('home', 'Home@index');

route('signin', 'SignIn@index');
route('signup', 'SignUp@index');
route('logout', 'Logout@index');

route('about', 'about/About@index');

route('verify', 'EmailVerify@index');

// ajax calling endpoints
route('verifyOtp', 'EmailVerify@verifyData');
route('resendOtp', 'EmailVerify@resendOtp');


route('customer/overview', 'customer/customerOverview@index');
route('customer/orders', 'customer/customerOrders@index');
route('customer/profile', 'customer/Profile@index');
route('customer/quotation', 'customer/Quotation@index');
route('customer/customer-orders', 'customer/customerOverview@index');

// customer ajax calling endpoints
route('customer/newOrder', 'customer/customerOrders@newOrder');
route('customer/updateOrder', 'customer/customerOrders@updateOrder');
route('customer/cancelOrder', 'customer/customerOrders@cancelOrder');

// customer ajax chat endpoint
route('customer/saveMsg', 'customer/customerOverview@saveMsg');
route('customer/chatbox', 'customer/customerOverview@chat_data');
route('customer/p', 'customer/customerOrders@payment_process');
route('customer/p_success', 'customer/customerOrders@payment_success');

//manager ajax calling endpoint
route('manager/assignGarment', 'manager/GarmentOrders@assignGarment');
route('manager/setDeadlines', 'manager/GarmentOrders@setDeadlines');
route('manager/updateGarmentOrder', 'manager/GarmentOrders@updateOrder');

route('manager/addMaterial', 'manager/Overview@addMaterial');
route('manager/deleteMaterial', 'manager/Overview@deleteMaterial');
route('manager/updateMaterial', 'manager/Overview@updateMaterial');
route('manager/addPrintingType', 'manager/Overview@addPrintingType');
route('manager/deletePrintingType', 'manager/Overview@deletePrintingType');
route('manager/updatePrintingType', 'manager/Overview@updatePrintingType');

route('manager/newOrder', 'manager/CustomerOrders@newOrder');
route('manager/updateOrder', 'manager/CustomerOrders@updateOrder');
route('manager/cancelOrder', 'manager/CustomerOrders@cancelOrder');

route('manager/assignDeliverymen','manager/AssignDelivery@assignDeliverymen');
route('manager/updateAssignedOrders','manager/AssignDelivery@updateAssignedOrders');

route('manager/updateOrderStatus', 'manager/PrintingProcess@updateOrderStatus');

route('manager/cancelReason','manager/CustomerOrders@cancelReason');


//merchandiser ajax calling endpoints
route('merchandiser/updateMaterial', 'merchandiser/Overview@updateMaterial');
route('merchandiser/newOrder', 'merchandiser/CustomerOrders@newOrder');
route('merchandiser/updateOrder', 'merchandiser/CustomerOrders@updateOrder');
route('merchandiser/complaintstatus', 'merchandiser/Complaints@complaintstatus');
route('merchandiser/updateGarmentOrder', 'merchandiser/GarmentOrders@updateOrder');

route('merchandiser/RemoveCustomer', 'merchandiser/CustomerDetails@RemoveCustomer');






route('manager/overview', 'manager/Overview@index');
route('manager/customerorders', 'manager/CustomerOrders@index');
route('manager/garmentorders', 'manager/GarmentOrders@index');
route('manager/profile', 'manager/Profile@index');
route('manager/employeedetails', 'manager/EmployeeDetails@index');
route('manager/assigndelivery', 'manager/AssignDelivery@index');
route('manager/printingprocess', 'manager/PrintingProcess@index');


// manager ajax chat endpoint
route('manager/chat', 'manager/ChatBox@index');
route('manager/chatbox', 'manager/ChatBox@chatbox');
route('manager/saveMsg', 'manager/ChatBox@saveMsg');



route('garment/overview', 'garment/Overview@index');
route('garment/orders', 'garment/Orders@index'); 
route('garment/profile', 'garment/Profile@index'); 

route('garment/update_info', 'garment/Overview@updateInfo'); 
route('garment/reports', 'garment/Orders@save_reports'); 
route('garment/update/status', 'garment/Orders@update_status'); 

route('garment/genarate/report', 'garment/Overview@genarate_report'); 

//delivery ajax endpoints
 
route('delivery/updateOrderStatus', 'delivery/Orders@updateOrderStatus');

route('delivery/orders', 'delivery/Orders@index');
route('delivery/profile', 'delivery/Profile@index');
route('delivery/overview', 'delivery/Overview@index');


route('manager/overview','manager/Overview@index');
route('manager/profile','manager/Profile@index');
route('manager/employeedetails','manager/EmployeeDetails@index');
route('manager/garmentdetails', 'manager/GarmentDetails@index');
route('manager/customerdetails', 'manager/CustomerDetails@index');
route('manager/reports', 'manager/Reports@index');
route('manager/reportstatus', 'manager/Reports@report_status');

route('manager/genarate/report', 'manager/Overview@genarate_report'); 

//merchandiser
route('merchandiser/overview', 'merchandiser/Overview@index');
route('merchandiser/customerorders', 'merchandiser/CustomerOrders@index');
route('merchandiser/garmentorders', 'merchandiser/GarmentOrders@index');
route('merchandiser/profile', 'merchandiser/Profile@index');
route('merchandiser/printingprocess', 'merchandiser/PrintingProcess@index');
route('merchandiser/garmentdetails', 'merchandiser/GarmentDetails@index');
route('merchandiser/customerdetails', 'merchandiser/CustomerDetails@index');
route('merchandiser/complaints', 'merchandiser/Complaints@index');


route('signinData', 'SignIn@formData');

route('guest','guest/Guest@index');
route('guest/new','guest/Guest_update@index');

route('tool', 'tool/Tool@index');

route('collection', 'collection/DesignCollection@index');
route('collection/newOrder', 'collection/DesignCollection@newOrder');

route('404', '_404@index');
route('failure', 'ServerError@index');
