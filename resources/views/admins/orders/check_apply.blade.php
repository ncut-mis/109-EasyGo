@extends('admins.layouts.master')

@section('page-title', '訂單列表')

@section('content')
    <section class="pt-4">

    <div class="container-fluid px-4">
        <h1 class="mt-4">訂單管理</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">審核專區</li>
        </ol>

        <div class="mb-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('admins.orders.check_apply')}}">待審核訂單</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admins.orders.cancel_apply')}}">申請取消訂單</a>
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
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelModal" data-bs-whatever="{{$order->id}}" data-bs-any="{{$order->remark}}">
                                查看
                            </button>
                    @elseif($order->status==5 || $order->status==6)

                    @else
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="{{$order->id}}">
                            修改狀態
                        </button>
                    @endif

                </td>

                <td style="width: 250px">

                    <a href="{{route('admins.orders.show',$order->id)}}" class=" btn btn-primary btn-sm">詳細資料</a>
            @endforeach
            </tbody>
        </table>
        <!--修改狀態-->
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
        <!--取消訂單-->
        <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelModalLabel">取消訂單</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admins.orders.update_cancel',$order->id)}}" method="post" class="col">
                        @method('patch')
                        <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="id" name="id">
                            <label class="fw-bolder">取消理由</label>
                            <div class="shadow-sm p-3 bg-body rounded" id="remark" name="remark" rows="3" disabled></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">確認</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
    <script>
        //修改狀態
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
        //取消訂單審核
        var cancelModal = document.getElementById('cancelModal')
        cancelModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget    //不懂甚麼意思
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever') //取得按鈕中data-bs-whatever的屬性值
            var remark = button.getAttribute('data-bs-any')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            // Update the modal's content.
            var modalBodyInput = cancelModal.querySelector('.modal-body input') //指定modalbody中的input標籤
            var modalBodyTextarea = cancelModal.querySelector('#remark') //指定modalbody中的textarea標籤

            modalBodyInput.value = recipient    //將input的值設定為recipient
            modalBodyTextarea.textContent = remark  //將textarea的值設為remark
        })
    </script>
@endsection

