@extends('admins.layouts.master')

@section('page-title', '商品列表')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">商品管理</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">商品一覽表</li>
        </ol>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{route('admins.products.create')}}">新增</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">商品名稱</th>
                <th scope="col">狀態</th>
                <th scope="col">功能</th>
            </tr>
            </thead>

            <tbody>
            @foreach($products as $product)<!--陣列內有幾筆資料就會重複執行幾次-->
            <tr>
                <th scope="row" style="width: 50px">{{$product->id}}</th>
                <td>{{$product->name}}</td>

                
                @if($product->status== 1)
                    <td>
                        已上架
                        <form action="{{route('admins.products.stop',$product->id)}}" method="POST" style="display: inline-block">
                            @method('patch')
                            @csrf
                            <button class="btn btn-sm btn-warning" type="submit">下架</button>
                        </form>
                    </td>
                @else
                    <td>
                        下架中
                        <form action="{{route('admins.products.launch',$product->id)}}" method="POST" style="display: inline-block">
                            @method('patch')
                            @csrf
                            <button class="btn btn-sm btn-warning" type="submit">上架</button>
                        </form>
                    </td>
                @endif

                <td class="col-2">
                    <a href="{{route('admins.products.show')}}" class="btn btn-primary btn-sm">詳細資料</a>




                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#product{{$product->id}}" data-bs-whatever="@123">刪除</button>
                    <div class="modal fade" id="product{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

{{--                        <form action="{{route('#',$meal->id)}}" method="post" >--}}
{{--                            @method('delete')--}}
{{--                            <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->--}}
{{--                            @csrf--}}

                        <!--互動視窗-->
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!--標題-->
                                <div class="modal-header">
                                    <h5 class="modal-title">刪除商品</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body">
                                        <p>確定要刪除 {{$product->name}} 嗎?</p>
                                        <p>訂單明細相關之商品也會被刪除!!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">取消</button>
                                        <form action="{{route('admins.products.destroy',$product->id)}}" method="post" style="display: inline-block">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">確定</button>
                                        </form>

                                    </div>
                            </div>
                        </div>
                        </form>
                    </div>


                </td>
            </tr>
            @endforeach
            </tbody>

        </table>

    </div>
@endsection
