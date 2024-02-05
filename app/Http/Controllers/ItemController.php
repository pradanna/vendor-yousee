<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Item;
use App\Models\ItemRent;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ItemController extends CustomController
{

    public function __construct()
    {
       parent::__construct();
    }

    public function index()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        Vendor::with([])
            ->where('id', '=', auth()->id())
            ->update([
                'last_seen' => $now
            ]);
        if (\request()->ajax()) {
            $data = Item::with(['type', 'city', 'rent'])
                ->get();
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
        return view('admin.datatitik');
    }

    public function getDataByID($id)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        Vendor::with([])
            ->where('id', '=', auth()->id())
            ->update([
                'last_seen' => $now
            ]);
        try {
            $data = Item::with(['rent', 'city.province', 'type'])
                ->where('id', '=', $id)
                ->first()->append(['status_on_rent']);
            if (!$data) {
                return $this->jsonNotFoundResponse();
            }
            if (\request()->method() === 'POST') {
                return $this->addRentHistory($id);
            }
            return $this->jsonSuccessResponse('success', $data);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    private function addRentHistory($id)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        Vendor::with([])
            ->where('id', '=', auth()->id())
            ->update([
                'last_seen' => $now
            ]);
        try {
            $request = \request()->request->all();
            $data_request = [
                'item_id' => $id,
                'start' => \request()->request->get('start'),
                'end' => \request()->request->get('end'),
            ];
            ItemRent::create($data_request);
            return $this->jsonSuccessResponse('success', $request);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}
