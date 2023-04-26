@extends('admins.layouts.master')
@section('page-title','食材')
@section('page-content')
<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5 ">
        <div class="row gx-5">
            <div >
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-success btn-sm" href="{{route('admins.products.edit',$product)}}">編輯</a>
                        </div>
                        <br>

                        <!-- Preview image figure-->
                       <figure class="mb-4"><img class="img-fluid rounded" src="https://www.pxmart.com.tw/Api/Images/133162494023417960.jfif" alt="..." /></figure>

                        <div class="row align-items-center">
                            <div class="col-xs-12 col-md-9">
                                <!-- Post title-->
                                <fieldset disabled>{{--禁用--}}
                                <div class="col-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">食材名稱:</label>
                                    <input name="name" id="name" type="text" class="form-control" value="{{$product->name}}">
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">價格:</label>
                                    <input name="name" id="name" type="text" class="form-control" value="{{$product->price}}">
                                </div>
                                </fieldset>
                            </div>
{{--                                <h1 class="fw-bolder mb-1 ">食材名稱:{{$product->name}}</h1>--}}
{{--                                <h3 class="fw-bolder mb-1">$100</h3>--}}
                        </div>
                        <fieldset disabled>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">商品詳情:</label>
                            <textarea name="reason" id="reason" class="form-control" rows="10" placeholder="">{{$product->text}}</textarea><!--多行輸入框-->
                        </div>
                        </fieldset>
{{--                            <div class="col-xs-12 col-md-9">--}}
{{--                                <h5 class="fw-bolder mb-1"></h5>--}}
{{--                                <p>我是介紹我是介紹我是介紹我是介紹我是介紹我是介紹我是介紹我是介紹我是介紹我是介紹</p>--}}
{{--                            </div>--}}
                    </header>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection
