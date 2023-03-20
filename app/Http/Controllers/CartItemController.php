<?php

namespace App\Http\Controllers;

use App\Models\Item;

use App\Models\Product;
use App\Models\ProductImg;
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

        return view('members.cart_items.finish');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
