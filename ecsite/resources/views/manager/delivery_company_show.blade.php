@extends('layouts/manager.application')

@section('title','詳細一覧')

@section('content')
<h1>{{$delivery_company->name}}</h1>
<h1>{{$delivery_company->telephone}}</h1>
<a href="/manager/delivery_companies/{{$delivery_company->id}}/edit">編集する</a>
<form action="/manager/delivery_companies/{{$delivery_company->id}}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="delete">
      <input type="submit" name="" value="削除する">
      </form>
<a href="/manager/delivery_companies">一覧に戻る</a>

@endsection