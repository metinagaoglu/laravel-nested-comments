<?php
namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ResponsableWithHttp {

    protected function respond(bool $status,?string $message = null,$payload = [], $httpStatus = Response::HTTP_OK)
    {
        return response([
            'success' => true,
            'data' => $payload,
            'message' => $message,
        ], $httpStatus);
    }

    protected function respondSucces(?string $message = null,$payload = [], $httpStatus = Response::HTTP_OK)
    {
        return response([
            'success' => true,
            'data' => $payload,
            'message' => $message,
        ], $httpStatus);
    }

    protected function respondError(?string $message = null,$httpStatus = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response([
            'success' => false,
            'data' => [],
            'message' => $message,
        ], $httpStatus);
    }

}
