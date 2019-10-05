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
        return response()->json($data, $code, ['X-Message' => $message]);
    }

    public function fail($message, $code)
    {
        $response = [];
        if (!is_string($message)) {
            $response['messages'] = $message;
        } else {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }
}
