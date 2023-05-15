@extends('admins.layouts.master')
@section('page-title','食材')
@section('page-content')

<form action="{{route('admins.products.update',$product)}}"  method="post"  enctype="multipart/form-data">
    @method('patch')
    @csrf
<div class="container-fluid px-4">
    <!-- Main Content -->
    <figure class="mb-4"><img class="img-fluid rounded" src="https://www.pxmart.com.tw/Api/Images/133162494023417960.jfif" alt="..." /></figure>

    <div class="row g-3">

        <!-- Post title-->
        <div class="col-6">
            <label for="exampleFormControlTextarea1" class="form-label">食材名稱:</label>
            <input name="name" id="name" type="text" class="form-control" value="{{$product->name}}">
        </div>
        <div class="col-6">
            <label for="exampleFormControlTextarea1" class="form-label">價格:</label>
            <input name="price" id="price" type="text" class="form-control" value="{{$product->price}}">
        </div>
        <div class="col-6">
            <label for="exampleFormControlTextarea1" class="form-label">品牌</label>
            <input name="brand" id="brand" type="text" class="form-control" value="{{$product->brand}}">
        </div>
        <div class="col-6">
            <label for="exampleFormControlTextarea1" class="form-label">產地</label>
            <input name="origin_place" id="origin_place" type="text" class="form-control" value="{{$product->origin_place}}">
        </div>
        <div class="col-6">
            <label for="exampleFormControlTextarea1" class="form-label">數量</label>
            <input name="stock" id="stock" type="text" class="form-control" value="{{$product->stock}}">
        </div>
        <div class="col-6">
            <label for="exampleFormControlInput1" class="form-label">種類</label>
            <select name="category" id="category" class="form-select form-select" aria-label=".form-select example">
                @foreach($categories as $category)
                    @if ($product->category_id==$category->id)
                      {{$category->id}} = {{$product->category_id}}
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @endif

                        <option value="{{$category->id}}">{{$category->name}} </option>
                @endforeach
            </select>
        </div>
    </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">商品詳情:</label>
            <textarea name="text" id="text" class="form-control" rows="10" placeholder="">{{$product->text}}</textarea><!--多行輸入框-->
        </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <button class="btn btn-primary btn-sm" type="submit">儲存</button>
        <a class="btn btn-danger btn-sm" href="{{route('admins.products.show',$product)}}">取消</a>
    </div>
    </fieldset>
</div>
</form>
@endsection
