@extends('product.layouts.master')
@section('title','EasyGo')
@section('content')


    <!--標籤列-->
    <div class="row justify-content-center">
        <div style="width: 83%">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-new-tab" data-bs-toggle="tab" data-bs-target="#nav-new"
                            type="button" role="tab" aria-controls="nav-new" aria-selected="true">穀物
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <!--內容--->

    </div>

    <section class="pt-4">
        <div class="container px-lg-5">
            <!-- Page Features-->
            <div class="row gx-lg-5">
                <div class="col-lg-6 col-xxl-4 mb-5">
                    <!--全聯--->
                    <div class="cookbook img-item">
                        <div class="card bg-light border-0 h-100">
                            <img src="https://www.pxmart.com.tw/Api/Images/133162494023417960.jfif">
                        </div>
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <div class="info"><h2>菲力牛柳 </h2>
                                <div class="name">價格:</div>
                                <div class="unit">
                                    <span>100</span>
                                    <span>分鐘</span>
                                </div>
                                <div class="name">份量:</div>
                                <div class="unit">
                                    <span>5</span>
                                    <span>克</span>
                                </div>
                                <a href="{{route('product.show')}}" class="stretched-link"> </a>
                            </div>
                        </div>
                        <!--尾全聯--->


{{--                    <div class="card bg-light border-0 h-100">--}}
{{--                        <!--圖片-->--}}
{{--                        <img src ="#">--}}
{{--                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">--}}

{{--                            <h2 class="fs-4 fw-bold">玉米</h2>--}}

{{--                            <a href="{{route('product.product')}}" class="stretched-link"></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>

@endsection
