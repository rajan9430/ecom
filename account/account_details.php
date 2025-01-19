<?php

include '../includes/header.php';

include '../includes/navbar.php';

$obj = new Crud();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['id'];
$userDetails = $obj->custom_get('users', " WHERE user_id = '$user_id'", 'fetch');

// $orderDetails = $obj->custom_get('orders', " WHERE user_id = '$user_id' ORDER BY order_id DESC LIMIT 10", 'fetchAll');
// echo '<pre>'; print_r($orderDetails); echo '</pre>';
?>
<style>
    .profile-card {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .card-header {
        background-color: #343a40;
        color: white;
        padding: 15px;
        border-radius: 8px 8px 0 0;
    }

    .card-body {
        padding: 25px;
    }

    .card-footer {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 0 0 8px 8px;
        text-align: right;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <?php require_once 'sidebar.php'; ?>

        <!-- Main Content: Account Overview -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3>Account Overview</h3>
                </div>
                <div class="card-body">
                    <h5>Welcome, <?= $userDetails['first_name'] . ' ' . $userDetails['last_name']; ?></h5>
                    <p>Email: <?= $userDetails['email']; ?></p>
                    <p>Phone: <?= $userDetails['mobile']; ?></p>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
include '../includes/footer.php';
?>