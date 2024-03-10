<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

Class QlsApiService 
{
    function getProducts($companyId) 
    {
        return Http::qls()->get('company/' . $companyId . '/product');
    }

    function getBrand($companyId) 
    {
        return Http::qls()->get('company/' . $companyId . '/brand');
    }

    function getShipmentLabel($companyId, $brandId, $productId, $combinationId, $weight, $order) 
    {
        return HTTP::qls()->post('company/' . $companyId . '/shipment/create', [
            'brand_id' => $brandId,
            'reference' => $order['number'],
            'weight' => $weight,
            'product_id' => $productId,
            'product_combination_id' => $combinationId,
            'cod_amount' => 0,
            'piece_total' => 1,
            'receiver_contact' => [
                'companyname' => $order['delivery_address']['companyname'],
                'name' => $order['delivery_address']['name'],
                'street' => $order['delivery_address']['street'],
                'housenumber' => $order['delivery_address']['housenumber'],
                'postalcode' => $order['delivery_address']['zipcode'],
                'locality' => $order['delivery_address']['city'],
                'country' => $order['delivery_address']['country'],
                'email' => $order['billing_address']['email'],
            ]
        ]);
    }
}
