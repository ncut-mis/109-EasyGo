@extends('admins.layouts.master')

@section('page-title', '食譜列表')

@section('content')

    <section class="pt-4">
        <div class="container-fluid px-4">
            <h1 class="mt-4">EasyGo管理平台</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"><h4>歡迎{{$user->name}}</h4></li>
            </ol>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

            </div>
            <table class="table">
                <thead>

                </thead>

                <tbody>
                </tbody>
            </table>
        </div>
    </section>

@endsection
