<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\City;
use App\Models\Item;
use App\Models\Type;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DashboardController extends CustomController
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
        $items = Item::with(['type', 'city', 'incoming_rent'])
            ->where('vendor_id', '=', auth()->id())
            ->get()->append(['status_on_rent']);

        $cities_id = $items->pluck('city_id');
        $types_id = $items->pluck('type_id');
        $cities = [];
        $types = [];
        if (count($cities_id) > 0) {
            $unique_cities = array_unique($cities_id->toArray());
            $cities = City::with([])
                ->whereIn('id', $unique_cities)
                ->get();
        }

        if (count($types_id) > 0) {
            $unique_types = array_unique($types_id->toArray());
            $types = Type::with([])
                ->whereIn('id', $unique_types)
                ->get();
        }

        $total = $items->count();

        $empty = $items->where('status_rent', '=', 0)->values()->count();
        $used = $items->where('status_rent', '=', 1)->values()->count();
        $willUsed = $items->where('status_rent', '=', 2)->values()->count();

        if (\request()->ajax()) {
            $dataEmpty = $items->where('status_on_rent', '=', 'used')->values()->toArray();
            return DataTables::of($dataEmpty)->addIndexColumn()->make(true);
        }

        $types = Type::with([])
            ->get()->append(['items_count']);

        return view('admin.dashboard')
            ->with([
                'total' => $total,
                'empty' => $empty,
                'used' => $used,
                'willUsed' => $willUsed,
                'types' => $types,
                'cities' => $cities,
                'types' => $types,
            ]);
    }
}
