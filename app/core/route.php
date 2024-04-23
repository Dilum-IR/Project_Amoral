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


// customer ajax chat endpoint
route('customer/saveMsg', 'customer/customerOverview@saveMsg');
route('customer/chatbox', 'customer/customerOverview@chat_data');
route('customer/p', 'customer/customerOrders@payment_process');
route('customer/p_success', 'customer/customerOrders@payment_success');

//manager ajax endpoint
route('manager/assignGarment', 'manager/GarmentOrders@assignGarment');
route('manager/setDeadlines', 'manager/GarmentOrders@setDeadlines');

route('manager/addMaterial', 'manager/Overview@addMaterial');
route('manager/deleteMaterial', 'manager/Overview@deleteMaterial');
route('manager/updateMaterial', 'manager/Overview@updateMaterial');
route('manager/addPrintingType', 'manager/Overview@addPrintingType');
route('manager/deletePrintingType', 'manager/Overview@deletePrintingType');
route('manager/updatePrintingType', 'manager/Overview@updatePrintingType');

route('manager/newOrder', 'manager/CustomerOrders@newOrder');
route('manager/updateOrder', 'manager/CustomerOrders@updateOrder');

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


route('delivery/updateOrderStatus', 'delivery/Orders@updateOrderStatus');

route('delivery/orders', 'delivery/Orders@index');
route('delivery/profile', 'delivery/Profile@index');
route('delivery/overview', 'delivery/Overview@index');


route('manager/overview','manager/Overview@index');
route('manager/profile','manager/Profile@index');
route('manager/employeedetails','manager/EmployeeDetails@index');
route('manager/garmentdetails', 'manager/GarmentDetails@index');
route('manager/customerdetails', 'manager/CustomerDetails@index');


route('signinData', 'SignIn@formData');

route('guest','guest/Guest@index');

route('tool', 'tool/Tool@index');

route('collection', 'collection/Collection@Index');

route('404', '_404@index');
route('failure', 'ServerError@index');
