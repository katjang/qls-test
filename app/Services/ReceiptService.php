<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Dompdf\Dompdf;

Class ReceiptService
{
    public function createReceipt($order, $imageUrl) 
    {
        $imagedata = file_get_contents($imageUrl);
        $base64 = base64_encode($imagedata);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('receipt', ['order' => $order, 'label' => $base64]));

        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Render the HTML as PDF
        return $dompdf->output();
    }
} 