<?php
session_start();

require_once '../class/Crud.php';

$obj = new Crud();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $first_name = trim(string: $_POST['first_name']);
    $last_name = trim(string: $_POST['last_name']);
    $phone = trim(string: $_POST['phone']);
    $email = trim(string: $_POST['email']);
    $address_1 = trim(string: $_POST['address_1']);
    $address_2 = trim(string: $_POST['address_2']);
    $city = trim(string: $_POST['city']);
    $pincode =trim(string: $_POST['pincode']);
    $state = trim(string: $_POST['state']);
    $country = trim(string: $_POST['country']);
    $user_id = $_SESSION['id'];
    $created_at = date("Y-m-d H:i:s");

    $insert_data = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'phone_number' => $phone,
        'email' => $email,
        'address_one' => $address_1,
        'address_two' => $address_2,
        'city_name' => $city,
        'pincode' => $pincode,
        'state_name' => $state,
        'country_name' => $country,
        'user_id' => $user_id,
        'created_at' => $created_at
    ];

    $query = $obj->insert('addresses', $insert_data);

    // if our address data is inserted
    if($query){
        header('Location: ../add_address.php?message=success');
    }else{
        header('Location: ../add_address.php?message=something went wrong');
    }
}
