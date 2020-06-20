@extends('layouts/manager.manager')

@section('配送会社', '編集')

@section('content')

<form action="/manager/delivery_companies/{{$deliverycompany->id}}" method="post">
    {{ csrf_field() }}
    @if ($errors->has('name'))
  <p>{{$errors->first('name')}}</p>
  @endif
    <div>
        <label for="title">配送会社</label>
        <input type="text" name="name" placeholder="nameを入れる" value="{{$deliverycompany->name}}">
    </div>
    @if ($errors->has('telephone'))
  <p>{{$errors->first('telephone')}}</p>
  @endif
    <div>
        <label for="title">電話番号</label>
        <input type="text" name="telephone" placeholder="nameを入れる" value="{{$deliverycompany->telephone}}">
    </div>
    @if ($errors->has('shipping_cost'))
  <p>{{$errors->first('shipping_cost')}}</p>
  @endif
    <div>
        <label for="title">送料</label>
        <input type="text" name="shipping_cost" placeholder="nameを入れる" value="{{$deliverycompany->shipping_cost}}">
    </div>
    <div>
        <input type="hidden" name="_method" value="patch">
        <input type="submit" value="更新">
    </div>
</form>
@endsection