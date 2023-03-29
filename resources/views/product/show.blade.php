@extends('layouts.master')
@section('title','菲力牛柳')
@section('content')
<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5 ">
        <div class="row gx-5">
            <div >
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="https://www.pxmart.com.tw/Api/Images/133162494023417960.jfif" alt="..." /></figure>

                        <div class="row align-items-center">
                            <div class="col-xs-12 col-md-9">
                                <!-- Post title-->
                                <h1 class="fw-bolder mb-1 ">菲力牛柳</h1>
                                <h3 class="fw-bolder mb-1">$100</h3>

                            </div>
                            <button type="button" id="btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#refund" data-bs-whatever="@123" >加入購物車</button><br><br><br><br>
                            <div class="modal fade" id="refund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            </div>

                            <div class="col-xs-12 col-md-9">
                                <h5 class="fw-bolder mb-1">商品詳情</h5>
                                <p>我是介紹我是介紹我是介紹我是介紹我是介紹我是介紹我是介紹我是介紹我是介紹我是介紹</p>

                            </div>
                        </div>
                    </header>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection
