@extends('product.layouts.master')
@section('title','EasyGo')
@section('content')
    @if($products->isNotEmpty())<!--搜尋到相關資料-->
    <!--內容-->
    <div class=" px-lg-5" id="nav-tabContent">
        <!--陣列內有幾筆資料就會重複執行幾次-->
        <div class="tab-pane fade show active " id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
            <section class="pt-4">
                {{-- 分割--}}
                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        @foreach($array as $array_item)
                            @if($array_item['status'] ==1)

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
                                            </td>
                                        </div>
                                    </div>
                                </form>

                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
        @else<!--無搜尋到相關資料-->
        <div class="p-lg-5  pt-lg-0 pt-5">
            <div class="fs-4 fw-bold pt-5">
                <h2>查無資料，請重新查詢.</h2>
            </div>
        </div>
    @endif
@endsection
