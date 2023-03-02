

@extends('layouts.master')
@section('title','上架商品')
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
                            <h1 class="fw-bolder mb-1 ">上架商品</h1>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                <button type="button" class="btn btn-danger btn-lg">上架</button>
                                <button type="button" class="btn  btn-lg">儲存</button>
                                <button type="button" class="btn btn-lg">刪除</button>
                            </div>

                                    <!-- Post title-->

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">商品品牌</label>
                                <!--回傳時會把name包裝成key，填入的內容包裝成value-->
                                <input name="name" id="name" type="text" class="form-control" placeholder=""><!--單行輸入框-->
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">商品名稱</label>
                                    <!--回傳時會把name包裝成key，填入的內容包裝成value-->
                                    <input name="name" id="name" type="text" class="form-control" placeholder="請輸入食譜名稱"><!--單行輸入框-->
                                </div>
                                <label for="exampleFormControlInput1" class="form-label">商品存貨</label>
                                <!--回傳時會把name包裝成key，填入的內容包裝成value-->
                                <input name="name" id="name" type="text" class="form-control" placeholder=""><!--單行輸入框-->
                                <label for="exampleFormControlInput1" class="form-label">商品產地</label>
                                <!--回傳時會把name包裝成key，填入的內容包裝成value-->
                                <input name="name" id="name" type="text" class="form-control" placeholder=""><!--單行輸入框-->


                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">商品封面</label>
                                            <input type="file" name="image" id="image" accept="image/*" class="form-control">
                                        </div>
                                        <label for="exampleFormControlTextarea1" class="form-label">商品類別</label>
                                        <div class="ms-3 me-3">
                                            <div class="row">

                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="1" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">穀物</label>
                                                </div>
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="2">
                                                    <label class="form-check-label" for="flexRadioDefault2">水果</label>
                                                </div>
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="3">
                                                    <label class="form-check-label" for="flexRadioDefault2">蔬菜
                                                    </label>
                                                </div><div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="3">
                                                    <label class="form-check-label" for="flexRadioDefault2">肉類
                                                    </label>
                                                </div><div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="3">
                                                    <label class="form-check-label" for="flexRadioDefault2">海鮮
                                                    </label>
                                                </div><div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="3">
                                                    <label class="form-check-label" for="flexRadioDefault2">奶類
                                                    </label>
                                                </div>
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="3">
                                                    <label class="form-check-label" for="flexRadioDefault2">調味
                                                    </label>
                                                </div>
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="3">
                                                    <label class="form-check-label" for="flexRadioDefault2">菇類
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            <label for="exampleFormControlInput1" class="form-label">商品規格</label>
                            <!--回傳時會把name包裝成key，填入的內容包裝成value-->
                            <input name="name" id="name" type="text" class="form-control" placeholder=""><!--單行輸入框-->
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">商品簡介</label>
                                <textarea name="introduce" id="introduce" class="form-control" rows="4" placeholder="請輸入商品簡介"></textarea><!--多行輸入框-->
                            </div>

                            </div>


@endsection
