@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="mx-auto" style="max-width:1200px">
    <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:1.2em; padding:24px 0px;">

      <div class="">
        <p class="text-center">{{ $message }}</p><br>
        <div class="d-flex flex-row flex-wrap">

          @foreach($my_carts as $my_cart)
          <div class="mycart_box">
            <p>ユーザーID：{{$my_cart->user_id}}</p>
            <p>ストックID：{{$my_cart->stock_id}}</p>
            @endforeach

          </div>

          <a href="/">商品一覧へ</a>
        </div>
      </div>
  </div>
</div>
@endsection