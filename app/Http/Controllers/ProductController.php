<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('product.product');

    }
    public function add_product()
    {
        return view('product.add_product');
    }
    public function cereals()
    {
        return view('product.cereals');
    }

    public function mushrooms()
    {
        return view('product.mushrooms');
    }

    public function fruit()
    {
        return view('product.fruit');
    }

    public function vegetable()
    {
        return view('product.vegetable');
    }

    public function meat()
    {
        return view('product.meat');
    }

    public function fresh()
    {
        return view('product.fresh');
    }

    public function milk()
    {
        return view('product.milk');
    }

    public function seasoning()
    {
        return view('product.seasoning');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        $products=Product::orderBy('id','DESC')->get();


        $data=[
            'products'=>$products

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
    public function show()
    {
        return view('product.show');
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
