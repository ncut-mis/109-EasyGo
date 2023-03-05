@extends('layouts.master')
@section('title','食材名稱')
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
                        <figure class="mb-4"><img class="img-fluid rounded" src="https://www.pxmart.com.tw/Api/Images/133162494023417960.jfif" alt="..." /></figure>

                        <div class="row align-items-center">
                            <div class="col-xs-12 col-md-9">
                                <!-- Post title-->
                                <h1 class="fw-bolder mb-1 ">菲力牛柳</h1>
                                <h5 class="fw-bolder mb-1"></h5>
                            </div>
                            <button type="button" id="btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#refund" data-bs-whatever="@123" >加入購物車</button>
                            <div class="modal fade" id="refund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="" method="post" >

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <!--標題-->
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </td>
                            </tr>
                            </tbody>

                            </table>
                        </div>
                    </header>
                </article>
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
                                <th scope="col">品牌</th>
                                <th scope="col">數量</th>
                                <th scope="col">價格</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">A牌</th>
                                <td>100g</td>
                                <td>100元</td>

                            </tr>
                            <tr>
                                <th scope="row">B牌</th>
                                <td>100g</td>
                                <td>120元</td>

                            </tr>
                            </tbody>
                        </table>
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
