<?php // Start PHP tag
//include required things // Including required files
// Including header.php file
include 'includes/header.php';
// Including navbar.php file
include 'includes/navbar.php';

require_once 'class/Crud.php';
require_once 'class/Address.php';

$obj = new Crud();
$address = new Address();

?>

<div class="cart">
    <div class="cart-body" style="background: #ffffff;">
        <h1 class="text-center py-5">Checkout</h1>

        <!-- container start -->
        <div class="container">
            <?php
            if (!isset($_SESSION['loggedIn'])) { ?>

                <h1 class="text-center pt-5 pb-3">You are not logged In.</h1>
                <div class="d-flex justify-content-center">
                    <a href="login.php" class="nav-link">Click here for login</a>
                </div>

            <?php } else {
                $user_id = $_SESSION['id'];

                // fetch cart items with their product name and details
                $cartQuery = "SELECT cart.id as cart_id, products.product_title, products.selling_price, products.regular_price, products.product_thumbnail, cart.quantity  FROM `cart` 
            
            LEFT JOIN products ON products.product_id = cart.product_id
            WHERE user_id = '$user_id'";


                $cartItems = $obj->query($cartQuery);

                ?>
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="mb-2">Select Delivery Address</h2>
                            <a href="add_address.php" class="btn btn-warning">Add Address</a>
                        </div>
                        <hr>

                        <!-- Existing Addresses Section -->
                        <div class="card-body">
                            <?php foreach($address->getAddresses() as $address): ?>
                            <div class="form-check mb-3">
                                <input class="form-check-input address" type="radio" name="address" id="address<?=  $address['address_id']; ?>" value="<?=  $address['address_id']; ?>">
                                <label class="form-check-label" for="address<?=  $address['address_id']; ?>">
                                    <strong><?= $address['first_name'] .' '.$address['last_name']; ?></strong><br>
                                    <?= $address['address_one'] .', '.$address['address_two']; ?>,<br>
                                    <?= $address['city_name'] .', '.$address['state_name'].', '.$address['country_name'].', '.$address['pincode']; ?>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col-md-5 p-3" style="background: #f5f5f5;">
                        <!-- added cart items information -->
                        <h3>Total Items</h3>
                        <hr>

                        <ul class="list-group list-group-flush" style="list-style-type: none;">
                            <?php
                            $total_final_price = 0;
                            foreach ($cartItems as $cartItem):
                                $total_price = $cartItem['selling_price'] * $cartItem['quantity'];
                                ?>
                                <li class="list-group-item  d-flex align-items-center">
                                    <div>
                                        <img src="<?= 'uploads/products/' . $cartItem['product_thumbnail']; ?>" height="60px">
                                    </div>
                                    <!-- second flex box -->
                                    <div class="flex-grow-1">
                                        <p><?= $cartItem['product_title']; ?>
                                            <br>
                                            <?= number_format($cartItem['selling_price'], 2); ?> X <?= $cartItem['quantity']; ?>
                                        </p>
                                    </div>

                                    <div class="fw-bold">
                                        <?= number_format($total_price, 2); ?>
                                    </div>
                                <li>
                                    <?php
                                    $total_final_price += $total_price;
                            endforeach; ?>
                        </ul>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="h4">Total Final Price:</span>
                            <span class="total_final_price h4"><?= number_format($total_final_price, 2); ?></span>
                        </div>

                        <hr>

                        <p>Payment Method</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                            <label class="form-check-label" for="cod">
                                Cash On Delivery
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="stripe" value="stripe">
                            <label class="form-check-label" for="stripe">
                                Stripe
                            </label>
                        </div>

                        <hr>

                        <button class="btn btn-success btn-lg w-100 place_order">Place Order</button>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>

<?php
include 'includes/footer.php';
?>