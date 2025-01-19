<?php

require_once 'Crud.php';

class Cart extends Crud
{
    // this for add your product to cart
    public function add_to_cart($product_id, $quantity)
    {

        // check your user is logged in or not
        if (!isset($_SESSION['loggedIn'])) {
            return $output = [
                'status' => false,
                'message' => 'You are not logged in, please login First.'
            ];
        } else {
            // if user is logged in
            $user_id = $_SESSION['id'];

            $checkCart = $this->custom_get('cart', "WHERE product_id = $product_id AND user_id = $user_id", 'fetch');

            if ($checkCart) {
                // if i already have the same product in my cart
                $cart_id = $checkCart['id'];
                $cartItem = [

                    'quantity' => $checkCart['quantity'] + 1
                ];

                $update_cart = $this->update('cart', $cartItem, " WHERE id = '$cart_id' ");

                if ($update_cart) {
                    return $output = [
                        'status' => true,
                        'message' => 'Product has been updated'
                    ];
                }
            } else {

                // store my product into database
                $cartItem = [
                    'product_id' => $product_id,
                    'user_id' => $user_id,
                    'quantity' => $quantity
                ];

                $insertIntocart = $this->insert('cart', $cartItem);
                if ($insertIntocart) {
                    return [
                        'status' => true,
                        'message' => 'Product has been added Successfully'
                    ];
                } else {
                    return [
                        'status' => false,
                        'message' => 'Somthing went wrong'
                    ];
                }
            }
        }
    }

    public function update_cart($cart_id, $quantity)
    {
        // store my product into database
        $cartItem = [
            'quantity' => $quantity
        ];

        $updateCart = $this->update('cart', $cartItem, " WHERE id = '$cart_id' ");
        if ($updateCart) {
            return [
                'status' => true,
                'message' => 'Product has been updated Successfully'
            ];
        }
    }

    // remove my cart items from database
    public function delete_cart($cart_id)
    {
        if ($this->delete("cart", " WHERE id = 'cart_id'")) {
            return [
                'status' => true,
                'message' => 'Product has been removed Successfully'
            ];
        }else{
            return[
                'status' => false,
                'message' => 'Somthing went wrong'
            ];
        }
    }
}
