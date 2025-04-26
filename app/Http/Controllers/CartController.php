<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Tambah item ke keranjang dan simpan ke session
    public function addToCart(Request $request)
    {

        $item = [
            'id' => $request->id,
            'address' => $request->address,
            'slug' => $request->slug,
        ];

        $cart = session()->get('cart', []);

        if (!isset($cart[$item['id']])) {
            $cart[$item['id']] = $item;
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Item berhasil ditambahkan ke keranjang.',
            'cart' => $cart
        ], 200);
    }

    public function getCartItems()
    {
        $cartItems = session('cart', []);
        return response()->json($cartItems);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Hapus item berdasarkan ID
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
        }

        // Simpan kembali data keranjang ke session
        session()->put('cart', $cart);

        // Kembalikan data keranjang yang telah diperbarui
        return response()->json(['cart' => $cart]);
    }

    public function clearCart()
    {
        // Menghapus data cart di session
        Session::forget('cart');

        return response()->json(['message' => 'Keranjang kosong.']);
    }
}
