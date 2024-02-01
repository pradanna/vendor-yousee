<?php


namespace App\Helper;


use App\Http\Controllers\Controller;

class CustomController extends Controller
{
    private $response = [
        'status' => 200,
        'message' => 'success',
        'data' => null
    ];

    public function jsonSuccessResponse($message = 'success', $data = null)
    {
        $response = [
            'status' => 200,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function jsonErrorResponse($message = '', $data = null)
    {
        $response = [
            'status' => 500,
            'message' => 'internal server error (' . $message . ')',
            'data' => $data
        ];
        return response()->json($response, 500);
    }

    public function jsonNotFoundResponse($message = '', $data = null)
    {
        $response = [
            'status' => 404,
            'message' => 'item not found',
            'data' => $data
        ];
        return response()->json($response, 404);
    }
}
