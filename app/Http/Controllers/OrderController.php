<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function checkout(Request $request)
    {
        $user = Auth::user(); //目前使用者
        $m = Member::where('user_id', '=', $user->id)->get();


        $member_id = $m[0]->id;
        $remit = $request->input('remit');
        $receiver = $request->input('receiver');
        $tel = $request->input('tel');
        $address = $request->input('address');

        Order::create([
            'member_id' => $member_id,
            'remit' => $remit,
            'status' => 0,
            'receiver' => $receiver,
            'tel' => $tel,
            'address' => $address,
        ]);

        $items = Item::where('member_id', '=', $member_id)
            ->join('products', 'items.product_id', 'products.id')
            ->where('products.status', '=', '1')
            ->get();

        foreach ($items as $item) {
            OrderDetali::create([
                'order_id' => Order::max('id'),
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }
        Item::where('member_id', '=', $member_id)
            ->join('products', 'items.product_id', 'products.id')
            ->where('products.status', '=', '1')
            ->delete();

        return redirect()->route('members.cart_items.index');
    }


}
