@extends('product.layouts.master')
@section('title','EasyGo')
@section('content')


    <!--標籤列-->
    <div class="row justify-content-center">
        <div style="width: 83%">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-new-tab" data-bs-toggle="tab" data-bs-target="#nav-new"
                            type="button" role="tab" aria-controls="nav-new" aria-selected="true">生鮮
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <!--內容--->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($array as $array_item)
                    @if ($array_item['category_id'] >=13 && $array_item['category_id'] <=15)
                        <form action="{{route('members.cart_items.store')}}?pid={{$array_item['id']}}" method="POST">
                            @csrf
                            @method('POST')
                            <!--典籍進入詳細葉面-->
                            <div class="pt-5">
                                <div class="card ht border-0 h-100 ">

                                    <td>   <img class="card-img-top" src="{{asset('img/product/'.$array_item['img'])}}" alt="..." width="232px" height="232px" value="{{$array_item['id']}}">
                                        <!-- Product details-->
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <!-- Product name-->
                                                <h5 class="fw-bolder" value="{{$array_item['name']}}">{{$array_item['name']}}</h5>
                                                <!-- Product price-->
                                                <h5>價格:{{$array_item['price']}}</h5>
                                                <a href="{{route('product.show',$array_item['id'])}}" class="stretched-link"></a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <input type="number" name="quantity" class="form-control mb-3" value="1">
                                    <button class="btn btn-outline-dark mt-auto">加入購物車</button>
                                </div>
                            </div>
                            </td>

                        </form>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

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
