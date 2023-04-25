@extends('layouts.master')
@section('title','詳細資訊')
@section('content')
<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5 ">
        <div class="row gx-5">
            <div >
                <!-- Post content-->
                <article>
                    <!-- Post header-->
{{--                   <header class="mb-4">--}}
{{--                    </header>--}}
                        <!-- Preview image figure-->
                    <div class="container px-4 px-lg-5 mt-5">


                        <form action="{{route('members.cart_items.store')}}?pid={{$product->id}}" method="POST">
                        <figure class="mb-4">
                            <img class="card-img-top" src="{{$product->product_imgs}}" alt="..." width="232px" height="232px" value="{{$product->product_imgs}}">
                        </figure>

                        <div class="row align-items-center">
                            <div class="col-xs-12 col-md-9">
                                <!-- Post title-->
                                <h1 class="fw-bolder">{{$product->name}}</h1>
                                <h3 class="fw-bolder">${{$product->price}}</h3>

                            </div>

                            <button type="button" id="btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#refund" data-bs-whatever="@123" >加入購物車</button><br><br><br><br>
                            <div class="modal fade" id="refund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
