@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="container">
    <div class="mx-auto" style="max-width:1200px">
      <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:1.2em; padding:24px 0px;">
        {{ Auth::user()->name }}さんのカートの中身</h1>

      <div class="">
        <p class="text-center">{{ $message ?? '' }}</p><br>
        <div class="d-flex flex-row flex-wrap">

          @foreach($my_carts ?? '' as $my_cart)
          <div class="mycart_box">
            {{ $my_cart->stock->name }} <br>
            {{ number_format($my_cart->stock->fee) }}円 <br>
            <img src="/image/{{$my_cart->stock->imgpath}}" alt="" class="incart">
            <br>

            <form action="/cartdelete" method="post">
              @csrf
              <input type="hidden" name="stock_id" value="{{ $my_cart->stock->id }}">
              <input type="submit" value="カートから削除する">
            </form>
          </div>
          @endforeach

        </div>

        <a href="/">商品一覧へ</a>
      </div>
    </div>
  </div>
</div>
@endsection