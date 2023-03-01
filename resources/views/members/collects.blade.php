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

                <h1 class="mt-4">我的收藏</h1>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-success btn-sm" href="#">新增</a>
                </div>
                <!-- Main Content -->
                <div class="tab-pane fade show active" id="nav-show" role="tabpanel" aria-labelledby="nav-show-tab">
                    <div class="pt-4">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">食譜名稱</th>
                                <th scope="col">功能</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>

                                <td style="width: 150px">
                                    <a href="#" class="btn btn-primary btn-sm">詳細</a>
                                    <form action="#" method="post" style="display: inline-block">

                                        <button type="submit" class="btn btn-danger btn-sm">刪除</button>
                                    </form>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
