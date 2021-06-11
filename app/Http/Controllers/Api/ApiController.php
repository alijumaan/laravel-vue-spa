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

    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondInvalidRequest($message = 'Invalid Request')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    public function respondCreated($message = 'Created Successfully')
    {
        return $this->setStatusCode(201)->respondWithSuccess($message);
    }

    public function respondUpdated($message = 'Updated Successfully')
    {
        return $this->setStatusCode(201)->respondWithSuccess($message);
    }

    public function respondInternalError($message = 'Internal Server Error')
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

    public function respondWithSuccess($message)
    {
        return $this->respond([
            'success' => [
                'message' => $message
            ]
        ]);

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
