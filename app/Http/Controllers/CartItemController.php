<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;

use App\Models\Items;
use App\Models\Member;
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
        $user=Auth::user()->id;//目前使用者

        $members=Member::where('user_id','=',5)->get();
        dd($members);

        foreach ($members as $member){
            $items = Item::where('member_id','=',$member->id)->get();//目前使用者的選購項目
        }
        $carts = array();

        $total=0;


        foreach ($items as $item)
        {
            $product_info = Product::where('id','=',$item->product_id)->get();//取得商品資料列
            $product_img = ProductImg::where('id','=',$item->product_id)->get();//取得商品圖片資料列
            $cart_item = $product_info[0];//取出陣列中單一筆資料
            $cart_item->quantity = $item->quantity;//將商品數量替代為選購數量
            $cart_item->picture = $product_img[0]->picture;//取得商品圖片
            $total = ($cart_item->price)*($cart_item->quantity)+$total;//計算總額
            array_push($carts, $cart_item);//將商品資訊加入陣列
        }

        $data = [
            'carts' => $carts,
           'total'=>$total,
            'items'=>$items,
        ];

        //$user_list = DB::select('select * from users');
        //return view('index',['user_list' => $user_list]);

        return view('members.cart_items.index',$data);
    }

    public function finish()
    {
        $user = Auth::user(); //目前使用者
        $name = Auth::user()->name;
        $members = Member::where('user_id', $user->id)->get();
        foreach ($members as $member) {
            $items = Item::where('member_id', '=', $member->id)
                ->join('products', 'items.product_id', 'products.id')
                ->where('products.status', '=', '1')
                ->get(); //目前使用者的選購項目
        }


        $carts = array();
        $total = 0;

        foreach ($items as $item) {
            $product_info = Product::where('id', '=', $item->product_id)->get(); //目前使用者的食譜
            $product_img = ProductImg::where('id', '=', $item->product_id)->get(); //目前使用者的食譜
            $cart_item = $product_info[0];
            $cart_item->quantity = $item->quantity;
            $cart_item->picture = $product_img[0]->picture;
            $total = ($cart_item->price) * ($cart_item->quantity) + $total;
            array_push($carts, $cart_item);
        }

        $data = [
            'name' => $name,
            'user' => $user,
            'carts' => $carts,
            'total' => $total
        ];
        return view('members.cart_items.finish', $data);
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

        $user = Auth::user(); //目前使用者
        $members = Member::where('user_id', $user->id)->get();

        $item_count = Item::where('member_id', $members[0]->id)->where('product_id', $request->input('pid'))->count();
        if ($item_count > 0) {
            return redirect()->back()->with('status', '系統提示：餐點已加入購物車');
        }

        Item::create([
            'member_id' => $members[0]->id,
            'product_id' => $request->input('pid'),
            'quantity' => $request->input('quantity')
        ]);
        return redirect()->back()->with('status', '系統提示：餐點已加入購物車');

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


    public function easy(Request $request)
    {
        $user = Auth::user(); //目前使用者
        $members = Member::where('user_id', $user->id)->get();
        $product = $request->input('product');

        foreach ($product as $key => $value) {
            $item_count = Item::where('member_id', $members[0]->id)->where('product_id', $value['product_id'])->count();
            if ($item_count == 0 and isset($value['suretobuy'])) {
                if ($value['product_id'] != "0") {
                    Item::create([
                        'member_id' => $members[0]->id,
                        'product_id' => $value['product_id'],
                        'quantity' => $value['quantity']
                    ]);
                }
            }

        }

        // Item::create([
        //     'member_id' => $members[0]->id,
        //     'product_id' => $request->input('pid'),
        //     'quantity' => $request->input('quantity')
        // ]);
        return redirect()->back()->with('status', '系統提示：餐點已加入購物車');
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
    public function update(Request $request)
    {
        $user=Auth::user();//目前使用者
        $members = Member::where('user_id', $user->id)->get();

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $item = Item::where('member_id', '=', $members[0]->id)->where('product_id', '=', $product_id)->get();
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
        $user = Auth::user(); //目前使用者
        //getMemberID
        $members = Member::where('user_id', $user->id)->get();

        $product_id = $request->input('id');


        Item::where('member_id', '=', $members[0]->id)->where('product_id', '=', $product_id)->delete();

        return redirect()->back()->with('success', '刪除成功');
    }
}
