<?php

namespace App\Http\Controllers\Api\V1;

use App\Model\Slide;
use App\Http\Controllers\Api\Controller;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();

        return $this->respond($slides);
    }
}
