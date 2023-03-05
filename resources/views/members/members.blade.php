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

                <div class="container-fluid px-3">
                    <h1 class="mt-4">個人資料</h1>
                    <div class="row g-3">

{{--                        圖片?--}}
{{--                        <div class="mb-3">--}}
{{--                            <figure class="figure">--}}
{{--                                <img src="https://dummyimage.com/150X200/ced4da/6c757d.jpg" class="figure-img img-fluid rounded" alt="...">--}}
{{--                            </figure>--}}
{{--                        </div>--}}

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
                            <label for="address" class="form-label">住址</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="請輸入住址" value="{{$member->address}}" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">信箱</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="請輸入信箱" value="{{$member->user->email}}" disabled>
                        </div>

                        <!-- Button trigger modal -->
                        <div class="col-12 justify-content-md-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">編輯</button>
                        </div>
                    </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">編輯個資</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="{{route('members.update',$member->id)}}" method="POST" role="form" class="row g-0">
                                        @method('patch')
                                        @csrf

                                        <div class="modal-body">
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">姓名</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="請輸入姓名" value="{{$member->user->name}}">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="nickname" class="form-label">暱稱</label>
                                            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="請輸入暱稱" value="{{$member->nickname}}">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="tel" class="form-label">電話</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="請輸入電話" value="{{$member->phone}}">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="address" class="form-label">住址</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="請輸入住址" value="{{$member->address}}">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="email" class="form-label">信箱</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="請輸入信箱" value="{{$member->user->email}}">
                                        </div>
                                        </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">儲存</button>
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
