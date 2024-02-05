<?php


namespace App\Helper;


use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Carbon\Carbon;

class CustomController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

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

    public function updateLastSeen()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        Vendor::with([])
            ->where('id', '=', auth()->id())
            ->update([
                'last_seen' => $now
            ]);
    }
}
