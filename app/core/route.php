<?php

$username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

route('signin', 'SignIn@index');


route('logout', 'Logout@index');


route('home', 'Home@index');

route('customer/overview', 'customer/customerOverview@index');
route('customer/orders', 'customer/customerOrders@index');
route('customer/profile', 'customer/Profile@index');
route('customer/quotation', 'customer/Quotation@index');



route('manager/overview', 'manager/Overview@index');
route('manager/profile', 'manager/Profile@index');

route('garment/overview', 'garment/Overview@index');
route('garment/orders', 'garment/Orders@index');
route('garment/orders/update/?id=id', 'garment/OrdersUpdate@index');
route('garment/profile', 'garment/Profile@index');

route('delivery/orders', 'delivery/Orders@index');

route('signinData', 'SignIn@formData');
