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
    
    public function myCart(Cart $cart)
    {
        $my_carts = $cart->showCart();
        return view('mycart',compact('my_carts'));
    }

    public function addMycart(Request $request, Cart $cart)
    {
        //カートに追加の処理
        $stock_id=$request->stock_id;
        $message = $cart->addCart($stock_id);
        //追加後の情報を取得
        $my_carts = $cart->showCart();
        return view('mycart',compact('my_carts' , 'message'));
    }

    public function deleteCart(Request $request, Cart $cart)
    {
        $stock_id=$request->stock_id;
        $user = auth()->user();
        $message = $cart->deleteMyCart($user->id, $stock_id);
        $my_carts = $cart->showCart();
        return view('mycart',compact('my_carts' , 'message'));
    }
}
