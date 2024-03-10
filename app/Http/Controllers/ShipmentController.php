<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MakeShipmentDocumentRequest;
use Illuminate\Support\Facades\Http;
use Spatie\PdfToImage\Pdf;
use App\Services\QlsApiService;
use App\Services\OrderService;
use Dompdf\Dompdf;

class ShipmentController extends Controller
{
    private QlsApiService $qlsApiService;
    private OrderService $orderService;

    function __construct(QlsApiService $qlsApiService, OrderService $orderService) 
    {
        $this->qlsApiService = $qlsApiService;
        $this->orderService = $orderService;
    }

    function create($companyId)
    {
        $productResponse = $this->qlsApiService->getProducts($companyId);
        $brandResponse = $this->qlsApiService->getBrand($companyId);

        return view('create', [
                'companyId' => $companyId, 
                'products' => $productResponse->json(), 
                'brands' => $brandResponse->json()
            ]);
    }

    function make(MakeShipmentDocumentRequest $request) 
    {
        $order = $this->orderService->getOrder($request->order_number);
        
        $imagedata = file_get_contents(asset('images/test.jpg'));
        $base64 = base64_encode($imagedata);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('receipt', ['order' => $order, 'label' => $base64]));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Render the HTML as PDF
        $dompdf->stream();

        return;

        $response = $this->qlsApiService->getShipmentLabel(
            $request->companyId, 
            $request->brand, 
            $request->product, 
            $request->combination, 
            $request->weight, 
            $order
        );

        return $response;

        $label = HTTP::get($response["data"]["a4"]["offset_2"]);
    }
}
