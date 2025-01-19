<?php
require_once '../class/Crud.php';

$userObj = new Crud();

//initialize user inputs
$email = trim($_POST['email']);
$password = trim($_POST['password']);

//initialize the output array
$output = [
        'status' => 'true',
        'errors' => [],
        'message' => ''
];

// check if the user email and password are correct
$loginQuery = $userObj->custom_get('users', " WHERE email = '$email' AND password = '$password' AND user_status = '1'", 'fetch');

if($loginQuery){
    // user is authenticated
    $first_name = $loginQuery['first_name'];
    $output['status'] = true;
    $output['message'] = "Login successful! Welcome $first_name";

    // start sssion for communicates on tthe server
    session_start();
    $_SESSION['id'] = $loginQuery['user_id'];
    $_SESSION['first_name'] = $first_name;
    $_SESSION['email'] = $loginQuery['email'];
    $_SESSION['loggedIn'] = true;
} else{
    // user is not authenticated
    $checkEmailQuery = $userObj->custom_get('users', " WHERE email = '$email' AND user_status = '1'", 'fetch');
    if($checkEmailQuery){
        // if email is correct, but password is incorrect
        $output['status'] = false;
        $output['errors']['password_error'] = "Incorrect password";
    } else{
        // email is incorrect
        $output['status'] = false;
        $output['errors']['email_error'] = "Email not found in our record.";
    }
}
echo json_encode($output);
