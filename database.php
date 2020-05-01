<?php 
    //run mysqladmin -u root password password in the terminal for XAMPP before this line, or set password to whatever you want and change password below
    $dbcon = new PDO("mysql:host=localhost;dbname=cars", 'root', 'password');
?>