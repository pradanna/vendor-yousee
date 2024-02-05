<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Item;
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
        $total = $items->count();

        $empty = $items->where('status_on_rent', '!=', 'used')->values()->count();
        $used = $items->where('status_on_rent', '=', 'used')->values()->count();

        if (\request()->ajax()) {
            $dataEmpty = $items->where('status_on_rent', '=', 'used')->values()->toArray();
            return DataTables::of($dataEmpty)->addIndexColumn()->make(true);
        }

        return view('admin.dashboard')
            ->with([
                'total' => $total,
                'empty' => $empty,
                'used' => $used,
            ]);
    }
}
