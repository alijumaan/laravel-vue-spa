<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    private $statusCode = 200;

    /**
     * @return mixed
    */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
    */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondNotFound($message = 'NotFound')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondInvalidRequest($message = 'Invalid request')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    public function respondCreated($message = 'Created successfully')
    {
        return $this->setStatusCode(201)->respondWithError($message);
    }

    public function respondUpdated($message = 'Updated successfully')
    {
        return $this->setStatusCode(201)->respondWithError($message);
    }

    public function respondInternalError($message = 'Created successfully')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    public function respondNoContent()
    {
        return response()->noContent();
    }

    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message
            ]
        ]);

    }
}
