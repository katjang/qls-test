<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    function index()
    {
        $response = Http::qls()->get('company');

        return view('dashboard', ['companies' => $response->json()]);
    }
}
