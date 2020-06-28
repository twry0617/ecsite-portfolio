@extends('layouts.supplier.supplier')

@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="container mt-5">
        <div class="row justify-content-left">
            @foreach ($products as $product)
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        <a href="/supplier/product/{{ $product->id }}">{{ $product->name }}</a>
                    </div>
                    <div class="card-body">
                        {{ $product->price }}円
                    </div>
                    @auth
                        <form method="POST" action="cartitem" class="form-inline m-1">
                            {{ csrf_field() }}
                            <select name="quantity" class="form-control col-md-2 mr-1">
                                <option selected>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <input type="hidden" name="item_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary col-md-6">カートに入れる</button>
                        </form>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
@endsection
