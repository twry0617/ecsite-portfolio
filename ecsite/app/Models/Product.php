<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'description', 'price', 'stock', 'status',
    ];

    /**
     * productのoptionを取得する
     */
    public function options()
    {
        return $this->hasMany('App\Models\Option');
    }

    /**
     * productのphotoを取得
     */
    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }

    /**
     * 画像をS3にアップロードしproductsテーブルに保存する
     *
     * @param $image
     * @param $request
     * @param $product
     */
    public function insertPhoto($image, $request, $product)
    {
        $photo = new Photo;
        $photo->product_id = $product->id;
        // 画像の拡張子を取得
        $extension = $image->getClientOriginalExtension();
        if ($extension === null) {
            Log::error("拡張子の取得に失敗しました: " . $image->getPathname());
        }
        // 画像の名前を取得
        $filename = $image->getClientOriginalName();
        If ($filename === null) {
            Log::error("ファイル名の取得に失敗しました: " . $image->getPathname());
        }
        // 画像をリサイズ
        $resize_img = Image::make($image)->resize(320, 240)->encode($extension);
        // 画像のpath
        $path = 'product/' . $request->name . '/' . $filename;
        // s3のuploadsファイルに追加
        $result = Storage::disk('s3')->put($path, (string)$resize_img, 'public');
        if ($result === false) {
            Log::error("ファイルの保存に失敗しました: " . $image->getPathname());
        }
        // 画像のURLを参照
        $url = Storage::disk('s3')->url($path);
        $photo->photo = $url;
        $photo->save();
    }
}
