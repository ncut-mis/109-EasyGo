@extends('product.layouts.master')
@section('title','EasyGo')
@section('content')
    @include('product.share.header')
    <!--標籤列-->
    <div class="row justify-content-center">
        <div style="width: 83%">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-new-tab" data-bs-toggle="tab" data-bs-target="#nav-new"
                            type="button" role="tab" aria-controls="nav-new" aria-selected="true">賣場
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <!--內容--->
{{--    <div class=" px-lg-5" id="nav-tabContent">--}}
{{--        <!--陣列內有幾筆資料就會重複執行幾次-->--}}
{{--        <div class="tab-pane fade show active " id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">--}}
{{--            <section class="pt-5">--}}
{{--                <div class="container px-4 px-lg-5 mt-5">--}}
{{--                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">--}}
{{--                    <!-- Page Features-->--}}
{{--                        @foreach($products as $product)--}}
{{--                            <form action="{{route('members.cart_items.store')}}?pid={{$product->id}}" method="POST">--}}
{{--                                @csrf--}}
{{--                                @method('POST')--}}
{{--                            <div class="col-lg-6 col-xxl-4 mb-5 pt-5">--}}
{{--                                <div class="card bg-light border-0 h-100 ">--}}
{{--                                    <!--圖片-->--}}
{{--                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">--}}
{{--                                        <div class="carousel-inner">--}}
{{--                                            <div class="carousel-item active">--}}
{{--                                                <img class="card-img-top" src="{{$product->product_imgs}}" alt="..." width="232px" height="232px" value="{{$product->product_imgs}}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <!-- Product details-->--}}
{{--                                    <div class="card-body text-center p-lg-5  pt-lg-0 pt-5">--}}
{{--                                         <div class="text-center">--}}
{{--                                             <!-- Product name-->--}}
{{--                                             <h5 class="fw-bolder" value="{{$product->name}}">{{$product->name}}</h5>--}}
{{--                                             <!-- Product price-->--}}
{{--                                             ${{$product->price}}--}}
{{--                                             <a href="{{route('product.show',$product->id)}}" class="stretched-link"></a>--}}
{{--                                         </div>--}}
{{--                                     </div>--}}
{{--                                    <!-- Product actions-->--}}
{{--                                    <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">--}}
{{--                                        <div class="text-center">--}}
{{--                                            <input type="number" name="quantity" class="form-control mb-3" value="1">--}}
{{--                                            <button class="btn btn-outline-dark mt-auto">加入購物車</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </section>--}}
{{--            </div>--}}
{{--        </div>--}}
            <!---->
        <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($products as $product)
                    <form action="{{route('members.cart_items.store')}}?pid={{$product->id}}" method="POST">
                        @csrf
                        @method('POST')
                        <!--典籍進入詳細葉面-->
                        <div class="pt-5">
                        <div class="card ht border-0 h-100 ">
                        <td>   <img class="card-img-top" src="{{$product->product_imgs}}" alt="..." width="232px" height="232px" value="{{$product->product_imgs}}">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder" value="{{$product->name}}">{{$product->name}}</h5>
                                    <!-- Product price-->
                                    <h5>價格:{{$product->price}}</h5>
                                    <a href="{{route('product.show',$product->id)}}" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                        </div>
{{--                            <!-- Product actions-->--}}
{{--                            <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">--}}
{{--                                <div class="text-center">--}}
{{--                                    <input type="number" name="quantity" class="form-control mb-3" value="1">--}}
{{--                                    <button class="btn btn-outline-dark mt-auto">加入購物車</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </td>

                    </form>
                @endforeach
            </div>
        </div>
    </section>
@endsection



{{--    <div class=" px-lg-5" id="nav-tabContent">--}}
{{--        <!--陣列內有幾筆資料就會重複執行幾次-->--}}
{{--        <div class="tab-pane fade show active " id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">--}}
{{--            <section class="pt-4">--}}
{{--                <div class="container px-lg-5">--}}
{{--                    <!-- Page Features-->--}}
{{--                    <form action="{{route('members.cart_items.store')}}" method="POST" role="form">--}}
{{--                        @method('POST')--}}
{{--                        @csrf--}}
{{--                    <div class="row gx-lg-5  px-lg-5">--}}
{{--                        @foreach($products as $product)--}}
{{--                            <div class="col-lg-6 col-xxl-4 mb-5 pt-5">--}}
{{--                                <div class="card bg-light border-0 h-100 ">--}}
{{--                                    <!--圖片-->--}}
{{--                                    <img src="{{asset('images/'.$product->product_imgs)}}">--}}
{{--                                    <div class="card-body text-center p-lg-5  pt-lg-0 pt-5">--}}
{{--                                        <h2 class="fs-4 fw-bold pt-5">{{$product->name}}</h2>--}}
{{--                                        <p class="mb-0">{{$product->text}}</p>--}}
{{--                                        <div style="text-align:center">--}}
{{--                                            <button class="btn btn-outline-dark mt-auto" href="{{ route('members.cart_items.store') }}">加入購物車</button>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        @endforeach--}}

{{--                    </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </section>--}}
{{--        </div>--}}
{{--@endsection--}}
