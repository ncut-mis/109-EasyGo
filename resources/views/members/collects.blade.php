@extends('members.layouts.master')

@section('page-title', '我的收藏')

@section('page-content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">我的收藏</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="#">新增</a>
        </div>
        <!-- Main Content -->
        <div class="tab-pane fade show active" id="nav-show" role="tabpanel" aria-labelledby="nav-show-tab">
            <div class="pt-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">食譜名稱</th>
                        <th scope="col">功能</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>

                        <td style="width: 150px">
                            <a href="#" class="btn btn-primary btn-sm">詳細</a>
                            <form action="#" method="post" style="display: inline-block">

                                <button type="submit" class="btn btn-danger btn-sm">刪除</button>
                            </form>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
