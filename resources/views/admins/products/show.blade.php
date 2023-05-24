@extends('admins.layouts.master')

@section('page-title', '商品資訊')

@section('content')
<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5 ">
        <div class="row g-3">
            <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-success btn-sm" href="{{route('admins.products.edit',$product)}}">編輯</a>
                            <a class="btn btn-dark btn-sm" href="{{route('admins.products.index')}}">返回</a>
                        </div><br>
                        <!-- Preview image figure-->
                        <div class="mb-3">
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
                        </div>
{{--                       <figure class="mb-4"><img class="img-fluid rounded" src="https://www.pxmart.com.tw/Api/Images/133162494023417960.jfif" alt="..." /></figure>--}}


                                <!-- Post title-->
                        <div class="row g-3">

                                <div class="col-6">
                                    <fieldset disabled><!-- 禁用-->
                                    <label for="exampleFormControlTextarea1" class="form-label">食材名稱</label>
                                    <input name="name" id="name" type="text" class="form-control" value="{{$product->name}}">
                                    </fieldset>
                                </div>
                                <div class="col-6">
                                    <fieldset disabled>
                                    <label for="exampleFormControlTextarea1" class="form-label">價格</label>
                                    <input name="name" id="name" type="text" class="form-control" value="{{$product->price}}">
                                    </fieldset>
                                </div>
                                <div class="col-6">
                                    <fieldset disabled>
                                    <label for="exampleFormControlTextarea1" class="form-label">品牌</label>
                                    <input name="brand" id="brand" type="text" class="form-control" value="{{$product->brand}}">
                                    </fieldset>
                                </div>
                                <div class="col-6">
                                    <fieldset disabled>
                                    <label for="exampleFormControlTextarea1" class="form-label">產地</label>
                                    <input name="origin_place" id="origin_place" type="text" class="form-control" value="{{$product->origin_place}}">
                                    </fieldset>
                                </div>
                                <div class="col-6">
                                    <fieldset disabled>
                                    <label for="exampleFormControlTextarea1" class="form-label">數量</label>
                                    <input name="stock" id="stock" type="text" class="form-control" value="{{$product->stock}}">
                                    </fieldset>
                                </div>
                            <div class="col-6">
                                <fieldset disabled>
                                    <label for="exampleFormControlInput1" class="form-label">種類</label>
                                    <select name="category" id="category" class="form-select form-select" aria-label=".form-select example">
                                        @foreach($categories as $category)
                                            @if ($product->category_id==$category->id)
                                            <option value="{{$category->id}}">{{$category->name}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <fieldset disabled>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">商品詳情</label>
                            <textarea name="reason" id="reason" class="form-control" rows="10" placeholder="">{{$product->text}}</textarea><!--多行輸入框-->
                        </div>
                        </fieldset>
                    </header>
                </article>
        </div>
    </div>
</section>


@endsection
