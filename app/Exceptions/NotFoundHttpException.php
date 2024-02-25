<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class NotFoundHttpException extends Exception
{
    public function __construct($message = "Resource not found")
    {
        parent::__construct($message);
    }
    public function render($request)
    {
        return response([
            'message' => $this->getMessage()
        ], JsonResponse::HTTP_NOT_FOUND);
    }
}
