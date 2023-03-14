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
                            <a class="nav-link active" aria-current="page" href="{{route('members.recipes')}}">我的食譜</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('members.collects')}}">食譜收藏</a>
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
                        <div class="d-grid gap-2 d-md-flex ">
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
                                        <a href="" type="button" class="btn btn-primary btn-sm">詳細資料</a>

                                        <!--刪除-->
                                        <form action="" method="POST" style="display: inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit">刪除</button>
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
