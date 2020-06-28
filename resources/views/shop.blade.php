@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="">
    <div class="mx-auto" style="max-width:1200px">
      <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品一覧</h1>
      <div class="">
        <div class="d-flex flex-row flex-wrap">
          商品一覧を出したい

          {{-- 追加 --}}

          @foreach($stocks as $stock)
          {{$stock->name}} <br>
          {{$stock->fee}}円<br>
          <img src="/image/{{$stock->imgpath}}" alt="" class="incart">
          <br>
          {{$stock->detail}} <br>
          @endforeach
          {{$stocks->links()}}

          {{-- ここまで --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection