<?php

namespace App\Contracts;

interface OrdersProviderContract
{
    public function setAuth($user, $pass);
    public function getOrderById($orderId) : OrderContract;
    public function getOrders();
    public function issueRefundForOrder($orderId);

}
