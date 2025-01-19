<?php 
// Include header and navbar
include 'includes/header.php'; 
include 'includes/navbar.php'; 
?>

<!-- Slider Area -->
<div class="slider-area">
    <div class="slider">
    <?php 
        // Fetch latest sliders
        $fetch_latest_sliders = $obj->custom_get("sliders", " ORDER BY id DESC");
        foreach ($fetch_latest_sliders as $latest_slider) :
    ?>
        <div>
            <a href="<?= $latest_slider['buy_now_link']; ?>">
                <img src="uploads/images/slider/<?= $latest_slider['image']; ?>">
            </a>
            <div class="slider-content">
                <h3 class="text-white text-capitalize"><?= $latest_slider['title']; ?></h3>
                <a href="<?= $latest_slider['buy_now_link']; ?>"><button class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Buy Now</button></a>
                <a href="<?= $latest_slider['read_more_link']; ?>" style="margin-left: 30px;"><button class="btn btn-outline-danger">Read More</button></a>
            </div>
        </div>
    <?php endforeach; ?> 
    </div>
</div>

<!-- Products Section -->
<div class="container-fluid">
    <section class="product-section">
        <div class="section-heading">
            <h3 class="heading"> Latest Products</h3>
        </div>
        <div class="section-product-cards">
            <div class="owl-carousel">
                <?php 
                // Fetch latest products
                $fetch_latest_products = $obj->custom_get("products", " WHERE status = '1' ORDER BY product_id DESC");
                foreach ($fetch_latest_products as $latest_product) :
                ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="uploads/products/<?php echo $latest_product['product_thumbnail']; ?>" alt="product name">
                        </div>
                        <div class="card-contents">
                            <button type="button" class="btn btn-warning cart-btn product-add-cart-btn" data-product-id="<?php echo $latest_product['product_id']; ?>">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                        <a href="product.php?product_id=<?php echo $latest_product['product_id']; ?>" style="text-decoration: none;">
                            <div class="product-details">
                                <h5 class="product-name" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                                    <?php echo $latest_product['product_title']; ?> 
                                </h5> 
                                <p class="product-price"> 
                                    <small class="text-danger"><s><?php echo $latest_product['regular_price']; ?></s></small> 
                                    <span class="text-success"><?php echo $latest_product['selling_price']; ?></span> 
                                </p> 
                            </div> 
                        </a> 
                    </div> 
                <?php endforeach; ?> 
            </div> 
        </div> 
    </section> 
</div> 

<?php 
// Include footer
include 'includes/footer.php'; 
?>
