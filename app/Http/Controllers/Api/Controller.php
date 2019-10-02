<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function respond($data, $code = 200, $message = null)
    {
        $response = [];
        $response['data'] = $data;
        if ($message != null) {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }

    public function fail($message, $code)
    {
        return response()->json([
            'message' => $message
        ], $code);
    }
}
