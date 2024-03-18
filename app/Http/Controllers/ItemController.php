<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\City;
use App\Models\Item;
use App\Models\ItemRent;
use App\Models\Type;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
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
            try {
                $queryParam = \request()->query->get('q');
                $type = \request()->query->get('type');
                $status = \request()->query->get('status');
                $city = \request()->query->get('city');
                $queryData = Item::with(['type', 'city', 'rent'])
                    ->where('vendor_id', '=', auth()->id());

                if ($queryParam) {
                    $queryData = $queryData->where(function ($q) use ($queryParam) {
                        /** @var Builder $q */
                        return $q->where('address', 'LIKE', '%' . $queryParam . '%')->whereNull('deleted_at')
                            ->orWhere('location', 'LIKE', '%' . $queryParam . '%');
                    });
                }

                if ($type) {
                    $queryData = $queryData->where('type_id', '=', $type);
                }

                if ($city) {
                    $queryData = $queryData->where('city_id', '=', $city);
                }

                if ($status !== null) {
                    $intStatus = (int)$status;
                    $queryData = $queryData->where('status_rent', '=', $intStatus);
                }
                $data = $queryData->get();
                return $this->jsonSuccessResponse('success', $data);
            } catch (\Exception $e) {
                return $this->jsonErrorResponse($e->getMessage());
            }

            //            return DataTables::of($data)->addIndexColumn()->make(true);
        }
        $itemQuery = Item::with(['type', 'city', 'incoming_rent'])
            ->where('vendor_id', '=', auth()->id())->whereNull('deleted_at');
        $cities_id = $itemQuery->pluck('city_id');
        $types_id = $itemQuery->pluck('type_id');
        $cities = [];
        $ownTypes = [];
        if (count($cities_id) > 0) {
            $unique_cities = array_unique($cities_id->toArray());
            $cities = City::with([])
                ->whereIn('id', $unique_cities)
                ->get();
        }

        if (count($types_id) > 0) {
            $unique_types = array_unique($types_id->toArray());
            $ownTypes = Type::with([])
                ->whereIn('id', $unique_types)
                ->get();
        }
        return view('admin.datatitik')->with([
            'ownTypes' => $ownTypes,
            'cities' => $cities,
        ]);
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
                //                return $this->addRentHistory($id);
                return $this->changeStatusRent($id);
            }
            return $this->jsonSuccessResponse('success', $data);
        } catch (\Exception $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    private function changeStatusRent($id)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        Vendor::with([])
            ->where('id', '=', auth()->id())
            ->update([
                'last_seen' => $now
            ]);
        try {
            $item = Item::with([])->where('id', '=', $id)
                ->first();
            $data_request = [
                'status_rent' => \request()->request->get('status'),
                'rent_until' => \request()->request->get('date')
            ];
            $item->update($data_request);
            return $this->jsonSuccessResponse('success', $data_request);
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
