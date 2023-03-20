<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;

use App\Models\Items;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();//目前使用者

        $items = Item::where('member_id','=',$user->id)->get();//目前使用者的食譜

        $carts = array();

        foreach ($items as $item)
        {
            $product_info = Product::where('id','=',$item->product_id)->get();//目前使用者的食譜
            $product_img = ProductImg::where('id','=',$item->product_id)->get();//目前使用者的食譜

            $cart_item = $product_info[0];
            $cart_item->quantity = $item->quantity;
            $cart_item->picture = $product_img[0]->picture;

            array_push($carts, $cart_item);
        }

        $data = [
            'carts' => $carts
        ];

        //$user_list = DB::select('select * from users');
        //return view('index',['user_list' => $user_list]);

        return view('members.cart_items.index',$data);
    }

    public function finish()
    {
        $user=Auth::user();//目前使用者
        $name=Auth::user()->name;
        $items = Item::where('member_id','=',$user->id)->get();//目前使用者的食譜
        $carts = array();

        foreach ($items as $item)
        {
            $product_info = Product::where('id','=',$item->product_id)->get();//目前使用者的食譜
            $product_img = ProductImg::where('id','=',$item->product_id)->get();//目前使用者的食譜

            $cart_item = $product_info[0];
            $cart_item->quantity = $item->quantity;
            $cart_item->picture = $product_img[0]->picture;

            array_push($carts, $cart_item);
        }

        $data = [
            'name'=>$name,
            'user'=>$user,
            'carts'=>$carts
        ];
        return view('members.cart_items.finish',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
//        //取得使用者此筆訂單資訊
//        $order = Auth::user()->order()->orderby('id', 'DESC')->first();
//
//
//        //關聯餐點及訂單到order_item表內
//        $product->order()->attach($order->id, ['quantity' => $request['quantity'], 'status' => 0]);
//
//        //變數$meal存入矩陣
//        $data=[ 'meal'=>$meal ];
//
//        //返回該餐點介面
//
//        return redirect()->route('product.index')->with('status','系統提示：訂單已送出！');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=Auth::user();//目前使用者

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $item = Item::where('member_id','=',$user->id)->where('product_id','=',$product_id)->get();
        $item[0]->quantity = $quantity;
        $item[0]->save();

        return redirect()->back()->with('success', '編輯成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user=Auth::user();//目前使用者

        $product_id = $request->input('id');

        Item::where('member_id','=',$user->id)->where('product_id','=',$product_id)->delete();

        return redirect()->back()->with('success', '刪除成功');
    }
}
