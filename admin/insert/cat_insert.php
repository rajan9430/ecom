<?php
require_once '../../class/Crud.php'; // Include the Crud class file

$obj = new Crud(); // Create a new instance of the Crud class

// Check if the form type is 'save'
if ($_POST['form_type'] == 'save') {
    // Check if the 'category_name' field is empty
    if (empty($_POST['category_name'])) {
        $data['msg_error'] = 'Please Fill the Category Field'; // Set error message
        $data['status'] = 0; // Set status as 0 (indicating failure)
    } else {
        // Prepare data array with category name and slug URL
        $data = [
            'category_name' => $_POST['category_name'], // Assign category name from form
            'category_slug_url' => $obj->slugify($_POST['category_name'], 'category_slug_url', 'category'), // Generate slug URL using Crud method
        ];

        // Insert data into the 'category' table
        if ($obj->insert('category', $data)) { // If insertion is successful
            $data['status'] = 1; // Set status as 1 (indicating success)
        } else {
            $data['status'] = 0; // Set status as 0 (indicating failure)
        }
    }

    // Encode data array as JSON and send it as response
    echo json_encode($data);
}

// Check if the form type is 'edit'
if ($_POST['form_type'] == 'edit') {
    // Check if the 'category_name' field is empty
    if (empty($_POST['category_name'])) {
        $data['msg_error'] = 'Please Fill the Category Field'; // Set error message
        $data['status'] = 0; // Set status as 0 (indicating failure)
    } else {
        // Prepare data array with category name and slug URL
        $data = [
            'category_name' => $_POST['category_name'], // Assign category name from form
            'category_slug_url' => $obj->slugify($_POST['category_name'], 'category_slug_url', 'category'), // Generate slug URL using Crud method
        ];
        $id = $_POST['id']; // Get the category ID from the form data

        // Update data in the 'category' table based on category ID
        if ($obj->update('category', $data, " WHERE `category_id` = $id")) { // If update is successful
            $data['status'] = 1; // Set status as 1 (indicating success)
        } else {
            $data['status'] = 0; // Set status as 0 (indicating failure)
        }
    }

    // Encode data array as JSON and send it as response
    echo json_encode($data);
}
