<?php // Start PHP tag
//include required things // Including required files
// Including header.php file
include 'includes/header.php';
// Including navbar.php file
include 'includes/navbar.php';

require_once 'class/Crud.php';

$obj = new Crud();
?>
<!-- cart detail page --> <!-- Start product detail page -->
<!-- Start card div -->
<div class="card">
    <!-- Start card-body div -->
    <div class="card-body">
        <!-- Start container div -->
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
                <h1 class="text-center py-5">Your Cart</h1>

                <div class="cart-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        $total_final_price = 0;
                        foreach ($cartItems as $cartItem) :
                            $total_price = $cartItem['selling_price'] * $cartItem['quantity'];
                        ?>
                            <tr>
                                <td>
                                    <img src="<?php echo 'uploads/products/' . $cartItem['product_thumbnail']; ?>" height="70px">
                                    <?php echo $cartItem['product_title']; ?>
                                </td>
                                <td class="selling_price"><?php echo number_format($cartItem['selling_price'], 2); ?></td>
                                <td>
                                    <div class="d-flex">
                                        <!-- this button is use for decrease the quentity -->
                                        <button class="btn btn-secondary changeQty" data-cart-id="<?php echo $cartItem['cart_id']; ?>">-</button>

                                        <!-- quentity number -->
                                        <span class="px-3 py-2 quantity"><?php echo $cartItem['quantity']; ?></span>

                                        <!-- this button is use for increase the quentity -->
                                        <button class="btn btn-secondary changeQty" data-cart-id="<?php echo $cartItem['cart_id']; ?>">+</button>
                                    </div>

                                </td>
                                <td class="total_price"><?php echo number_format($total_price, 2); ?></td>

                                <!-- delete butto for remove cart items -->
                                <td>
                                    <a href="#" class="btn btn-danger remove-item" data-cart-id="<?php echo $cartItem['cart_id']; ?>"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                        <?php
                            $total_final_price += $total_price;
                        endforeach; ?>
                    </table>

                    <div class="float-end">
                        <span class="h4">Total Final Price: <span class="total_final_price"><?php echo number_format($total_final_price, 2); ?></span>
                        </span>

                        <div>
                            <a class="btn btn-success w-100 mt-3" href="checkout.php">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- End container div -->
        </div>
        <!-- End card-body div -->
    </div>
    <!-- End card div -->
</div>
<!-- Include footer.php file -->
<?php include 'includes/footer.php'; ?>
<script>
    $(document).ready(function() {
        $('.changeQty').click(function() {
            let $this = $(this);
            let quantitySpan = $(this).siblings('.quantity');
            let quantity = parseInt(quantitySpan.text());

            let cart_id = $(this).data('cart-id');

            if ($(this).text() == '-') {
                quantity = Math.max(1, quantity - 1);
            } else {
                Math.max(1, quantity += 1);
            }

            // update quantity if needed
            quantitySpan.text(quantity);


            // work on selling price or get the selling price
            let selling_price_text = $(this).closest('tr').find('.selling_price').text().trim();
            let selling_price = parseFloat(selling_price_text.replace(/,/g, ''));


            let total_cost = selling_price * quantity;

            let formatted_final_price = total_cost.toLocaleString('en-US', {
                minimumFractionDigits: 2
            });
            console.log(formatted_final_price);

            $.ajax({
                url: "action/add-to-cart.php",
                type: "POST",
                data: {
                    'cart_id': cart_id,
                    'quantity': quantity
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        $this.closest('tr').find('.total_price').text(formatted_final_price);
                        updateTotalFinalPrice();
                        //     console.log(response)
                        const toastLiveExample = document.getElementById('liveToast')
                        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                        $('.toast-message').text(response.message)
                        toastBootstrap.show()
                        $("#loginForm")[0].reset();
                    }

                }
            })

        }); +

        // remove from cart functinality
        $('.remove-item').click(function() {
            let $this = $(this);
            let cart_id = $(this).data('cart-id');

            $.ajax({
                url: "action/add-to-cart.php",
                type: "POST",
                data: {
                    'cart_id': cart_id,
                    'action': "delete_cart_item"
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        $this.closest('tr').remove();

                        updateTotalFinalPrice();

                        const toastLiveExample = document.getElementById('liveToast')
                        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                        $('.toast-message').text(response.message)
                        toastBootstrap.show()
                        $("#loginForm")[0].reset();
                    }

                }
            })
        })

    });

    function updateTotalFinalPrice() {
        let total_final_price = 0;
        $('.total_price').each(function() {
            total_final_price += parseFloat($(this).text().replace(/,/g, ''));
        });

        $(".total_final_price").text(total_final_price.toLocaleString('en-US', {
            minimumFractionDigits: 2
        }));
    }
</script>