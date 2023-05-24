<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetali;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminOrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('updated_at','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'orders'=>$orders
        ];

        return view('admins.orders.index',$data);
    }

    public function cancel_apply()
    {
        //取消申請訂單列表
        $orders = Order::where('status','=','7')->orderBy('updated_at','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'orders'=>$orders
        ];

        return view('admins.orders.cancel_apply',$data);
    }

    public function done()
    {
        //已完成訂單列表
        $orders = Order::where('status','=','5')->orderBy('updated_at','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'orders'=>$orders
        ];

        return view('admins.orders.done',$data);
    }

    public function check_apply()
    {
        //待審核訂單列表
        $orders = Order::where('status','=','0')->orderBy('updated_at','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'orders'=>$orders
        ];

        return view('admins.orders.check_apply',$data);
    }
    public function audited()
    {
        //已審核訂單列表
        $orders = Order::where('status','=','1')->orderBy('updated_at','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'orders'=>$orders
        ];

        return view('admins.orders.audited',$data);
    }
    public function ship()
    {
        //出貨中訂單列表
        $orders = Order::where('status','=','2')->orderBy('updated_at','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'orders'=>$orders
        ];

        return view('admins.orders.ship',$data);
    }
    public function shipped()
    {
        //已出貨訂單列表
        $orders = Order::where('status','=','3')->orderBy('updated_at','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'orders'=>$orders
        ];

        return view('admins.orders.shipped',$data);
    }

    public function arrival()
    {
        //已送達訂單列表
        $orders = Order::where('status','=','4')->orderBy('updated_at','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'orders'=>$orders
        ];

        return view('admins.orders.arrival',$data);
    }
    public function cancel()
    {
        //已取消訂單列表
        $orders = Order::where('status','=','6')->orderBy('updated_at','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'orders'=>$orders
        ];

        return view('admins.orders.cancel',$data);
    }
    public function create()
    {

    }


    public function store(Request $request)
    {
        //
    }


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


    public function update(Request $request,Order $order)
    {
//        $order=Order::find($request->id);
//        $order->update([
//            'status'=>$request->status,
//        ]);
        $order_status=$order->status;
        $order->update([
            'status'=>$order_status+1,
        ]);
        return redirect()->route('admins.orders.index');

    }

    public function destroy(Request $request)
    {
        $order_details=OrderDetali::where('order_id',$request->id)->get();
        foreach ($order_details as $order_detail){
            OrderDetali::destroy($order_detail->id);
        }
        Order::destroy($request->id);
        return redirect()->route('admins.orders.index');
    }

    public function update_check(Order $order){
        $order->update([
            'status'=>1,
        ]);
        return redirect()->route('admins.orders.index');
    }

    public function update_cancel(Request $request){
        $order=Order::find($request->id);
        $order->update([
            'status'=>6,
        ]);
        return redirect()->route('admins.orders.index');
    }
}
