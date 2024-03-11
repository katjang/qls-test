<?php

namespace App\Factories;
use App\Services\FooBarOrderService;

class OrderServiceFactory 
{
    public static function getService($companyId)
    {
        // companyId is a UUID, should probably have a conversion table in DB that converts them to simple integer IDs
        $convertedCompanyId = 1;
        // switch from which company the order comes, to determine which API service to use
        switch($convertedCompanyId) 
        {
            case 1:
                return new FooBarOrderService();
            case 2:
                return new AnotherOrderService();
        }
    }
}