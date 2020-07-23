@extends('layouts/consumer.app')

@section('content')
<div class='container'>
    <div class="row justify-content-center" style="margin-bottom:10px;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    お届け先入力
                </div>
                <div class="card-body">
                    <form method="POST" action="/buy">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">氏名</label>
                                @if(Request::has('confirm'))
                                <p class="form-controller-satatic">{{ old('name') }}</p>
                                <input type="hidden" id="name" name="name" value="{{ old('name') }}">
                                @else
                                <input id="name" type="text" class="form-controll" name="name" value="{{old('name')}}">
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="potalcode">郵便番号</label>
                                @if(Request::has('confirm'))
                                <p class="form-controller-satatic">{{ old('potalcode') }}</p>
                                <input type="hidden" id="potalcode" name="name" value="{{old('potalcode')}}">
                                @else
                                <input id="potalcode" type="text" class="form-controll" name="name" value="{{old('potalcode')}}">
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="region">都道府県</label>
                                @if(Request::has('confirm'))
                                <p class="form-controller-satatic">{{ old('region') }}</p>
                                <input type="hidden" id="region" name="name" value="{{old('region')}}">
                                @else
                                <select id="region" class="form-control" name="region">
                                    @foreach(Config::get('region') as $value)
                                    <option @if(old('region')==$value) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="form-group col-md-6">
                                <label for="address">住所</label>
                                @if(Request::has('confirm'))
                                <p class="form-control-static">{{ old('address') }}</p>
                                <input type="hidden" id="address" name="address" value="{{ old('address')}}">
                                @else
                                <input type="text" id="address" class="form-control" name="address" value="{{old('address')}}">
                                @endif
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="form-group col-md-6">
                                <label for="phonenumber">電話番号</label>
                                @if(Request::has('confirm'))
                                <p class="form-control-static">{{ old('phonenumber') }}</p>
                                <input type="hidden" id="phonenumber" name="phonenumber" value="{{old('phonenumber')}}">
                                @else
                                <input type="text" id="phonenumber" class="form-control" name="phonenumber" value="{{ old('phonenumber') }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                @if(Request::has('confirm'))
                                <button type="submit" class="btn btn-primary" name="post">注文を確定する</button>
                                <button type="submit" class="btn btn-primary" name="back">修正する</button>
                                @else
                                <button type="submit" class="btn btn-primary" name="confirm">入力内容を確認する</button>
                                @endif
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($cartproducts as $cartproduct)
                    <div class="card-header">
                        {{$cartproduct->name}}
                    </div>
                    <div class="card-body">
                        <div>
                            {{$cartproduct->price}}円
                        </div>
                        <div>
                            {{$cartproduct->stock}}個
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
</div>
    @endsection