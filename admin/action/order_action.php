<?php
require_once '../../class/Crud.php'; // Include the Crud class
$obj = new Crud(); // Create an instance of the Crud class

// Check if a POST request is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Handle update order request
    if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
        $total_amount = $_POST['total_amount'];
        $status = $_POST['status'];

        // Prepare the data array for updating the order
        $data = [
            'total_amount' => $total_amount,
            'order_status' => $status
        ];

        // Perform the update using the update method of Crud class
        $update_result = $obj->update('orders', $data, " WHERE `order_id` = '$order_id'");

        if ($update_result) {
            // Return success response
            echo json_encode([
                'status' => 1,
                'message' => 'Order updated successfully!'
            ]);
        } else {
            // Return error response
            echo json_encode([
                'status' => 0,
                'message' => 'Failed to update the order!'
            ]);
        }
    }

    // Handle delete order request
    if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];

        // Perform delete using the delete method of Crud class
        $delete_result = $obj->delete('orders', " WHERE order_id = '$order_id'");

        if ($delete_result) {
            // Return success response
            echo json_encode([
                'status' => 1,
                'order_id' => $order_id,
                'message' => 'Order deleted successfully!'
            ]);
        } else {
            // Return error response
            echo json_encode([
                'status' => 0,
                'message' => 'Failed to delete the order!'
            ]);
        }
    }
}
