@extends('layouts/manager.manager')

@section('title','配送会社')

@section('content')
<div class="page-header" style="margin-top:-30px;padding-bottom:0px;">
    <a href="/manager/delivery_companies/create" class="btn btn-danger btn-sm">新規作成</a>
    <h1><small>配送会社</small></h1>
</div>
<table class="table table->striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>name</th>
            <th>telephone</th>
            <th>shipping_cost</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($delivery_companies as $delivery_company)
        <tr>
            <td>{{$delivery_company->id}}</td>
            <td>{{$delivery_company->name}}</td>
            <td>{{$delivery_company->telephone}}</td>
            <td>{{$delivery_company->shipping_cost}}
            <td></td>
            <td>
                <a href="delivery_companies/{{$delivery_company->id}}" class="btn btn-primary btn-sm">詳細を表示</a>
                <a href="delivery_companies/{{$delivery_company->id}}/edit" class="btn btn-primary btn-sm">編集する</a>
                @endforeach
</table>
{{$delivery_companies->links()}}
@endsection