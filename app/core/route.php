<?php

route('delivery/orders', 'delivery/Orders@index');

route('customer/overview', 'customer/customerOverview@index');
route('customer/orders', 'customer/customerOrders@index');
route('customer/profile', 'customer/Profile@index');

route('manager/overview','manager/Overview@index');
route('manager/profile','manager/Profile@index');

route('garment/overview','garment/Overview@index');
route('garment/orders','garment/Orders@index');
route('garment/profile','garment/Profile@index');

route('signin','SignIn@index');
route('home','Home@index');

