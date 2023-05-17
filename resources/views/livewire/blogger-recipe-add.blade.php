@section('page-title', '其他資料')
<div>

        <div class="container px-5 my-5 ">
            <div class="row gx-3">

                    <!--食譜資料-->
                    <div class="mb-3">
                        <h4>食譜名稱：{{ $recipe->name }}</h4>
                        <h4>食譜簡介：{{ $recipe->text }}</h4>
                        <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">
                    </div>

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

                <form wire:submit.prevent="IngredientSave" >
                <div class="mb-3">
                    <h1 class="fw-bolder mb-1">食材<button type="button" class="btn btn-lg"  wire:click="addList">+</button></h1>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">名稱*</th>
                            <th scope="col"> </th>
                            <th scope="col">建議</th>
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
                                            <option value="">食材庫</option>
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
                                <td><input type="text" class="form-control" wire:model="ingredients.{{ $index }}.remark"></td>
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

                    <form wire:submit.prevent="stepSave" enctype="multipart/form-data">
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
                        </div>
                    </form>
                <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">


                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                    <!--食譜封面影片上傳-->
                    @if(!$isSaved)
                        <form wire:submit.prevent="add" enctype="multipart/form-data">

                            <!--食譜封面-->
                            <div class="mb-3">
                                <label for="images">食譜封面</label>

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
                                <a href="{{route('members.recipes.index')}}" type="submit" class="btn btn-secondary btn-lg">回列表</a>
                            </div>
                        </form>
                    @endif

            </div>

        </div>
</div>
