@extends('product.layouts.master')
@section('title','詳細資訊')
@section('content')
    <!-- Page Content-->
    <section class="py-5">
        <div class="container px-5 my-5 ">
            <div class="row gx-5">
                <div>
                    <!-- Post content-->
                    <article>
                        <div class="container px-4 px-lg-5 mt-5">

                            <form action="{{route('members.cart_items.store')}}?pid={{$product->id}}" method="POST">
                                @csrf
                                @method('POST')

                                <!--輪播圖片-->
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($productImgs as $key=> $productImg)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{asset('img/product/'.$productImg->picture)}}" width="1250" height="850">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-xs-12 col-md-9">
                                        <!-- Post title-->
                                        <h1 class="fw-bolder">{{$product->name}}</h1>
                                        <h3 class="fw-bolder">${{$product->price}}</h3>

                                    </div>
                                    <!-- Product actions-->
                                    <!--原加入購物車位置-->
{{--                                    <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">--}}
{{--                                        <div class="text-center">--}}
{{--                                            <input style="width:100px;" type="number" name="quantity" min="1" max="99" value="1">--}}
{{--                                            <button class="btn btn-outline-dark mt-auto">加入購物車</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <!--靠左加入購物車位置-->
                                    <div class="card-footer pl-2 pt-0 border-top-0 bg-transparent">
                                        <div>
                                            <input style="width:100px;" type="number" name="quantity" min="1" max="99" value="1">
                                            <button class="btn btn-outline-dark mt-auto">加入購物車</button>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-9">
                                        <h5 class="fw-bolder mb-1">商品詳情</h5>
                                        <p>{{$product->text}}</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
