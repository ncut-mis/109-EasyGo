@section('page-title', '食譜編輯')
<div>
    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="container px-5 my-5 ">
            <div class="row gx-3">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                    <!-- Post title-->
                    <div class="mb-3">
                        <!--食譜名稱-->
                        <div class="mb-3">
                            <label class="form-label" for="name">食譜名稱</label>
                            <!--回傳時會把name包裝成key，填入的內容包裝成value-->
                            <input  wire:model="name" id="name" type="text" class="form-control" placeholder="請輸入食譜名稱" value="{{$recipe->name}}">
                        </div>

                        <!--食譜封面-->
                        <div class="mb-3">
                            <label class="form-label" for="images">食譜封面</label>
                            <div class="carousel-inner">
                                @foreach ($recipeImages as $recipeImg)
                                    <img src="{{ asset('img/recipe/' . $recipeImg->picture) }}" width="350px" height="350px">
                                    <a herf="#" wire:click.prevent="deleteRecipeImg({{ $recipeImg->id }})"><i class="fa fa-times text-danger
                                    mr-2"></i></a>
                                @endforeach
                            </div>

                            <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                            <input type="file" class="form-control" wire:model="images" multiple>
                            <div wire:loading wire:target="images">Uploading...</div>
                            <div wire:loading.remove>
                            @if ($images)
                                <div>
                                    @foreach($images as $index => $image)
                                        <img src="{{ $image->temporaryUrl() }}" width="350px" height="350px">
                                        <a herf="#" wire:click.prevent="deleteUploadImg({{ $index }})"><i class="fa fa-times text-danger
                                    mr-2"></i></a>
                                    @endforeach
                                </div>
                            @endif
                            </div>

                        </div>

                        <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                        <!--食譜影片-->
                        <div class="mb-3">
                            <label class="form-label" for="videos">食譜影片</label>
                            <div class="carousel-inner">
                                @foreach ($recipeVideos as $recipeVideo)
                                    <video src="{{ asset('video/' . $recipeVideo->film) }}" controls  width="40%" height="350"></video>
                                    <a href="#" wire:click.prevent="deleteRecipeVideo({{ $recipeVideo->id }})"><i class="fa fa-times text-danger mr-2"></i></a>
                                @endforeach
                            </div>

                            <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

{{--                            <input type="file" class="form-control" wire:model="videos" multiple>--}}
{{--                            <div wire:loading wire:target="videos">Uploading...</div>--}}
{{--                            <div wire:loading.remove>--}}
{{--                                @if ($videos)--}}
{{--                                    <div>--}}
{{--                                        @foreach($videos as $index => $video)--}}
{{--                                            <video src="{{$video->temporaryUrl() }}" controls width="350px" height="350px"></video>--}}

