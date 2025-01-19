<?php

require_once 'Crud.php';

class Address extends Crud
{
    public function getAddresses(){
        $user_id = $_SESSION['id'];

        return $getAddress = $this->custom_get('addresses'," WHERE user_id = '$user_id'", 'fetchAll');
    }
}