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
                            @if (!count($product->photos))
                                <img src="{{ asset('image/no-image.jpg') }}" alt="" class="card-img-top">
                            @else
                                @foreach ($product->photos as $photo)
                                    <img src="{{ $photo->photo }}" alt="" class="card-img-top">
                                @endforeach
                            @endif
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <a href="/supplier/product/{{ $product->id }}">{{ $product->name }}</a>
                        </div>
                        {{ $product->price }}円
                    </div>
                    @auth
                        <form method="POST" action="cartitem" class="form-inline m-1">
                            {{ csrf_field() }}
                        </form>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
@endsection
