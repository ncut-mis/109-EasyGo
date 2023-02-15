@extends('members.layouts.master')

@section('page-title', '我的訂單')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">我的訂單</h1>


        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('members.orders')}}">所有訂單</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('members.finishorders')}}">已完成訂單</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('members.cancelorders')}}">已取消訂單</a>
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
@endsection
