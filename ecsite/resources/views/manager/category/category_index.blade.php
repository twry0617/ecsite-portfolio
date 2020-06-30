@extends('layouts/manager.manager')

@section('title','商品カテゴリ-')

@section('content')
<div class="page-header" style="margin-top:0px;padding-bottom:0px;">
    <a href="/manager/categories/create" class="btn btn-danger btn-sm">新規作成</a>
    <h1><small>商品カテゴリー</small></h1>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>
                <a href="categories/{{$category->id}}" class="btn btn-primary btn-sm">詳細を表示</a>
                <a href="categories/{{$category->id}}/edit" class="btn btn-primary btn-sm">編集する</a>
                @endforeach
</table>
{{$categories->links()}}
@endsection