<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Photo;
use App\Models\Option;
use App\Http\Requests\ProductStore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    protected $productList = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Product $product, Photo $photo)
    {
        $products = $product->paginate(6);

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
                $photo = new Photo;
                $photo->product_id = $product->id;
                Log::info($image);
                $extension = $image->getClientOriginalExtension();
                // 画像の名前を取得
                $filename = $image->getClientOriginalName();
                // 画像をリサイズ
                $resize_img = Image::make($image)->resize(320, 240)->encode($extension);
                // 画像のpath
                $path = 'product/' . $request->name . '/' . $filename;
                // s3のuploadsファイルに追加
                Storage::disk('local')->put($path, (string)$resize_img, 'public');
                // 画像のURLを参照
                $url = Storage::disk('local')->url($path);
                $photo->photo = $url;
                $photo->save();
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
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
