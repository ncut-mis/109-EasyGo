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
                            <a class="nav-link" href="{{route('members.orders')}}">我的訂單</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('members.members')}}">個人資料</a>
                        </li>
                    </ul>

                    <div class="container-fluid px-4">
                        <h1 class="mt-4">我的食譜</h1>

                    <section class="pt-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-success btn-sm" href="{{route('blogger.recipes')}}">新增</a>
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
                                    <td>{{ $loop->iteration }}</td><!--自動編號-->
                                    <td class="col-7">{{$recipe->name}}</td>

                                    @if($recipe->status== 1)
                                        <td>
                                            已上架
                                            <button class="btn btn-sm btn-warning" type="submit">下架</button>
                                        </td>
                                    @else
                                        <td>
                                            下架中
                                            <button class="btn btn-sm btn-warning" type="submit">上架</button>
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

                    </section>
                </div>
            </div>
            </div>
        </div>
    </section>


@endsection
