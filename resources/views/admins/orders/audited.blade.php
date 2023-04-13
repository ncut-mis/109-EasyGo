@extends('admins.layouts.master')

@section('page-title', '訂單列表')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">訂單管理</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">訂單一覽表</li>
        </ol>

        <div class="mb-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admins.orders.index')}}">所有訂單</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('admins.orders.audited')}}">已成立</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admins.orders.ship')}}">出貨中</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admins.orders.shipped')}}">已出貨</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admins.orders.arrival')}}">已送達</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admins.orders.done')}}">已完成</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admins.orders.cancel')}}">已取消</a>
                </li>

            </ul>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">訂單編號</th>
                <th scope="col">收件人</th>
                <th scope="col">付款狀態</th>
                <th scope="col">訂單狀態</th>

                <th scope="col">功能</th>
            </tr>
            </thead>

            <tbody>
            @foreach($orders as $order)<!--陣列內有幾筆資料就會重複執行幾次-->
            <tr>
                <th scope="row" style="width: 100px">{{$order->id}}</th>
                <td>{{$order->receiver}}</td>
                <td>
                    @if($order->remit==0)
                        未付款
                    @else
                        已付款
                    @endif
                </td>
                <td style="width:300px">
{{--                    <form>--}}
{{--                        <div class="input-group pe-3">--}}
{{--                            <select class="form-select" id="status" aria-label="Example select with button addon">--}}
{{--                                <option value="0" {{($order->status==0)?'selected':''}}>審核中</option>--}}
{{--                                <option value="1" {{($order->status==1)?'selected':''}}>已成立</option>--}}
{{--                                <option value="2" {{($order->status==2)?'selected':''}}>出貨中</option>--}}
{{--                                <option value="3" {{($order->status==3)?'selected':''}}>已出貨</option>--}}
{{--                                <option value="4" {{($order->status==4)?'selected':''}}>已送達</option>--}}
{{--                                <option value="5" {{($order->status==5)?'selected':''}}>已完成</option>--}}
{{--                                <option value="6" {{($order->status==6)?'selected':''}}>已取消</option>--}}
{{--                            </select>--}}
{{--                            <button class="btn btn-outline-secondary" type="submit">Button</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}

                    @switch ($order->status)    //辨識訂單狀態
                    @case(0)
                        訂單審核中
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
                    @case(7)
                        取消申請中
                    @break
                    @default
                        error
                    @endswitch

                    @if($order->status==0)
                        <form action="{{route('admins.orders.update_check',$order->id)}}" method="post" class="col" style="display: inline-block">
                            @method('patch')
                            <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">確認</button>
                        </form>
                    @elseif($order->status==7)
                        <form action="{{route('admins.orders.update_cancel',$order->id)}}" method="post" class="col" style="display: inline-block">
                            @method('patch')
                            <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">取消</button>
                        </form>
                    @elseif($order->status==5 || $order->status==6)

                    @else
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="{{$order->id}}">
                            修改狀態
                        </button>
                    @endif

                </td>

                <td style="width: 250px">

                    <a href="{{route('admins.orders.show',$order->id)}}" class=" btn btn-primary btn-sm">詳細資料</a>
                    <button type="button" class="col btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#order{{$order->id}}" data-bs-whatever="@123">刪除</button>
            @endforeach
            </tbody>
        </table>
{{--            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                <div class="modal-dialog">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                        </div>--}}

{{--                        <div class="modal-body">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="recipient-name" class="col-form-label">Recipient:</label>--}}
{{--                                    <input type="text" class="form-control" id="recipient-name">--}}
{{--                                </div>--}}
{{--                            --}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                            <button type="button" class="btn btn-primary">Send message</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">更新訂單狀態</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admins.orders.update',$order->id)}}" method="post" class="col">
                        @method('patch')
                        <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="id" name="id">
                            <select class="form-select" id="status" name="status" aria-label="Example select with button addon">
                                <option value="2">出貨中</option>
                                <option value="3">已出貨</option>
                                <option value="4">已送達</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">儲存</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        var exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalBodyInput = exampleModal.querySelector('.modal-body input')

            modalBodyInput.value = recipient
        })
    </script>
@endsection

