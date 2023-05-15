@extends('admins.layouts.master')

@section('page-title', '新增商品')

@section('page-content')
<div class="container-fluid px-4">
    <h1 class="mt-4">新增商品</h1>

    <!-- Main Content -->
    <form action="{{route('admins.products.store')}}" method="post"  enctype="multipart/form-data">
        @method('post')
        <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->
        @csrf
        <div class="pt-4">
            <div class=" row mb-3">
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label">名稱</label>
                    <input name="name" id="name" type="text" class="form-control">
                </div>
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label">品牌</label>
                    <input name="brand" id="brand" type="text" class="form-control">
                </div>
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label">產地</label>
                    <input name="origin_place" id="origin_place" type="text" class="form-control">
                </div>
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label">數量</label>
                    <input name="stock" id="stock" type="text" class="form-control">
                </div>
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label">價格</label>
                    <input name="price" id="price" type="text" class="form-control">
                </div>
                <div class="col-6">
                    <!--改為下拉式選單-->
                    <label for="exampleFormControlInput1" class="form-label">種類</label>
                    <select name="category" id="category" class="form-select form-select" aria-label=".form-select example">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">介紹</label>
            <textarea name="text" id="text" class="form-control" rows="10" placeholder="請輸入商品介紹"></textarea><!--多行輸入框-->
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary btn-sm" type="submit">儲存</button>
        </div>
    </form>
</div>
@endsection
