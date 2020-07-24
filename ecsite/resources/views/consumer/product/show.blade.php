@extends('layouts/consumer.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="/consumer/index/{{ $product->id }}">{{$product->name}}</a>
                    </div>
                    <div class="card-body">
                        {{ $product->price }}円<br>
                        {{ $product->description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @auth
    <form action="/consumer/index/cartproduct" method="post"　class="form-inline m-1 row justify-content-center">
        {{csrf_field()}}
        <select name="{{$product->stock}}">
            <option selected>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <button type="submit" class="btn btn-primary col-md-6">カートに入れる</button>
        </form>
        @endauth
@endsection