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
                        <a class="nav-link" href="{{route('members.collects.index')}}">食譜收藏</a>
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

                                                <tr>
                                                    <td>{{$array_item['id']}}</td>
                                                    <td>{{$array_item['creat_time']}}</td>
                                                    <td>{{$array_item['price']}}</td>
                                                    <td>{{$array_item['status']}}</td>
                                                    <td>
                                                        <a href="{{route('members.orders.show',$array_item['id'])}}" class="btn btn-secondary btn-sm">詳細資料</a>
                                                        @if($array_item['status']=='訂單審核中' || $array_item['status']=='已成立')
                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="{{$array_item['id']}}">
                                                                取消訂單
                                                            </button>
                                                            <form action="{{route('members.orders.cancel_update',$array_item['id'])}}" method="post" enctype="multipart/form-data">
                                                                @method('patch')
                                                                <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm" type="submit">取消訂單</button>
                                                            </form>
                                                        @endif
                                                        @if($array_item['status']=='已送達')
                                                            <form action="{{route('members.orders.done_update',$array_item['id'])}}" method="post" enctype="multipart/form-data">
                                                                @method('patch')
                                                                <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->
                                                                @csrf
                                                                <button class="btn btn-success btn-sm" type="submit">完成訂單</button>
                                                            </form>
                                                        @endif
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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">取消訂單申請</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('members.orders.cancel_update',$array_item['id'])}}" method="post" class="col">
                        @method('patch')
                        <!--csrf驗證機制，產生隱藏的input，包含一組驗證密碼-->
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="id" name="id">
                            <label>取消理由</label>
                            <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">確認</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <script>
        var exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget    //不懂甚麼意思
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever') //取得按鈕中data-bs-whatever的屬性值
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalBodyInput = exampleModal.querySelector('.modal-body input') //指定modalbody中的input標籤

            modalBodyInput.value = recipient    //將input的值設定為recipient
        })
    </script>
@endsection
