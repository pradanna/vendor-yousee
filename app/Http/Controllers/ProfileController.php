<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ProfileController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Vendor::with([])
            ->where('id', '=', auth()->id())
            ->first();
        if (request()->method() === 'POST') {
            try {
                $data_request = [
                    'name' => request()->request->get('p-namacv'),
                    'address' => request()->request->get('p-alamat'),
                    'phone' => request()->request->get('p-telpkantor'),
                    'brand' => request()->request->get('p-brand'),
                    'email' => request()->request->get('p-email'),
                    'picName' => request()->request->get('p-pic'),
                    'picPhone' => request()->request->get('p-nomorpic'),
                    'last_seen' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                $oldPassword = request()->request->get('p-pswlama');
                $newPassword = request()->request->get('p-pswbaru');
                $newPasswordConfirm = request()->request->get('p-konfrpsw');
                if ($newPassword !== null && $newPassword !== '') {
                    $isPasswordValid = Hash::check($oldPassword, $data->password);
                    if ($isPasswordValid) {
                        if ($newPassword === $newPasswordConfirm) {
                            $data_request['password'] = Hash::make($newPassword);
                        } else {
                            return redirect()->back()->with('failed', 'password baru tidak cocok...');
                        }
                    } else {
                        return redirect()->back()->with('failed', 'password lama tidak cocok...');
                    }
                }
                $data->update($data_request);
                return redirect()->back()->with('success', 'Berhasil Merubah Profil');
            } catch (\Exception $e) {
                return redirect()->back()->with('failed', 'internal server error...');
            }
        }
        return view('admin.profile')->with([
            'data' => $data
        ]);
    }
}
