<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as ResponseStatus;
use Illuminate\Support\Facades\Response;

class BaseController extends Controller
{
    /**
     * @param array $data
     * @param       $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $status = ResponseStatus::HTTP_OK)
    {
        return Response::json($data, $status);
    }

    /**
     * @param array $data
     * @param       $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unsuccessResponse(array $data, $status = ResponseStatus::HTTP_BAD_REQUEST)
    {
        return Response::json($data, $status);
    }
}
