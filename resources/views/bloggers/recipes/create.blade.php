

@extends('layouts.master')
@section('title','食譜名稱')
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
                            <h1 class="fw-bolder mb-1 ">寫食譜</h1>
{{--                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">--}}

{{--                                <button type="button" class="btn btn-danger btn-lg">發布</button>--}}
{{--                                <button type="button" class="btn  btn-lg">儲存</button>--}}
{{--                                <button type="button" class="btn btn-lg">刪除</button>--}}
{{--                            </div>--}}

                                    <!-- Post title-->
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">食譜名稱</label>
                                            <!--回傳時會把name包裝成key，填入的內容包裝成value-->
                                            <input name="name" id="name" type="text" class="form-control" placeholder="請輸入食譜名稱"><!--單行輸入框-->
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">食譜封面</label>
                                            <input type="file" name="image" id="image" accept="image/*" class="form-control">
                                        </div>
                                        <label for="exampleFormControlTextarea1" class="form-label">食譜類別</label>
                                        <div class="ms-3 me-3">
                                            <div class="row">

                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="1" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">中式</label>
                                                </div>
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="2">
                                                    <label class="form-check-label" for="flexRadioDefault2">西式</label>
                                                </div>
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" name="category" id="category" value="3">
                                                    <label class="form-check-label" for="flexRadioDefault2">日式
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">食譜簡介</label>
                                <textarea name="introduce" id="introduce" class="form-control" rows="4" placeholder="請輸入食譜簡介"></textarea><!--多行輸入框-->
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                <div class="col-xs-12 col-md-3 d-md-flex">
                                    <a href="{{route('bloggers.recipes.create2')}}" class="btn btn-secondary fs justify-content-md-end-5 position-end " >下一步</a>
                                </div>

                            </div>
{{--                            <h1 class="fw-bolder mb-1 ">食材   <button type="button" class="btn  btn-lg">+</button></h1></h1>--}}
{{--                            <table class="table">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">食材名稱</th>--}}
{{--                                    <th scope="col">食材另購買處</th>--}}
{{--                                    <th scope="col">數量</th>--}}

{{--                                </tr>--}}
{{--                                </thead>--}}

{{--                                <td>--}}
{{--                                    <input type="text" class="name" value="">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <input type="text" class="name" value="">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <input type="text" class="name" value="">--}}
{{--                                </td>--}}



{{--                            </table>--}}


{{--                            <h1 class="fw-bolder mb-1 ">步驟1 <button type="button" class="btn btn-lg">+</button></h1>--}}

{{--                            <div class="mb-3">--}}
{{--                                <input type="file" name="image" id="image" accept="image/*" class="form-control">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="exampleFormControlTextarea1" class="form-label"></label>--}}
{{--                                    <textarea name="introduce" id="introduce" class="form-control" rows="4" placeholder=""></textarea><!--多行輸入框-->--}}
{{--                                </div>--}}

{{--                                <h1 class="fw-bolder mb-1 ">步驟2</h1>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <input type="file" name="image" id="image" accept="image/*" class="form-control">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label for="exampleFormControlTextarea1" class="form-label"></label>--}}
{{--                                        <textarea name="introduce" id="introduce" class="form-control" rows="4" placeholder=""></textarea><!--多行輸入框-->--}}
{{--                                    </div>--}}

{{--                                    <h1 class="fw-bolder mb-1 ">步驟3</h1>--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <input type="file" name="image" id="image" accept="image/*" class="form-control">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label for="exampleFormControlTextarea1" class="form-label"></label>--}}
{{--                                            <textarea name="introduce" id="introduce" class="form-control" rows="4" placeholder=""></textarea><!--多行輸入框-->--}}
{{--                                        </div>--}}
{{--                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">--}}
{{--                                            <button class="btn btn-primary btn-sm" type="submit">儲存</button>--}}
{{--                                        </div>--}}




{{--                                        <div class="input_fields_wrap">--}}
{{--                                            <button class="add_field_button">Add More Fields</button>--}}
{{--                                            <div><input type="text" name="mytext[]"></div>--}}
{{--                                        </div>--}}

{{--                            </div>--}}


@endsection
