@extends('members.layouts.master')

@section('page-title', '食譜編輯')

@section('content')

    <section class="py-0">
        <div class="container px-5 my-5 ">
        <div class="row gx-3">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{route('bloggers.recipes.update',$recipe->id)}}" method="POST" style="display: inline-block" enctype="multipart/form-data">
                @method('patch')
                @csrf

                <!-- Post title-->
                <div class="mb-3">
                    <!--食譜名稱-->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">食譜名稱</label>
                        <!--回傳時會把name包裝成key，填入的內容包裝成value-->
                        <input name="name" id="name" type="text" class="form-control" placeholder="請輸入食譜名稱" value="{{$recipe->name}}">
                    </div>

                    <!--食譜封面-->
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">食譜封面</label>
                        <!--輪播圖片-->
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($recipe->recipeImgs as $key=> $recipeImg)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{asset('img/recipe/'.$recipeImg->picture)}}" width="1250" height="850">
                                        <button class="btn delete-btn btn-danger" style="position: absolute; top: 0; right: 0; z-index: 1;">&times;</button>
                                    </div>
                                @endforeach

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                            <!--上傳圖片-->
                            <div>
                                <label for="images"></label>
                                <input type="file" id="images" name="images[]" class="custom-file-input form-control" multiple>
                            </div>
                            <div id="preview-img"></div>

                        </div>
                    </div>

                    <!--食譜影片-->
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">食譜影片</label>
                        <!--輪播影片-->
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($recipe->recipeFilms as $key=> $recipeFilm)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <video src="{{asset('video/'.$recipeFilm->film)}}" width="1250" height="740" controls></video>
                                        <button class="btn delete-btn btn-danger" style="position: absolute; top: 0; right: 0; z-index: 1;">刪除</button>
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

                            <!--上傳影片-->
                            <div>
                                <label for="videos"></label>
                                <input type="file" id="videos" name="videos[]" class="custom-file-input form-control" >
                            </div>

                            <div>
                                <video id="preview-video" controls>
                                    <source id="source" src="" type="video/mp4">
                                </video>
                            </div>


{{--                            <div>--}}
{{--                                <label for="films"></label>--}}
{{--                                <input type="file" id="films" name="films[]" class="custom-file-input form-control" multiple>--}}
{{--                            </div>--}}
{{--                            <div id="preview-film"></div>--}}
                        </div>
                    </div>

                    <!--食譜類別-->
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">食譜類別</label>
                        <div class="form-group">
                            <select class="form-select" aria-label="Default select example" name="recipe_category_id" id="recipe_category_id">
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
                                <input class="form-check-input" type="radio" name="status" id="status" value="1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status" value="0">
                                <label class="form-check-label" for="flexRadioDefault2">否</label>
                            </div>
                        @else
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status" value="1">
                                <label class="form-check-label" for="flexRadioDefault1">是</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status" value="0" checked>
                                <label class="form-check-label" for="flexRadioDefault2">否</label>
                            </div>
                        @endif

                    </div>

                    <!--食譜簡介-->
                    <div class="mb-3">
                        <label for="recipe_text" class="form-label">食譜簡介</label>
                        <textarea name="recipe_text" id="recipe_text" class="form-control" rows="4" placeholder="請輸入食譜簡介">{{$recipe->text}}</textarea><!--多行輸入框-->
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary btn-sm">儲存</button>
                        <button type="button" class="btn btn-danger btn-sm">取消</button>
                    </div>

                </div>
            </form>
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

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary btn-sm">儲存</button>
                        <button type="button" class="btn btn-danger btn-sm">取消</button>
                    </div>

                </div>

                <hr style="border-top: 3px solid #ccc; margin-top: 20px; margin-bottom: 20px;">

                <!--步驟-->
                <div class="mb-3">
                    <h1 class="fw-bolder mb-2">步驟<button type="button" class="btn btn-lg">+</button></h1>
                    @foreach ($recipe->recipeSteps as $recipeStep)
                        <div class="card w-80 mb-3">
                            <div class="row g-0">
                                @if($recipeStep->picture!=null)
                                    <div class="col-md-4">
                                        <img class="d-block w-100" src="{{asset('img/step/'.$recipeStep->picture)}}" alt="...">
                                        <div class="navbar-fixed-bottom">
                                            <input type="file" name="stepimage" id="stepimage" accept="image/*" class="form-control">
                                        </div>
                                    </div>
                                @else
                                    <div class="row col-md-4 align-items-center">
                                        <h1 class="card-title text-secondary">目前無照片</h1>
                                        <div class="navbar-fixed-bottom">
                                            <input type="file" name="stepimage" id="stepimage" accept="image/*" class="form-control">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-8">
                                    <div class="card-body mb-3">
                                        <h2 class="card-title mb-6">步驟{{$recipeStep->sequence}}<button type="button" class="btn btn-lg">－</button></h2>
                                        <textarea name="step_text" id="step_text" class="form-control" rows="7" placeholder="">{{$recipeStep->text}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary btn-sm">儲存</button>
                        <button type="button" class="btn btn-danger btn-sm">取消</button>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- JavaScript 預覽圖片 -->
    <script>
        function previewImages() {
            var preview = document.querySelector('#preview-img');
            var images = document.querySelector('#images').files;

            function readAndPreview(image) {
                if ( /\.(jpe?g|png|gif)$/i.test(image.name) ) {
                    var reader = new FileReader();

                    reader.addEventListener("load", function () {
                        var imageElement = document.createElement("img");
                        imageElement.src = this.result;
                        preview.appendChild(imageElement);
                    }, false);

                    reader.readAsDataURL(image);
                }
            }

            if (images) {
                [].forEach.call(images, readAndPreview);
            }
        }

        // 載入時顯示已經上傳的圖片
        window.addEventListener('load', function() {
            previewImages();
        });

        // 上傳時預覽圖片
        document.querySelector('#images').addEventListener('change', function() {
            previewImages();
        });

        //影片
        // function previewVideo(event) {
        //     var input = event.target;
        //     var preview = document.getElementById('preview-film');
        //     var source = document.getElementById('source');
        //     var reader = new FileReader();
        //
        //     reader.onload = function() {
        //         preview.style.display = 'block';
        //         source.src = reader.result;
        //         preview.load();
        //     }
        //
        //     reader.readAsDataURL(input.files[0]);
        // }
        function previewVideos() {
            var preview = document.querySelector('#preview-video');
            var source = document.getElementById('source');
            var videos = document.querySelector('#videos').files;

            function readAndPreview(video) {
                if ( /\.(mp4?|mp3)$/i.test(video.name) ) {
                    var reader = new FileReader();

                    reader.addEventListener("load", function () {
                        var videoElement = document.createElement("video");
                        videoElement.src = this.result;
                        preview.appendChild(videoElement);
                    }, false);

                    reader.readAsDataURL(video);
                }
            }

            if (videos) {
                [].forEach.call(videos, readAndPreview);
            }
        }

        reader.onload = function() {
            preview.style.display = 'block';
            source.src = reader.result;
            preview.load();
        }

        reader.readAsDataURL(input.files[0]);


    </script>

@endsection

