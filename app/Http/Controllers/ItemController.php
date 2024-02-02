<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Item;
use App\Models\ItemRent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ItemController extends CustomController
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Item::with(['type', 'city', 'rent'])
                ->get();
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
        return view('admin.datatitik');
    }

    public function getDataByID($id)
    {

        try {
            $data = Item::with(['rent', 'city.province', 'type'])
                ->where('id', '=', $id)
                ->first();
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
