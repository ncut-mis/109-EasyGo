@extends('admins.layouts.master')
@section('page-title','食材')
@section('content')

<form action="{{route('admins.products.update',$product)}}"  method="post"  enctype="multipart/form-data">
    @method('patch')
    @csrf
<div class="container-fluid px-4">
    <!-- Main Content -->
    <div class="row g-3">
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
        <!--新增圖片-->
        <div>
            <label for="images" class="form-label">食材圖片</label>
            <input type="file" name="images[]" multiple>
        </div>
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
                        @if ($category->category_id === null)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @foreach ($categories as $child)
                                @if ($child->category_id === $category->id)
                                    <option value="{{ $child->id }}">- {{ $child->name }}</option>
                                @endif
                            @endforeach
                        @endif
                    {{--<option value="{{$category->id}}">{{$category->name}} </option>--}}
                @endforeach
            </select>
        </div>
    </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">商品詳情:</label>
            <textarea name="text" id="text" class="form-control" rows="10" placeholder="">{{$product->text}}</textarea><!--多行輸入框-->
        </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <button class="btn btn-primary btn-sm" type="submit" >儲存</button>
        <a class="btn btn-danger btn-sm" href="{{route('admins.products.show',$product)}}">取消</a>
    </div>
    </fieldset>
</div>
</form>
@endsection
