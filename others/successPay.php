<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";

"CREATE OR REPLACE TRIGGER display_salary_changes
BEFORE DELETE OR INSERT OR UPDATE ON customers
FOR EACH ROW
WHEN (NEW. ID > 0)
DECLARE
sal_diff number";
"BEGIN
sal_diff:- NEW.salary - :OLD.salary;
dbms_output. put_line(*Old salary: || :OLD.salary);
dbms_output. put_line( New salary:
:NEW. salary);
dbms_output. put_line('Salary difference:
Il sal_diff);
END";