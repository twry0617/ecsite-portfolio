@extends('layouts/consumer.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="/consumer/index/{{ $product->id }}">{{$product->name}}></a>
                    </div>
                    <div class="card-body">
                        {{ $product->amount }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection