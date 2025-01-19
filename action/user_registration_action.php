<?php
require_once '../class/Crud.php';

$userObj = new Crud();

//initialize user inputs
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$mobile = trim($_POST['mobile']);
$password = trim($_POST['password']);

//initialize the output array
$output = [
        'status' => true,
        'errors' => [],
        'message' => ''
];

// cheking email duplycacy
$emailExists = $userObj->custom_get('users', " WHERE email = '$email'", "fetch");

if($emailExists){
    $output['status'] = false;
    $output['errors']['email_error'] = "This email already exists, please try again with a different email";
}

// cheking mobile no. duplycacy
$mobileExists = $userObj->custom_get('users', " WHERE mobile = '$mobile'", "fetch");

if($mobileExists){
    $output['status'] = false;
    $output['errors']['mobile_error'] = "This mobile no. is already exists, please try again with a different mobile number";
}

// if thereare errors of existance check of email and mobile
if($output['status'] == false){
    echo json_encode($output);
    exit;
}

$data = [
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'mobile' => $mobile,
    'password' => $password,
    'user_status' => '1',
    'created_at' => date('Y-m-d H:i:s')
];

$insertuserData = $userObj->insert('users', $data);

if($insertuserData){
    $output = [
        'status' => 'success',
        'message' => 'User Register Successfully',
        'user_id' => $insertuserData
    ];
}
else {
    $output = [
        'status' => 'failed',
        'message' => 'Something went wrong',
    ];
}

echo json_encode($output);
