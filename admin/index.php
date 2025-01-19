<!-- Include the header file -->
<?php 
require_once('includes/header.php'); 
?>
<!-- This is our working panel section -->
<section class="working-panel">
    <div class="container-fluid">
        <!-- Welcome message and dashboard title -->
        <h1 class="display-4">Welcome to Dashboard</h1>
        <hr>

        <div class="row">
            <!-- Category widget -->
            <div class="col-md-3">
                <div class="card bg-orange-g text-white">
                    <div class="card-body">
                        <h4 class="font-weight-light"><i class="fas fa-layer-group"></i> All Category</h4>
                        <hr>
                        <h5>
                            <b>12345</b>
                        </h5>
                    </div>
                </div>
            </div>
            <!-- All brands widget -->
            <div class="col-md-3">
                <div class="card bg-green-g text-white">
                    <div class="card-body">
                        <h4 class="font-weight-light"><i class="fas fa-dolly-flatbed"></i> All Brands</h4>
                        <hr>
                        <h5>
                            <b>655</b>
                        </h5>
                    </div>
                </div>
            </div>
            <!-- All users widget -->
            <div class="col-md-3">
                <div class="card bg-primary-g text-white">
                    <div class="card-body">
                        <h4 class="font-weight-light"><i class="fas fa-users"></i> All Users</h4>
                        <hr>
                        <h5>
                            <b>1500</b>
                        </h5>
                    </div>
                </div>
            </div>
            <!-- All orders widget -->
            <div class="col-md-3">
                <div class="card bg-golden-g text-white">
                    <div class="card-body">
                        <h4 class="font-weight-light"><i class="fas fa-truck-loading"></i> All Orders</h4>
                        <hr>
                        <h5>
                            <b>700</b>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Order table section -->
        <div class="all-order mt-5">
            <!-- New orders title -->
            <h2>New Orders</h2>
            <hr>
            <!-- Orders table -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <!-- Table headers for order details -->
                        <th scope="col" class="bg-primary text-white">Order No.</th>
                        <th scope="col" class="bg-primary text-white">Product Name</th>
                        <th scope="col" class="bg-primary text-white">Quantity</th>
                        <th scope="col" class="bg-primary text-white">Date</th>
                        <th scope="col" class="bg-primary text-white">Paid Status</th>
                        <th scope="col" class="bg-primary text-white">Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- Order details for the first row -->
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>3</td>
                        <td>30-03-2024</td>
                        <td><span class="badge text-bg-danger">Unpaid</span></td>
                        <td><span class="badge text-bg-success">Complete</span></td>
                    </tr>
                    <tr>
                        <!-- Order details for the second row -->
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>1</td>
                        <td>30-03-2024</td>
                        <td><span class="badge text-bg-success">Paid</span></td>
                        <td><span class="badge text-bg-info">Process</span></td>
                    </tr>
                    <tr>
                        <!-- Order details for the third row -->
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>15</td>
                        <td>30-03-2024</td>
                        <td><span class="badge text-bg-success">Paid</span></td>
                        <td><span class="badge text-bg-danger">Rejected</span></td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination for the orders table -->
            <div class="order-pagination">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <!-- Previous page link -->
                        <li class="page-item"><a class="page-link" href="#"><span class="larger-angle">&lt;&lt;</span> Previous</a></li>
                        <!-- Pagination links for each page -->
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <!-- Next page link -->
                        <li class="page-item"><a class="page-link" href="#">Next <span class="larger-angle">&gt;&gt;</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End of working panel section -->

<?php require_once('includes/footer.php'); ?>
<!-- Include the footer file -->
