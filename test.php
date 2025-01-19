<?php
$password = 'admin123'; // Your dummy password
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
echo $hashed_password; // Copy this hashed password for the SQL insert
?>
