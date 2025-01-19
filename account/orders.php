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

$orderDetails = $obj->custom_get('orders', " WHERE user_id = '$user_id' ORDER BY order_id DESC", 'fetchAll');
// echo '<pre>'; print_r($orderDetails); echo '</pre>';
?>

<div class="container mt-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <?php require_once 'sidebar.php'; ?>

        <!-- Main Content: Account Overview -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3>All Orders</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orderDetails as $order): ?>
                                <tr>
                                    <td><?= $order['order_id']; ?></td>
                                    <td><?= date('M d, Y', strtotime($order['order_date'])); ?></td>
                                    <td>
                                        <?php 
                                        $order_status = $order['order_status'];
                                        switch ($order_status) {
                                            case '':
                                                echo '<span class="badge bg-warning">Pending</span>';
                                                break;
                                            case 'waiting':
                                                echo '<span class="badge bg-info">Waiting</span>';
                                                break;
                                            case 'approved':
                                                echo '<span class="badge bg-success">Approved</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td><?= number_format($order['total_amount'], 2); ?></td>
                                    <td>
                                        <a href="<?= $base_url; ?>account/order_details.php?order_id=<?= htmlspecialchars($order['order_id']); ?>" class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <!-- End loop -->
                            </tbody>
                        </table>
                    </div>

                    <!-- <a href="orders.php" class="btn btn-primary">View All Orders</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include '../includes/footer.php';
?>