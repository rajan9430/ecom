<?php require_once 'includes/header.php'; // Include header file
require_once '../class/Crud.php'; // Include CRUD class
$obj = new Crud(); // Create an instance of Crud class
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
        <h1 class="text-uppercase border-bottom">category</h1>

        <button class="btn btn-primary add_category">Add new Category</button> <!-- Button to add new category -->

        <div class="modal fade" id="catModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- Modal for adding/updating category -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> <!-- Modal title -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="cat_form"> <!-- Form for category -->
                            <div class="form-group">
                                <label for="category_name">Category Name</label> <!-- Label for category name input -->
                                <input type="text" class="form-control" name="category_name" id="category_name"> <!-- Input field for category name -->

                                <span id="error" class="text-danger"></span> <!-- Error message display -->
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="cat_id" name="id"> <!-- Hidden input field for category ID -->
                        <input type="hidden" name="form_type" id="form_type" value="save"> <!-- Hidden input field for form type -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <!-- Close button for modal -->
                        <button type="submit" class="btn btn-primary save" id="submit">Save</button> <!-- Button to save category -->
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-bordered mt-3">
            <tr>
                <th>ID</th>
                <th>Category name</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($obj->get('category', $offset, $no_of_records_per_page) as $row) { ?> <!-- Loop through categories -->
                <tr>
                    <td><?php echo $row['category_id']; ?></td> <!-- Display category ID -->
                    <td><?php echo $row['category_name']; ?></td> <!-- Display category name -->
                    <td><?php echo $row['cat_created_at']; ?></td> <!-- Display category creation date -->
                    <td><button type="button" class="btn btn-primary edit" id="<?php echo $row['category_id']; ?>">Edit</a></td> <!-- Button to edit category -->
                    <td><a href="#" class="btn btn-danger delete" data-id="<?php echo $row['category_id']; ?>">Delete</a></td> <!-- Button to delete category -->
                </tr>
            <?php } ?>
        </table>
        <ul class="pagination">
            <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li> <!-- Link to first page -->
            <li class="page-item <?php if ($pageno <= 1) { echo 'disabled'; } ?>"> <!-- Check if current page is first -->
                <a href="<?php if ($pageno <= 1) { echo '#'; } else { echo '?pageno=' . ($pageno - 1); } ?>" class="page-link"><span class="larger-angle">&lt;&lt;</span> Previos</a> <!-- Link to previous page -->
            </li>
            <?php
            $total_pages = $obj->pagination('category', $no_of_records_per_page); // Get total number of pages for pagination
            for ($i = 1; $i <= $total_pages; $i++) { // Loop through pages
                if ($pageno == $i) {
                    echo '<li class="page-item active"><a href="?pageno=' . $i . '" class="page-link">' . $i . '</a></li>'; // Display active page
                } else {
                    echo '<li class="page-item"><a href="?pageno=' . $i . '" class="page-link">' . $i . '</a></li>'; // Display page link
                }
            }
            ?>
            <li class="page-item <?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>"> <!-- Check if current page is last -->
                <a href="<?php if ($pageno >= $total_pages) { echo '#'; } else { echo '?pageno=' . ($pageno + 1); } ?>" class="page-link">Next <span class="larger-angle">&gt;&gt;</span></i></a> <!-- Link to next page -->
            </li>
            <li class="page-item <?php if ($pageno >= $total_pages) { echo 'disabled'; } ?>"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li> <!-- Link to last page -->
        </ul>
    </section>
</div>

<?php require_once 'includes/footer.php'; ?> <!-- Include footer file -->

<script>
    $(document).ready(function() {
        $(document).on('submit', '#cat_form', function(e) { // Form submission event listener
            e.preventDefault(); // Prevent default form submission

            var fd = new FormData(); // Create new FormData object

            $.ajax({ // AJAX request
                url: 'insert/cat_insert.php', // URL to handle form data
                type: 'post', // Request type
                data: fd, // Form data
                dataType: 'json', // Expected data type
                processData: false, // Process data option
                contentType: false, // Content type option
                success: function(response) { // Success callback
                    console.log(response); // Log response to console
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on("submit", "#cat_form", function(e) { // Form submission event listener
            e.preventDefault(); // Prevent default form submission

            var fd = new FormData(this); // Create new FormData object with form data

            $.ajax({ // AJAX request
                url: 'insert/cat_insert.php', // URL to handle form data
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
                        $('#cat_form')[0].reset(); // Reset form
                        $('#catModal').modal('hide'); // Hide modal
                        $('#error').html(''); // Clear error message
                        location.reload(); // Reload page
                    }
                }
            });
        });

        $('.edit').click(function() { // Edit button click event listener
            var cat_id = $(this).attr('id'); // Get category ID
            var btn = "edit"; // Set action as edit
            $('#catModal').modal('show'); // Show modal
            $('.modal-title').text('Update your Category'); // Change modal title
            $('#submit').removeClass('btn-primary save').addClass('btn-warning update').text('update'); // Change submit button text and class
            $('#form_type').val('edit'); // Set form type as edit

            $.ajax({ // AJAX request
                url: "action/cat_action.php", // URL to handle form data
                method: "POST", // Request type
                data: { // Data to be sent
                    cat_id: cat_id,
                    action: btn,
                },
                dataType: "json", // Expected data type
                success: function(res) { // Success callback
                    $('#category_name').val(res.category_name); // Set category name in input field
                    $('#cat_id').val(res.category_id); // Set category ID in hidden input field
                }
            })

        });

        $('.delete').click(function() { // Delete button click event listener
            var id = $(this).data('id'); // Get category ID
            var confirm = window.confirm("Are you sure you want to delete?"); // Confirmation message
            if (confirm) { // If user confirms deletion
                $.ajax({ // AJAX request
                    url: "action/cat_action.php", // URL to handle form data
                    method: "POST", // Request type
                    data: { // Data to be sent
                        id: id,
                        action: "delete",
                    },
                    dataType: "json", // Expected data type
                    success: function(res) { // Success callback
                        if (res.status == 200) { // If deletion is successful
                            $("#"+res.cat_id).remove(); // Remove category from table
                            location.reload(); // Reload page
                        }
                    }
                });
            }
        });
    });
</script>
