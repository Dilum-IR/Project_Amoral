<?php

$username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

route('signin', 'SignIn@index');
route('signup', 'SignUp@index');
route('logout', 'Logout@index');

route('about', 'about/About@index');

route('verify', 'EmailVerify@index');

// ajax calling endpoints
route('verifyOtp', 'EmailVerify@verifyData');
route('resendOtp', 'EmailVerify@resendOtp');


route('home', 'Home@index');

route('customer/overview', 'customer/customerOverview@index');
route('customer/orders', 'customer/customerOrders@index');
route('customer/profile', 'customer/Profile@index');
route('customer/quotation', 'customer/Quotation@index');

// customer ajax chat endpoint
route('customer/saveMsg', 'customer/customerOverview@saveMsg');
route('customer/chatbox', 'customer/customerOverview@chat_data');


route('manager/overview', 'manager/Overview@index');
route('manager/customerorders', 'manager/CustomerOrders@index');
route('manager/garmentorders', 'manager/GarmentOrders@index');
route('manager/quotation', 'manager/Quotation@index');
route('manager/profile', 'manager/Profile@index');
route('manager/employeedetails', 'manager/EmployeeDetails@index');


// manager ajax chat endpoint
route('manager/chat', 'manager/ChatBox@index');
route('manager/chatbox', 'manager/ChatBox@chatbox');
route('manager/saveMsg', 'manager/ChatBox@saveMsg');

route('garment/overview', 'garment/Overview@index');
route('garment/orders', 'garment/Orders@index');
route('garment/profile', 'garment/Profile@index');

route('delivery/orders', 'delivery/Orders@index');
route('delivery/profile', 'delivery/Profile@index');
route('delivery/overview', 'delivery/Overview@index');


route('customer/customer-orders', 'customer/customerOverview@index');
route('customer/orders', 'customer/customerOrders');

route('manager/overview','manager/Overview@index');
route('manager/profile','manager/Profile@index');
route('manager/employeedetails','manager/EmployeeDetails@index');


route('signinData', 'SignIn@formData');

route('guest','guest/Guest@index');

route('tool', 'tool/Tool@index');


route('premade', 'premade/Premade@Index');

route('404', '_404@index');
