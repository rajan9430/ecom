<?php
require_once 'includes/header.php'; // Include header
require_once '../class/Crud.php'; // Include CRUD class
$obj = new Crud(); // Create an instance of Crud class
$no_of_records_per_page = 10; // Number of records per page

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno']; // Get the current page number from URL
} else {
    $pageno = 1; // Default to the first page
}

$offset = ($pageno - 1) * $no_of_records_per_page; // Calculate offset for pagination
?>

<div class="container">
    <section class="slider-section">
        <h1 class="text-uppercase border-bottom">Sliders</h1>

        <button class="btn btn-primary add_slider">Add New Slider</button> <!-- Button to add new slider -->

        <!-- Modal for adding/updating slider -->
        <div class="modal fade" id="sliderModal" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sliderModalLabel">Add New Slider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="slider_form" enctype="multipart/form-data"> <!-- Form for slider -->
                            <div class="form-group">
                                <label for="slider_title">Slider Title</label>
                                <input type="text" class="form-control" name="slider_title" id="slider_title">
                                <span id="error_title" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="slider_image">Slider Image</label>
                                <input type="file" class="form-control" name="slider_image" id="slider_image">
                                <span id="error_image" class="text-danger"></span>
                            </div>
                            <img src="" height="150px" id="slider_old_image">
                            <div class="form-group">
                                <label for="buy_now_link">Buy Now Link</label>
                                <input type="url" class="form-control" name="buy_now_link" id="buy_now_link">
                                <span id="error_link" class="text-danger"></span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="slider_id" name="id">
                        <input type="hidden" name="form_type" id="form_type" value="save">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary save" id="submit">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table to display sliders -->
        <table class="table table-bordered mt-3">
            <tr>
                <th>ID</th>
                <th>Slider Image</th>
                <th>Title</th>
                <th>Buy Now Link</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($obj->get('sliders', $offset, $no_of_records_per_page) as $row) { ?>
                <tr class="slider_row_<?= $row['id']; ?>">
                    <td><?php echo $row['id']; ?></td>
                    <td><img src="../uploads/images/slider/<?php echo $row['image']; ?>" width="100"></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><a href="<?php echo $row['buy_now_link']; ?>"
                            target="_blank"><?php echo $row['buy_now_link']; ?></a></td>
                    <td><button class="btn btn-primary edit_slider" id="<?php echo $row['id']; ?>">Edit</button></td>
                    <!-- <td><a href="#" class="btn btn-danger delete" data-id="<?php echo $row['id']; ?>">Delete</a></td> -->
                    <td><button type="button" class="btn btn-danger delete"
                            data-id="<?php echo $row['id']; ?>">Delete</button></td>
                </tr>
            <?php } ?>
        </table>

        <!-- Pagination links -->
        <ul class="pagination">
            <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
            <li class="page-item <?php if ($pageno <= 1) {
                echo 'disabled';
            } ?>">
                <a href="<?php if ($pageno <= 1) {
                    echo '#';
                } else {
                    echo '?pageno=' . ($pageno - 1);
                } ?>" class="page-link">Previous</a>
            </li>
            <?php
            $total_pages = $obj->pagination('sliders', $no_of_records_per_page);
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($pageno == $i) {
                    echo '<li class="page-item active"><a href="?pageno=' . $i . '" class="page-link">' . $i . '</a></li>';
                } else {
                    echo '<li class="page-item"><a href="?pageno=' . $i . '" class="page-link">' . $i . '</a></li>';
                }
            }
            ?>
            <li class="page-item <?php if ($pageno >= $total_pages) {
                echo 'disabled';
            } ?>">
                <a href="<?php if ($pageno >= $total_pages) {
                    echo '#';
                } else {
                    echo '?pageno=' . ($pageno + 1);
                } ?>" class="page-link">Next</a>
            </li>
            <li class="page-item <?php if ($pageno >= $total_pages) {
                echo 'disabled';
            } ?>"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
        </ul>
    </section>
</div>

<?php require_once 'includes/footer.php'; ?> <!-- Include footer -->
<script>
    $(document).ready(function () {
        $(document).on("submit", "#slider_form", function (e) {
            e.preventDefault();

            var fd = new FormData(this); // Create FormData object with form data

            $.ajax({
                url: 'action/slider_action.php', // URL for handling insert/update
                type: 'POST',
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 0) {
                        $('#error').html(response.msg_error);
                    } else if (response.status == 1) {
                        $('#slider_form')[0].reset(); // Reset form
                        $('#sliderModal').modal('hide'); // Hide modal
                        location.reload(); // Reload page
                    }
                }
            });
        });

        $('.edit_slider').click(function () { // Edit button click event listener
            var slider_id = $(this).attr('id'); // Get category ID
            var btn = "fetch"; // Set action as edit
            $('#sliderModal').modal('show'); // Show modal
            $('.modal-title').text('Update your Slider'); // Change modal title
            $('#submit').removeClass('btn-primary save').addClass('btn-warning update').text('update'); // Change submit button text and class
            $('#form_type').val('edit'); // Set form type as edit

            $.ajax({ // AJAX request
                url: "action/slider_action.php", // URL to handle form data
                method: "POST", // Request type
                data: { // Data to be sent
                    slider_id: slider_id,
                    action: btn,
                },
                dataType: "json", // Expected data type
                success: function (res) { // Success callback
                    $('#slider_title').val(res.slider_title);
                    $('#slider_id').val(res.slider_id);
                    $('#slider_old_image').attr('src', `../uploads/images/slider/${res.slider_image}`)
                    $('#buy_now_link').val(res.buy_now_link);
                }
            })

        });

        // Edit button click event
        $('.edit').click(function () {
            var slider_id = $(this).attr('id'); // Get slider ID

            $.ajax({
                url: 'action/slider_action.php', // Server script to fetch the slider data
                method: 'POST',
                data: { slider_id: slider_id, action: 'edit' }, // Send the slider ID
                dataType: 'json',
                success: function (response) {
                    // Populate the popup form with the slider data
                    $('#slider_title').val(response.slider_title);
                    $('#buy_now_link').val(response.buy_now_link);
                    $('#slider_id').val(response.slider_id); // Hidden input for slider ID
                    $('#form_type').val('edit'); // Set form type to 'edit'

                    // Display the image in a preview
                    $('#image_preview').attr('src', '../images/slider/' + response.slider_image);

                    // Change modal title and button text
                    $('#sliderModal').modal('show');
                    $('.modal-title').text('Edit Slider');
                    $('#submit').removeClass('btn-primary').addClass('btn-warning').text('Update');
                }
            });
        });

        $('.delete').click(function () {
            var slider_id = $(this).data('id'); // Get slider ID
            var confirmDelete = confirm("Are you sure you want to delete this slider?");

            if (confirmDelete) {
                $.ajax({
                    url: 'action/slider_action.php', // Server script for delete action
                    method: 'POST',
                    data: { slider_id: slider_id, action: 'delete' }, // Send slider ID and action type
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 1) {
                            // Remove the row from the table
                            $('.slider_row_' + slider_id).remove();
                        } else {
                            alert("Failed to delete slider: " + response.msg_error);
                        }
                    }
                });
            }
        });
    });

</script>