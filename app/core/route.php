<?php

route('delivery/orders', 'delivery/Orders@index');

route('customer/customer-orders', 'customer/customerOverview@index');
route('customer/orders', 'customer/customerOrders');

route('manager/overview','manager/Overview@index');
route('manager/profile','manager/Profile@index');
route('manager/employeedetails','manager/EmployeeDetails@index');

