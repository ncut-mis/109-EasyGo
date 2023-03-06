@extends('members.layouts.master')

@section('page-title', '購物車')

@section('content')
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand h2 mb-0" href="#">
            <i class="fas fa-heart text-info"></i>
            六角血拚買賣
        </a>
        <!--cart-->
        <div class="dropdown ml-auto">
            <button class="btn btn-cart" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-shopping-cart fa-2x"></i>
                <span class="badge badge-pill badge-danger">2</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton"
                 style="min-width: 300px;">
                <div class="px-4 py-3">
                    <div class="h6">已選購商品</div>
                    <table class="table table-sm">

                        <tbody>
                        <tr>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#removeModal" data-title="金牌西裝">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                            <td>金牌西裝</td>
                            <td>1件</td>
                            <td>$ 520</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#removeModal" data-title="金牌女裝">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                            <td>金牌女裝</td>
                            <td>1件</td>
                            <td>$ 480</td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-block" type="button">加入購物車</button>
                </div>

            </div>
        </div>
    </nav>

    <h2 class="text-center mt-5 mb-4">六角血拚結帳</h2>

    <div class="container">
        <!--結帳步驟-多步驟提示-->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-12 col-md">
                <div class="alert alert-success rounded-pill mr-2" role="alert">
                    1.輸入訂單資料
                </div>
            </div>
            <div class="col-12 col-md">
                <div class="alert alert-secondary rounded-pill mr-2" role="alert">
                    2.金流付款
                </div>
            </div>
            <div class="col-12 col-md">
                <div class="alert alert-secondary rounded-pill mr-2" role="alert">
                    3.完成
                </div>
            </div>
        </div>

        <!--Collapse-->
        <div class="row justify-content-center">
            <div class="col col-md-8">
                <div class="accordion" id="accordionExample">
                    <div class="card border-bottom rounded">
                        <div class="card-header " id="headingOne">
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    顯示購物車細節
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <div class="h3 mb-0">$ 520</div>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                         data-parent="#accordionExample">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="2" scope="col"></th>
                                    <th scope="col">商品名稱</th>
                                    <th scope="col">數量</th>
                                    <th scope="col">小計</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="align-middle">
                                        <a href="#" data-toggle="modal" data-target="#removeModal"
                                           data-title="特務西裝">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <img class="img-fluid img-thumbnail"
                                             src="https://images.unsplash.com/photo-1490114538077-0a7f8cb49891?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                             alt="" style="width: 120px;">
                                    </td>
                                    <td class="align-middle">特務西裝</td>
                                    <td class="align-middle">1件</td>
                                    <td class="align-middle text-right">$ 520</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right">運費</td>
                                    <td class="text-right">$ 60</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-right">合計</td>
                                    <td class="text-right">$ 580</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>
    <!--刪除的 Modal -->
    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="removeModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
