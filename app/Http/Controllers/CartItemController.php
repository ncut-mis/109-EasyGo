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

        $total=0;


        foreach ($items as $item)
        {
            $product_info = Product::where('id','=',$item->product_id)->get();//目前使用者的食譜
            $product_img = ProductImg::where('id','=',$item->product_id)->get();//目前使用者的食譜
            $cart_item = $product_info[0];
            $cart_item->quantity = $item->quantity;
            $cart_item->picture = $product_img[0]->picture;
            $total = ($cart_item->price)*($cart_item->quantity)+$total;
            array_push($carts, $cart_item);
        }

        $data = [
            'carts' => $carts,
           'total'=>$total
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
        $total=0;

        foreach ($items as $item)
        {
            $product_info = Product::where('id','=',$item->product_id)->get();//目前使用者的食譜
            $product_img = ProductImg::where('id','=',$item->product_id)->get();//目前使用者的食譜
            $cart_item = $product_info[0];
            $cart_item->quantity = $item->quantity;
            $cart_item->picture = $product_img[0]->picture;
            $total = ($cart_item->price)*($cart_item->quantity)+$total;
            array_push($carts, $cart_item);
        }

        $data = [
            'name'=>$name,
            'user'=>$user,
            'carts'=>$carts,
             'total'=>$total
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
    public function store(Request $request)
    {
        $user=Auth::user();//目前使用者
      Item::create($request->all());
       return redirect()->route('members.cart_items.index')->with('status','已加入購物車');

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
