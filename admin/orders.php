<?php
require_once 'includes/header.php'; // Include header
require_once '../class/Crud.php'; // Include CRUD class
$obj = new Crud(); // Create an instance of Crud class
$no_of_records_per_page = 5; // Records per page

// Check and set the current page number
$pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
$offset = ($pageno - 1) * $no_of_records_per_page; // Calculate the offset for pagination
?>

<div class="container">
    <section class="order-section">
        <h1 class="text-uppercase border-bottom">Orders</h1>

        <table class="table table-bordered mt-3">
            <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            // Fetch orders data using the Crud class
            foreach ($obj->get('orders', $offset, $no_of_records_per_page) as $row) {
                $user_id = $row['user_id'];
                // Fetch user details using the user ID in the orders table
                $user = $obj->custom_get('users', " WHERE user_id =  '$user_id'",'fetch');
                // echo '<pre>'; print_r($user); die();
            ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td><?php echo $row['order_status']; ?></td>
                    <td><button type="button" class="btn btn-primary edit" id="<?php echo $row['order_id']; ?>">Edit</button></td>
                    <td><a href="#" class="btn btn-danger delete" data-id="<?php echo $row['order_id']; ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

        <!-- Pagination Links -->
        <ul class="pagination">
            <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
            <li class="page-item <?php if ($pageno <= 1) echo 'disabled'; ?>">
                <a href="<?php if ($pageno <= 1) echo '#'; else echo '?pageno=' . ($pageno - 1); ?>" class="page-link">Previous</a>
            </li>
            <?php
            // Fetch total number of pages for pagination
            $total_pages = $obj->pagination('orders', $no_of_records_per_page);
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($pageno == $i) {
                    echo '<li class="page-item active"><a href="?pageno=' . $i . '" class="page-link">' . $i . '</a></li>';
                } else {
                    echo '<li class="page-item"><a href="?pageno=' . $i . '" class="page-link">' . $i . '</a></li>';
                }
            }
            ?>
            <li class="page-item <?php if ($pageno >= $total_pages) echo 'disabled'; ?>">
                <a href="<?php if ($pageno >= $total_pages) echo '#'; else echo '?pageno=' . ($pageno + 1); ?>" class="page-link">Next</a>
            </li>
            <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
        </ul>
    </section>
</div>
<?php require_once 'includes/footer.php'; ?>
<script>
// AJAX for edit and delete functionality
$(document).ready(function() {
    // Edit order event listener
    $('.edit').click(function() {
        var order_id = $(this).attr('id');
        window.location.href = "order_edit.php?order_id=" + order_id;
    });

    // Delete order event listener
    $('.delete').click(function() {
        var order_id = $(this).data('id');
        if (confirm("Are you sure you want to delete this order?")) {
            $.ajax({
                url: "action/order_action.php",
                method: "POST",
                data: { order_id: order_id, action: "delete" },
                success: function(response) {
                    location.reload();
                }
            });
        }
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>
