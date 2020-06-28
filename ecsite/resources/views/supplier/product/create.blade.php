@extends('layouts.supplier.supplier')

@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="container mt-5">
        <div class="row bg-light d-flex">
            <form action="{{ route('supplier.product.store') }}" method="post" class="form-inline" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="form-group">
                        <label class="col-md-6" for="name">商品名</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 mx-auto" for="code">商品コード</label>
                        <input class="form-control" type="text" name="code" value="{{ old('code') }}">
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 mx-auto" for="body">金額</label>
                        <input class="form-control" type="text" name="price" value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 mx-auto" for="stock">在庫</label>
                        <input class="form-control" type="text" name="stock" value="{{ old('stock') }}">
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 mx-auto" for="description">商品説明</label>
                        <textarea name="description" class="form-control" cols="30" rows="5">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label class="col col-md-5" for="image">画像1</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col col-md-5" for="image">画像2</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col col-md-5" for="image">画像3</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="size" class="col col-md-5">サイズ</label>
                        <input type="text" class="form-control" name="size" value="{{ old('size') }}">
                    </div>
                    <div class="form-group">
                        <label for="color" class="col col-md-5">カラー</label>
                        <input type="text" class="form-control" name="color" value="{{ old('color') }}">
                    </div>
                </div>
                <div class="form-block">
                    <div class="text-center">
                        <button class="btn btn-lg  btn-primary" type="submit">完了</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection