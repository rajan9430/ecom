<?php
require_once '../../class/Crud.php'; // Include CRUD class

$obj = new Crud();

$response = array('status' => 0, 'msg_error' => '');

// Check if the form is submitted via POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type']) && ($_POST['form_type'] == 'save' || $_POST['form_type'] == 'edit')) {
    // Retrieve form data
    $slider_title = $_POST['slider_title'];
    $buy_now_link = $_POST['buy_now_link'];
    $form_type = $_POST['form_type'];

    // Validation - Check if required fields are filled
    if (empty($slider_title)) {
        $response['msg_error'] = 'Slider title is required';
        echo json_encode($response);
        exit;
    }
    
    if (empty($buy_now_link)) {
        $response['msg_error'] = 'Buy Now link is required';
        echo json_encode($response);
        exit;
    }

    // File upload handling
    if (isset($_FILES['slider_image']['name']) && $_FILES['slider_image']['name'] != '') {
        $image_name = $_FILES['slider_image']['name'];
        $image_temp = $_FILES['slider_image']['tmp_name'];

        $upload_dir = '../../uploads/images/slider/'; // Folder to upload images
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION); // Get file extension
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

        // Validate image type
        if (!in_array($image_extension, $allowed_extensions)) {
            $response['msg_error'] = 'Only JPG, JPEG, PNG, GIF files are allowed';
            echo json_encode($response);
            exit;
        }

        // Set unique image name
        $new_image_name = time() . '_' . $image_name;

        // Move the uploaded file to the destination folder
        if (!move_uploaded_file($image_temp, $upload_dir . $new_image_name)) {
            $response['msg_error'] = 'Image upload failed';
            echo json_encode($response);
            exit;
        }
    } elseif($_POST['form_type'] != 'edit') {
        $response['msg_error'] = 'Slider image is required';
        echo json_encode($response);
        exit;
    }

    // Insert or Update based on form type
    if ($form_type == 'save') {
        // Prepare data to insert into the sliders table
        $data = array(
            'title' => $slider_title,
            'image' => $new_image_name,
            'buy_now_link' => $buy_now_link
        );

        // Insert into the database
        if ($obj->insert('sliders', $data)) {
            $response['status'] = 1;
        } else {
            $response['msg_error'] = 'Failed to insert slider';
        }
    } elseif ($form_type == 'edit') {
        // Handle update logic here if editing an existing slider
        $slider_id = $_POST['id'];

        // Update data array
        $data = array(
            'title' => $slider_title,
            'buy_now_link' => $buy_now_link
        );

        if (!empty($new_image_name)) {
            $data['image'] = $new_image_name; // Update image only if a new one is uploaded
        }

        // Update the slider in the database
        if ($obj->update('sliders', $data, " WHERE id = '$slider_id'")) {
            $response['status'] = 1;
        } else {
            $response['msg_error'] = 'Failed to update slider';
        }
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $slider_id = $_POST['slider_id'];
    // echo '<pre>'; print_r($slider_id); die();
    // Fetch slider details from database
    $slider = $obj->custom_get('sliders', " WHERE id = '$slider_id'", 'fetch');

    // Prepare JSON response with slider data
    $response = array(
        'slider_id' => $slider['id'],
        'slider_title' => $slider['title'],
        'slider_image' => $slider['image'],
        'buy_now_link' => $slider['buy_now_link']
    );

    // echo json_encode($response);
}

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $slider_id = $_POST['slider_id'];

    // Fetch the slider data to get the image filename
    $slider = $obj->custom_get('sliders', " WHERE id = '$slider_id'", 'fetch');
    $slider_image = $slider['image'];
    $image_path = "../images/slider/" . $slider_image;

    // Check if image exists, then delete it
    if (file_exists($image_path) && is_file($image_path)) {
        unlink($image_path); // Delete the image file
    }

    // Delete the slider record from the database
    if ($obj->delete('sliders', " WHERE id = '$slider_id' ")) {
        $response = ['status' => 1]; // Successful deletion response
    } else {
        $response = ['status' => 0, 'msg_error' => 'Failed to delete slider'];
    }
}

// Return the JSON response
echo json_encode($response);
?>
