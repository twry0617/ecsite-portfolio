@extends('layouts/manager.manager')

@section('title','配送会社')

@section('content')

<form action="/manager/delivery_companies" method="post">

    {{ csrf_field() }}
    @if ($errors->has('name'))
  <p>{{$errors->first('name')}}</p>
  @endif
    <div>
        <label for="title">配送会社</label>
        <input type="text" name="name" placeholder="nameを入れる">
    </div>
    @if ($errors->has('telephone'))
  <p>{{$errors->first('telephone')}}</p>
  @endif
    <div>
        <label for="">電話番号</label>
        <input type="text" name="telephone" plecehoder="電話番号を入れる">
    </div>
    @if ($errors->has('shipping_cost'))
  <p>{{$errors->first('shipping_cost')}}</p>
  @endif
    <div>
        <label for="">送料</label>
        <input type="text" name="shipping_cost" plecehoder="送料を入れる">
    </div>
    <div>
        <input type="submit" value="送信">
    </div>
</form>
@endsection