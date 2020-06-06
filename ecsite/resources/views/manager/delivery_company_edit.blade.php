@extends('layouts/manager.application')

@section('配送会社', '編集')

@section('content')

<form action="/manager/delivery_companies/{{$delivery_company->id}}" method="post">
{{ csrf_field() }}
<div>
<label for="title">配送会社</label>
<input type="text" name="name" placeholder="nameを入れる" value="{{$delivery_company->name}}">
</div>
<div>
<label for="title">電話番号</label>
<input type="text" name="telephone" placeholder="nameを入れる" value="{{$delivery_company->telephone}}">
</div>
<div>
<label for="title">送料</label>
<input type="text" name="shipping_cost" placeholder="nameを入れる" value="{{$delivery_company->shipping_cost}}">
</div>
<div>
<input type="hidden" name="_method" value="patch">
<input type="submit" value="更新">
</div>
</form>
@endsection