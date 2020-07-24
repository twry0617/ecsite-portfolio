<?php

namespace App\Http\Controllers\consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CartProduct;
use App\Mail\Buy;
use Illuminate\Support\Facades\Mail;
class BuyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartproducts = CartProduct::select('cart_product.*', 'products.name', 'products.price', 'products.stock')
            ->where('user_id', Auth::id())
            ->join('products', 'products.id', '=', 'cart_product.product_id')
            ->get();



        return view('consumer.buy.index', ['cartproducts' => $cartproducts]);
    }

    public function store(Request $request, CartProduct $cartproducts)
    {
        if ($request->has('post')) {
            $cartproducts = Cartproduct::select('cart_product.*', 'products.name', 'products.stock')
            ->join('products', 'products.id', '=', 'cart_product.product_id')
            ->get();
            Mail::to(Auth::user()->email)->send(new Buy($cartproducts));
            CartProduct::where('user_id', Auth::id())->delete();
            return view('consumer/buy/complete', ['cartproducts' => $cartproducts]);
        }
        $request->flash();
        return $this->index();
    }
}
