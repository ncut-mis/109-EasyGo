<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'products'=>$products
        ];

        return view('admins.products.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //資料驗證
        $this->validate($request,[
            'name'=>'required',
            'brand'=>'required',
            'origin_place'=>'required',
            'stock'=>'required',
            'price'=>'required',
            'text'=>'required|max:255',
        ]);
        //取得現在時間
        $created_at=date('y/n/j');

//        //判斷種類為種類編號
//        $categories=$request->categories;
//        $categoryname=Category::all('name');
//
//        if ($categories == $categoryname) {
//            $categoryid = Category::all('category_id');
//        }
//        else {
//                print "產品種類輸入錯誤!";
//        }

        //儲存資料至products
        Product::create([
            'category_id'=>'1',//修改
            'name'=>$request->name,
            'brand'=>$request->brand,
            'origin_place'=>$request->origin_place,
            'stock'=>$request->stock,
            'norm'=>'/份',//修改
            'price'=>$request->price,
            'text'=>$request->text,
            'created_at'=>$created_at,
        ]);
        return redirect()->route('admins.products.index');
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


    public function destroy(Product $product)//待修改
    {
        //要把產品相關的訂單一起刪除才可以把產品刪除
        Product::destroy($product->id);
        return redirect()->route('admins.products.index');
    }
}
