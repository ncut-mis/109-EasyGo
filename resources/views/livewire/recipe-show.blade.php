@extends('layouts.master')

@section('title', '食譜內容')

@section('content')

    <section class="py-0">
        <div class="container px-5 my-5 ">
            <div class="row gx-3">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Post title-->
                <div class="mb-3">
                    <!--收藏按鈕-->
                    <!--未登入-->
                    @if(!is_null($isCollect))
                        <!--登入後-->
                        @if($isCollect)
                            <form action="{{route('members.collects.destroy',$collect->id)}}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-lg">★已收藏</button>
                            </form>
                        @else
                            <form action="{{route('members.collects.store',$recipe->id)}}" method="POST">
                                @method('post')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-lg">☆收藏</button>
                            </form>
                        @endif
                    @endif


                    <!--食譜名稱-->
                    <div class="mb-3">
                        <h4>
                            <p class="text-end">發表人：{{$recipe->user->name}}</p>
                        </h4>
                        <h2>
                            <p>食譜名稱：{{$recipe->name}}</p>
                        </h2>
                    </div>


            </header>
                    <!--食譜封面-->
                    <div class="mb-3">
                        <!--輪播圖片-->
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($recipe->recipeImgs as $key=> $recipeImg)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{asset('img/recipe/'.$recipeImg->picture)}}" width="1250" height="850">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <!--食譜影片-->
                    <div class="mb-3">
                        <!--輪播圖片-->
                        <div id="videoControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($recipe->recipeFilms as $key=> $recipeFilm)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <video src="{{ asset('video/' . $recipeFilm->film) }}" autoplay controls muted  width="1250" height="850"></video>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev btn-sm" type="button" data-bs-target="#videoControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#videoControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <!--食譜類別-->
                    <div class="mb-3">
                        <h4>食譜類別：{{$recipe->recipeCategory->name}}</h4>
                    </div>

                    <!--食譜簡介-->
                    <div class="mb-3">
                        <h4>食譜簡介：{{$recipe->text}} </h4>
                    </div>
                </div>

                <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                <!--食材-->
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed fs-2 custom-color" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <b>食材</b>
                            </button>

                        </h2>

                        <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"><h4>名稱</h4></th>
                                                <th scope="col"><h4>用量</h4></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($ingredients as $ingredient)
                                            <tr>
                                                <td><h4>{{ $ingredient->name }}</h4></td>
                                                <td><h4>{{ $ingredient->quantity }}</h4></td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
{{--                                    <head>--}}
{{--                                        <!-- 引入 Bootstrap CSS 檔案 -->--}}
{{--                                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--                                    </head>--}}
                                    <head>
                                        <style>
                                            .right-align {
                                                float: right;
                                            }
                                        </style>
                                    </head>
                                    <button type="button" id="dss" class="btn btn-danger  btn-lg right-align" data-bs-toggle="modal" data-bs-target="#refund" data-bs-whatever="@123">點我一鍵選購!</button>
                                    <div class="modal fade" id="refund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" keyboard="false" backdrop="false">
                                        <form action="{{route('members.cart_items.easy')}}" method="post">
                                            @csrf
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!--標題-->
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col"></th>
                                                                <th scope="col">所需食材</th>
                                                                <th scope="col">商品</th>
                                                                <th scope="col">數量</th>
                                                                <th scope="col">備註</th>
                                                                <!-- <th scope="col">金額</th> -->

                                                            </tr>
                                                            </thead>
                                                            <tbody id="products">

                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </td>
                                                                <td>
                                                                    <button type="submit" class="btn btn-primary refund">加入購物車</button>
                                                                </td>
                                                            </tr>
                                                            </tfoot>
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--步驟-->
                    <div class="accordion-flush">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed fs-2  custom-color" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                <b>製作步驟</b>
                            </button>
                        </h2>

                        <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    @foreach ($recipe->recipeSteps as $recipeStep)
                                        <div class="card w-80 mb-3">
                                            <div class="row g-0">
                                                @if($recipeStep->picture!=null)
                                                    <div class="col-md-4">
                                                        <img class="d-block w-100" src="{{asset('img/step/'.$recipeStep->picture)}}" alt="...">
                                                    </div>
                                                @else
                                                    <div class="row col-md-4 align-items-center">
                                                        <h1 class="card-title text-secondary">目前無照片</h1>
                                                    </div>
                                                @endif

                                                <div class="col-md-8">
                                                    <div class="card-body mb-3">
                                                        <h2 class="card-title mb-6"><b>步驟{{$recipeStep->sequence}}</b></h2><br>
                                                        <h3>{{$recipeStep->text}}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">
        <!-- card 元件為外層-->

        <div class="card">
            <div class="card-header">
                <h2>留言區</h2>
            </div>

            <div class="card-body">
                <!-- media object-->
                <div class="media">

                    <div class="media-body">
                        <h5 class="mt-0">留言區</h5>
                        <!--表單 textarea-->
                        <form action="{{route('comment.create')}}" method="post">
                            @csrf <!-- Laravel's built-in CSRF protection -->
                            <div class="form-group">
                                <input name="recipe_id" value="{{$recipe->id}}" style="display:none" />
                                <textarea class="form-control" rows="3" name="content"></textarea>
                                <!--讓 button 滿版寬使用 .btn-block-->
                                <button class="btn btn-success">留言</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- media object-->
                @foreach($comments as $comment)
                    <div class="media my-3">

                        <div class="media-body">
                            <ul>
                                <li>
                                    <div class="card mb-4 col-12 d-flex align-items-end">
                                        <div class="card-body col-12">
                                            <div class="d-flex flex-row align-items-center">
                                                <img class="rounded-circle shadow-1-strong me-3" src="https://teameowdev.files.wordpress.com/2016/04/avatar-01.png?w=300&h=300" alt="avatar" width="40" height="40" />
                                                <p class="small mb-0 ms-2">{{ $comment->nickname }}</p>
                                            </div>
                                            <p>{{ $comment->content }}</p>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <p class="small text-muted mb-0">發布時間: {{$comment->created_at}}</p>
                                                    <i class="far fa-thumbs-up mx-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
                                                    <!-- <p class="small text-muted mb-0">4</p> -->
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($comment->sub_comments as $sub_comment)
                                            <div class="card mb-4 col-10 ">

                                                <div class="card-body">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <img class="rounded-circle shadow-1-strong me-3" src="https://teameowdev.files.wordpress.com/2016/04/avatar-01.png?w=300&h=300" alt="avatar" width="40" height="40" />
                                                        <p class="small mb-0 ms-2">{{ $sub_comment->nickname }}</p>
                                                    </div>
                                                    <p>{{ $sub_comment->content }}</p>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex flex-row align-items-center">

                                                            <!-- <div class="input-group mb-3">
                                                                <button class="btn btn-success input-group-text" id="inputGroup-sizing-default">送出</button>
                                                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                                            </div> -->
                                                            <i class="far fa-thumbs-up mx-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
                                                            <!-- <p class="small text-muted mb-0">4</p> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <form class="card-footer py-3 border-0 col-12 my-0" style="background-color: #f8f9fa;" action="{{route('comment.create')}}" method="post">
                                            @csrf
                                            <div class="d-flex flex-start w-100">
                                                <img class="rounded-circle shadow-1-strong me-3" src="https://teameowdev.files.wordpress.com/2016/04/avatar-01.png?w=300&h=300" alt="avatar" width="40" height="40" />
                                                <div class="form-outline w-100">
                                                    <input type="text" style="display:none" name="recipe_id" value="{{ $comment->recipe_id }}">
                                                    <input type="text" style="display:none" name="comment_id" value="{{ $comment->id }}">
                                                    <textarea name="content" class="form-control" id="textAreaExample" rows="4" style="background: #fff;"></textarea>
                                                    <label class="form-label" for="textAreaExample">留ㄍ言吧......</label>
                                                </div>
                                            </div>
                                            <div class="float-end mt-2 pt-1">
                                                <button wire:submit.prevent class="btn btn-primary btn-sm">回覆</button>
                                                <!-- <button type="button" class="btn btn-outline-primary btn-sm">清除</button> -->
                                            </div>
                                        </form>
                                    </div>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#refund").on("hidden.bs.modal", function() {
                location.reload();
            });
            $("#dss").click(function() {

                //送 AJAX 請
                $.ajax({
                    url: "{{route('members.recipes.List',$recipe->id)}}",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        let appendHtml = ``;
                        let orderListCategoryGroup = data.reduce((group, product) => {
                            const {
                                category_name
                            } = product;
                            group[category_name] = group[category_name] ?? [];
                            group[category_name].push(product);
                            return group;
                        }, [])
                        console.log(orderListCategoryGroup)
                        //orderListCategoryName
                        let category_name = Object.keys(orderListCategoryGroup)
                        category_name.forEach((category_name, index) => {

                            let html = `<tr>
                            <td>
                                <input type="checkbox" name="product[${index}][suretobuy]"  checked>
                            </td>
                            <td>
                                <h4>${category_name}</h4>
                            </td>
                            <td>
                                 <select class="form-select selectProduct" aria-label="Default select example" name="product[${index}][product_id]>
                                    <!--option value="0">選擇商品</option-->
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" id="quantity" value="1" placeholder="數量" name="product[${index}][quantity]">
                            </td>
                            <!--td>
                                <h4 class="price"></h4>
                            </td--!>
                        </tr>`

                            $('#products').append(html)//顯示商品列表

                            orderListCategoryGroup[category_name].forEach((product) => {
                                const {
                                    product_name,
                                    product_id,
                                    product_price,
                                    product_norm
                                } = product;

                                let option = `<option value="${product_id}">${product_name}</option>`
                                let price = `${product_price} ${product_norm}`
                                $('.selectProduct').eq(index).append(option)//對應類別到下拉選單

                            })

                        })

                    }
                });
            });
        });
    </script>

@endsection
