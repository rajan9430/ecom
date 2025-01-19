<!-- Navigation bar -->
<div class="navigation-bar">
    <!-- Container for navigation elements -->
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <!-- Link to homepage -->
            <a href="<?= $base_url; ?>index.php">
                <!-- Image logo -->
                <img src="<?= $base_url; ?>images/logo.png" alt="logo">
            </a>
        </div>

        <!-- Search box -->
        <div class="search-area">
            <!-- Form for search -->
            <form action="search.php" method="get">
                <!-- Input for search query -->
                <input type="text" name="query" class="search_box" placeholder="Search all items...">
                <!-- Button to submit search -->
                <button class="search_btn btn btn-success" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
        </div>

        <!-- User menu -->
        <div class="user-menu">
            <!-- List of user actions -->
            <ul>
                <!-- Dropdown menu for user account -->
                <li class="dropdown-center">
                    <!-- Link to user account dropdown -->
                    <a href="#" class="dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user"></i> My Account</a>
                    <!-- Dropdown box -->
                    <div class="dropdown-menu dropdown-menu-end bg-dark" style="width: 175px;" aria-labelledby="navbarDropdown">
                        <?php
                        session_start();
                        if (isset($_SESSION['loggedIn'])) {
                            // if you are logged in
                        ?>
                            <!-- User account options -->
                            <a href="<?= $base_url; ?>account/index.php" type="button" class="dropdown-item"><i class="fas fa-user"></i> &nbsp; Your Account</a>
                            <a href="<?= $base_url; ?>account/orders.php" type="button" class="dropdown-item"><i class="fas fa-cube"></i> &nbsp; Your Order</a>
                            <a href="#" type="button" class="dropdown-item"><i class="fas fa-heart"></i> &nbsp; Wishlist</a>

                            <a href="<?= $base_url; ?>logout.php" type="button" class="dropdown-item" ><i class="fas fa-sign-out-alt"></i> &nbsp Logout</a>
                        <?php } else {
                            // if not logged in
                        ?>

                            
                            <!-- Text for new users -->
                            <p class="text-center text-white" style="height:10px; line-height:20px;"><small>if you are a new user</small></p>
                            <!-- Register link -->
                            <a href="register.php" type="button" class="dropdown-item text-center"><i class="fas fa-user"></i> &nbsp; Register</a>
                            <!-- Log in link -->
                            <a href="login.php" type="button" class="dropdown-item text-center bg-danger" style="color: white;" onmouseover="this.style.color='black'" onmouseout="this.style.color='white'"><i class="fas fa-user"></i> &nbsp; Log In</a>
                        <?php } ?>
                    </div>
                </li>
                <!-- Link to shopping cart -->
                <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li>
            </ul>
        </div>
    </div>
</div>