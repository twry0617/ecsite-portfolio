{{Auth::user()->name}}様<br>
この度はecsiteでの購入ありがとうございました

お客様が購入された商品は<br>
@foreach($cartproducts as $cartproduct)
{{$cartproduct->name}}円{{$cartproduct->stock}}個
@endforeach

となります<br>

下記の決済画面より決済を完了させてください
<a href=""></a>