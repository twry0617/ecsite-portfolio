@extends('layouts/manager.manager')

@section('title','商品カテゴリー')

@section('content')

<form action="/manager/categories" method="post">

{{ csrf_field() }}

<div>
<label for="title">商品カテゴリー</label>
<input type="text" name="name" placeholder="nameを入れる">
</div>
<div>
<input type="submit" value="送信">
</div>
</form>
@endsection

