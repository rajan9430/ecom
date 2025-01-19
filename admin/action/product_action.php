<?php

require_once '../../class/crud.php'; // Include the Crud class file
$obj = new Crud(); // Create a new instance of the Crud class

// Check if the form type is 'save'
if ($_POST['form_type'] == 'save') {

    $allowed_types = ['jpg', 'png', 'jpeg']; // Allowed file types for upload
    $max_file_size = 2 * 1024 * 1024; // Maximum file size: 2MB
    $result = []; // Initialize result array

    // Check if the file is uploaded without any errors
    if ($_FILES['product_thumbnail']['error'] == UPLOAD_ERR_OK) {

        $file_name = $_FILES['product_thumbnail']['name']; // Get the name of the uploaded file

        $tmp_file_name = $_FILES['product_thumbnail']['tmp_name']; // Get the temporary file name
        $file_size = $_FILES['product_thumbnail']['size']; // Get the file size

        $file_extension_name = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // Get the file extension

        // Validate file extension
        if (!in_array($file_extension_name, $allowed_types)) {
            $result = [
                'status' => 'error',
                'message' => 'Invalid file extension ' . $file_extension_name
            ];
        } 
        // Validate file size
        elseif ($file_size > $max_file_size) {
            $result = [
                'status' => 'error',
                'message' => 'Invalid file size. Max file size is - 2MB'
            ];
        } else {
            $new_file_name = date("Ymdhis") . '.' . $file_extension_name; // Generate a new unique file name

            $target_dir = '../../uploads/products'; // Target directory for file upload

            $target_file = $target_dir . '/' . $new_file_name; // Full path to the target file

            move_uploaded_file($tmp_file_name, $target_file); // Move the uploaded file to the target directory

            // Prepare product data for insertion
            $product_data = [
                'product_title' => $_POST['product_title'],
                'category_id' => $_POST['category_name'],
                'brand_id' => $_POST['brand_name'],
                'regular_price' => $_POST['regular_price'],
                'selling_price' => $_POST['selling_price'],
                'short_description' => $_POST['short_description'],
                'long_description' => $_POST['long_description'],
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ];

            // If a file was uploaded, add its name to the product data
            if ($file_name) {
                $product_data['product_thumbnail'] = $new_file_name;
            }

            // Insert the product data into the database
            if ($obj->insert('products', $product_data)) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
            }
        }
    } else {
        $result = [
            'status' => 'error',
            'message' => 'Error uploading file'
        ];
    }

    echo json_encode($result); // Encode the result as JSON and echo it
}

// Check if the form type is 'fetch_product'
if ($_POST['form_type'] == 'fetch_product') {

    $product_id = $_POST['product_id']; // Get the product ID from the form data

    $fetch_product = $obj->custom_get("products", " WHERE product_id = $product_id", 'fetch'); // Fetch product data by ID

    echo json_encode($fetch_product); // Encode the fetched product data as JSON and echo it
}

// Check if the form type is 'update_product'
if ($_POST['form_type'] == 'update_product') {

    // Check if a new thumbnail file was uploaded
    if ($_FILES['product_thumbnail']['name'] != '') {
        $allowed_types = ['jpg', 'png', 'jpeg']; // Allowed file types for upload
        $max_file_size = 2 * 1024 * 1024; // Maximum file size: 2MB
        $result = []; // Initialize result array

        // Check if the file is uploaded without any errors
        if ($_FILES['product_thumbnail']['error'] == UPLOAD_ERR_OK) {

            $file_name = $_FILES['product_thumbnail']['name']; // Get the name of the uploaded file

            $tmp_file_name = $_FILES['product_thumbnail']['tmp_name']; // Get the temporary file name
            $file_size = $_FILES['product_thumbnail']['size']; // Get the file size

            $file_extension_name = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // Get the file extension

            // Validate file extension
            if (!in_array($file_extension_name, $allowed_types)) {
                $result = [
                    'status' => 'error',
                    'message' => 'Invalid file extension ' . $file_extension_name
                ];
            } 
            // Validate file size
            elseif ($file_size > $max_file_size) {
                $result = [
                    'status' => 'error',
                    'message' => 'Invalid file size. Max file size is - 2MB'
                ];
            } else {
                $new_file_name = date("Ymdhis") . '.' . $file_extension_name; // Generate a new unique file name

                $target_dir = '../../uploads/products'; // Target directory for file upload

                $target_file = $target_dir . '/' . $new_file_name; // Full path to the target file

                move_uploaded_file($tmp_file_name, $target_file); // Move the uploaded file to the target directory
            }
        } else {
            $result = [
                'status' => 'error',
                'message' => 'Error uploading file'
            ];
        }
    } else {
        $file_name = ''; // If no new file was uploaded, set file name to empty string
    }

    // Prepare product data for update
    $product_data = [
        'product_title' => $_POST['product_title'],
        'category_id' => $_POST['category_name'],
        'brand_id' => $_POST['brand_name'],
        'regular_price' => $_POST['regular_price'],
        'selling_price' => $_POST['selling_price'],
        'short_description' => $_POST['short_description'],
        'long_description' => $_POST['long_description'],
        'status' => 1,
        'created_at' => date("Y-m-d H:i:s")
    ];
    
    // If a new thumbnail file was uploaded, add its name to the product data
    if ($file_name) {
        $product_data['product_thumbnail'] = $new_file_name;
    }
    
    $product_id = $_POST['product_id']; // Get the product ID from the form data

    // Update the product data in the database
    if ($update_query = $obj->update("products", $product_data, "WHERE product_id = '$product_id'")) {
        $result['status'] = 1;
    } else {
        $result['status'] = 0;
    }

    echo json_encode($result); // Encode the result as JSON and echo it
}

// Check if the form type is 'delete_product'
if ($_POST['form_type'] == 'delete_product') {
    $product_id = $_POST['product_id']; // Get the product ID from the form data
    $delete_product = $obj->delete("products", "where product_id = '$product_id'"); // Delete the product by ID

    // Check if the deletion was successful
    if ($delete_product) {
        $result = [
            'status' => 200,
            'message' => "Product delete successfully"
        ];
    } else { 
        $result = [
            'status' => 401,
            'message' => "Something went wrong"
        ];
    }
    
    echo json_encode($result); // Encode the result as JSON and echo it
}
