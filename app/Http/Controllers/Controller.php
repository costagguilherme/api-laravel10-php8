<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse(array $content, $message = 'success', $statusCode = 200)
    {
        return response([
            'message' => $message,
            'data' => $content,
            'statusCode' => $statusCode
        ]);
    }
}
