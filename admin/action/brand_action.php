<?php
require_once '../../class/crud.php'; // Include the Crud class file
$obj = new Crud(); // Create a new instance of the Crud class

// Check if the form type is 'save'
if ($_POST['form_type'] == 'save') {
    // Check if the 'category_name' field is empty
    if (empty($_POST['category_name'])) {
        $data['msg_error'] = 'Please select a category'; // Set error message for empty category name
        $data['status'] = 0; // Set status as 0 (indicating failure)
    }

    // Check if the 'brand_name' field is empty
    if (empty($_POST['brand_name'])) {
        $data['msg_error'] = 'Please Fill the Brand Field'; // Set error message for empty brand name
        $data['status'] = 0; // Set status as 0 (indicating failure)
    } else {
        // Prepare data array with brand details
        $data = [
            'brand_name' => $_POST['brand_name'], // Assign brand name from form
            'brand_slug_name' => $obj->slugify($_POST['brand_name'], 'brand_slug_name', 'brand'), // Generate slug name for brand
            'brand_category_id' => $_POST['category_name'], // Assign category ID from form
            'brand_created_at' => date('Y-m-d H:i:s') // Assign current date and time
        ];

        // Insert data into the 'brand' table
        if ($obj->insert('brand', $data)) { // If insertion is successful
            $data['status'] = 1; // Set status as 1 (indicating success)
        } else {
            $data['status'] = 0; // Set status as 0 (indicating failure)
        }
    }
    echo json_encode($data); // Encode data array as JSON and send it as response
}

// Check if the form type is 'edit'
if ($_POST['form_type'] == 'edit') {
    $brand_id = $_POST['brand_id']; // Get the brand ID from the form data
    $query = $obj->custom_get("brand", "WHERE brand_id = '$brand_id'"); // Fetch brand data by ID

    echo json_encode($query); // Encode fetched data as JSON and send it as response
}

// Check if the form type is 'update_brand'
if ($_POST['form_type'] == 'update_brand') {
    $brand_id = $_POST['brand_id']; // Get the brand ID from the form data
    $data = [
        'brand_name' => $_POST['brand_name'], // Assign brand name from form
        'brand_slug_name' => $obj->slugify($_POST['brand_name'], 'brand_slug_name', 'brand'), // Generate slug name for brand
        'brand_category_id' => $_POST['category_name'], // Assign category ID from form
        'brand_created_at' => date('Y-m-d H:i:s') // Assign current date and time
    ];

    // Update data in the 'brand' table based on brand ID
    $update_query = $obj->update("brand", $data, "WHERE brand_id = '$brand_id'"); 

    if ($update_query) { // If update is successful
        $output = [
            'status' => '1',
            'message' => "brand data successfully updated"
        ];

        echo json_encode($output); // Encode output data as JSON and send it as response
    }
}

// Check if the form type is 'delete_brand'
if ($_POST['form_type'] == 'delete_brand') {
    $brand_id = $_POST['brand_id']; // Get the brand ID from the form data
    $delete_product = $obj->delete("brand", "where brand_id = '$brand_id'"); // Delete brand by ID

    if ($delete_product) { // If deletion is successful
        $result = [
            'status' => 200,
            'message' => "brand delete successfully"
        ];
    } else { // If deletion fails
        $result = [
            'status' => 401,
            'message' => "Something went wrong"
        ];
    }
    echo json_encode($result); // Encode result data as JSON and send it as response
}
