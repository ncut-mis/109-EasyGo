<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'orders'=>$orders
        ];

        return view('admins.orders.index',$data);
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
    public function show(Order $order)
    {
        $array=[];
        $key=0;
        $sum=0;
        $orderderails=$order->orderDetali()->get();//取得訂單明細
        foreach ($orderderails as $orderderail){
            $products=$orderderail->product()->get();//取得商品資訊
            foreach ($products as $product){
                $subtotal=$product->price * $orderderail->quantity;//計算價格(各品項小計)
                $array=Arr::add($array,$key,[//產生新的資料表
                    'name'=>$product->name,//產品名稱
                    'quantity'=>$orderderail->quantity,//數量
                    'price'=>$product->price,//單價
                    'subtotal'=>$subtotal,//小計

                ]);
                $sum+=$subtotal;
                $key++;
            }

        }
        $data=[
            'order'=>$order,
            'array'=>$array,
            'sum'=>$sum,
        ];

        return view('admins.orders.show',$data);
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
    public function check(Order $order){
        $order->update([
            'status'=>1,
        ]);
        return redirect()->route('admins.orders.index');
    }
}
