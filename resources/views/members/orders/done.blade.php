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
                    <h1 class="mt-4">我的訂單</h1>


                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('members.orders')}}">所有訂單</a>
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
                        <div class="pt-4">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">訂單編號</th>
                                    <th scope="col">時間</th>
                                    <th scope="col">總金額</th>
                                    <th scope="col">付款方式</th>
                                </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
