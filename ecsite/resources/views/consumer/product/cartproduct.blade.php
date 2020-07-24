@extends('layouts/consumer.app')

@section('content')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    {{session('flash_message')}}
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(empty($cartproducts[0]))
                <p>カート内に商品がありません</p>
                <a href="consumer/index">商品一覧へ</a>
                @else
                @foreach ($cartproducts as $cartproduct)
                <div class="card-header">
                    <a href="/consumer/index/cartproduct/{{$cartproduct->product_id}}">{{$cartproduct->name}}</a>
                </div>
                <div class="card-body">
                    <div>
                        {{$cartproduct->price}}円
                    </div>
                    <div>
                        {{$cartproduct->stock}}個
                    </div>
                    <form method="POST" action="/cartproduct/{{$cartproduct->id}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-primary ml-1">カートから削除する</button>
                    <a class="btn btn-danger ml-1" href="/buy">購入する</a>
                </form>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection