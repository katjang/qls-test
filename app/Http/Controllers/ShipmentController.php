<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MakeShipmentDocumentRequest;
use Spatie\PdfToImage\Pdf;
use App\Services\QlsApiService;
use App\Services\OrderService;
use App\Services\ReceiptService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ShipmentController extends Controller
{
    private QlsApiService $qlsApiService;
    private OrderService $orderService;
    private ReceiptService $receiptService;

    function __construct(QlsApiService $qlsApiService, OrderService $orderService, ReceiptService $receiptService) 
    {
        $this->qlsApiService = $qlsApiService;
        $this->orderService = $orderService;
        $this->receiptService = $receiptService;
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

        $response = $this->qlsApiService->getShipmentLabel(
            $request->companyId, 
            $request->brand, 
            $request->product, 
            $request->combination, 
            $request->weight, 
            $order
        );

        // $pdfLabel = file_get_contents($response["data"]["labels"]["a4"]["offset_2"]);

        // $imagick = new \Imagick();
        // $imagick->readImageBlob($pdf);
        // $imagick->setImageFormat("jpeg");
        // $imageBlob = $imagick->getImageBlob();
        

        $newPdf = $this->receiptService->createReceipt($order, asset('images/test.jpg'));

        Storage::put('public/receipts/' . $order['number'] . '.pdf', $newPdf);
    }
}
