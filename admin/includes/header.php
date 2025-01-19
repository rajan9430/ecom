<?php 
session_start();
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page if not logged in
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/admin_panel.css">
</head>

<body>
    <!-- header section -->
    <header>
        <div class="container-fluid">
            <div class="header-content">
                <!-- sider place of header -->
                <div class="side-head">
                    <span class="text-white">Admin Panel</span> &nbsp;
                    <i class="fas fa-bars menu-btn text-white"></i>
                    <i class="fas fa-arrow-right text-white close-btn"></i>
                </div>

                <!-- header navigation bar -->
                <div class="header-nav">
                    <ul>
                        <li><a href="#"><i class="fas fa-shopping-basket"></i> Order</a></li>
                        <li><a href="#"><i class="fas fa-truck"></i> Delivery</a></li>
                        <li><a href="#"><i class="fas fa-users"></i> User</a></li>
                        <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="wrapper">
        <!-- this is sidebar -->
        <section class="sidebar">

            <ul class="nav-bar">
                <!-- Add more sidebar navigation items here -->
                <li><a href="#"><i class="fas fa-tachometer-alt"></i><span class="text-link"> Dashboard</span></a></li>
                <li><a href="brand.php"><i class="fas fa-dolly-flatbed"></i><span class="text-link"> Brand</span></a></li>
                <li><a href="category.php"><i class="fas fa-layer-group"></i><span class="text-link"> Category</span></a></li>
                <li><a href="product.php"><i class="fas fa-shopping-basket"></i><span class="text-link"> Products</span></a></li>
                <li><a href="orders.php"><i class="fas fa-truck"></i><span class="text-link"> Orders</span></a></li>
                <!-- <li><a href="#"><i class="fas fa-truck-loading"></i><span class="text-link"> Delivery</span></a></li> -->
                <li><a href="slider_list.php"><i class="fas fa-images"></i><span class="text-link"> Slider Images</span></a></li>
                <!-- <li><a href="#"><i class="fas fa-cogs"></i><span class="text-link"> Settings</span></a></li>
                <li><a href="#"><i class="fas fa-id-badge"></i><span class="text-link"> Profile</span></a></li> -->
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span class="text-link"> Logout</span></a></li>
            </ul>

        </section>