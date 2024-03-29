@extends('members.layouts.master')

@section('page-title', '購物車')

@section('content')


    <style>
        .br2{
            line-height:91px
        }
    </style>
    <br>
    <header class="masthead">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <br><center><h1><b>結帳</b></h1></center>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <center><hr width="80%"></center>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <form action="{{route('members.orders.checkout')}}" method="post" role="form">
                    @method('POST')
                    @csrf
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <br>
                            <th width="20%" style="text-align: center">名稱</th>
                            <th width="10%" style="text-align: center">單價</th>
                            <th width="10%" style="text-align: center">數量</th>
                            <th width="10%" style="text-align: center">小計</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($carts as $cart)
                            <tr>
                                <td style="text-align: center;line-height:40px;">
                                    {{$cart->name}}
                                </td>
                                <td style="text-align: center;line-height:40px;">
                                    ${{$cart->price}}
                                </td>
                                <td style="text-align: center;line-height:40px;">
                                    {{$cart->quantity}}
                                </td>
                                <td style="text-align: center;line-height:40px;">
                                    ${{($cart->quantity)*($cart->price)}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="text-align:right">
                        <b>總計： {{$total}}元</b>
                    </div>
                    <tr>
                        <th scope="col"> <b>收件資訊</th>
                    </tr>
                </thead>
                    <br>
                    <div class="form-group">
                        <label for="name">收件人姓名</label><br>
                        <input name="receiver" value="{{$user->name}}" class="form-control" required>
                        <br>
                        <label for="name">收件人信箱</label><br>
                        <input name="email" value="{{$user->email}}" class="form-control" required>
                        <table class="table">
                            <br>
                            <label for="name">收件地址</label><br>
                            <input name="address" class="form-control"  placeholder="輸入收件地址" required>
                            <input type="hidden" name="remit" value="0" id="">
                            <table class="table">
                                <label for="name">收件人電話</label> <input class="form-control" name="tel" placeholder="手機號碼" required></th>

                                <br>
                            <tr>
                                <th scope="col"> 付款資訊</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                            </tr>
                            <tr>
                                <th scope="row">信用卡號<input class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx"></th>

                            </tr>
                            <tr>
                                <th scope="row">有效期限<input  class="form-control"  placeholder="有效期限"></th>

                            </tr>


                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div style="text-align:center">
                        <button class="btn btn-outline-primary" type="submit">完成結帳</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="br2">
            <br>
        </div>
    </div>


@endsection
