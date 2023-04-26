@extends('layouts.master')
@section('title','EasyGo')
@section('content')

    @if($recipes->isNotEmpty())<!--搜尋到相關資料-->
    <!--內容-->
    <div class=" px-lg-5" id="nav-tabContent">
        <!--陣列內有幾筆資料就會重複執行幾次-->
        <div class="tab-pane fade show active " id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
            <section class="pt-4">
                <div class="container px-lg-5">
                    <!-- Page Features-->
                    <div class="row gx-lg-5  px-lg-5">

                        @foreach($recipes as $recipe)
                            <div class="col-lg-6 col-xxl-4 mb-5 pt-5">
                                <div class="card bg-light border-0 h-100 ">
                                    <!--圖片-->
                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($recipe->recipeImgs as $recipeImg)
                                                <div class="carousel-item active">
                                                    <img src="{{asset('img/recipe/'.$recipeImg->picture)}}" width="350" height="250">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="card-body text-center p-lg-5  pt-lg-0 pt-5">
                                        <h2 class="fs-4 fw-bold pt-5">{{$recipe->name}}</h2>
                                        <p class="mb-0">{{$recipe->text}}</p>
                                        <a href="{{route('members.recipes.show',$recipe->id)}}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        </div>
        @else<!--無搜尋到相關資料-->
        <div class="p-lg-5  pt-lg-0 pt-5">
        <div class="fs-4 fw-bold pt-5">
{{--            <div class="position-absolute top-50 start-50 translate-middle">--}}
            <h2>查無資料，請重新查詢.</h2>

        </div>
        </div>
    @endif

@endsection
