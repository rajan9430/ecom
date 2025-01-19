<?php // Start PHP tag
//include required things // Including required files
// Including header.php file
include 'includes/header.php';
// Including navbar.php file
include 'includes/navbar.php';

require_once 'class/Crud.php';

$obj = new Crud();

?>

<div class="cart">
    <div class="cart-body" style="background: #ffffff;">
        <h1 class="text-center py-5">Manage All Address</h1>

        <!-- container start -->
        <div class="container">
            <?php
            if (!isset($_SESSION['loggedIn'])) { ?>

                <h1 class="text-center pt-5 pb-3">You are not logged In.</h1>
                <div class="d-flex justify-content-center">
                    <a href="login.php" class="nav-link">Click here for login</a>
                </div>

            <?php } else {

                if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Your address has been saved in your account successfully</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }

                $user_id = $_SESSION['id'];

                // fetch all address
                $all_address = $obj->custom_get('addresses'," WHERE user_id = '$user_id'",'fetchAll');

                // echo '<pre>';print_r($all_address); die();

            ?>
                <div class="row">
                    <div class="col-md-7">
                        <a href="checkout.php" class="btn btn-warning">Go back to checkout page</a>
                        <!-- User billing address area -->
                        <h1 class="border-bottom pb-3 mb-5">Add new billing Address</h1>
                        <form action="action/address_action.php" method="post">
                            <div class="row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control">
                                </div>

                                <div class="form-group mb-3 col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control">
                                </div>

                                <div class="form-group mb-3 col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" placeholder="Phone Number" class="form-control">
                                </div>

                                <div class="form-group mb-3 col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                                </div>

                                <!-- User address 1 -->
                                <div class="form-group mb-3 col-md-12">
                                    <label for="address_1">Address 1</label>
                                    <input type="text" name="address_1" id="address_1" placeholder="Address 1" class="form-control">
                                </div>

                                <!-- User address 2 -->
                                <div class="form-group mb-3 col-md-12">
                                    <label for="address_2">Address 2</label>
                                    <input type="text" name="address_2" id="address_2" placeholder="Address 2 (Optional)" class="form-control">
                                </div>

                                <!-- City Name -->
                                <div class="form-group mb-3 col-md-6">
                                    <label for="city">City Name (i.e New york)</label>
                                    <input type="text" name="city" id="city" placeholder="City Name (i.e New york)" class="form-control">
                                </div>

                                <!-- Pincode -->
                                <div class="form-group mb-3 col-md-6">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" name="pincode" id="pincode" placeholder="Enter Your Pincode" class="form-control">
                                </div>

                                <!-- State -->
                                <div class="form-group mb-3 col-md-6">
                                    <label for="state">State Name</label>
                                    <input type="text" name="state" id="state" placeholder="State Name" class="form-control">
                                </div>

                                <!-- Country -->
                                <div class="form-group mb-3 col-md-6">
                                    <label for="country">Country Name</label>

                                    <select name="country" id="country" class="form-select">
                                        <option selected disabled>--Select your Country--</option>
                                        <option value="India">India</option>
                                        <option value="USA">USA</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Nepal">Nepal</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Add Address</button>
                                </div>

                            </div>
                        </form>
                    </div>

                    <div class="col-md-5 p-3" style="background: #f5f5f5;">
                        <!-- added cart items information -->
                        <h3>Select Address</h3>
                        <hr>
                        <ul class="list-group list-group-flush" style="list-style-type: none;">
                            <?php
                            foreach ($all_address as $address) :
                                // $total_price = $cartItem['selling_price'] * $cartItem['quantity'];
                            ?>
                                <li class="list-group-item mb-4">
                                   
                                    <!-- second flex box -->
                                    <div class="fw-bold">
                                        <p class="text-uppercase">
                                            <?= $address['first_name'].' '.$address['last_name']; ?>
                                        </p>
                                    </div>

                                    <div class="">
                                        <p>
                                            <strong>Address - </strong><?= $address['address_one'].','.$address['address_two']; ?>
                                            <br>
                                            <?= $address['city_name'].' '.$address['state_name'].' '.$address['country_name']; ?>
                                        </p>
                                        <p>
                                            <strong>Phone - </strong><?= $address['phone_number']; ?>
                                        </p>   
                                        <p>
                                            <strong>Email - </strong><?= $address['email']; ?>
                                        </p>
                                    </div>
                                <li>
                                <?php
                                
                            endforeach; ?>
                        </ul>
                        <!-- <button class="btn btn-success btn-lg w-100">Select</button> -->
                    </div>
                </div>
        </div>

    <?php } ?>
    </div>
</div>

<?php
include 'includes/footer.php';
?>