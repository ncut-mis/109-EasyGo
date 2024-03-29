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
                    @if(session('message1'))
                        <div class="alert alert-success">
                            {{ session('message1') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                <form wire:submit.prevent="IngredientUpdate" >
                <div class="mb-3">
                    <h1 class="fw-bolder mb-1">食材<button type="button" class="btn btn-lg"  wire:click="addList">+</button></h1>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">名稱*</th>
                            <th scope="col"> </th>
                            <th scope="col">建議商品(可勾選)</th>
                            <th scope="col">用量*</th>
                            <th scope="col"> </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($ingredients as $index => $ingredient)
                            <tr>

                                <td>
                                    <div class="form-group">
                                        <select class="form-select" aria-label="ingredient-{{ $index }}" wire:model="ingredients.{{ $index }}.category_id" wire:change="selectCategory({{ $index }}, $event.target.value)">
                                            <option selected value="">食材庫</option>
                                            @foreach ($categories as $category)
                                                {{--類別第一階--}}
                                                @if ($category->category_id === null)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @foreach ($categories as $child)
                                                        {{--類別第二階--}}
                                                        @if ($child->category_id === $category->id)
                                                            <option value="{{ $child->id }}">- {{ $child->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>

                                <td>
                                    @if ($showInput[$index])
                                        <input type="text" class="form-control" wire:model="ingredients.{{ $index }}.name" placeholder="輸入食材名稱">
                                    @endif
                                </td>

                                {{--建議--}}
                                <td>
                                    {{--新增按鈕--}}
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-lg" wire:click="addSuggest({{ $index }})"><h5>+賣場商品</h5></button>
                                    </div>
                                    @foreach ($ingredient['suggests'] as $key=> $suggest)
                                        <div class="form-check">
                                            {{--多選--}}
                                            <input class="form-check-input" type="checkbox" value="1" name="recommend[{{ $index }}][{{ $key }}]" id="recommend_{{ $index }}_{{ $key }}" wire:model="ingredients.{{ $index }}.suggests.{{ $key }}.recommend">

                                            <label class="form-check-label" for="productStatus">
                                                <div class="form-group">
                                                    <select class="form-select"  aria-label="suggest-{{ $key }}" wire:model="ingredients.{{ $index }}.suggests.{{ $key }}.product_id" wire:change="selectSuggest({{ $index }}, {{ $key }}, $event.target.value)">
                                                        <option selected value="">賣場品牌</option>
                                                        @foreach ($products as $product)
                                                            {{--如果有選擇食材類別(名稱)及商品的category_id和所選的一致，且為上架商品，商品庫存>0--}}
                                                            @if (isset($ingredient['category_id']) && $product->category_id == $ingredient['category_id'] && $product->status ==1 && $product->stock >0)
                                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </label>

                                            {{--購買數量--}}
                                            @if (isset($ingredient['suggests'][$key]['product_id']))
                                                @php
                                                    $Max = $this->getMaxQuantity($key, $index);
                                                @endphp
                                                <input type="number" name="quantity" step="1" min="1" max="{{ $Max }}" wire:model="ingredients.{{ $index }}.suggests.{{ $key }}.quantity" value="1">
                                            @endif

                                            {{--刪除按鈕--}}
                                            <button type="button" class="btn btn-lg" wire:click="delSuggest({{ $index }}, {{ $key }})"><img src="{{ asset('img/garbage.png') }}" width="25" height="25"></button>

                                            {{--之前新增資料時該商品未下架，但日後下架問題--}}
                                            @if (isset($ingredient['suggests'][$key]['product_id']))
                                                @php
                                                    $productId = $ingredient['suggests'][$key]['product_id'];
                                                    //回DB找尋商品事否上架
                                                    $status = \App\Models\Product::where('id', $productId)->value('status');
                                                @endphp

                                                @if ($status === 0)
                                                    *此商品已下架!
                                                @endif
                                            @endif

                                        </div>
                                    @endforeach

                                    {{--自行輸入--}}
                                    <div class="mb-3">
                                        <input type="text" class="form-control" wire:model="ingredients.{{ $index }}.remark" placeholder="自行輸入建議商品">
                                    </div>
                                </td>

                                <td><input type="text" class="form-control" wire:model="ingredients.{{ $index }}.quantity" placeholder="ex：?/單位"></td>
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

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary btn-lg">儲存</button>
                                @if( Auth::user()->type==1)
                                    <a href="{{route('members.recipes.index')}}" class="btn btn-secondary btn-lg">回列表</a>
                                @else
                                    <a href="{{route('admins.recipes.index')}}" class="btn btn-secondary btn-lg">回列表</a>
                                @endif
                            </div>
                        </div>
                    </form>

            </div>

        </div>
</div>
