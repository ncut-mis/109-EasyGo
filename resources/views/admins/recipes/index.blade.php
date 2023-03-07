@extends('admins.layouts.master')

@section('page-title', '食譜列表')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">食譜管理</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">食譜一覽表</li>
        </ol>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="#">新增</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">食譜名稱</th>
                <th scope="col">功能</th>
            </tr>
            </thead>

            <tbody>
            @foreach($recipes as $recipe)<!--陣列內有幾筆資料就會重複執行幾次-->
            <tr>
                <th scope="row" style="width: 50px">{{$recipe->id}}</th>
                <td>{{$recipe->name}}</td>
                <td style="width: 150px">

                    <a href="#" class="btn btn-primary btn-sm">詳細資料</a>




                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#recipe{{$recipe->id}}" data-bs-whatever="@123">刪除</button>
                    <div class="modal fade" id="recipe{{$recipe->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

{{--                        <form action="{{route('#',$recipe->id)}}" method="post" >--}}
{{--                            @method('delete')--}}
{{--                            <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->--}}
{{--                            @csrf--}}

                        <!--互動視窗-->
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!--標題-->
                                <div class="modal-header">
                                    <h5 class="modal-title">刪除食譜</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body">
                                        <p>確定要刪除 {{$recipe->name}} 嗎?</p>
                                        <p>訂單明細相關之食譜也會被刪除!!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">取消</button>
                                        <button type="submit" class="btn btn-sm btn-danger">確定</button>
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
