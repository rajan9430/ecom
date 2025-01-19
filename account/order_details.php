<?php
include '../includes/header.php';

include '../includes/navbar.php';
require_once '../class/Crud.php'; // Include the Crud class

// session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['id'];
$order_id = $_GET['order_id']; // Get the order ID from the URL

$crud = new Crud();

// Custom SQL query to fetch order details, products, and shipping address
$query = "
    SELECT 
    orders.order_id, 
    orders.total_amount, 
    orders.order_status, 
    orders.created_at,
    orders.payment_method,
    addresses.first_name, 
    addresses.last_name, 
    addresses.address_one, 
    addresses.address_two, 
    addresses.city_name, 
    addresses.state_name, 
    addresses.country_name, 
    addresses.pincode, 
    products.product_title, 
    products.selling_price, 
    products.product_thumbnail,
    order_items.quantity
    FROM 
        orders
    JOIN 
        order_items ON orders.order_id = order_items.order_id
    JOIN 
        products ON order_items.product_id = products.product_id
    JOIN 
        addresses ON orders.order_address_id = addresses.address_id
    WHERE 
        orders.order_id = '$order_id' AND orders.user_id = '$user_id'
";

// $params = [':order_id' => $order_id, ':user_id' => $user_id];
$order_details = $crud->query($query);

// Check if the order exists
if (empty($order_details)) {
    echo "Order not found!";
    exit;
}

// Extract the basic order information (same for all items)
$order = $order_details[0];

// echo '<pre>'; print_r($order); die();
?>
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar Navigation -->
        <?php require_once 'sidebar.php'; ?>

        <div class="col-md-9">
            <div class="row">
                <!-- Order Details Section -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">

                                <div>
                                    <h3>Order #<?= htmlspecialchars($order['order_id']); ?> Details</h3>
                                    <p><strong>Status:</strong>

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
                                    </p>
                                    <p><strong>Order Date:</strong>
                                        <?= htmlspecialchars(date('M d, Y', strtotime($order['created_at']))); ?></p>
                                </div>

                                <!-- delivery details -->
                                <div>
                                    <p class="mb-1 pb-1 border-bottom h5">Delivery To:</p>
                                    <p class="mb-0 h4 text-capitalize"><strong><?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></strong></p>
                                    <p class="mb-0"><?= htmlspecialchars($order['address_one']); ?></p>
                                    <p class="mb-0"><?= htmlspecialchars($order['address_two']); ?></p>
                                    <p class="mb-0"><?= htmlspecialchars($order['city_name'] . ', ' . $order['state_name'] . ', ' . $order['country_name']); ?></p>
                                    <p class="mb-0"><?= htmlspecialchars($order['pincode']); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Product Details Table -->
                            <?php foreach ($order_details as $item): ?>
                                <div class="order-product-card">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-4">
                                            <div class="order-product-image">
                                                <img
                                                    src="<?= $base_url; ?>uploads/products/<?= $item['product_thumbnail']; ?>">
                                            </div>

                                            <div class="order-product-heading d-flex flex-column justify-content-between">
                                                <h4><?= $item['product_title']; ?></h4>
                                                <div>
                                                    <p class="h5 fw-bold">Rs.
                                                        <?= number_format($item['selling_price'], 2); ?>
                                                    </p>
                                                    <p>Qty: <?= $item['quantity']; ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- status -->
                                        <div class="order-status d-flex flex-column justify-content-center">
                                            <p class="text-secondary mb-1"><small>Total</small></p>
                                            <h4>Rs.
                                                <?= htmlspecialchars(number_format($item['selling_price'] * $item['quantity'], 2)); ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="d-flex justify-content-between mt-2">
                                <div class="text-danger fw-bold">Order via <?= strtoupper($order['payment_method']); ?>
                                </div>
                                <div class="h2">Total: Rs. <?= $order['total_amount']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information Section -->
                <!-- <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shipping Information</h4>
                        </div>
                        <div class="card-body">
                            <p class="mb-1 h4 text-capitalize"><strong><?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></strong></p>
                            <p class="mb-1"><?= htmlspecialchars($order['address_one']); ?></p>
                            <p class="mb-1"><?= htmlspecialchars($order['address_two']); ?></p>
                            <p class="mb-1"><?= htmlspecialchars($order['city_name'] . ', ' . $order['state_name'] . ', ' . $order['country_name']); ?></p>
                            <p class="mb-1"><?= htmlspecialchars($order['pincode']); ?></p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>