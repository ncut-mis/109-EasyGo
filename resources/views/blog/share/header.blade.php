<!-- Header -->
<header class="py-4">
    <div class="container px-lg-5">
        <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($topRecipes as $key => $topRecipe)
                        @foreach($topRecipe->recipeImgs as $index => $recipeImg)
                            <!--第一個項目（索引值為零的）在幻燈片中設為預設顯示（具有 active 類別）-->
                            <div class="carousel-item @if($key === 0 && $index === 0) active @endif">
                                <img src="{{ asset('img/recipe/'.$recipeImg->picture) }}" class="d-block w-100">
                                <a href="{{route('members.recipes.show',$topRecipe->id)}}" class="stretched-link"></a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>
