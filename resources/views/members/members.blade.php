@extends('members.layouts.master')
@section('page-title', '個人資料')

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

                <div class="container-fluid px-3">
                    <h1 class="mt-4">個人資料</h1>
                    <div class="row g-3">
                        <form action="{{route('members.update',$member->id)}}" method="POST" role="form" class="row g-0">
                            @method('patch')
                            @csrf
{{--                        圖片?--}}
{{--                        <div class="mb-3">--}}
{{--                            <figure class="figure">--}}
{{--                                <img src="https://dummyimage.com/150X200/ced4da/6c757d.jpg" class="figure-img img-fluid rounded" alt="...">--}}
{{--                            </figure>--}}
{{--                        </div>--}}

                            <div class="row g-2 align-items-center">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">姓名</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="請輸入姓名" value="{{$member->user->name}}" disabled>
                                </div>

                                <div class="col-md-6">
                                    <label for="nickname" class="form-label">暱稱</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname" placeholder="請輸入暱稱" value="{{$member->nickname}}" disabled>
                                </div>

                                <div class="col-md-6">
                                    <label for="tel" class="form-label">電話</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="請輸入電話" value="{{$member->phone}}" disabled>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">信箱</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="請輸入信箱" value="{{$member->user->email}}" disabled>
                                </div>

                                <div class="col-md-12">
                                    <label for="address" class="form-label">住址</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="請輸入住址" value="{{$member->address}}" disabled>
                                </div>

                                <!-- Button trigger modal -->
                                <div class="col-12 g-3 justify-content-md-end">
                                    <button class="btn btn-primary edit-button" type="button" onclick="enableFields()">編輯</button>
                                    <button type="submit" class="btn btn-primary save-button" disabled>儲存</button>
                                    <script>
                                        const editBtn = document.querySelector('.edit-button');
                                        const saveBtn = document.querySelector('.save-button');

                                        // 當編輯按鈕被按下時
                                        editBtn.addEventListener('click', () => {
                                            // 移除 disabled 屬性
                                            saveBtn.removeAttribute('disabled');
                                        });
                                        function enableFields() {
                                            // 找到需要解除 disabled 屬性的元素，例如 input 和 textarea
                                            var inputs = document.querySelectorAll('input');

                                            // 解除 disabled 屬性
                                            inputs.forEach(function(input) {
                                                input.removeAttribute('disabled');
                                            });
                                            // 將編輯按鈕禁用
                                            document.getElementById('edit-button').setAttribute('disabled', 'disabled');
                                        }
                                        function enableFields() {
                                            // 找到需要解除 disabled 屬性的元素，例如 input 和 textarea
                                            var inputs = document.querySelectorAll('input');

                                            // 解除 disabled 屬性
                                            inputs.forEach(function(input) {
                                                input.removeAttribute('disabled');
                                            });
                                            // 將編輯按鈕禁用
                                            document.getElementById('edit-button').setAttribute('disabled', 'disabled');
                                        }

                                    </script>
                                </div>
                            </div>
                        </form>
                    </div>

                    <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                    <h1 class="mt-4">重設密碼</h1>
                    <!--訊息-->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row g-3">
                        <form method="POST" action="{{ route('members.password.update')}}">
                            @method('post')
                            @csrf

                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="current_password" class="form-label">舊密碼：</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" class="form-control" name="current_password" required>
                                </div>

                                <div class="col-auto">
                                    <label for="password" class="form-label">新密碼：</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" class="form-control" name="password" required>
                                </div>

                                <div class="col-auto">
                                    <label for="password_confirmation" class="form-label">確認密碼：</label>
                                </div>
                                <div class="col-auto">
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">確認</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>

@endsection

