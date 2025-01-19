<?php 
include 'includes/header.php'; 
include 'includes/navbar.php'; 

$product_id = $_GET['product_id']; // Get product ID from URL

$fetch_product = $obj->custom_get('products', " LEFT JOIN `category` ON `category`.`category_id` = `products`.`category_id` WHERE product_id = $product_id", 'fetch'); // Fetch product details

$regular_price = $fetch_product['regular_price'];
$selling_price = $fetch_product['selling_price'];

$price_difference = $regular_price - $selling_price;
$discount_in_percentage = ($price_difference / $regular_price) * 100;
?>

<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row product-custom-row">
                <!-- Product Image -->
                <div class="col-md-6">
                    <div class="product_details_image">
                        <img src="uploads/products/<?php echo $fetch_product['product_thumbnail']; ?>" class="img-fluid large-image">
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6">
                    <!-- Category -->
                    <div style="background-color: black; padding: 5px; width: 100px; text-align: center; border-radius: 5px; font-weight: bold;">
                        <span style="color: white;"><?php echo $fetch_product['category_name']; ?></span>
                    </div>
                    <!-- Title, Description, Price -->
                    <div class="product-detail-title">
                        <h1><?php echo $fetch_product['product_title']; ?></h1>
                    </div>
                    <div class="product-detail-short-description">
                        <p><?php echo $fetch_product['short_description']; ?></p>
                    </div>
                    <div class="product-detail-price">
                        <span class="font-weight-bold">-<?php echo round($discount_in_percentage, 0); ?>%</span>
                        <span class="Selling-price">$<?php echo $fetch_product['selling_price']; ?></span>
                        <span class="Regular-price"><del class="text-danger">$<?php echo $fetch_product['regular_price']; ?></del></span>
                    </div>
                    <button type="button" class="btn btn-dark btn-lg product-add-cart-btn" data-product-id="<?php echo $fetch_product['product_id']; ?>">
                        <i class="fas fa-cart-plus"></i> Add to cart</button>
                </div>

                <!-- Long Description -->
                <div class="col-md-12 mt-5">
                    <h2>Description</h2>
                    <hr>
                    <p class="product-detail-long-description"><?php echo $fetch_product['long_description']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
