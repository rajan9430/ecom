<?php

require_once '../../class/crud.php'; // Include the Crud class file

$obj = new Crud(); // Create a new instance of the Crud class

// Check if the action is 'edit'
if ($_POST['action'] == 'edit') {
    $cat_id = $_POST['cat_id']; // Get the category ID from the form data
    $a = $obj->custom_get('category', "WHERE `category_id` = '$cat_id'"); // Fetch category data by ID

    // Loop through the fetched data and encode each row as JSON and echo it
    foreach ($a as $row) {
        echo json_encode($row);
    }
}

// Check if the action is 'delete'
if ($_POST['action'] == 'delete') {
    $cat_id = $_POST['id']; // Get the category ID from the form data
    $q = $obj->delete('category', "WHERE `category_id` = '$cat_id'"); // Delete category by ID
    if ($q) { // If deletion is successful
        $data = [
            'status' => 200,
            'message' => 'Category has been deleted',
        ];
    } else { // If deletion fails
        $data = [
            'status' => 203,
            'message' => 'Something went wrong',
        ];
    }

    echo json_encode($data); // Encode result data as JSON and send it as response
}

// Check if the action is 'fetch_brand'
if ($_POST['action'] == 'fetch_brand') {
    $cat_id = $_POST['cat_id']; // Get the category ID from the form data

    // Fetch brands associated with the category ID
    $query = $obj->custom_get("brand", "WHERE `brand_category_id` = '$cat_id'");
    $output = '<option selected disabled>--Select your brand name --</option>'; // Initial select option
    // Loop through the fetched brands and create option elements
    foreach ($query as $brand) {
        $output .= '<option value="' . $brand['brand_id'] . '">' . $brand['brand_name'] . '</option>';
    }
    echo $output; // Echo the generated HTML for brand options
}
