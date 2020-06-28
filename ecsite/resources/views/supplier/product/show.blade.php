@extends('layouts.supplier.supplier')

@section('content')

    <div class="container mt-5">
        <div class="col col-md-8 mx-auto">
            <h1 class="text-center mb-3">{{ $product->name }}</h1>
        </div>
        <div class="row p-4 mb-3 bg-white rounded shadow-sm">
            <div class="col-lg-6">
{{--                <div class="text-center mx-auto">--}}
{{--                    --}} TODO: 画像表示を行う
{{--                </div>--}}
            </div>
            <div class="col-lg-6 ">
                <h2 class="pt-4">金額： {{ $product->price }}円</h2>
                <h2 class="pt-4">在庫： {{ $product->stock }}個</h2>
                <h2 class="pt-4">商品コード： {{ $product->code }}</h2>
            </div>
            <div class="col-12 pt-3">
                <div class="col-10 mx-auto">
                    <p class="text-center">商品紹介</p>
                    <h3 class="text-center">{{ $product->description }}</h3>
                </div>
            </div>
{{--            <div class="col-12 pt-3">--}}　TODO: option表示を行う
{{--                <h3 class="text-center">オプション</h3>--}}
{{--                <h4 class="pt-4">サイズ： {{ $product->options->size }}</h4>--}}
{{--                <h4 class="pt-4">カラー： {{ $product->options->color }}</h4>--}}
{{--            </div>--}}
                <div class="col-12 pt-3 text-center">
                    <a class="btn btn-lg btn-primary"  href="{{ route('supplier.product.edit', ['product' => $product->id ]) }}">編集</a>
                    <form class="d-inline" action="{{ route('supplier.product.delete', ['product' => $product->id]) }}" method="get">
                        @csrf
                        <input type="submit" name="delete" value="削除" class=" btn btn-lg btn-danger" onClick="delete_alert(event);return false;">
                    </form>
                </div>
        </div>
    </div>
@endsection
