@extends('members.layouts.master')

@section('page-title', '我的訂單')

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
                    <h1 class="mt-4">我的訂單</h1>

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('members.orders.index')}}">所有訂單</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('members.orders.done')}}">已完成訂單</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('members.orders.cancel')}}">已取消訂單</a>
                        </li>

                    </ul>
                    <!-- Main Content -->
                    <div class="tab-pane fade show active" id="nav-show" role="tabpanel" aria-labelledby="nav-show-tab">
                        <div style="min-height:365px">
                            <div class="pt-4">
                                @if($has_data == 0)
                                    <div class="my-auto">
                                        <h4 class="text-center text-secondary">親，快去買一份屬於你的食材吧</h4>
                                    </div>
                                @else
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">訂單編號</th>
                                            <th scope="col">時間</th>
                                            <th scope="col">總金額</th>
                                            <th scope="col">狀態</th>
                                            <th scope="col">功能</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($array as $array_item)

                                                <tr onclick="window.location.href='#';">
                                                    <td>{{$array_item['id']}}</td>
                                                    <td>{{$array_item['creat_time']}}</td>
                                                    <td>{{$array_item['price']}}</td>
                                                    <td>{{$array_item['status']}}</td>
                                                    <td>
                                                        <a href="{{route('members.orders.show',$array_item['id'])}}" class="btn btn-secondary btn-sm">詳細資料</a>

                                                    </td>
                                                </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
