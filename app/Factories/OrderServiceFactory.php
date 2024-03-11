<?php

namespace App\Factories;
use App\Services\FooBarOrderService;

class OrderServiceFactory 
{
    public static function getService($orderNumber)
    {
        // switch from company the order comes, to determine which API service to use
        $apiService = 1; // should come from a local data structure.
        switch($apiService) 
        {
            case 1:
                return new FooBarOrderService();
            case 2:
                return new AnotherOrderService();
        }
    }
}