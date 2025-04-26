<?php

namespace App\Http\Controllers;

use App\Models\FrontProfile;
use App\Models\Item;
use App\Models\type;
use Illuminate\Support\Facades\Config;

class TitikController extends Controller
{
    private $dom;

    public function __construct()
    {
        $this->dom = env('INTERNAL_DOMAIN', 'https://internal.yousee-indonesia.com');
    }

    public function dataTitik($num = 12, $non = null)
    {
        $titik = Item::where('isShow', '=', true);
        if ($non) {
            $titik = $titik->where('id', '!=', $non);
        }
        $titik = $titik->paginate($num);

        return $titik;
    }

    public function index()
    {
        $titik = $this->dataTitik();
        $type = type::get();
        $profiles = FrontProfile::get();
        return view('user.titikkami2', ['titik' => $titik, 'dom' => $this->dom, 'profiles' => $profiles, 'type' => $type]);
    }

    public function detail($slug)
    {
        $item = Item::where('slug', $slug)->firstOrFail();
        $titik = Item::where([['city_id', $item->city_id], ['id', '!=', $item->id]])
            ->inRandomOrder()
            ->paginate(18);
        $profiles = FrontProfile::get();

        return view('user.detailtitik', [
            'titik' => $titik,
            'data' => $item,
            'dom' => $this->dom,
            'profiles' => $profiles
        ]);
    }

    public function titikProvince($province)
    {
        $titik = Item::where('isShow', '=', true)
            ->whereHas('city.province', function ($q) use ($province) {
                return $q->where('name', 'LIKE', '%' . $province . '%');
            })->paginate(12);
        $profiles = FrontProfile::get();
        return view('user.titik_per_provinsi', ['titik' => $titik, 'dom' => $this->dom, 'profiles' => $profiles]);
    }

    public function titikCity($city)
    {
        $titik = Item::where('isShow', '=', true)
            ->whereHas('city', function ($q) use ($city) {
                return $q->where('name', 'LIKE', '%' . $city . '%');
            })->paginate(12);
        $profiles = FrontProfile::get();
        return view('user.titik_per_kota', ['titik' => $titik, 'dom' => $this->dom, 'profiles' => $profiles]);
    }
}
