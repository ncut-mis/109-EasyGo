<?php

namespace App\Http\Controllers;

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

        $user_id=Auth::id();
        $members=Member::where('user_id',$user_id)->get();//取得會員編號
        foreach ($members as $member){
            $orders=Order::where('member_id',$member->id)->get();//取得訂單編號
            foreach ($orders as $order){
                $sum_price=0;
                $order_details=OrderDetali::where('order_id',$order->id)->get();//取得訂單明細編號
                foreach ($order_details as $order_detail){
                    $price=Product::find($order_detail->product_id)->price;//取得產品價格
                    $sum_price+=$price * $order_detail->quantity;//加總該訂單所有價格
                }
                switch ($order->status){    //辨識訂單狀態
                    case 0:
                        $status='審核中';
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
                    default:
                        $status='error';
                };
                //建立新的資料表
                $array=Arr::add($array,$array_key,[
                    'id'=>$order->id,//訂單編號
                    'creat_time'=>$order->created_at,//成立時間
                    'price'=>$sum_price,//總金額
                    'status'=>$status,//訂單狀態
                ]);

                $array_key++;
            }
        }
        $data=[
            'array'=>$array,
        ];
        return view('members.orders.index',$data);
    }
}
