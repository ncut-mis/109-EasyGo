<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetali;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class MemberOrderController extends Controller
{
    public function index(){
        //顯示訂單列表
        $array=[];
        $array_key=0;
        $has_data=null;

        $user_id=Auth::id();
        $members=Member::where('user_id',$user_id)->get();//取得會員編號
        foreach ($members as $member){
            $orders=Order::where('member_id',$member->id)->orderBy('updated_at','DESC')->orderBy('id','DESC')->get();//取得訂單編號
            if (Order::where('member_id',$member->id)->first()==null){  //檢測是否有資料
                $has_data=0;
            }else{
                $has_data=1;
                foreach ($orders as $order){
                    $sum_price=0;
                    $order_details=OrderDetali::where('order_id',$order->id)->get();//取得訂單明細編號
                    foreach ($order_details as $order_detail){
                        $price=Product::find($order_detail->product_id)->price;//取得產品價格
                        $sum_price+=$price * $order_detail->quantity;//加總該訂單所有價格
                    }
                    switch ($order->status){    //辨識訂單狀態
                        case 0:
                            $status='訂單審核中';
                            break;
                        case 1:
                            $status='已成立';
                            break;
                        case 2:
                            $status='出貨中';
                            break;
                        case 3:
                            $status='已出貨';
                            break;
                        case 4:
                            $status='已送達';
                            break;
                        case 5:
                            $status='已完成';
                            break;
                        case 6:
                            $status='已取消';
                            break;
                        case(7):
                            $status='取消申請中';
                            break;
                        default:
                            $status='error';
                    };
                    switch ($order->remit){    //辨識付款狀態
                        case 0:
                            $remit='未付款';
                            break;
                        case 1:
                            $remit='已付款';
                            break;
                        case 2:
                            $remit='已退款';
                            break;
                    };
                    //建立新的資料表
                    $array=Arr::add($array,$array_key,[
                        'id'=>$order->id,//訂單編號
                        'creat_time'=>$order->created_at,//成立時間
                        'price'=>$sum_price,//總金額
                        'status'=>$status,//訂單狀態
                        'remit'=>$remit//付款狀態
                    ]);

                    $array_key++;
                }
            }

        }
        $data=[
            'has_data'=>$has_data,
            'array'=>$array,
        ];
        return view('members.orders.index',$data);
    }

    public function done(){
        //顯示已完成訂單列表
        $array=[];
        $array_key=0;
        $has_data=null;

        $user_id=Auth::id();
        $members=Member::where('user_id',$user_id)->get();//取得會員編號
        foreach ($members as $member){
            $orders=Order::where('member_id',$member->id)->where('status',5)->orderBy('updated_at','DESC')->orderBy('id','DESC')->get();//取得訂單
            if (Order::where('member_id',$member->id)->where('status',5)->first()==null){  //檢測是否有資料
                $has_data=0;
            }else{
                $has_data=1;
                foreach ($orders as $order){
                    $sum_price=0;
                    $order_details=OrderDetali::where('order_id',$order->id)->get();//取得訂單明細編號
                    foreach ($order_details as $order_detail){
                        $price=Product::find($order_detail->product_id)->price;//取得產品價格
                        $sum_price+=$price * $order_detail->quantity;//加總該訂單所有價格
                    }
                    switch ($order->remit){    //辨識付款狀態
                        case 0:
                            $remit='未付款';
                            break;
                        case 1:
                            $remit='已付款';
                            break;
                        case 2:
                            $remit='已退款';
                            break;
                    };
                    //建立新的資料表
                    $array=Arr::add($array,$array_key,[
                        'id'=>$order->id,//訂單編號
                        'creat_time'=>$order->created_at,//成立時間
                        'price'=>$sum_price,//總金額
                        'status'=>'已完成',//訂單狀態
                        'remit'=>$remit//付款狀態
                    ]);

                    $array_key++;
                }
            }

        }
        $data=[
            'has_data'=>$has_data,
            'array'=>$array,
        ];
        return view('members.orders.done',$data);
    }
    public function cancel(){
        //顯示已完成訂單列表
        $array=[];
        $array_key=0;
        $has_data=null;

        $user_id=Auth::id();
        $members=Member::where('user_id',$user_id)->get();//取得會員編號
        foreach ($members as $member){
            $orders=Order::where('member_id',$member->id)->where('status',6)->orderBy('updated_at','DESC')->orderBy('id','DESC')->get();//取得訂單
            if (Order::where('member_id',$member->id)->where('status',6)->first()==null){  //檢測是否有資料
                $has_data=0;
            }else{
                $has_data=1;
                foreach ($orders as $order){
                    $sum_price=0;
                    $order_details=OrderDetali::where('order_id',$order->id)->get();//取得訂單明細編號
                    foreach ($order_details as $order_detail){
                        $price=Product::find($order_detail->product_id)->price;//取得產品價格
                        $sum_price+=$price * $order_detail->quantity;//加總該訂單所有價格
                    }
                    switch ($order->remit){    //辨識付款狀態
                        case 0:
                            $remit='未付款';
                            break;
                        case 1:
                            $remit='已付款';
                            break;
                        case 2:
                            $remit='已退款';
                            break;
                    };
                    //建立新的資料表
                    $array=Arr::add($array,$array_key,[
                        'id'=>$order->id,//訂單編號
                        'creat_time'=>$order->created_at,//成立時間
                        'price'=>$sum_price,//總金額
                        'status'=>'已取消',//訂單狀態
                        'remit'=>$remit//付款狀態
                    ]);

                    $array_key++;
                }
            }

        }
        $data=[
            'has_data'=>$has_data,
            'array'=>$array,
        ];
        return view('members.orders.cancel',$data);
    }
    public function show(Order $order){

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
                $sum+=$subtotal;//總金額
                $key++;
            }

        }
        $data=[
            'order'=>$order,
            'array'=>$array,
            'sum'=>$sum,
        ];
        //運送狀態
        //收件者姓名
        //電話
        //地址
        //訂單明細(品項、數量、金額)
        //總金額
        //付款方式
        //付款狀態
        //訂單編號
        //訂單成立時間
        return view('members.orders.show',$data);
    }
    public function cancel_update(Order $order,Request $request){
        //修改訂單狀態為取消
        $order=Order::find($request->id);
        $order->update([

            'remark'=>$request->remark,
            'status'=>7,
        ]);
        return redirect()->route('members.orders.index');
    }
    public function done_update(Order $order){
        //修改訂單狀態為已完成
        $order->update([
            'status'=>5
        ]);
        return redirect()->route('members.orders.index');
    }



}

