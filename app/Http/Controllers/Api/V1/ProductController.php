<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return $this->respond(\App\Model\Product::all());
    }
}
