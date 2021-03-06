<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    protected $statusCode = 200;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respondNotFound($message = ['Not Found !'])
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondForbidden($message = ['Access Denied !'])
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    public function respondInternalError($message = ['Internal Error !'])
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    public function requestTimeout($message = ['Request Timeout !'])
    {
        return $this->setStatusCode(408)->respondWithError($message);
    }

    public function respondValidation($message = ['Validation Errors !'])
    {
        return $this->setStatusCode(422)->respondWithError($message);
    }

    public function respondTooManyAttempts($message = ['Too Many Attempts !'])
    {
        return $this->setStatusCode(429)->respondWithError($message);
    }
}
