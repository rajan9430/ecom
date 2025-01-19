<?php
session_start();
require_once '../class/Crud.php';  // Assuming Crud class for DB interactions

$crud = new Crud();
$user_id = $_SESSION['id'];  // Assuming user is logged in and session holds their user ID
$address_id = $_POST['address_id'];
$payment_method = $_POST['payment_method'];

// Initialize total amount and fetch cart data as in the previous example
$total_amount = 0.00;

$cartQuery = "SELECT cart.id as cart_id, products.product_id, products.product_title, products.selling_price, products.regular_price, products.product_thumbnail, cart.quantity  FROM `cart` 
            
            LEFT JOIN products ON products.product_id = cart.product_id
            WHERE user_id = '$user_id'";

$cart_items = $crud->query($cartQuery);

if ($cart_items) {
    foreach ($cart_items as $item) {
        $quantity = $item['quantity'];
        $price = $item['selling_price'];
        $total_amount += $price * $quantity;
    }
    
    // Insert order into orders table
    $orderData = [
        'user_id' => $user_id,
        'order_address_id' => $address_id,
        'total_amount' => $total_amount,
        'payment_method' => $payment_method,  // Save payment method (COD or Stripe)
        'order_status' => 'waiting',
        'created_at' => date('Y-m-d H:i:s')
    ];
    $order_id = $crud->insert('orders', $orderData);
    // echo '<pre>'; print_r($order_id); die();

    foreach ($cart_items as $item) {
        $order_item_data = [
            'order_id' => $order_id,
            'product_id' => $item['product_id'],
            'product_name' => $item['product_title'],
            'quantity' => $item['quantity'],
            'price' => $item['selling_price']
        ];
        $crud->insert('order_items', $order_item_data);
    }

    $crud->delete('cart', "WHERE user_id = $user_id");
    echo json_encode(['status' => 'success', 'order_id' => $order_id, 'payment_method' => $payment_method]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Your cart is empty.']);
}