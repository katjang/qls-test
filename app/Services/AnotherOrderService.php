<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FooBarOrderService implements OrderServiceInterface
{
    public function getOrder($orderNumber) 
    {
        // implement another API
    }
}