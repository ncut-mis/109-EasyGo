@extends('layouts.master')

@section('title', '食譜內容')

@section('content')

    <section class="py-0">
        <div class="container px-5 my-5 ">
            <div class="row gx-3">
                <!-- Post title-->
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-secondary btn-lg">收藏</button>
                    <!--食譜名稱-->
                    <div class="mb-3">
                        <h4>
                            <p class="text-end">發表人：{{$recipe->user->name}}</p>
                        </h4>
                        <h2>
                            <p>食譜名稱：{{$recipe->name}}</p>
                        </h2>
                    </div>

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
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($recipe->recipeFilms as $key=> $recipeFilm)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <video src="{{asset('video/'.$recipeFilm->film)}}" width="1250" height="850" controls></video>
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
                    
                    <!--食譜類別-->
                    <div class="mb-3">
                        <h4>食譜類別： </h4>
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
                            <button class="accordion-button collapsed fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                食材
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"><h4>名稱</h4></th>
                                                <th scope="col"><h4>推薦</h4></th>
                                                <th scope="col"><h4>數量</h4></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recipe_ingredients as $recipe_ingredient)
                                                <tr>
                                                    <td><h4>{{$recipe_ingredient->name}}</h4></td>
                                                    <td><button type="button" class="btn btn-info btn-lg">詳細</button></td>
                                                    <td><h4>{{$recipe_ingredient->quantity}}</h4></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--步驟-->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                製作步驟
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    @foreach ($recipe_steps as $recipe_step)
                                        <div class="card w-80 mb-3">
                                            <div class="row g-0">
                                                @if($recipe_step->picture!=null)
                                                    <div class="col-md-4">
                                                        <img class="d-block w-100" src="{{asset('img/step/'.$recipe_step->picture)}}" alt="...">
                                                    </div>
                                                @else
                                                    <div class="row col-md-4 align-items-center">
                                                        <h1 class="card-title text-secondary">目前無照片</h1>
                                                    </div>
                                                @endif

                                                <div class="col-md-8">
                                                    <div class="card-body mb-3">
                                                        <h2 class="card-title mb-6">步驟{{$recipe_step->sequence}}</h2><br>
                                                        <h3>{{$recipe_step->text}}</h3>
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
                        <img src="https://randomuser.me/api/portraits/lego/2.jpg" class="mr-3" alt="..." width="64"
                             height="64">
                        <div class="media-body">
                            <h5 class="mt-0">留言區</h5>
                            <!--表單 textarea-->
                            <form action="{{route('comment.create')}}" method="post">
                                @csrf <!-- Laravel's built-in CSRF protection -->
                                <div class="form-group">
                                    <input name="recipe_id" value="" style="display:none"/>
                                    <textarea class="form-control" rows="3" name="content"></textarea>
                                    <!--讓 button 滿版寬使用 .btn-block-->
                                    <button class="btn btn-success btn-block mt-3">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- media object-->
                    {{--                            @foreach($comments as $comment)--}}
                    <div class="media my-3">
                        <img src="https://randomuser.me/api/portraits/lego/2.jpg" class="mr-3" alt="..." width="64" height="64">
                        <div class="media-body">
                            <ul>
                                @foreach ($comments as $comment)
                                    <li>
                                        {{ $comment->content }}
{{--                                        @if ($comment->childComments()->count() > 0)--}}
{{--                                            @include('comment.replies', ['comments' => $comment->childComments])--}}
{{--                                        @endif--}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{--                            @endforeach--}}
                </div>
            </div>


        </div>
    </section>
@endsection
