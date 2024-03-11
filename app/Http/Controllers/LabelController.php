<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MakeLabelRequest;
use Spatie\PdfToImage\Pdf;
use App\Services\QlsApiService;
use App\Services\FooBarOrderService;
use App\Services\LabelService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class LabelController extends Controller
{
    private QlsApiService $qlsApiService;
    private FooBarOrderService $orderService;
    private LabelService $labelService;

    function __construct(QlsApiService $qlsApiService, FooBarOrderService $orderService, LabelService $labelService) 
    {
        $this->qlsApiService = $qlsApiService;
        $this->orderService = $orderService;
        $this->labelService = $labelService;
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

    function make(MakeLabelRequest $request) 
    {
        $order = $this->orderService->getOrder($request->order_number);
        // instead of using injected orderService, create the correct orderService with a factory pattern.

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
        // $imagick->readImageBlob($pdfLabel);
        // $imagick->setImageFormat("jpg");
        // $imageBlob = $imagick->getImageBlob();
        
        $newPdf = $this->labelService->createLabel($order, asset('images/test.jpg')); // supposed to use the imagick imageblob

        $fileName = $order['number'] . '.pdf';
        Storage::put('labels/' . $fileName, $newPdf);

        return Storage::download('labels/' . $fileName);
    }
}
