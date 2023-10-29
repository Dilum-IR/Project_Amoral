<?php

$username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

if ($username != 'User') {
    route('customer/overview', 'customer/customerOverview@index');
    route('customer/orders', 'customer/customerOrders');
} else {
    // redirect('home');
    route('home', 'Home@index');
}

route('logout', 'Logout@index');

route('delivery/orders', 'delivery/Orders@index');
route('manager/overview', 'manager/Overview@index');
route('manager/profile', 'manager/Profile@index');

route('garment/overview', 'garment/Overview@index');
route('garment/orders', 'garment/Orders@index');
route('garment/profile', 'garment/Profile@index');

route('signin', 'SignIn@index');

route('signinData', 'SignIn@formData');
