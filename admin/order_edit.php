<?php
require_once 'includes/header.php';
require_once '../class/Crud.php';
$obj = new Crud();

// Fetch the order ID from URL
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;

// Fetch order details
$order = $obj->custom_get('orders', " WHERE order_id =  '$order_id'",'fetch');
                // echo '<pre>'; print_r($order); die();
$user_id = $order['user_id'];
$user = $obj->custom_get('users', " WHERE user_id =  '$user_id'",'fetch');
// $address = $obj->getById('addresses', $order['address_id']);
$address = $obj->custom_get('addresses', " WHERE user_id =  '$user_id'",'fetch');
?>

<div class="container">
    <h2>Edit Order #<?php echo $order['order_id']; ?></h2>

    <form id="order_form">
        <div class="form-group">
            <label for="order_id">Order ID</label>
            <input type="text" class="form-control" id="order_id" name="order_id" value="<?php echo $order['order_id']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="user_name">User Name</label>
            <input type="text" class="form-control" id="user_name" value="<?php echo $user['first_name'] . ' ' . $user['last_name']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="total_amount">Total Amount</label>
            <input type="text" class="form-control" id="total_amount" name="total_amount" value="<?php echo $order['total_amount']; ?>">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="pending" <?php if ($order['order_status'] == 'pending') echo 'selected'; ?>>Pending</option>
                <option value="shipped" <?php if ($order['order_status'] == 'shipped') echo 'selected'; ?>>Shipped</option>
                <option value="delivered" <?php if ($order['order_status'] == 'delivered') echo 'selected'; ?>>Delivered</option>
                <option value="cancelled" <?php if ($order['order_status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
            </select>
        </div>
        <div class="form-group">
            <label for="address">Delivery Address</label>
            <textarea class="form-control" id="address" readonly><?php echo $address['address_one'] . ', ' . $address['city_name']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
<?php require_once 'includes/footer.php'; ?>

<script>
// AJAX to update order details
$(document).ready(function() {
    $('#order_form').on('submit', function(e) {
        e.preventDefault();
        var form_data = $(this).serialize();

        $.ajax({
            url: 'action/order_action.php',
            method: 'POST',
            data: form_data,
            success: function(response) {
                alert('Order updated successfully');
                window.location.href = 'orders.php';
            }
        });
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>
