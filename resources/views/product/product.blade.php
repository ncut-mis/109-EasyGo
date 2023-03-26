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
    <div class=" px-lg-5" id="nav-tabContent">
        <!--陣列內有幾筆資料就會重複執行幾次-->
        <div class="tab-pane fade show active " id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
            <section class="pt-4">
                <div class="container px-lg-5">
                    <!-- Page Features-->
{{--                    <form action="{{route('members.cart_items.store')}}" method="POST" role="form">--}}
                        @method('POST')
                        @csrf
                    <div class="row gx-lg-5  px-lg-5">
                        @foreach($products as $product)
                            <div class="col-lg-6 col-xxl-4 mb-5 pt-5">
                                <div class="card bg-light border-0 h-100 ">
                                    <!--圖片-->
                                    <img src="{{asset('images/'.$product->product_imgs)}}">
                                    <div class="card-body text-center p-lg-5  pt-lg-0 pt-5">
                                        <h2 class="fs-4 fw-bold pt-5">{{$product->name}}</h2>
                                        <p class="mb-0">{{$product->text}}</p>
                                        <div style="text-align:center">
                                            <br><button type="submit" class="btn btn-outline-success" name="products_id" value="{{$product->id}}">加入購物車</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                    </form>
                </div>
            </section>
        </div>
@endsection
