@extends('members.layouts.master')
@section('page-title', '個人資料')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">個人資料</h1>
{{--        <div class="d-grid gap-2 d-md-flex justify-content-md-end">--}}
{{--            <a class="btn btn-success btn-sm" href="{{route('members.members')}}">修改</a>--}}
{{--        </div>--}}
        <!-- Main Content -->
        <form>
            <div class="mb-3">
                <figure class="figure">
                    <img src="https://dummyimage.com/150X200/ced4da/6c757d.jpg" class="figure-img img-fluid rounded" alt="...">
                </figure>
            </div>
            <div class="row mb-3">


                <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">姓名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name">
                </div>

                <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">電話</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cel">
                </div>

                <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">生日</label>
                <div class="col-sm-10">
                <input type="date" class="form-control" id="bir" >
                </div>

                <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">信箱</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="mail">
                </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary btn-sm" type="submit">儲存</button>
            </div>

        </form>
    </div>
@endsection
