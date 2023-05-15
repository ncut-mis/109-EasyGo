@section('page-title', '食譜編輯')
<div>

        <div class="container px-5 my-5 ">
            <div class="row gx-3">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">食譜基本資料</h1>
                    <div class="mb-3">
                        <!--食譜名稱-->
                        <div class="mb-3">
                            <label class="form-label" for="name">食譜名稱</label>
                            <input  wire:model="name" id="name" type="text" class="form-control" placeholder="請輸入食譜名稱" value="{{$recipe->name}}">
                        </div>

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

                        <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                        <!--食譜封面-->
                        <div class="mb-3">
                            <label for="images">食譜封面</label>
                            <div>
                                @foreach ($recipeImages as $recipeImg)
                                    <img src="{{ asset('img/recipe/' . $recipeImg->picture) }}" width="350px" height="350px">
                                    <a herf="#" wire:click.prevent="deleteRecipeImg({{ $recipeImg->id }})"><i class="fa fa-times text-danger
                                    mr-2"></i></a>
                                @endforeach
                            </div>

                            <input type="file" class="form-control" wire:model="images" id="images" name="images[]" accept="image/*" multiple>
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
                            <label for="videos">食譜影片</label>
                            <div>
                                @foreach ($recipeVideos as $recipeVideo)
                                    <video src="{{ asset('video/' . $recipeVideo->film) }}" autoplay controls muted  width="40%" height="350"></video>
                                    <a href="#" wire:click.prevent="deleteRecipeVideo({{ $recipeVideo->id }})"><i class="fa fa-times text-danger mr-2"></i></a>
                                @endforeach
                            </div>

                            <input type="file" class="form-control"  wire:model="videos" id="videos" name="videos[]" accept="video/*" multiple>
                            <div wire:loading wire:target="videos">Uploading...</div>
                            <div wire:loading.remove>
                                @if ($videos)
                                    <div>
                                        @foreach($videos as $index => $video)
                                            <div class="mb-2">
                                                <video src="{{ $video->temporaryUrl() }}" autoplay controls muted width="40%" height="350"></video>
                                                <a href="#" wire:click.prevent="deleteUploadVideo({{ $index }})"><i class="fa fa-times text-danger mr-2"></i></a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary btn-lg">儲存</button>
                    </div>
                </form>
                    <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                <!--食材-->
                <form wire:submit.prevent="IngredientUpdate" >
                <div class="mb-3">
                    <h1 class="fw-bolder mb-1">食材<button type="button" class="btn btn-lg"  wire:click="addList">+</button></h1>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">名稱</th>
                            <th scope="col">建議</th>
                            <th scope="col">數量</th>
                            <th scope="col"> </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($ingredients as $index => $ingredient)
                            <tr>
                                <td><input type="text" class="form-control" wire:model="ingredients.{{ $index }}.name"></td>
                                <td><input type="text" class="form-control" wire:model="ingredients.{{ $index }}.remark"></td>
                                <td><input type="text" class="form-control" wire:model="ingredients.{{ $index }}.quantity"></td>
                                <td><button type="button" class="btn btn-lg" wire:click="removeList({{ $index }})"><img src="{{ asset('img/garbage.png') }}" width="30" height="30"></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary btn-lg">儲存</button>
                    </div>
                </form>

                <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                    <!--步驟-->
                    @if(session('message2'))
                        <div class="alert alert-success">
                            {{ session('message2') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="StepUpdate" enctype="multipart/form-data">
                    <div class="mb-3">
                        <h1 class="fw-bolder mb-2">步驟<button type="button" class="btn btn-lg" wire:click="addStep">+</button></h1>
                            @foreach ($steps as $index => $step)
                            <div class="card w-80 mb-3 step">
                                <div class="row g-0" >

                                    @if($step['picture'])
                                        <div class="col-md-4">
                                            <div wire:loading.remove>
                                                @if (!is_null($steps[$index]['picture']) && $steps[$index]['picture'] instanceof \Illuminate\Http\UploadedFile)
                                                    <img src="{{ $steps[$index]['picture']->temporaryUrl() }}" alt="Step {{ $step['sequence'] }} picture" width="370px" height="350px">
                                                @elseif(is_null($steps[$index]['picture']) || $step['picture'])
                                                    <img src="{{ asset('img/step/' . $step['picture']) }}" alt="Step {{ $step['sequence'] }} picture" width="370px" height="350px">
{{--                                                    <a href="#" wire:click.prevent="deleteStepImg({{ $step['id'] }})"><i class="fa fa-times text-danger mr-2"></i></a>--}}
                                                @endif
                                            </div>
                                            <div wire:loading wire:target="steps.{{ $index }}.picture">Uploading...</div>
                                            <input type="file" class="form-control" wire:model="steps.{{ $index }}.picture" id="picture_{{ $step['id'] }}" name="picture_{{ $step['id'] }}" accept="image/*">
                                        </div>
                                    @else
                                        <div class="row col-md-4 align-items-center">
                                            <h1 class="card-title text-secondary">目前無照片</h1>

                                            <div wire:loading.remove>
                                                @if (!is_null($steps[$index]['picture']) && $steps[$index]['picture'] instanceof \Illuminate\Http\UploadedFile)
                                                    <img src="{{ $steps[$index]['picture']->temporaryUrl() }}" alt="Step {{ $step['sequence'] }} picture" width="370px" height="350px">
                                                @endif
                                            </div>
                                            <div wire:loading wire:target="steps.{{ $index }}.picture">Uploading...</div>
                                            <input type="file" class="form-control" wire:model="steps.{{ $index }}.picture" id="picture_{{ $step['id'] }}" name="picture_{{ $step['id'] }}" accept="image/*">
                                        </div>
                                    @endif


                                    <div class="col-md-8">
                                        <div class="card-body mb-3">
                                            <h2 class="card-title mb-6">
                                                <span>步驟{{ $step['sequence'] }}</span>
                                                <button type="button" class="btn btn-lg" wire:click="removeStep({{ $loop->index }})"><img src="{{ asset('img/garbage.png') }}" width="30" height="30"></button>

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

                                </div>

                            </div>
                        @endforeach
                    </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary btn-lg">儲存</button>
                            <a href="{{route('members.recipes.index')}}" type="submit" class="btn btn-secondary btn-lg">回列表</a>
                        </div>
                    </form>

            </div>

        </div>
</div>
