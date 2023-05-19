@extends('admins.layouts.master')

@section('page-title', '食譜列表')

@section('content')

    <section class="pt-4">
        <div class="container-fluid px-4">
            <h1 class="mt-4">食譜管理</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">食譜一覽表</li>
            </ol>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success btn-sm" href="{{route('admins.recipes.create')}}">新增</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">食譜名稱</th>
                    <th scope="col">狀態</th>
                    <th scope="col">功能</th>
                </tr>
                </thead>

                <tbody>
                @foreach($recipes as $recipe)
                    <tr>
                        <td>{{ $loop->iteration}}</td><!--自動編號-->
                        <td class="col-7">{{$recipe->name}}</td>

                        @if($recipe->status== 1)
                            <td>
                                已上架
                                <form action="{{route('admins.recipes.stop',$recipe->id)}}" method="POST" style="display: inline-block">
                                    @method('patch')
                                    @csrf
                                    <button class="btn btn-sm btn-warning" type="submit">下架</button>
                                </form>
                            </td>
                        @else
                            <td>
                                下架中
                                <form action="{{route('admins.recipes.launch',$recipe->id)}}" method="POST" style="display: inline-block">
                                    @method('patch')
                                    @csrf
                                    <button class="btn btn-sm btn-warning" type="submit">上架</button>
                                </form>
                            </td>
                        @endif

                        <td class="col-2">
                            <a href="#" type="button" class="btn btn-primary btn-sm">編輯</a>

                            <!--刪除-->
                            <form action="" method="POST" style="display: inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#recipe{{$recipe->id}}" data-bs-whatever="@123">刪除</button>
                                <div class="modal fade" id="recipe{{$recipe->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
