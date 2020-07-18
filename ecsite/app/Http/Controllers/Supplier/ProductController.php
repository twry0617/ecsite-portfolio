<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Photo;
use App\Models\Option;
use App\Http\Requests\ProductStore;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productList = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Product $product)
    {
        $products = $product->paginate(6);
        foreach ($products as $product) {
            $product->photos;
        }

        return view('supplier.product.index',[
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('supplier.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStore $request
     * @param Product $product
     * @param Photo $photo
     * @param Option $option
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductStore $request, Product $product, Option $option)
    {
        $supplier = DB::transaction(function () use ($request, $product, $option) {
            $supplier = $request->user();
            $product->supplier_id = $supplier->id;
            $product->fill($request->all())->save();

            $option->product_id = $product->id;
            $option->fill($request->all())->save();

            if (empty($request->file('photo'))) {
                return redirect()->route('supplier.product.list');
            }

            foreach ($request->file('photo') as $image) {
               $product->insertPhoto($image, $request, $product);
            }

            return $supplier;
        });


        return redirect()->route('supplier.product.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        $photos = $product->photos;
        return view('supplier.product.show', [
            'product' => $product,
            'photos' => $photos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $product->photos;
        $product->options;

        return view('supplier.product.edit', [
            'product' => $product
        ]);
    }

    /**
     *  Update the specified resource in storage.
     *
     * @param ProductStore $request
     * @param Product $product
     * @param Option $option
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductStore $request, Product $product, Option $option)
    {
        $supplier = DB::transaction(function () use ($request, $product, $option) {
            $supplier = $request->user();
            $product->supplier_id = $supplier->id;
            $product->fill($request->all())->save();

            $option->product_id = $product->id;
            $option->fill($request->all())->save();

            if (empty($request->file('photo'))) {
                return redirect()->route('supplier.product.list');
            }

            foreach ($request->file('photo') as $image) {
                $product->insertPhoto($image, $request, $product);
            }

            return $supplier;
        });

        return redirect()->route('supplier.product.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('supplier.product.list');
    }
}
