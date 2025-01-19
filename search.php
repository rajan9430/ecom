<?php
include 'includes/header.php'; // Including header.php file
include 'includes/navbar.php';
require_once 'class/Crud.php'; // Include the CRUD class

$obj = new Crud(); // Instantiate CRUD object

// Get the search term from the URL
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Prepare a query to search products by name or description
$sql = "SELECT * FROM products WHERE product_title LIKE '%$searchQuery%' OR short_description LIKE '%$searchQuery%'";
// $params = ["%$searchQuery%", "%$searchQuery%"];
$products = $obj->query($sql); // Fetch matching products

?>
<?php // Start PHP tag
//include required things // Including required files

?>

<div class="card">
    <div class="card-body container">
        <div class="search-results">
            <h2>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
            <?php if (count($products) > 0): ?>
                <div class="card">
                    <?php foreach ($products as $product): ?>
                        <a href="product.php?product_id=<?php echo $product['product_id']; ?>" class="nav-link">
                            <div class="card-body order-product-card">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex gap-5">
                                        <div class="order-product-image">
                                            <img src="<?= $base_url; ?>uploads/products/<?= $product['product_thumbnail']; ?>">
                                        </div>

                                        <div class="order-product-heading d-flex flex-column">
                                            <h4><?= $product['product_title']; ?></h4>
                                            <div>
                                                <p class="h5 fw-bold"><?= $product['short_description']; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- status -->
                                    <div class="order-status d-flex flex-column justify-content-center" style="width:200px;">
                                        <p class="text-secondary mb-1"><small>Total</small></p>
                                        <h4>Rs. <?= number_format($product['selling_price'], 2); ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No products found for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>