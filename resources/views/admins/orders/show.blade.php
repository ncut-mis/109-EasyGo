@extends('admins.layouts.master')

@section('page-title', '訂單列表')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">訂單管理</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">訂單詳細資料</li>
        </ol>

        <div class="container-fluid px-4">
            <!-- Main Content -->
            <div>
                <h4 for="exampleFormControlInput1" class="col-sm-2  mt-2">訂單狀態</h4>
                <div class=" bg-light p-3 border">
                    @switch($order->status)
                        @case(0)
                            審核中
                            @break
                        @case(1)
                            已成立
                            @break
                        @case(2)
                            出貨中
                            @break
                        @case(3)
                            已出貨
                            @break
                        @case(4)
                            已送達
                            @break
                        @case(5)
                            已完成
                            @break
                        @case(6)
                            已取消
                            @break
                        @default
                            error
                    @endswitch
                </div>

                <h4 for="exampleFormControlInput1" class="col-sm-2 mt-2">收件資訊</h4>
                <div class=" bg-light p-3 border">
                    姓名：{{$order->receiver}}<br>
                    電話：{{$order->tel}}<br>
                    地址：{{$order->address}}
                </div>
            </div>
            <div>
                <h4 for="exampleFormControlInput1" class="col-sm-2 mt-2">訂單明細</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">品項</th>
                        <th scope="col">數量</th>
                        <th scope="col">單價</th>
                        <th scope="col">小計</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($array as $array_tiem)
                        <tr>
                            <th scope="col">{{$array_tiem['name']}}</th>
                            <th scope="col">{{$array_tiem['quantity']}}</th>
                            <th scope="col">{{$array_tiem['price']}}</th>
                            <th scope="col">{{$array_tiem['subtotal']}}</th>
                        </tr>
                    @endforeach
                    <tr class="table-active">
                        <th>總金額</th>
                        <th></th>
                        <th></th>
                        <th>{{$sum}}</th>
                    </tr>
                    </tbody>
                </table>
            </div>


            <h4 for="exampleFormControlInput1" class="col-sm-2 mt-2">付款方式</h4>
            <div>
                <div class=" bg-light p-3 border">
                    線上付款
                </div>
            </div>
            <h4 for="exampleFormControlInput1" class="col-sm-2 mt-2">付款狀態</h4>
            <div>
                <div class=" bg-light p-3 border">
                    @switch($order->remit)
                        @case(0)
                            未付款
                            @break
                        @case(1)
                            已付款
                            @break
                    @endswitch
                </div>
            </div>
            <table>
                <h6 for="exampleFormControlInput1" class="col-form-label">訂單編號：{{$order->id}}</h6>

                <h6 for="exampleFormControlInput1" class="col-form-label">訂單成立時間：{{$order->created_at}}</h6>
                @if($order->status == 6)
                    <h6 for="exampleFormControlInput1"  class="col-form-label mb-2">訂單取消時間：{{$order->updated_at}}</h6>
                @endif
            </table>
            @if($order->status==0)
                <form action="{{route('admins.orders.update_check',$order->id)}}" method="post" >
                    @method('patch')
                    <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">確認訂單</button>
                </form>
            @endif
        </div>

    </div>
@endsection

