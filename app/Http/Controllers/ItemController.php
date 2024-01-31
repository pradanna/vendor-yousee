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
            $data = Item::with(['type', 'city'])
                ->get();
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
        return view('admin.datatitik');
    }

    public function addRentHistory()
    {

    }
}
