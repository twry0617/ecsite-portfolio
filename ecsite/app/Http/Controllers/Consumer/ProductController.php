<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {
        $keyword = $request->input('keyword');
        $amount_from = $request->input('amount_from');
        $amount_to = $request->input('amount_to');

        
        if(!empty($keyword)){

        $products = Product::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
        }
        else{
            $products = Product::paginate(10);
        }

        if(!empty($amount_from)){

        $products = Product::whereBetween('amount', [$amount_from, $amount_to])->paginate(5);
        }else{
            $products= Product::paginate(10);
        }

        if(!empty($amount_to)){

            $products =Product::whereBetween('amount', [$amount_from, $amount_to])->paginate(5);
            }else{
                $products= Product::paginate(10);
            }


        return view('consumer.product.index', compact('products','keyword', 'amount_from', 'amount_to'));

        
    }

    public function search(ProductRequest $request){

        $keyword = $request->input('keyword');
        $amount_from = $request->input('amount_from');
        $amount_to = $request->input('amount_to');

        
        if(!empty($keyword)){

        $products = Product::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
        }
        else{
            $products = Product::paginate(10);
        }

        if(!empty($amount_from)){

        $products = Product::whereBetween('amount', [$amount_from, $amount_to])->paginate(5);
        }else{
            $products= Product::paginate(10);
        }

        if(!empty($amount_to)){

            $products =Product::whereBetween('amount', [$amount_from, $amount_to])->paginate(5);
            }else{
                $products= Product::paginate(10);
            }


        return view('consumer.product.index', compact('products','keyword', 'amount_from', 'amount_to'));


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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('consumer.product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
