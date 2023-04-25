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
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($products as $product)
                    @if ($product->category_id >=22)
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
                                                ${{$product->price}}
                                                <a href="{{route('product.show',$product->id)}}" class="stretched-link"></a>
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

@endsection
