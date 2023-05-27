@extends('members.layouts.master')

@section('page-title', '我的食譜')

@section('content')
    <section class="pt-4">
        <div class="container px-lg-5">
            <!-- Page Features-->
            <div class="row gx-lg-5">

                    <!--導染列-->
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('members.recipes.index')}}">我的食譜</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('members.collects.index')}}">食譜收藏</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('members.orders.index')}}">我的訂單</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('members.index')}}">個人資料</a>
                        </li>
                    </ul>

                    <div class="container-fluid px-4">
                        <h1 class="mt-4">我的食譜</h1>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-success btn-sm" href="{{route('bloggers.recipes.create')}}">新增</a>
                        </div>

                    <section class="pt-4">
                        @if($datanull == 0)
                            <div class="my-auto">
                                <h4 class="text-center text-secondary">~撰寫你的美味料理祕密配方~</h4>
                            </div>
                        @else

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
                                    <td>{{ $loop->iteration }}</td><!--自動編號-->
                                    <td class="col-7">{{$recipe->name}}</td>

                                    @if($recipe->status== 1)
                                        <td>
                                            已上架
                                            <form action="{{route('bloggers.recipes.stop',$recipe->id)}}" method="POST" style="display: inline-block">
                                                @method('patch')
                                                @csrf
                                                <button class="btn btn-sm btn-warning" type="submit">下架</button>
                                            </form>
{{--                                            已上架--}}
                                        </td>
                                    @else
                                        <td>
                                            下架中
                                            <form action="{{route('bloggers.recipes.launch',$recipe->id)}}" method="POST" style="display: inline-block">
                                                @method('patch')
                                                @csrf
                                                <button class="btn btn-sm btn-warning" type="submit">上架</button>
                                            </form>
                                        </td>
                                    @endif

                                    <td class="col-2">
                                        <a href="{{route('bloggers.recipes.edit',$recipe->id)}}" type="button" class="btn btn-primary btn-sm">詳細資料</a>

                                        <!--刪除-->
                                        <form action="{{route('bloggers.recipes.destroy',$recipe->id)}}" method="POST" style="display: inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#recipe{{$recipe->id}}" data-bs-whatever="@123">刪除</button>

                                            @if($recipe->status==1)
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
                                                                <h5>
                                                                    <p><span class="text-danger">"{{$recipe->name}}"</span>還未下架!</p>
                                                                    <p>請先下架食譜再進行刪除!</p>
                                                                </h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">關閉</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
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
                                                                <h5>
                                                                    <p>確定要刪除<span class="text-danger">"{{$recipe->name}}"</span>嗎?</p>
                                                                    <p>該食譜資料也會被一併刪除!!</p>
                                                                </h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">取消</button>
                                                                <button type="submit" class="btn btn-sm btn-danger">確定</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        @endif

                    </section>
                </div>
            </div>
            </div>
        </div>
    </section>


@endsection
