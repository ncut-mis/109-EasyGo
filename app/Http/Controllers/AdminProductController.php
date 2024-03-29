<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImg;
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
//        $categories=Category::all();
        $products = Product::orderBy('id','DESC')->get();//取得資料庫中的欄位值，以陣列的方式
        $data=[
            'products'=>$products,
//            'categories'=>$categories,
        ];

        return view('admins.products.index',$data);
    }
    //下架食材
    public function stop(Product $product)
    {
        $product->update(['status'=>0]);
        return redirect()->route('admins.products.index');
    }
    //上架食材
    public function launch(Product $product)
    {
        $product->update(['status'=>1]);
        return redirect()->route('admins.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //取得種類名稱
        $categories=Category::all();
        $data=[
            'categories'=>$categories,
        ];
        return view('admins.products.create',$data);
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
            'category'=>'required',
            'name'=>'required',
            'brand'=>'required',
            'origin_place'=>'required',
            'stock'=>'required',
            'price'=>'required',
            'text'=>'required|max:255',
        ]);
        //取得現在時間
        $created_at=date('y/n/j');

        $newProduct=Product::create([
            'category_id'=>$request->category,//種類
            'status'=>'0',//皆為下架狀態
            'name'=>$request->name,
            'brand'=>$request->brand,
            'origin_place'=>$request->origin_place,
            'stock'=>$request->stock,
            'norm'=>'/份',
            'price'=>$request->price,
            'text'=>$request->text,
            'created_at'=>$created_at,
        ]);

        $productId=$newProduct->id;
        // 處理圖片上傳
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('img/product', $fileName);

                // 關聯圖片與產品
                ProductImg::create([
                    'product_id' => $productId,
                    'picture' => $fileName,
                ]);
            }
        }
        else {
            // 沒有上傳圖片，使用預設圖片
            $fileName = 'default.jpg';
            // 關聯圖片與產品
            ProductImg::create([
                'product_id' => $productId,
                'picture' => $fileName,
            ]);
        }
        return redirect()->route('admins.products.index');

    }


    public function show(Product $product )
    {
        $productImgs=ProductImg::where('product_id','=',$product->id)->get();
        $categories=Category::all();
        $data=[
            'product'=>$product,
            'categories'=>$categories,
            'productImgs'=>$productImgs,
        ];
        return view('admins.products.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productImgs=ProductImg::where('product_id','=',$product->id)->get();
        $categories=Category::all();
        $data=[
            'product'=>$product,
            'categories'=>$categories,
            'productImgs'=>$productImgs,
        ];
        return view('admins.products.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // 先處理圖片上傳
        if ($request->hasFile('images')) {
            $productImgs=ProductImg::where('product_id','=',$product->id)->get();
            foreach ($productImgs as $productImg){
                if ($productImg) {
                    //刪除public下的圖片
                    $path = public_path('img/product/' . $productImg->picture);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                //刪除DB資料
                $productImg->delete();
            }
            foreach ($request->file('images') as $image) {
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('img/product', $fileName);

                // 關聯圖片與產品
                ProductImg::create([
                    'product_id' => $product->id,
                    'picture' => $fileName,
                ]);
            }
        }
        $product->update([
            'category_id' => $request->category,//種類
            'name' => $request->name,
            'brand' => $request->brand,
            'origin_place' => $request->origin_place,
            'stock' => $request->stock,
            'price' => $request->price,
            'text' => $request->text,
        ]);


        return redirect()->route('admins.products.show',$product);
    }


    public function destroy(Product $product)//待修改
    {

        //要把產品相關的訂單一起刪除才可以把產品刪除
         $productImgs=ProductImg::where('product_id','=',$product->id)->get();
        foreach ($productImgs as $productImg){
            if ($productImg) {
                //刪除public下的圖片
                $path = public_path('img/product/' . $productImg->picture);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            //刪除DB資料
            $productImg->delete();
        }

        Product::destroy($product->id);
        return redirect()->route('admins.products.index');
    }
}
