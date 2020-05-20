<?php
    //run mysqladmin -u root password mytest in the terminal for XAMPP before this line, or set password to whatever you want and change password below
    $dbcon = new PDO("mysql:host=127.0.0.1;dbname=cars", 'root', 'mytest');
?>
