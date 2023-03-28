@extends('product.layouts.master')
@section('title','EasyGo')
@section('content')
        <style>
            .br1{
                line-height:30px
            }
        </style>
        <br>
        <header class="masthead">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="page-heading">
                            <br><center><h1><b>商品資訊</b></h1></center>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <center><hr width="80%"></center>
        <section class="py-5 bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <form action="/cart/store" method="post">
                            @method('POST')
                            @csrf

                            @foreach($products as $product)
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="#">
                                            <img class="img-fluid rounded mb-3 mb-md-0" src="{{url($products->picture)}}" style="width:300px;height:300px" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <br><h3>{{$products->name}}&emsp;<font color="#FF0000">NT.{{$products->price}}</font></h3>
                                        <br>
                                        <div style="line-height:35px;font-size:17px;">
                                            <p></p>
                                        </div>
                                        <br>
                                        數量：<input style="width:80px;" type="number" name="quantity" min="1" max="99" value="1">
                                    </div>
                                </div>
                            @endforeach
                            <div style="text-align:center">
                                <br><button type="submit" class="btn btn-outline-success" name="products_id" value="">加入購物車</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="br1">
                <br>
            </div>
        </section>
    @endsection