{{--                                            <a herf="#" wire:click.prevent="deleteUploadVideo({{ $index }})"><i class="fa fa-times text-danger--}}
{{--                                    mr-2"></i></a>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            </div>--}}
                            <input type="file" class="form-control" wire:model="videos" controls multiple>
                            <div wire:loading wire:target="videos">Uploading...</div>
                            <div wire:loading.remove>
                                @if ($videos)
                                    <div>
                                        @foreach($videos as $index => $video)
                                            <div class="mb-2">
                                                <video src="{{ $video->temporaryUrl() }}" controls width="100%"></video>
                                                <a href="#" wire:click.prevent="deleteUploadVideo({{ $index }})"><i class="fa fa-times text-danger mr-2"></i></a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                        </div>

                        <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                        <!--食譜類別-->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">食譜類別</label>
                            <div class="form-group">
                                <select class="form-select" aria-label="Default select example" wire:model="recipe_category_id" name="recipe_category_id" id="recipe_category_id">
                                    @foreach ($recipe_categories as $recipe_category)
                                        <!--顯示目前設定的食譜類別，並可選擇其他類別-->
                                        <option value="{{ $recipe_category->id }}" {{ $recipe->recipe_category_id == $recipe_category->id ? 'selected' : '' }}>{{ $recipe_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--食譜是否上架-->
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">是否上架</label>
                            @if($recipe->status == 1)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="status" name="status" id="status" value="1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">是</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"  wire:model="status" name="status" id="status" value="0">
                                    <label class="form-check-label" for="flexRadioDefault2">否</label>
                                </div>
                            @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="status" name="status" id="status" value="1">
                                    <label class="form-check-label" for="flexRadioDefault1">是</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="status" name="status" id="status" value="0" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">否</label>
                                </div>
                            @endif

                        </div>

                        <!--食譜簡介-->
                        <div class="mb-3">
                            <label for="text" class="form-label">食譜簡介</label>
                            <textarea wire:model="text" id="text" class="form-control" rows="4" placeholder="請輸入食譜簡介">{{$recipe->text}}</textarea><!--多行輸入框-->
                        </div>

                    </div>

                <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                <!--食材-->
                <div class="mb-3">
                    <h1 class="fw-bolder mb-1">食材<button type="button" class="btn btn-lg">+</button></h1>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">名稱</th>
                            <th scope="col">建議</th>
                            <th scope="col">數量</th>
                            <th scope="col"> </th>
                        </tr>
                        </thead>

                        @foreach($recipe->ingredients as $ingredient)
                            <tbody>
                            <tr>
                                <td><input name="ingredient" id="ingredient" type="text" class="form-control" placeholder="請輸入食材名稱" value="{{$ingredient->name}}"></td>
                                <td><input name="remark" id="remark" type="text" class="form-control" value="{{$ingredient->remark}}"></td>
                                <td><input name="quantity" id="quantity" type="text" class="form-control" value="{{$ingredient->quantity}}"></td>
                                <td><button type="button" class="btn btn-lg">－</button></td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

                <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                    <!--步驟-->
                    <div class="mb-3">
                        <h1 class="fw-bolder mb-2">步驟<button type="button" class="btn btn-lg" wire:click="addStep">+</button></h1>
                            @foreach ($steps as $index => $step)
                            <div class="card w-80 mb-3 step">
                                <div class="row g-0">
{{--                                    <div class="col-md-4">--}}
{{--                                        <label for="picture_{{ $index }}">Upload picture:</label>--}}
{{--                                        <input type="file" id="picture_{{ $index }}" wire:model="steps.{{ $index }}.picture" class="form-control">--}}
{{--                                        <div wire:loading wire:target="steps.{{ $index }}.picture">Uploading...</div>--}}
{{--                                        <div wire:ignore>--}}
{{--                                            @if ($step['picture'])--}}
{{--                                                <img src="{{ $step['picture']->temporaryUrl() }}" alt="Step {{ $step['sequence'] }} picture" width="350px" height="350px">--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    @if($step['picture'])
                                        <div class="col-md-4">
                                            <img class="d-block" src="{{asset('img/step/'. $step['picture'] )}}" alt="Step {{ $step['sequence'] }} picture" width="406px" height="290px">
                                            <a href="#" wire:click.prevent="deleteStepImg({{ $step['id'] }})"><i class="fa fa-times text-danger mr-2"></i></a>

                                            <div class="navbar-fixed-bottom"></div>

                                        </div>
                                    @else
                                        <div class="row col-md-4 align-items-center">
                                            <h1 class="card-title text-secondary">目前無照片</h1>
                                            <div class="navbar-fixed-bottom">
{{--                                                <input type="file" wire:model="steps.{{ $loop->index }}.picture" class="form-control">--}}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-8">
                                        <div class="card-body mb-3">
                                            <h2 class="card-title mb-6">
                                                <span>步驟{{ $step['sequence'] }}</span>
                                                <button type="button" class="btn btn-lg" wire:click="removeStep({{ $loop->index }})"><img src="{{ asset('img/garbage.png') }}" width="30" height="30"></button>

{{--                                                <img src="../img/login.png" class="mr-3" alt="..." width="600" height="300">--}}


                                            @if ($loop->index  > 0)
                                                    <button class="btn btn-lg" wire:click="moveStepUp({{ $loop->index }})">▲</button>
                                                @endif
                                                @if ($loop->index  < count($steps) - 1)
                                                    <button class="btn btn-lg" wire:click="moveStepDown({{ $loop->index }})">▼</button>
                                                @endif
                                            </h2>
                                            <textarea class="form-control" rows="7" wire:model="steps.{{ $loop->index }}.text"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
{{--                                        <label for="picture_{{ $step['id'] }}">Upload picture:</label>--}}
                                        <input type="file"  wire:model="steps.{{ $index }}.picture" class="form-control">
{{--                                        <div wire:loading wire:target="steps.{{ $index }}.picture">Uploading...</div>--}}
{{--                                        <div wire:ignore>--}}
{{--                                            @if ($step['picture'])--}}
{{--                                                <img src="{{ $step['picture']->temporaryUrl() }}" alt="Step {{ $step['sequence'] }} picture" width="350px" height="350px">--}}
{{--                                                <a href="#" wire:click.prevent="deleteStepImg({{ $step['id'] }})"><i class="fa fa-times text-danger mr-2"></i></a>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
                                    </div>

                                </div>

                            </div>
                        @endforeach
                    </div>

            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary btn-lg">儲存</button>
                <button type="button" class="btn btn-danger btn-lg">取消</button>
            </div>

        </div>
    </form>
</div>
