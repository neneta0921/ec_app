<?php

namespace App\Http\Controllers;

use App\Models\Stock; //追加
use App\Models\Cart; //追加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index() //追加
    {
        $stocks = Stock::Paginate(6); //Eloquantで検索
        return view('shop',compact('stocks')); //追記変更
    }
    
    public function myCart() //追加
    {
        $my_carts = Cart::all(); //Eloquantで検索
        return view('mycart',compact('my_carts')); //追記変更
    }

    public function addMyCart(Request $request)
    {
        // $user_id = Auth::id(); 
        $user_id = 1; 
        $stock_id=$request->stock_id;
        $cart_add_info=Cart::firstOrCreate(['stock_id' => $stock_id,'user_id' => $user_id]);
        if($cart_add_info->wasRecentlyCreated){
            $message = 'カートに追加しました';
        }
        else{
            $message = 'カートに登録済みです';
        }
        $my_carts = Cart::where('user_id',$user_id)->get();
        return view('mycart',compact('my_carts' , 'message'));
    }
}
