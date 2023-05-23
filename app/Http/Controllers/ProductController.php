<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\RecipeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function detail(Product $products)
//    {
//
//        $products=Product::where('id','=',$products->id)->get();
//
//        $data=[
//            'products'=>$products,
//        ];
//        return view('product.detail',$data);
//
//    }
    public function index()
    {
        $count=0;
        $array=array();
        $products=Product::all();

        foreach ($products as $product){
            $product_imgs=ProductImg::where('product_id',$product->id)->get();
            foreach ($product_imgs as $product_img){
                $array=Arr::add($array,$count,[
                    'id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'status'=>$product->status,
                    'img'=>$product_img->picture,
                ]);
                $count++;
            }
        }
        $data=[
            'array'=>$array,
        ];
        return view('product.product',$data);

    }
    public function add_product()
    {
        return view('product.add_product');
    }
    public function cereals(Request $request)
    {
        $count=0;
        $array=array();
        $products=Product::all();

        foreach ($products as $product){
            $product_imgs=ProductImg::where('product_id',$product->id)->get();
            foreach ($product_imgs as $product_img){
                $array=Arr::add($array,$count,[
                    'id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'status'=>$product->status,
                    'category_id'=>$product->category_id,
                    'img'=>$product_img->picture,
                ]);
                $count++;
            }
        }

        $id = $request->input('id');
//        $products=Product::orderBy('id','DESC')->get();

        $products_imgs=ProductImg::where('product_id','=',$id)->get();

        $data=[
            'products'=>$products,
            'products_img'=>$products_imgs,
            'array'=>$array,
        ];
        return view('product.cereals', $data);
    }

    public function mushrooms(Request $request)
    {
        $count=0;
        $array=array();
        $products=Product::all();

        foreach ($products as $product){
            $product_imgs=ProductImg::where('product_id',$product->id)->get();
            foreach ($product_imgs as $product_img){
                $array=Arr::add($array,$count,[
                    'id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'status'=>$product->status,
                    'category_id'=>$product->category_id,
                    'img'=>$product_img->picture,
                ]);
                $count++;
            }
        }
        $id = $request->input('id');
//        $products=Product::orderBy('id','DESC')->get();

        $products_imgs=ProductImg::where('product_id','=',$id)->get();

        $data=[
            'products'=>$products,
            'products_img'=>$products_imgs,
            'array'=>$array,
        ];
        return view('product.mushrooms', $data);
//        return view('product.mushrooms');
    }

    public function fruit(Request $request)
    {
        $count=0;
        $array=array();
        $products=Product::all();

        foreach ($products as $product){
            $product_imgs=ProductImg::where('product_id',$product->id)->get();
            foreach ($product_imgs as $product_img){
                $array=Arr::add($array,$count,[
                    'id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'status'=>$product->status,
                    'category_id'=>$product->category_id,
                    'img'=>$product_img->picture,
                ]);
                $count++;
            }
        }
        $id = $request->input('id');
//        $products=Product::orderBy('id','DESC')->get();

        $products_imgs=ProductImg::where('product_id','=',$id)->get();

        $data=[
            'products'=>$products,
            'products_img'=>$products_imgs,
            'array'=>$array,
        ];
        return view('product.fruit', $data);
//        return view('product.fruit');
    }

    public function vegetable(Request $request)
    {
        $count=0;
        $array=array();
        $products=Product::all();

        foreach ($products as $product){
            $product_imgs=ProductImg::where('product_id',$product->id)->get();
            foreach ($product_imgs as $product_img){
                $array=Arr::add($array,$count,[
                    'id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'status'=>$product->status,
                    'category_id'=>$product->category_id,
                    'img'=>$product_img->picture,
                ]);
                $count++;
            }
        }
        $id = $request->input('id');
//        $products=Product::orderBy('id','DESC')->get();

        $products_imgs=ProductImg::where('product_id','=',$id)->get();

        $data=[
            'products'=>$products,
            'products_img'=>$products_imgs,
            'array'=>$array,
        ];
        return view('product.vegetable', $data);
//        return view('product.vegetable');
    }

    public function meat(Request $request)
    {
        $count=0;
        $array=array();
        $products=Product::all();

        foreach ($products as $product){
            $product_imgs=ProductImg::where('product_id',$product->id)->get();
            foreach ($product_imgs as $product_img){
                $array=Arr::add($array,$count,[
                    'id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'status'=>$product->status,
                    'category_id'=>$product->category_id,
                    'img'=>$product_img->picture,
                ]);
                $count++;
            }
        }
        $id = $request->input('id');
//        $products=Product::orderBy('id','DESC')->get();

        $products_imgs=ProductImg::where('product_id','=',$id)->get();
        $data=[
            'products'=>$products,
            'products_img'=>$products_imgs,
            'array'=>$array,
        ];
        return view('product.meat', $data);
//        return view('product.meat');
    }

    public function fresh(Request $request)
    {
        $count=0;
        $array=array();
        $products=Product::all();

        foreach ($products as $product){
            $product_imgs=ProductImg::where('product_id',$product->id)->get();
            foreach ($product_imgs as $product_img){
                $array=Arr::add($array,$count,[
                    'id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'status'=>$product->status,
                    'category_id'=>$product->category_id,
                    'img'=>$product_img->picture,
                ]);
                $count++;
            }
        }
        $id = $request->input('id');
//        $products=Product::orderBy('id','DESC')->get();

        $products_imgs=ProductImg::where('product_id','=',$id)->get();

        $data=[
            'products'=>$products,
            'products_img'=>$products_imgs,
            'array'=>$array,
        ];
        return view('product.fresh', $data);
//        return view('product.fresh');
    }

    public function milk(Request $request)
    {
        $count=0;
        $array=array();
        $products=Product::all();

        foreach ($products as $product){
            $product_imgs=ProductImg::where('product_id',$product->id)->get();
            foreach ($product_imgs as $product_img){
                $array=Arr::add($array,$count,[
                    'id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'status'=>$product->status,
                    'category_id'=>$product->category_id,
                    'img'=>$product_img->picture,
                ]);
                $count++;
            }
        }
        $id = $request->input('id');
//        $products=Product::orderBy('id','DESC')->get();

        $products_imgs=ProductImg::where('product_id','=',$id)->get();

        $data=[
            'products'=>$products,
            'products_img'=>$products_imgs,
            'array'=>$array,
        ];
        return view('product.milk', $data);
//        return view('product.milk');
    }

    public function seasoning(Request $request)
    {
        $count=0;
        $array=array();
        $products=Product::all();

        foreach ($products as $product){
            $product_imgs=ProductImg::where('product_id',$product->id)->get();
            foreach ($product_imgs as $product_img){
                $array=Arr::add($array,$count,[
                    'id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'status'=>$product->status,
                    'category_id'=>$product->category_id,
                    'img'=>$product_img->picture,
                ]);
                $count++;
            }
        }
        $id = $request->input('id');
//        $products=Product::orderBy('id','DESC')->get();

        $products_imgs=ProductImg::where('product_id','=',$id)->get();

        $data=[
            'products'=>$products,
            'products_img'=>$products_imgs,
            'array'=>$array,
        ];
        return view('product.seasoning', $data);
    }
    //搜尋食材
    public function keyword(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::query()->where('name', 'LIKE', "%{$keyword}%")->get();
        //$categories=RecipeCategory::orderBy('id','DESC')->get();//sidenav顯示類別
        $data=['products'=>$products];//index的sib需要類別的資料，記得給分類的資料
        return view('product.keyword',$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product(Request $request)
    {
        $id = $request->input('id');
        $products=Product::orderBy('id','DESC')->get();
        $product_imgs=ProductImg::where('product_id','=',$id)->get();

        $data=[
            'products'=>$products,
            'product_img'=>$product_imgs,

        ];
        return view('product.product', $data);

    }
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
    public function store($id)
    {
        $carts=DB::table('items')->where('product_id','=',$id)->count();
        if($carts==0){
            DB::table('items')->insert
            (
                [
                    'customer_id'=>auth()->user()->id,
                    'product_id'=>$id,
                    'quantity'=>1
                ]
            );

        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $productImgs=ProductImg::where('product_id','=',$product->id)->get();
        $data=[
            'product'=>$product,
            'productImgs'=>$productImgs,
        ];
        return view('product.show', $data);
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
