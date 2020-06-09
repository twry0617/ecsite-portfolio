@extends('layouts/manager.manager')

@section('title','詳細一覧')

@section('content')
<h1>{{$category->name}}</h1>
<a href="/manager/categories/{{$category->id}}/edit">編集する</a>
<form action="/manager/categories/{{$category->id}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="delete">
      <input type="submit" name="" value="削除する">
      </form>
<a href="/manager/categories">一覧に戻る</a>

@endsection

