<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\QlsApiService;

class PageController extends Controller
{
    private QlsApiService $qlsApiService;

    function __construct(QlsApiService $qlsApiService) 
    {
        $this->qlsApiService = $qlsApiService;
    }

    function index()
    {
        $response = $this->qlsApiService->getCompanies();

        return view('dashboard', ['companies' => $response->json()]);
    }
}
