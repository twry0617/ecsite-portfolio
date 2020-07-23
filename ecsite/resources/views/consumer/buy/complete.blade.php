@extends('layouts/consumer.app')

@section('content')
<div class="container-fluid">
    <div class="">
<div class="mx-auto" style="max-width:1200px;">
<h1 class="text-center font-weight-bold" style="color:#555555;  font-size:1.2em; padding:24px 0px;">
<h1>{{Auth::user()->name}}さんご購入ありがとうございました</h1>
<div class="card-body">
    <p>ご登録頂いたメールアドレスに決済情報をお送りしています</p>
    <a href="/consumer/index">商品一覧へ</a>
</div>
</div>
    </div>
</div>
@endsection