<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Item::with(['type'])
                ->get();
            $results = DataTables::of($data)->addIndexColumn()->make(true);
            return response()->json([
                'data' => $results,
                'message' => 'success',
                'status' => 200
            ], 200);
        }
        return view('admin.datatitik');
    }
}
