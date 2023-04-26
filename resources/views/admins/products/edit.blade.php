@extends('admins.layouts.master')
@section('page-title','食材')
@section('page-content')

<form action="{{route('admins.products.update',$product)}}"  method="post"  enctype="multipart/form-data">
    @method('patch')
    @csrf
<div class="container-fluid px-4">
    <!-- Main Content -->
    <figure class="mb-4"><img class="img-fluid rounded" src="https://www.pxmart.com.tw/Api/Images/133162494023417960.jfif" alt="..." /></figure>

    <div class="row align-items-center">
        <div class="col-xs-12 col-md-9">
            <!-- Post title-->
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label">食材名稱:</label>
                    <input name="name" id="name" type="text" class="form-control" value="{{$product->name}}">
                </div>
                <div class="col-6">
                    <label for="exampleFormControlTextarea1" class="form-label">價格:</label>
                    <input name="price" id="price" type="text" class="form-control" value="{{$product->price}}">
                </div>
            </fieldset>
        </div>
    </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">商品詳情:</label>
            <textarea name="text" id="text" class="form-control" rows="10" placeholder="">{{$product->text}}</textarea><!--多行輸入框-->
        </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <button class="btn btn-primary btn-sm" type="submit">儲存</button>
{{--        <button class="btn btn-danger btn-sm" type="submit">取消</button>--}}
        <a class="btn btn-danger btn-sm" href="{{route('admins.products.show',$product)}}">取消</a>
    </div>
    </fieldset>
</div>
</form>
@endsection
