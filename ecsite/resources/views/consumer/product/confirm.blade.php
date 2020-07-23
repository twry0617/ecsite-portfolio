@extends('layouts/consumer.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
            <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品一覧</h1>
            <div class="">
                <form method="POST" action="/consumer/index">
                @csrf
                    @if($errors->has('name'))
                    <p>{{$errors->first('name')}}</p>
                    @endif
                    <p>商品名</p>
                    <input type="text" name="keyword" value="{{$keyword}}">
                    @if ($errors->has('amount_from'))
                    <p>{{$errors->first('amount_from')}}</p>
                    @endif
                    @if ($errors->has('amount_to'))
                    <p>{{$errors->first('amount_to')}}</p>
                    @endif
                    <p>金額</p>
                    <input type="number" min="0" max="9999" name="amount_from">
                    ~
                    <input type="number" min="0" max="9999" name="amount_to">
                    <input type="submit" value="検索">
                </form>
                <div class="d-flex flex-row flex-wrap">
                    @foreach($products as $product)
                    <div class="col-xs-6 col-sm-4 col-md-4 ">
                        <div class="mycart_box">
                            {{$product->name}} <br>
                            {{$product->amount}}円<br>
                            <img src="/image/{{$product->photo1}}" alt="" class="">
                            <br>
                            <a href="/consumer/index/{{ $product->id }}">商品詳細ページへ</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center" style="width: 200px;margin: 20px auto;">
                    　{{ $products->appends(['keyword' => $keyword, 'amount_from' => $amount_from, 'amount_to' => $amount_to])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection