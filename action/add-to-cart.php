<?php
session_start();

require_once '../class/Cart.php';

$cart = new Cart();

if(isset($_POST['action']) && $_POST['action'] == "delete_cart_item"){
   $cart_id = $_POST['cart_id'];
   echo json_encode($cart->delete_cart($cart_id));
   exit;
}

if (isset($_POST['cart_id']) && $_POST['quantity']) {

   // run update cart function
   $cart_id = $_POST['cart_id'];
   $quantity = $_POST['quantity'];
   echo json_encode($cart->update_cart($cart_id, $quantity));
   exit;

} else {
   $product_id = $_POST['product_id'];

   echo json_encode($cart->add_to_cart($product_id, '1'));
   exit;
}
