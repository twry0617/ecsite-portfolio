<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\CartProduct;

class CartController extends Controller
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


       
        return view('consumer.product.cartproduct', compact('cartproducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        CartProduct::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->post('product_id'),
            ]
            

        );

        return redirect('consumer/index')->with('flash_message', 'カートに追加しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CartProduct  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(CartProduct $Cartproduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CartProduct  $cartproduct
     * @return \Illuminate\Http\Response
     */
    public function edit(CartProduct $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CartProduct  $cartproduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartProduct $cartproduct)
    {
        $cartproduct->save();
        return redirect('/cartproduct')->with('flash_message', 'カートを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CartProduct  $cartproduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartProduct $cartproduct)
    {
        $cartproduct->delete();

        return redirect('/cartproduct')->with('flash_message', 'カートから削除しました');
    }
}
