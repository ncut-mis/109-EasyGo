@extends('members.layouts.master')

@section('page-title', '我的收藏')

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

                <h1 class="mt-4">我的收藏</h1>

                <section class="pt-4">
                    @if($datanull == 0)
                        <div class="my-auto">
                            <h4 class="text-center text-secondary">~快收藏美味秘方~</h4>
                        </div>
                    @else

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">食譜名稱</th>
                                <th scope="col">功能</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($collects as $collect)
                                <tr>
                                    <td class="col-1">{{ $loop->iteration }}</td><!--自動編號-->
                                    <td class="col-9">{{$collect->recipe->name}}</td>
                                    <td class="col-2">
                                        <a href="{{route('members.recipes.show',$collect->recipe->id)}}" type="button" class="btn btn-primary btn-sm">詳細資料</a>

                                        <!--刪除-->
                                        <form action="{{route('members.collects.destroy',$collect->id)}}" method="POST" style="display: inline-block">
                                            @method('DELETE')
                                            @csrf

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#recipe{{$collect->id}}" data-bs-whatever="@123">刪除</button>
                                            <div class="modal fade" id="recipe{{$collect->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <!--互動視窗-->
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!--標題-->
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">刪除收藏</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>
                                                                <p>確定要刪除<span class="text-danger">"{{$collect->recipe->name}}"</span>收藏嗎?</p>
                                                            </h5>
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
                    @endif

                </section>
            </div>
        </div>
    </section>

@endsection
