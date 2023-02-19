@extends('product.layouts.master')
@section('title','EasyGo')
@section('content')


    <!--標籤列-->
    <div class="row justify-content-center">
        <div style="width: 83%">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-new-tab" data-bs-toggle="tab" data-bs-target="#nav-new"
                            type="button" role="tab" aria-controls="nav-new" aria-selected="true">菇類
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <!--內容--->
    <section class="pt-4">
        <div class="container px-lg-5">
            <!-- Page Features-->
            <div class="row gx-lg-5">
                <div class="col-lg-6 col-xxl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <!--圖片-->
                        <img src ="#">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">

                            <h2 class="fs-4 fw-bold">香菇</h2>

                            <a href="{{route('product.product')}}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>










    {{--    <!--內容-->--}}
{{--    <div class="tab-content" id="nav-tabContent">--}}
{{--        <!--最新--><!--陣列內有幾筆資料就會重複執行幾次-->--}}
{{--        <div class="tab-pane fade show active" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">--}}
{{--            <section class="pt-4">--}}
{{--                <div class="container px-lg-5">--}}
{{--                    <!-- Page Features-->--}}
{{--                    <div class="row gx-lg-5">--}}
{{--                                                    @foreach( as )--}}
{{--                                                        <div class="col-lg-6 col-xxl-4 mb-5">--}}
{{--                                                            <div class="card bg-light border-0 h-100">--}}
{{--                                                                <!--圖片-->--}}
{{--                                                                <img src="{{asset('images/'.$activity->img)}}">--}}
{{--                                                                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">--}}
{{--                                                                    <h2 class="fs-4 fw-bold">{{$activity->name}}</h2>--}}
{{--                                                                    <p class="mb-0">{{$activity->introduce}}</p>--}}
{{--                                                                    <a href="{{route('activity.activity',$activity->id)}}" class="stretched-link"></a>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}
{{--        </div>--}}

{{--    </div>--}}

@endsection
