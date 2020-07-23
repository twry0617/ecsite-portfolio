{{$name}}様<br>
この度はecsiteでの購入ありがとうございました

お客様が購入された商品は<br>
@foreach($cartproducts as $cartproduct)
{{$cartproduct->namae}}円{{$cartproduct}}個
@endforeach

となります<br>

