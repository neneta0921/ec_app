<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; //追記
use App\Mail\Thanks;//追記

class ShopController extends Controller
{
    public function index()
    {
        $stocks = Stock::Paginate(6); //Eloquantで検索
        return view('shop',compact('stocks')); //追記変更
    }
    
    public function myCart(Cart $cart)
    {
        $data = $cart->showCart();
        return view('mycart',$data);
    }

    public function addMycart(Request $request, Cart $cart)
    {
        //カートに追加の処理
        $stock_id=$request->stock_id;
        $message = $cart->addCart($stock_id);
        //追加後の情報を取得
        $data = $cart->showCart();
        return view('mycart',$data)->with('message',$message);
    }

//    public function deleteCart(Request $request, Cart $cart)
//    {
//        $stock_id=$request->stock_id;
//        $user = auth()->user();
//        $message = $cart->deleteMyCart($user->id, $stock_id);
//        $my_carts = $cart->showCart();
//        return view('mycart',compact('my_carts' , 'message'));
//    }

    public function deleteCart(Request $request,Cart $cart)
    {
        //カートから削除の処理
        $stock_id=$request->stock_id;
        $message = $cart->deleteCart($stock_id);
        //追加後の情報を取得
        $data = $cart->showCart();
        return view('mycart',$data)->with('message',$message);
    }

    public function checkout(Request $request,Cart $cart)
    {
        $user = Auth::user();
        $mail_data['user']=$user->name; //追記
        $mail_data['checkout_items']=$cart->checkoutCart(); //編集
        Mail::to($user->email)->send(new Thanks($mail_data));//編集
        return view('checkout');
    }
}
