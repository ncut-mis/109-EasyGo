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
                            <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                                <div class="row align-items-center">
                                    <div class="col-xs-12 col-md-9">
                                        <!-- Post title-->
                                        <h1 class="fw-bolder mb-1 ">白醬蛤蠣義大利麵</h1>
                                        <h5 class>這道大人小孩都愛的白酒蛤蜊麵，不但能吃到蛤蜊的鮮味，蒜味和白酒更有提香的作用，最後利用九層塔的香氣來取代平時不常用的巴西利，依然美味無比哦！</h5>
                                        <h5 class="fw-bolder mb-1"></h5>
                                    </div>
                                    <div class="col-xs-12 col-md-3 d-md-flex">
                                        <a href="" class="btn btn-secondary fs justify-content-md-end-5 position-end " >食材加入購物車</a>
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





                        </section>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
