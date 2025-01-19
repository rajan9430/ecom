<?php
require_once 'includes/header.php'; // Include header file
require_once '../class/Crud.php'; // Include CRUD class

if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page if not logged in
    header('Location: admin_login.php');
    exit;
}

$obj =  new Crud(); // Create an instance of Crud class

$q = $obj->custom_get("category"); // Fetch categories from the database
$no_of_records_per_page = 5; // Number of records per page

if (isset($_GET['pageno'])) { // Check if 'pageno' is set in the URL
    $pageno = $_GET['pageno']; // Assign the value of 'pageno' from URL
} else {
    $pageno = 1; // Default page number is 1
}

$offset = ($pageno - 1) * $no_of_records_per_page; // Calculate offset for pagination
?>

<div class="container">
    <section class="category-section">
        <h1 class="text-uppercase border-bottom">Brand</h1>

        <button class="btn btn-primary add_brand">Add new Brand</button> <!-- Button to add new brand -->

        <div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- Modal for adding/updating brand -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> <!-- Modal title -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="brand_form">
                            <!-- Fetch the category list from database -->
                            <div class="form-group mb-3">
                                <label for="category_name">Category Name</label> <!-- Label for category select -->
                                <select name="category_name" id="category_name" class="form-control"> <!-- Select input for category -->
                                    <option value="0">Select a Category</option>
                                    <?php foreach ($q as $row) : ?> <!-- Loop through categories -->
                                        <option value="<?= $row['category_id']; ?>"><?= $row['category_name']; ?></option> <!-- Option for each category -->
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Brand Name</label> <!-- Label for brand name input -->
                                <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Brand Name"> <!-- Input field for brand name -->

                                <span id="error" class="text-danger"></span> <!-- Error message display -->
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="brand_id" name="brand_id"> <!-- Hidden input field for brand ID -->
                        <input type="hidden" name="form_type" id="form_type"> <!-- Hidden input field for form type -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <!-- Close button for modal -->
                        <button type="submit" class="btn btn-primary save" id="submit">Save</button> <!-- Button to save brand -->
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-bordered mt-3">
            <tr>
                <th>ID</th>
                <th>Brand name</th>
                <th>Category Name</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php foreach ($obj->get('brand LEFT JOIN category ON brand.brand_category_id = category.category_id', $offset, $no_of_records_per_page) as $row) { ?> <!-- Loop through brands -->
                <tr class="brand_row_<?= $row['brand_id']; ?>"> <!-- Row for each brand -->
                    <td><?= $row['brand_id']; ?></td> <!-- Display brand ID -->
                    <td><?= $row['brand_name']; ?></td> <!-- Display brand name -->
                    <td><?= $row['category_name']; ?></td> <!-- Display category name -->
                    <td><?= $row['brand_created_at']; ?></td> <!-- Display brand creation date -->
                    <td><button class="btn btn-primary edit" id="<?= $row['brand_id']; ?>">Edit</button></td> <!-- Button to edit brand -->
                    <td><a href="#" class="btn btn-danger delete-brand" data-brand-id="<?= $row['brand_id']; ?>">Delete</a></td> <!-- Button to delete brand -->
                </tr>
            <?php } ?>

        </table>

        <ul class="pagination">
            <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li> <!-- Link to first page -->
            <li class="page-item <?php if ($pageno <= 1) { echo 'disabled'; } ?>"> <!-- Check if current page is first -->
                <a href="<?php if ($pageno <= 1) { echo '#'; } else { echo '?pageno=' . ($pageno - 1); } ?>" class="page-link"><span class="larger-angle">&lt;&lt;</span> Previos</a> <!-- Link to previous page -->
            </li>
            <?php
            $total_pages = $obj->pagination('brand', $no_of_records_per_page); // Get total number of pages for pagination
            for ($i = 1; $i <= $total_pages; $i++) { // Loop through pages
                if ($pageno == $i) {
                    echo '<li class="page-item active"><a href="?pageno=' . $i . '" class="page-link">' . $i . '</a></li>'; // Display active page
                } else {
                    echo '<li class="page-item"><a href="?pageno=' . $i . '" class="page-link">' . $i . '</a></li>'; // Display page link
                }
            }
            ?>
            <li class="page-item <?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>">
                <a href="<?php if ($pageno >= $total_pages) { echo '#'; } else { echo '?pageno=' . ($pageno + 1); } ?>" class="page-link">Next <span class="larger-angle">&gt;&gt;</span></a> <!-- Link to next page -->
            </li>
            <li class="page-item <?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li> <!-- Link to last page -->
        </ul>

    </section>
</div>
<?php require_once 'includes/footer.php'; ?> <!-- Include footer file -->

<script>

    $(document).ready(function() {
        $(document).on("submit", "#brand_form", function(e) { // Form submission event listener
            e.preventDefault(); // Prevent default form submission

            var fd = new FormData(this); // Create new FormData object with form data

            $.ajax({ // AJAX request
                url: 'action/brand_action.php', // URL to handle form data
                type: 'POST', // Request type
                data: fd, // Form data
                dataType: 'json', // Expected data type
                processData: false, // Process data option
                contentType: false, // Content type option
                success: function(response) { // Success callback
                    if (response.status == 0) { // If status is 0 (error)
                        $('#error').html(response.msg_error); // Display error message
                    }
                    if (response.status == 1) { // If status is 1 (success)
                        $('#brand_form')[0].reset(); // Reset form
                        $('#brnadModal').modal('hide'); // Hide modal
                        $('#error').html(''); // Clear error message
                        location.reload(); // Reload page
                    }
                }
            });
        });

        $('.edit').click(function() { // Edit button click event listener
            var brand_id = $(this).attr('id'); // Get brand ID
            var btn = "edit"; // Set action as edit
            $('#brandModal').modal('show'); // Show modal
            $('.modal-title').text('Update your Brand'); // Change modal title
            $('#submit').removeClass('btn-primary save').addClass('btn-warning update').text('update'); // Change submit button text and class
            $('#form_type').val('update_brand'); // Set form type as update_brand

            $.ajax({ // AJAX request
                url: "action/brand_action.php", // URL to handle form data
                method: "POST", // Request type
                data: { // Data to be sent
                    brand_id: brand_id,
                    form_type: "edit"
                },
                dataType: "json", // Expected data type
                success: function(res) { // Success callback
                    console.log(res); // Log response to console
                    var brand_name = res[0].brand_name; // Get brand name from response
                    var category_id = res[0].brand_category_id; // Get category ID from response

                    $("#brand_name").val(brand_name); // Set brand name in input field
                    $("#category_name").val(category_id); // Set category ID in select field
                    $("#brand_id").val(res[0].brand_id); // Set brand ID in hidden input field
                }
            })
        });
        
        $(".delete-brand").click(function() { // Delete button click event listener
            let brand_id = $(this).data("brand-id"); // Get brand ID
            let delete_confirmation = confirm("Are you sure you want to delete this product ?"); // Confirmation message
            if (delete_confirmation) { // If user confirms deletion
                $.ajax({ // AJAX request
                    url: "action/brand_action.php", // URL to handle form data
                    type: 'POST', // Request type
                    data: { // Data to be sent
                        brand_id: brand_id,
                        form_type: "delete_brand"
                    },
                    dataType: 'json', // Expected data type
                    success: function(res) { // Success callback
                        if (res.status == 200) { // If deletion is successful
                            $(".brand_row_" + brand_id).remove(); // Remove brand row from table
                        }
                    }
                })
            }
        });
    });
</script>
