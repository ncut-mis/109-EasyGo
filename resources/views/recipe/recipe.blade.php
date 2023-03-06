@extends('layouts.master')
@section('title','食譜名稱')
@section('content')
    <!-- Page Content-->
    <section class="py-5">
        <div class="container px-5 my-5 ">
            <div class="row gx-5">
                <div >
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="{{asset('images/'.$recipe->recipe_imgs)}}" /></figure>

                                <div class="row align-items-center">
                                    <div class="col-xs-12 col-md-9">
                                        <!-- Post title-->
                                        <h1 class="fw-bolder mb-1 ">{{$recipe->name}}</h1>
                                        <button>收藏</button>
                                        <h5 class>{{$recipe->text}}</h5>
                                        <h5 class="fw-bolder mb-1"></h5>
                                    </div>
                                    <button type="button" id="btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#refund" data-bs-whatever="@123" >選購食材</button>
                                    <div class="modal fade" id="refund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <form action="" method="post" >

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!--標題-->





                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col">食材名稱</th>
                                                            <th scope="col">食材品牌</th>
                                                            <th scope="col">數量</th>
                                                            <th scope="col">金額</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">加入購物車</button>
                                                            </th>
                                                            <th scope="row">義大利麵</th>
                                                            <td>
                                                                <select >
                                                                <option value="a牌">a牌</option>
                                                                <option value="b牌" selected>b牌</option>
                                                            </select>
                                                            </td>
                                                            <td>   <select >
                                                                    <option value="1">1</option>
                                                                    <option value="2" selected>2</option>
                                                                    <option value="3">3</option>

                                                                </select>
                                                            </td>
                                                            <td>$199</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">加入購物車</button>
                                                            </th>
                                                            <th scope="row">蒜頭</th>
                                                            <td>
                                                                <select >
                                                                    <option value="a牌"selected>a牌</option>
                                                                    <option value="b牌" >b牌</option>
                                                                </select>
                                                            </td>
                                                            <td>   <select >
                                                                    <option value="1">1</option>
                                                                    <option value="2" selected>2</option>
                                                                    <option value="3">3</option>

                                                                </select>
                                                            </td>
                                                            <td>$50</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">加入購物車</button>
                                                            </th>
                                                            <th scope="row">九層塔</th>
                                                            <td>
                                                                <select >
                                                                    <option value="a牌">a牌</option>
                                                                    <option value="b牌" selected>b牌</option>
                                                                </select>
                                                            </td>
                                                            <td>   <select >
                                                                    <option value="1">1</option>
                                                                    <option value="2" selected>2</option>
                                                                    <option value="3">3</option>

                                                                </select>
                                                            </td>
                                                            <td>$19</td>

                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">加入購物車</button>
                                                            </th>
                                                            <th scope="row">蛤蠣</th>
                                                            <td>
                                                                <select >
                                                                    <option value="a牌">a牌</option>
                                                                    <option value="b牌" selected>b牌</option>
                                                                </select>
                                                            </td>
                                                            <td>   <select >
                                                                    <option value="1">1</option>
                                                                    <option value="2" selected>2</option>
                                                                    <option value="3">3</option>

                                                                </select>
                                                            </td>
                                                            <td>$299</td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            </td>
                                                            <td>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <td>
                                                                
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>



                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    </td>
                                    </tr>
                                    </tbody>

                                    </table>
                                </div>
                                </div>

                        </header>
                        <!-- Post content-->
                        <section class="mb-5">
                            <hr>
                            <div class="accordion" id="accordionExample">
                                <!--食譜資訊-->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            食材
                                        </button>
                                    </h2>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">食材名稱</th>
                                            <th scope="col">數量</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">義大利麵</th>
                                            <td>100g</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">蒜頭</th>
                                            <td>3瓣</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">九層塔</th>
                                            <td>適量</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">蛤蜊</th>
                                            <td>300g</td>

                                        </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <!--製作步驟-->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button  collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                            製作步驟
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body fs-5">
                                            <strong></strong>
                                        </div>

                                        <div class="card mb-3" style="max-width: 800px;">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <img src=".../img/1-step1.png">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h1 class="card-title">步驟1</h1>
                                                        <p class="card-text">
                                                            將蒜頭去膜切末；辣椒切末；蛤蜊以1000cc的水加入30g的鹽，吐沙1-2小時；九層塔切碎備用。</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- card 元件為外層-->
                                <div class="card">
                                    <div class="card-header">
                                        留言區
                                    </div>
                                    <div class="card-body">
                                        <!-- media object-->
                                        <div class="media">
                                            <img src="https://randomuser.me/api/portraits/lego/2.jpg" class="mr-3" alt="..." width="64"
                                                 height="64">
                                            <div class="media-body">
                                                <h5 class="mt-0">留言區</h5>
                                                <!--表單 textarea-->
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="3"></textarea>
                                                    <!--讓 button 滿版寬使用 .btn-block-->
                                                    <button class="btn btn-light btn-block mt-3">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- media object-->
                                        <div class="media my-3">
                                            <img src="https://randomuser.me/api/portraits/women/60.jpg" class="mr-3" alt="..." width="64" height="64">
                                            <div class="media-body">
                                                <h5 class="mt-0">徐義竹</h5>
                                                好好吃好好吃好好吃好好吃好好吃好好吃好好吃好好吃
                                            </div>
                                        </div>
                                        <div class="media my-3">
                                            <img src="https://randomuser.me/api/portraits/women/40.jpg" class="mr-3" alt="..." width="64" height="64">
                                            <div class="media-body">
                                                <h5 class="mt-0">徐123</h5>
                                                真難吃真難吃真難吃真難吃真難吃真難吃真難吃真難吃
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
