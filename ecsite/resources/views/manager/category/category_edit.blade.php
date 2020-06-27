@extends('layouts/manager.manager')

@section('商品カテゴリー', '編集')

@section('content')

<form action="/manager/categories/{{$category->id}}" method="post">
    {{ csrf_field() }}

  @if ($errors->has('name'))
  <p>{{$errors->first('name')}}</p>
  @endif
    
    <div>
        <label for="title">商品カテゴリー</label>
        <input type="text" name="name" placeholder="nameを入れる" value="{{$category->name}}">
       
    </div>
    <div>
        <input type="hidden" name="_method" value="patch">
        <input type="submit" value="更新">
    </div>
</form>
@endsection


