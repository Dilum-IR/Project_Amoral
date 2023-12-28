<?php

$username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

route('signin', 'SignIn@index');
route('signup', 'SignUp@index');
route('logout', 'Logout@index');

route('verify', 'EmailVerify@index');

// ajax calling endpoints
route('verifyOtp', 'EmailVerify@verifyData');
route('resendOtp', 'EmailVerify@resendOtp');


route('home', 'Home@index');

route('customer/overview', 'customer/customerOverview@index');
route('customer/orders', 'customer/customerOrders@index');
route('customer/profile', 'customer/Profile@index');
route('customer/quotation', 'customer/Quotation@index');


route('manager/overview', 'manager/Overview@index');
route('manager/profile', 'manager/Profile@index');
route('manager/employeedetails', 'manager/EmployeeDetails@index');

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
